<title>Office Details</title>
<link href="style/officehome.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Indie+Flower|Open+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Gafata" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nothing+You+Could+Do|Special+Elite" rel="stylesheet">
<?php
include 'include/connect.php';
include 'include/navbar.php';
$oid = $_GET['oid'];
if ($r = mysqli_query($link, "select * from officedetails where oid=$oid")) {
    $rd = mysqli_fetch_array($r);

    ?>
    <script src="jquery.js"></script>
    <script>
        var bleh = "loadcom";
        var oid="<?php echo $oid?>";
        $.ajax({
            type: "post",
            url: "function.php",
            data: "bleh=" + bleh+"&oid="+oid,
            success: function (msg) {
                //alert(msg);
                str=msg.split(":");
                for(var i=0;i<str.length;i++) {
                    var comm = "<br/><label class='commen'>" + str[i] + "</label>";
                    $("#comments").append(comm);
                }
            }
        });


        function subcom() {
            var comment = document.getElementById("comment").value;
            var bleh = "subcom";
            var oid = "<?php echo $oid?>";
            //alert(oid);
            $.ajax({
                type: "post",
                url: "function.php",
                data: "bleh=" + bleh + "&comment="+comment+"&oid=" + oid,
                success: function (msg) {
                    //alert(msg);
                    var comm = "<label class='commen'>" + msg + "</label>";
                    $("#comments").append(comm);
                    document.getElementById("comment").value="";
                }
            });
        }

    </script>
    <div id="main">
        <div>
            <center><label id="officename"> <?php echo $rd['oname']; ?></label></center>
            <hr>
        </div>
        <div>
            <table align="center">
                <tr>
                    <td>Contact:</td>
                    <td><?php echo $rd['contact']; ?></td>
                </tr>
                <tr>
                    <td>Office Timing:</td>
                    <td><?php echo $rd['stime'] ?> to <?php echo $rq['etime'] ?></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><?php echo $rd['address'] ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?php echo $rd['email'] ?></td>
                </tr>
            </table>

        </div>
        <div id="images">
            <div>
                <label style="font-size: 24px; font-family: 'Open Sans'">Some Related Images:</label>
            </div>
            <div>
                <?php
                if ($r1 = mysqli_query($link, "select * from officeimage where oid=$oid")) {
                    while ($r1d = mysqli_fetch_array($r1)) {
                        ?>
                        <img src="img/<?php echo $r1d['imagesrc']; ?>" width="150"
                             style="margin: 10px; border-color: #FFF; border: 1px solid; border-radius: 2px;"/>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <fieldset>
            <legend>Comments</legend>
        <div id="comments">

        </div>
        <label style="font-size: 30px ; font-family:'Open Sans';">Add Comments:</label>
        <div>
        </div>
        <form method="post">
            <textarea cols="100" rows="2" name="comment" id="comment"></textarea><br>
            <input type="button" value="submit" onclick="subcom()"/>
        </form>
            </fieldset>
    </div>
    <?php

}
?>