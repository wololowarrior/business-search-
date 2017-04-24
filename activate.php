<?php
include 'include/connect.php';
$rid=$_GET['rid'];
mysqli_query($link, "update registration set flag=1 where rid=$rid");
header("location:user.php");
?>