<?php
include 'include/navbar.php';
include 'include/connect.php';
session_start();
if(isset($_SESSION['rid'])){
    header('location:userpage.php');
}
if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    if ($username == 'admin') {
        if ($password == '1234') {
            $_SESSION['admin'] = 'admin';
            header('location:adminkapage.php');
        }
    } else {
        if ($res = mysqli_query($link, "select * from registration where email='$username'"))
             {
            $re = mysqli_fetch_array($res);
            if ($password == $re['password']) {
if($re['flag']==0){
    echo '<center><font color="#b22222" size="10px" >You are Banned/Yet to be activated<br/>Please Contact The</font><font color="#b22222" size="10px" > Administrator</font></center>';

}else {
    $_SESSION['rid'] = $re['rid'];
    $_SESSION['name'] = $re['name'];
    header('location:userpage.php');
}
            }
        }
    }
}
?>
<head>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"/>
    <link href="style/signupcss.css" rel="stylesheet"/>
    <link href="style/signin.css" rel="stylesheet"/>
    <script src="jquery.js"></script>
    <script src='jquery-ui/jquery-ui/jquery-ui.js'></script>
    <link href="jquery-ui/jquery-ui/jquery-ui.structure.css" rel="stylesheet"/>
    <link href="jquery-ui/jquery-ui/jquery-ui.css" rel="stylesheet"/>
    <link href="jquery-ui/jquery-ui/jquery-ui.theme.css" rel="stylesheet"/>
</head>
<script>
    $(document).ready(function(){
    $("#username").tooltip({track:true},{show:{effect:"slideDown",duration:500}},{hide:{effect:"slideUp",duration:500}});
    });
</script>
<div id="container4">
    <form method="post">
        <div class="text" >
            Username
        </div>
        <div>
            <input type="text" name="username" id="username" title="Email"/>
        </div>
        <div class="text">
            Password
        </div>
        <div>
            <input type="password" name="password"/>
        </div>
        <div>
            <input type="submit" value="SignIn"/>
        </div>
    </form>
</div>