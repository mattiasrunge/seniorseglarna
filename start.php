<?php

header("Expires: Sun, 01 Jan 2014 00:00:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", FALSE);
header("Pragma: no-cache");

require_once("config.php");
//require_once("msession.php");

session_name($sessionName);
//session_save_path(realpath($sessionPath));
session_start();

?>
