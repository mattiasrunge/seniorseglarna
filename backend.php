<?php

require_once("start.php");
require_once("config.php");
require_once("actions.php");

$gDatabase = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
$gDatabase->set_charset("utf8");

$response = array();

$event = $_REQUEST['event'];
$args = $_REQUEST['args'];

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
      unset($GLOBALS["session"]['user']);
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
        $response['error'] = "Username and password combination was not recognized.";
        break;
      }

      $GLOBALS["session"]['user'] = $user;
      $response['data'] = $user;
      break;
    }
    case "getUser":
    {
      $response['data'] = $GLOBALS["session"]['user'];
      break;
    }
    case "getMembers":
    {
      if (isset($GLOBALS["session"]['user']))
      {
        $response['data'] = Action_GetMembers();
      }
      break;
    }
    case "echo":
    {
      $response['data'] = $args;
      break;
    }
    default:
    {
      throw new Exception("Unknown event: " + $event);
    }
  }
}
catch (Exception $e)
{
  $response['error'] = $e->getMessage();
}

echo json_encode($response);

?>