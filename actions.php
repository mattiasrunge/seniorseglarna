<?php

require_once("config.php");
require_once("helpers.php");

function Action_FindMember($username, $password)
{
  global $gDatabase;

  $query = "SELECT * FROM `members` WHERE `username` = '" . $username . "' AND `password` = '" . sha1($password) . "'";

  if (($result = $gDatabase->query($query)) === false)
  {
    throw new Exception($gDatabase->error . ": " . $query);
  }

  while ($member = $result->fetch_assoc())
  {
    unset($member["password"]);

    $member["admin"] = !empty($member["admin"]);

    return $member;
  }

  return false;
}

function Action_CheckAccess($action, $collection)
{
  $access = array();

  $access["members"] = array("all" => false, "user" => "read", "admin" => "delete");
  $access["news"] = array("all" => "read", "user" => "read", "admin" => "delete");
  $access["program"] = array("all" => "read", "user" => "read", "admin" => "delete");
  $access["texts"] = array("all" => "read", "user" => "read", "admin" => "delete");
  $access["protocols"] = array("all" => "read", "user" => "read", "admin" => "delete");
  $access["guestbook"] = array("all" => "write", "user" => "write", "admin" => "delete");
  $access["forumCategories"] = array("all" => "read", "user" => "read", "admin" => "delete");
  $access["forumThreads"] = array("all" => "read", "user" => "write", "admin" => "delete");
  $access["forumEntries"] = array("all" => "read", "user" => "write", "admin" => "delete");

  if (!isset($access[$collection]))
  {
    return false;
  }

  $type = "all";

  if (isset($_SESSION["user"]))
  {
    $type = "user";

    if ($_SESSION["user"]["admin"])
    {
      $type = "admin";
    }
  }

  if ($access[$collection][$type] === "delete")
  {
    return true;
  }
  if ($access[$collection][$type] === "write" && ($action === "write" || $action === "read"))
  {
    return true;
  }
  else if ($access[$collection][$type] === "read" && $action === "read")
  {
    return true;
  }

  return false;
}

function Action_Save($item, $collection)
{
  global $gDatabase;

  if (!Action_CheckAccess("write", $collection))
  {
    throw new Exception("Collection is not accessable");
  }

  if (isset($item["_id"]))
  {
    $sqlQuery = "UPDATE `" . $gDatabase->real_escape_string($collection) . "` SET";

    $set = array();

    $item["timestamp"] = mktime();
    $item["_who"] = isset($_SESSION["user"]) ? $_SESSION["user"]["_id"] : 0;

    foreach ($item as $key => $value)
    {
      if ($key === "_id")
      {
        continue;
      }

      $set[] = "`" . $gDatabase->real_escape_string($key) . "` = '" . $gDatabase->real_escape_string($value) . "'";
    }

    $sqlQuery .= " " . implode(", ", $set) . " WHERE `_id` = " . $gDatabase->real_escape_string($item["_id"]);

    Helper_RunQuery($sqlQuery);

    return $item;
  }

  $sqlQuery = "INSERT INTO `" . $gDatabase->real_escape_string($collection) . "`";

  $keys = array();
  $values = array();

  $item["timestamp"] = mktime();
  $item["_who"] = isset($_SESSION["user"]) ? $_SESSION["user"]["_id"] : 0;

  foreach ($item as $key => $value)
  {
    $keys[] = "`" . $gDatabase->real_escape_string($key) . "`";
    $values[] = "'" . $gDatabase->real_escape_string($value) . "'";
  }

  $sqlQuery .= " (" . implode(", ", $keys) . ") VALUES (" . implode(", ", $values) . ")";

  Helper_RunQuery($sqlQuery);

  $item["_id"] = $gDatabase->insert_id;

  return $item;
}

function Action_Delete($item, $collection)
{
  global $gDatabase;
  $documents = array();

  if (!Action_CheckAccess("delete", $collection))
  {
    throw new Exception("Collection is not accessable");
  }

  $sqlQuery = "DELETE FROM `" . $gDatabase->real_escape_string($collection) . "` WHERE `_id` = '" . $item["_id"] . "'";

  if (($result = $gDatabase->query($sqlQuery)) === FALSE)
  {
    throw new Exception($gDatabase->error . ": " . $sqlQuery);
  }
}

function Action_Find($query, $options)
{
  global $gDatabase;
  $documents = array();

  $collection = false;
  $limit = false;
  $order = false;

  if (is_array($options))
  {
    $limit = isset($options["limit"]) ? $options["limit"] : false;
    $order = isset($options["sort"]) ? $options["sort"] : false;
    $collection = isset($options["collection"]) ? $options["collection"] : false;
  }
  else
  {
    $collection = $options;
  }

  if (!Action_CheckAccess("read", $collection))
  {
    throw new Exception("Collection is not accessable");
  }

  $sqlQuery = "SELECT * FROM `" . $gDatabase->real_escape_string($collection) . "`";

  if (is_array($query))
  {
    $where = array();

    foreach ($query as $key => $value)
    {
      if ($key !== "timestamp" && $key[0] !== "_")
      {
        $where[] = "`" . $gDatabase->real_escape_string($key) . "` LIKE '" . $gDatabase->real_escape_string($value) . "'";
      }
      else
      {
        $where[] = "`" . $gDatabase->real_escape_string($key) . "` = " . $gDatabase->real_escape_string($value);
      }
    }

    $sqlQuery .= " WHERE " . implode(" AND ", $where);
  }

  if ($order !== false)
  {
    $sqlQuery .= " ORDER BY `" . $gDatabase->real_escape_string($order) . "` DESC";
  }

  if ($limit !== false)
  {
    $sqlQuery .= " LIMIT " . $gDatabase->real_escape_string( $limit);
  }

  if (($result = $gDatabase->query($sqlQuery)) === FALSE)
  {
    throw new Exception($gDatabase->error . ": " . $sqlQuery);
  }

  while ($doc = $result->fetch_assoc())
  {
    if (isset($doc["password"]))
    {
      unset($doc["password"]);
    }

    if (isset($doc["admin"]))
    {
      $doc["admin"] = !empty($doc["admin"]);
    }

    $documents[$doc["_id"]] = $doc;
  }

  return $documents;
}

function Action_GetWhoName($id)
{
  global $gDatabase;
  $members = array();

  $query = "SELECT `name` FROM `members` WHERE `_id` = " . $id;

  if (($result = $gDatabase->query($query)) === FALSE)
  {
    throw new Exception($gDatabase->error . ": " . $query);
  }

  while ($member = $result->fetch_assoc())
  {
    return $member["name"];
  }

  return "";
}

?>