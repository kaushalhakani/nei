<?php
require_once("class/database_class.php");
/*require_once("message.php");
require_once("func/func.php");
require_once("inc/func/paging.php");
require_once("inc/func/paging-2.php");*/
$db = new Database("localhost","root","","nei","");
$db -> connect();
session_start();
?>