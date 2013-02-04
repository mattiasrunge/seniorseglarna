<?php

require_once("config.php");
require_once("msession.php");

msession_name($sessionName);
msession_path($sessionPath);
msession_start();

?>