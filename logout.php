<?php
session_start();
$action=$_GET['action'];
if($action=='logout'){
    $_SESSION = array();
session_destroy();
}
