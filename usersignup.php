<html>
    <head>
        <title>Sign Up!</title>
       <?php include 'include/connect.php';
       include 'include/navbar.php';
       ?>
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link href="style/signupcss.css" rel="stylesheet"/>
    </head>
    <?php
    if(isset($_REQUEST['name'])){
        $name=$_POST['name'];
        $contact=$_POST['contact'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $dob=$_POST['dob'];
        $password=$_POST['password'];
        $date=date("Y-m-d");
        if(mysqli_query($link, "insert into registration values('','$name','$contact','$email','$address','$dob','$date','$password','')")){
            header('location:signin.php');
        }
    }
    ?>
    <body>
        <div id='container1'>
            <form method="post">
            <div id='container2'>
                <div class='in'>
                    <label>Name</label>
                </div>
                <div class='in'>
                    <input type="text" name='name'/>
                </div>
                <div class='in'>
                    <label>Contact</label>
                </div>
                <div class='in'>
                    <input type='number' name='contact'/>
                </div>
                <div class='in'>
                    <label>Email</label>
                </div>
                <div class='in'>
                    <input type="text" name="email">
                </div>
                <div class='in'>
                    <label>Address</label>
                </div>
                <div class='in'>
                    <input type="text" name="address">
                </div>
                <div class='in'>
                    <label>Date Of Birth</label>
                </div>
                <div class='in'>
                    <input type="date" name="dob">
                </div>
                <div class='in'>
                    <label>Password</label>
                </div>
                <div class='in'>
                    <input type="password" name="password">
                </div>
                <div>
                    <input type="submit" value="Sign Up"/>
                </div>
            </div>
                </form>
        </div>
    </body>
</html>