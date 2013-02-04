<?

$msession_path = realpath("./msessions") . "/";
$msession_name = "msession";
$msession_timeout = 86400 * 7;
$msession_id = FALSE;

function msession_path($path)
{
  global $msession_path;

  $msession_path = realpath($path) . "/";
}

function msession_name($name)
{
  global $msession_name;

  $msession_name = $name;
}

function msession_start()
{
  global $msession_name, $msession_id, $msession_path, $msession_timeout;

  $GLOBALS["session"] = array();

  if (isset($_COOKIE[$msession_name]))
  {
    $msession_id = $_COOKIE[$msession_name];

    if (file_exists($msession_path . $msession_id))
    {
      $GLOBALS["session"] = unserialize(file_get_contents($msession_path . $msession_id));
    }
  }
  else
  {
    $msession_id = uniqid("msession_", TRUE);
  }

  setcookie($msession_name, $msession_id, time() + $msession_timeout);
}

function msession_save()
{
  global $msession_id, $msession_path;

  if ($msession_id === FALSE || !isset($GLOBALS["session"]))
  {
    return;
  }

  file_put_contents($msession_path . $msession_id, serialize($GLOBALS["session"]));
}

register_shutdown_function("msession_save");

?>