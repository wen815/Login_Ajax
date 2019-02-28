<?php
session_start();
error_reporting(0);

include'includes/conn.php';
$name=$_GET['name'];
$password=MD5($_GET['password']);
$sql="select id,active from tb_member where name='$name'and password='$password'";
$num=$conne->getRowsNum($sql);
$active=$conne->getFields($sql,1);
if($num==1&&$active==1){
    echo "1";
    $_SESSION['name'] =$name;
}
else{
    echo "0";
}
