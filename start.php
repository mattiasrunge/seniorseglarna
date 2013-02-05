<?php

require_once("config.php");
//require_once("msession.php");

session_name($sessionName);
//session_save_path(realpath($sessionPath));
session_start();

?>