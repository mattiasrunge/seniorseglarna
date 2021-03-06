<?php

require_once("config.php");
require_once("helpers.php");

function Action_GetList($id)
{
  $out = file_get_contents("https://www.googleapis.com/drive/v3/files?q=%27" . $id . "%27+in+parents&key=AIzaSyAzTGs7-CapqJw6sHT67vDhNfJ0TPu6LL8");

  if ($html === false)
  {
    throw new Exception("Laddningen misslyckades, ladda om sidan!");
  }

//   $out = utf8_decode($out);
  $json = json_decode($out);

  for ($i = 0; $i < count($json->files); $i++)
  {
    $item = $json->files[$i];

    $name = $item->name;
    $date = $name;
    $type = str_replace("application/vnd.google-apps.", "", $item->mimeType);

    $pos = strpos($name, ":");

    if ($pos !== false)
    {
        $date = trim(substr($name, 0, $pos));
        $name = trim(substr($name, $pos + 1));
    }

    $items[] = array("id" => $item->id, "name" => $name, "date" => $date, "type" => $type);
  }

  function cmp($a, $b)
  {
    if (strpos($a["date"], "-") === false || strpos($b["date"], "-") === false)
    {
      return strnatcasecmp($a["date"], $b["date"]);
    }

    return strnatcasecmp($b["date"], $a["date"]);
  }

  usort($items, "cmp");

  return $items;
}

function Action_GetList2($id)
{
  $html = file_get_contents("https://drive.google.com/folderview?id=" . $id);

  if ($html === false)
  {
    throw new Exception("Laddningen misslyckades, ladda om sidan!");
  }

  if (strpos($_SERVER["HTTP_HOST"], "seniorseglarna.se") !== false)
  {
    $html = utf8_decode($html);
  }

  $DOM = new DOMDocument;
  $DOM->loadHTML('<?xml encoding="UTF-8">' . $html);
  $DOM->encoding = 'UTF-8'; // insert proper

  $elements = $DOM->getElementsByTagName('script');

  $items = array();

  $id = false;
  $name = false;
  $type = false;
  $date = false;

  for ($i = 0; $i < $elements->length; $i++)
  {
    if (strpos($elements->item($i)->textContent, "_DRIVE_ivd") !== false)
    {
      $str = $elements->item($i)->textContent;

      $out = preg_replace_callback("(\\\\x([0-9a-f]{2}))i", function($a) {
        return chr(hexdec($a[1]));
      }, $str);

      $out = str_replace("window['_DRIVE_ivd'] = '", "", $out);

      $out = substr($out, 0, strpos($out, ";") - 1);
      $out = str_replace("\\n", "", $out);

      $json = json_decode($out);

      for ($c = 0; $c < count($json[0]); $c++)
      {
        $id = $json[0][$c][0];
        $name = $json[0][$c][2];
        $type = str_replace("application/vnd.google-apps.", "", $json[0][$c][3]);

        $date = $name;

        $pos = strpos($name, ":");

        if ($pos !== false)
        {
          $date = trim(substr($name, 0, $pos));
          $name = trim(substr($name, $pos + 1));
        }

        $items[] = array("id" => $id, "name" => $name, "date" => $date, "type" => $type);
      }

      break;
    }
  }

  function cmp($a, $b)
  {
    if (strpos($a["date"], "-") === false || strpos($b["date"], "-") === false)
    {
      return strnatcasecmp($a["date"], $b["date"]);
    }

    return strnatcasecmp($b["date"], $a["date"]);
  }

  usort($items, "cmp");

  return $items;
}

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
  $access["stories"] = array("all" => "read", "user" => "read", "admin" => "delete");

  if (!isset($access[$collection]))
  {
    return false;
  }

  $type = "all";

  if (isset($_SESSION["user"]))
  {
    $type = "user";

    if (!empty($_SESSION["user"]["admin"]))
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

function Action_SetPassword($user, $password)
{
  if (!isset($_SESSION["user"]))
  {
    throw new Exception("No logged in user, password change failed");
  }

  if ($_SESSION["user"]["_id"] !== $user["_id"] && !empty($_SESSION["user"]["admin"]))
  {
    throw new Exception("Only administrator can set password on user other than the user itself");
  }

  $sqlQuery = "UPDATE `members` SET `password` = SHA1('" . $password . "') WHERE `_id` = " . $user["_id"];

  Helper_RunQuery($sqlQuery);
}

function Action_Save($item, $collection)
{
  global $gDatabase;

  if (!Action_CheckAccess("write", $collection))
  {
    throw new Exception("Collection is not accessable, " . $collection);
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

  if ($collection != "guestbook")
  {
    $keys[] = "`password`";
    $values[] = "SHA1('seglare')";
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
