<?php

require_once("start.php");
require_once("config.php");
require_once("actions.php");

$gDatabase = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
$gDatabase->set_charset("utf8");

$response = array();

$event = $_REQUEST['event'];
$args = $_REQUEST;

try
{
  switch ($event)
  {
    case "getWhoName":
    {
      $response['data'] = Action_GetWhoName($args['_id']);
      break;
    }
    case "delete":
    {
      Action_Delete($args['item'], $args['collection']);
      break;
    }
    case "save":
    {
      $response['data'] = Action_Save($args['item'], $args['collection']);
      break;
    }
    case "find":
    {
      $response['data'] = Action_Find($args['query'], $args['options']);
      break;
    }
    case "logout":
    {
      unset($_SESSION['user']);
      break;
    }
    case "login":
    {
      if (empty($args['username']) || empty($args['password']))
      {
        $response['error'] = "Username or password is empty, login failed!";
        break;
      }

      $user = Action_FindMember($args['username'], $args['password']);

      if ($user === FALSE)
      {
        $response['error'] = "Inloggningen misslyckades.";
        break;
      }

      $_SESSION['user'] = $user;
      $response['data'] = $user;
      break;
    }
    case "changePassword":
    {
      if (empty($args['password']))
      {
        $response['error'] = "Password is empty, change failed!";
        break;
      }

      Action_SetPassword($_SESSION['user'], $args['password']);
      break;
    }
    case "getUser":
    {
      $response['data'] = $_SESSION['user'];
      break;
    }
    case "getMembers":
    {
      if (isset($_SESSION['user']))
      {
        $response['data'] = Action_GetMembers();
      }
      break;
    }
    case "getList":
    {
      if (empty($args['id']))
      {
        $response['error'] = "Id is empty, list failed!";
        break;
      }
    
      $response['data'] = Action_GetList($args['id']);
      break;
    }
    case "echo":
    {
      $response['data'] = $args;
      break;
    }
    default:
    {
      throw new Exception("Unknown event: " . $event);
    }
  }
}
catch (Exception $e)
{
  $response['error'] = $e->getMessage();
}

// $response["session"] = $_SESSION;
//$response["request"] = $_REQUEST;

header("Content-Type: application/json; charset=utf-8");
echo json_encode($response);

?>