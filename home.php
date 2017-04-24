<title>Home</title>
<?php
include 'include/navbar.php';
include 'include/connect.php';
?>
<link href="style/homecss.css" rel="stylesheet"/>
<!--<link href='style/signupcss.css' rel="stylesheet"/>-->
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<script src="jquery.js"></script>
<script src='jquery-ui/jquery-ui/jquery-ui.js'></script>
<link href="jquery-ui/jquery-ui/jquery-ui.structure.css" rel="stylesheet"/>
<link href="jquery-ui/jquery-ui/jquery-ui.css" rel="stylesheet"/>
<link href="jquery-ui/jquery-ui/jquery-ui.theme.css" rel="stylesheet"/>
<script>
    $(document).ready(function () {
        $(".off").tooltip({track: "true"}, {show: {effect: "fadeIn", duration: 500}}, {
            hide: {
                effect: "slideUp",
                duration: 200
            }
        });
    });
</script>
<script>
    var bleh="loaddata";
    $.ajax({
        type:"post",
        url:"function.php",
        data:"bleh="+bleh,
        success:function (msg) {
            //alert(msg);
        }
    });
    
    var bleh = "loadcat";
    $.ajax({
        type: "post",
        url: "function.php",
        data: "bleh=" + bleh,
        success: function (msg) {
                  //alert(msg);
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

</script>
<div id="main">
    <div id="sidebar">
        <div>
            <form name="srch" method="post">
            <div>
                <select id="cat" onchange="loadsub();">
                <option value="0">Select Category</option>
                </select>
            </div>
            <div>
                <select id="subcat">
                    <option value="0">Select SubCategory</option>
                </select>
            </div>
                </form>
        </div>
    </div>
    <div id="mbody">

        <div>
            <?php

            if ($r = mysqli_query($link, "select * from officedetails")) {
                while ($rq = mysqli_fetch_array($r)) {
                    $i = 1;
                    ?>

                    <div class="off" onclick="window.location.href='officehome.php?oid=<?php echo $rq['oid'] ?>'"
                         title="Click For More Details">
                        <div style="float: left">
                            <?php
                            $oid = $rq['oid'];
                            if ($r1 = mysqli_query($link, "select * from  officeimage where oid=$oid")) {

                                while (($r1r = mysqli_fetch_array($r1)) && ($i == 1)) {
                                    ?>
                                    <img src="img/<?php echo $r1r['imagesrc']; ?>" width="150"/>
                                    <?php
                                    $i++;
                                }

                            }

                            ?>
                        </div>
                        <div style="float: left">
                            <table>
                                <tr>
                                    <td>Name:</td>
                                    <td class="oname"><?php echo $rq['oname'] ?></td>
                                </tr>
                                <tr>
                                    <td>Contact:</td>
                                    <td><?php echo $rq['contact']; ?></td>
                                </tr>
                                <tr>
                                    <td>Office Timing:</td>
                                    <td><?php echo $rq['stime'] ?> to <?php echo $rq['etime'] ?></td>
                                </tr>
                                <tr>
                                    <td>Address:</td>
                                    <td><?php echo $rq['address'] ?></td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td><?php echo $rq['email'] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

    </div>
</div>
