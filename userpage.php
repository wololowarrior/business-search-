<?php
include 'include/navbar.php';
include 'include/connect.php';
$rid = $_SESSION['rid'];
?>
    <link href='style/signupcss.css' rel="stylesheet"/>
    <script src="jquery.js"></script>
    <script src='jquery-ui/jquery-ui/jquery-ui.js'></script>
    <link href="jquery-ui/jquery-ui/jquery-ui.structure.css" rel="stylesheet"/>
    <link href="jquery-ui/jquery-ui/jquery-ui.css" rel="stylesheet"/>
    <link href="jquery-ui/jquery-ui/jquery-ui.theme.css" rel="stylesheet"/>

    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <script>
        $(document).ready(function () {
            $("#contact").tooltip({track: true}, {
                show: {
                    effect: "slideDown",
                    duration: 500
                }
            }, {hide: {effect: "slideUp", duration: 500}});
            $("#ode").click(function () {
                $("#details").show();
                $("#vie").hide();
            });
            $("#view").click(function () {
                $("#details").hide();
                $("#vie").show();
            });
            $("button").click(function () {
                $("#addimg").show();
            });
            $("#mcontainer").tabs({heightstyle: "fill"}, {
                show: {
                    effect: "fadeIn",
                    duration: 800
                }
            }, {hide: {effect: "fadeOut", duration: 200}});
            $(".main").click(function () {
                $("#loginbox").slideUp();
            });
            $("#insideimg").tabs();
        });
    </script>
    <script>
        var bleh = "loadcat";
        $.ajax({
            type: "post",
            url: "function.php",
            data: "bleh=" + bleh,
            success: function (msg) {
                //      alert(msg);
                var str = msg.split("+");
                var strid = str[0].split(":");
                var strcat = str[1].split(":");
                for (var i = document.srch.cat.options.length - 1; i >= 1; i--) {
                    document.srch.cat.remove(i);
                }

                for (i = 0; i < strid.length - 1; i++) {
                    var optn = document.createElement("OPTION");
                    optn.value = strid[i];
                    optn.text = strcat[i];
                    document.srch.cat.options.add(optn);
                }

            }
        });
        function loadsub() {
            var subcat = document.srch.cat.value;
            //alert(subcat);
            var bleh = "loadsub";
            $.ajax({
                type: "post",
                url: "function.php",
                data: "bleh=" + bleh + "&subcat=" + subcat,
                success: function (msg) {
                    //      alert(msg);
                    var str = msg.split("+");
                    var strid = str[0].split(":");
                    var strcat = str[1].split(":");
                    for (var i = document.srch.subcat.options.length - 1; i >= 1; i--) {
                        document.srch.subcat.remove(i);
                    }

                    for (i = 0; i < strid.length - 1; i++) {
                        var optn = document.createElement("OPTION");
                        optn.value = strid[i];
                        optn.text = strcat[i];
                        document.srch.subcat.options.add(optn);
                    }
                }
            });
        }
        function loasub(cat) {
            var subcat = cat;
            //alert(subcat);
            var bleh = "loadsub";
            $.ajax({
                type: "post",
                url: "function.php",
                data: "bleh=" + bleh + "&subcat=" + subcat,
                success: function (msg) {
                    //      alert(msg);
                    var str = msg.split("+");
                    var strid = str[0].split(":");
                    var strcat = str[1].split(":");
                    for (var i = document.srch.subcat.options.length - 1; i >= 1; i--) {
                        document.srch.subcat.remove(i);
                    }

                    for (i = 0; i < strid.length - 1; i++) {
                        var optn = document.createElement("OPTION");
                        optn.value = strid[i];
                        optn.text = strcat[i];
                        document.srch.subcat.options.add(optn);
                    }
                    return;
                }
            });
        }
function editde(oid){
            alert(oid);
    $(document).ready(function () {
       $("#mcontainer").tabs("option","active",1);
    });
    var bleh="loaddetails";
    $.ajax({
        type:"post",
        url:"function.php",
        data:"bleh="+bleh+"&oid="+oid,
        success:function (msg) {
            alert(msg);
            str=msg.split("+");
            document.srch.oname.value=str[1];
            document.srch.contact.value=str[2];
            document.srch.email.value=str[3];
            document.srch.address.value=str[4];
            document.srch.cat.value=str[6];
            loasub(str[6]);
            document.srch.subcat.value=str[5];
            document.srch.stime.value=str[7];
            document.srch.etime.value=str[8];


        }
    });

        }
        //var bleh="office_details";
        //$.ajax({
        //    type:"post",
        //    url:"function.php",
        //    data:"bleh="+bleh+"&rid=<?php echo $rid; ?>",
        //    success:funtion(msg){
        //        alert(msg);
        //    }
        //});
    </script>
    <link href="style/userpage.css" rel="stylesheet"/>
    <div>
        <h3>Welcome <?php echo $_SESSION['name'] ?></h3>
    </div>
    <div class="main" style="width: 100%">
        <div id="mcontainer">
            <ul>
                <li><a href="#vie">View</a></li>
                <li><a href="#details">Details</a></li>
                <li><a href="#addimg">Images</a></li>
            </ul>
            <div id='vie' style="float: left">
                <h2>Your Office Details are:</h2>
                <div id='officedeatil'>
                    <table>
                        <?php
                        if ($r = mysqli_query($link, "select * from officedetails where rid=$rid")) {

                            while ($re = mysqli_fetch_array($r)) {
                                ?>
                                <tr>
                                    <input type="text" hidden="true" name="oid" id='oid'
                                           value="<?php echo $re['oid'] ?>"/>
                                    <td>Office Name</td>
                                    <td><?php echo $re['oname']; ?></td>
                                </tr>
                                <tr>
                                    <td>Contact</td>
                                    <td><?php echo $re['contact']; ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $re['email'] ?></td>
                                </tr>
                                <tr>
                                    <td>address</td>
                                    <td><?php echo $re['address']; ?></td>
                                </tr>
                                <tr>
                                    <td>Start Time</td>
                                    <td><?php echo $re['stime']; ?></td>
                                </tr>
                                <tr>
                                    <td>End Time</td>
                                    <td><?php echo $re['etime']; ?></td>
                                </tr>
                                <tr>
                                    <td><input type="button" value="Edit" onclick="editde(<?php echo $re['oid']?>)"></td>
                                </tr>

                                <!--                    <tr><td colspan="2"><input type="button" value="Add Images"/></td></tr>-->
                                <tr>
                                    <td colspan="2">
                                        <hr>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
            <div id='addimg'>
                <div id="insideimg">
                    <ul>
                        <?php
                        if ($r1 = mysqli_query($link, "select * from officedetails where rid=$rid")) {
                            while ($re2 = mysqli_fetch_array($r1)) { ?>
                                <li><a href="#<?php echo $re2['oname']; ?>">
                                        <?php echo $re2['oname']; ?>
                                    </a></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>

                    <?php
                    if ($r2 = mysqli_query($link, "select * from officedetails where rid=$rid")) {
                        while ($re3 = mysqli_fetch_array($r2)) {
                            $oid = $re3['oid'];

                            ?>
                            <div id="<?php echo $re3['oname']; ?>">
                                <?php
                                if ($r3 = mysqli_query($link, "select * from officeimage where oid=$oid")) {
                                    while ($re4=mysqli_fetch_array($r3)){
                                        ?>
                                        <img src="img/<?php echo  $re4['imagesrc']; ?>" width="150"/>
                                <?php
                                    }
                                } ?>
                                <div>
                                <input type="button" value="add"
                                       onclick="window.location.href='addimages.php?oid=<?php echo $re3['oid']; ?>'"/>
                                    </div>
                            </div>
                            <?php
                        }
                    }
                    ?>

                </div>
            </div>
            <div id='details'>
                <form name='srch' method="post">
                    <h2>
                        Enter Office Details
                    </h2>
                    <div>Office Name</div>
                    <div><input type="text" name="oname"/></div>
                    <div>Contact</div>
                    <div><input type="number" name="contact" id='contact' title="numeric only"/></div>
                    <div>Address</div>
                    <div><textarea cols="50" rows="4" name="address"></textarea></div>
                    <div>Categories</div>
                    <div>
                        <select name="cat" onchange="loadsub();">
                            <option value="0">Select</option>
                        </select>
                    </div>
                    <div>Sub-Categories</div>
                    <div>
                        <select name='subcat'>
                            <option value="0">Select</option>
                        </select>
                    </div>
                    <div>Office Timings</div>
                    <div><input type="text" name="stime"/> to <input type="text" name='etime'></div>
                    <div>Email</div>
                    <div><input type="text" name="email"/></div>
                    <div>
                        <input type="submit" style="margin-top: 3px;"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
/* @var $_POST type */
if (isset($_POST['oname'])) {
    $name = $_POST['oname'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $sid = $_POST['subcat'];
    $stime = $_POST['stime'];
    $etime = $_POST['etime'];
    $email = $_POST['email'];
    $date = date("Y-m-d");
    if (mysqli_query($link, "insert into officedetails values('','$name','$contact','$email','$address',$sid,'$stime','$etime',$rid,'$date')")) {

    }
}
?>

<?php
//if (isset($_FILES['files'])) {
//    $oid = $_POST['oid'];
//    echo $oid;
//    $date1 = date("Y-m-d");
//    foreach ($_FILES['files']['name'] as $key=>$tmp_name) {
//        $filename = $key . $_FILES['files']['name'][$key];
//        if (move_uploaded_file($_FILES['files']['tmp_name'][$key], "img/" . $filename)) {
//            if (mysqli_query($link, "insert into officeimage VALUES ('',$oid,'$filename','$date1')")) {
//
//            }
//        }
//    }
//}
?>