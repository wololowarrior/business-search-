<html>
<head>
    <title>
        Admin's Page
    </title>
    <link href="style/adminstyle.css" rel='stylesheet' type="text/css"/>
    <!--<link href="bootstrap/css/bootstrap.css" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

    <?php
    include 'include/navbar.php';
    include 'include/connect.php';
    ?>
    <script>
        function editit(strsubid) {
            //loads subcategory for editing
            var bleh = "edit";
            $.ajax({
                type: "post",
                url: "function.php",
                data: "bleh=" + bleh + "&sub=" + strsubid,
                success: function (msg) {
                    /*alert(msg);*/
                    var str = msg.split("+");
                    var cat1 = str[0];
                    var sub = str[1];
                    var subid = str[2];
                    document.getElementById('cat').value=cat1;
                    document.getElementById('subcategory').value = sub;
                    document.getElementById('sid').value = subid;
                    document.getElementById('add1').value = "Edit";
                }
            });
        }


        var bleh = "loadcat";
        $.ajax({
            type: "post",
            url: "function.php",
            data: "bleh=" + bleh,
            success: function (msg) {
                alert(msg);
                var str = msg.split("+");
                var strid = str[0].split(":");
                var strcat = str[1].split(":");
                for (i = 0; i < strid.length - 1; i++) {
                    var optn = document.createElement("OPTION");
                    optn.value = strid[i];
                    optn.text = strcat[i];
                    document.srch.cat.options.add(optn);
                }

            }
        });
        function wololo() {
            //alert('inside wololo');
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
                    wololo2();
                }
            });
        }
        function addcat() {
            var category = document.getElementById("category").value;
            var bleh = "cat";
            $.ajax({
                type: "post",
                url: "function.php",
                data: "bleh=" + bleh + "&category=" + category,
                success: function (msg) {
                    document.getElementById("category").value = "";
                    wololo();
                }
            });
        }
        function deleteit(strsubid) {
            //delete sub category
            var bleh = "delete";
            $.ajax({
                type: "post",
                url: "function.php",
                data: "bleh=" + bleh + "&subid=" + strsubid,
                success: function (msg) {
                    var str = msg.split("+");
                    var strcat = str[0].split(":");
                    var strsub = str[1].split(":");
                    var strsubid = str[2].split(":");
                    document.getElementById("category").value = "";
                    document.getElementById("subcategory").value = "";
                    var tabgen = "<table width='70%'><tr><th>Category</th><th>Subcategory</th><th>Edit</th><th>Delete</th></tr>";
                    for (i = 0; i < strcat.length - 1; i++) {
                        tabgen = tabgen + "<tr><td>" + strcat[i] + "</td><td>" + strsub[i] + "</td><td><input type='button' value='Edit' onclick='editit(" + strsubid[i] + ")'></td><td><input type='button' value='Delete' onclick='deleteit(" + strsubid[i] + ")'></td></tr>";
                    }
                    tabgen = tabgen + "</table>";
                    $("#ban").html("" + tabgen);
                }
            });
        }
        function addit() {
            //adds sub category
            //alert('inside addit');
            var subcategory = document.getElementById("subcategory").value;
            ///alert(subcategory);
            var category = document.getElementById("cat").value;
            var btn = document.getElementById("add1").value;
            var sid = document.getElementById("sid").value;
            //alert(btn);
//                var bleh = "addsub";
            $.ajax({
                type: "post",
                url: "function.php",
                data: "bleh=" + btn + "&category=" + category + "&subcategory=" + subcategory + "&sid=" + sid,
                success: function (msg) {
                    // alert(msg);
                    var str = msg.split("+");
                    var strcat = str[0].split(":");
                    var strsub = str[1].split(":");
                    var strsubid = str[2].split(":");
                    document.getElementById("subcategory").value = "";
                    var tabgen = "<table width='70%' cellspacing='0' border='2'><tr><th>Category</th><th>Subcategory</th><th>Edit</th><th>Delete</th></tr>";
                    for (i = 0; i < strcat.length - 1; i++) {
                        tabgen = tabgen + "<tr><td>" + strcat[i] + "</td><td>" + strsub[i] + "</td><td><input type='button' value='Edit' onclick='editit(" + strsubid[i] + ")'></td><td><input type='button' value='Delete' onclick='deleteit(" + strsubid[i] + ")'></td></tr>";
                    }
                    tabgen = tabgen + "</table>";
                    $("#ban").html("" + tabgen);
                    document.getElementById("add1").value = "Add!";
                }
            });
        }

        function deletecat(catid) {
            //detele category
            var bleh = "deletecat";
            $.ajax({
                type: "post",
                url: "function.php",
                data: "bleh=" + bleh + "&catid=" + catid,
                success: function (msg) {

                    var str = msg.split("+");
                    var cat = str[1].split(":");
                    var catid = str[0].split(":");
                    var tabgen1 = "<table width='70%'><tr><th>Category</th><th>Edit</th><th>Delete</th></tr>";
                    for (i = 0; i < catid.length - 1; i++) {
                        tabgen1 = tabgen1 + "<tr><td>" + cat[i] + "</td><td><input type='button' value='edit' onclick='editcat(" + catid[i] + ")'></td><td><input type='button' value='delete' onclick='deletecat(" + catid[i] + ")'></td></tr>";
                    }
                    tabgen1 = tabgen1 + "</table>";
                    $("#ban3").html("" + tabgen1);
                    wololo();
                }
            });

        }
        function wololo2() {
            var bleh = "show";
            $.ajax({
                type: "post",
                url: "function.php",
                data: "bleh=" + bleh,
                success: function (msg) {
                    // alert(msg);
                    var str = msg.split("+");
                    var strcat = str[0].split(":");
                    var strsub = str[1].split(":");
                    var strsubid = str[2].split(":");
                    document.getElementById("category").value = "";
                    document.getElementById("subcategory").value = "";
                    var tabgen = "<table width='70%'><tr><th>Category</th><th>Subcategory</th><th>Edit</th><th>Delete</th></tr>";
                    for (i = 0; i < strcat.length - 1; i++) {
                        tabgen = tabgen + "<tr><td>" + strcat[i] + "</td><td>" + strsub[i] + "</td><td><input type='button' value='Edit' onclick='editit(" + strsubid[i] + ")'></td><td><input type='button' value='Delete' onclick='deleteit(" + strsubid[i] + ")'></td></tr>";
                    }
                    tabgen = tabgen + "</table>";
                    $("#ban").html("" + tabgen);
                    wololo3();
                }
            });
        }
        function wololo3() {
            var bleh2 = "catshow";
            $.ajax({
                type: "post",
                url: "function.php",
                data: "bleh=" + bleh2,
                success: function (msg) {
                    //alert(msg);
                    var str = msg.split("+");
                    var cat = str[1].split(":");
                    var catid = str[0].split(":");
                    var tabgen1 = "<table width='70%'><tr><th>Category</th><th>Edit</th><th>Delete</th></tr>";
                    for (i = 0; i < catid.length - 1; i++) {
                        tabgen1 = tabgen1 + "<tr><td>" + cat[i] + "</td><td><input type='button' value='edit' onclick='editcat(" + catid[i] + ")'></td><td><input type='button' value='delete' onclick='deletecat(" + catid[i] + ")'></td></tr>";
                    }
                    tabgen1 = tabgen1 + "</table>";
                    $("#ban3").html("" + tabgen1);
                }
            });
        }


        var bleh = "show";
        $.ajax({
            type: "post",
            url: "function.php",
            data: "bleh=" + bleh,
            success: function (msg) {
                // alert(msg);
                var str = msg.split("+");
                var strcat = str[0].split(":");
                var strsub = str[1].split(":");
                var strsubid = str[2].split(":");
                document.getElementById("category").value = "";
                document.getElementById("subcategory").value = "";
                var tabgen = "<table width='70%'><tr><th>Category</th><th>Subcategory</th><th>Edit</th><th>Delete</th></tr>";
                for (i = 0; i < strcat.length - 1; i++) {
                    tabgen = tabgen + "<tr><td>" + strcat[i] + "</td><td>" + strsub[i] + "</td><td><input type='button' value='Edit' onclick='editit(" + strsubid[i] + ")'></td><td><input type='button' value='Delete' onclick='deleteit(" + strsubid[i] + ")'></td></tr>";
                }
                tabgen = tabgen + "</table>";
                $("#ban").html("" + tabgen);
            }
        });

        var bleh2 = "catshow";
        $.ajax({
            type: "post",
            url: "function.php",
            data: "bleh=" + bleh2,
            success: function (msg) {
                //alert(msg);
                var str = msg.split("+");
                var cat = str[1].split(":");
                var catid = str[0].split(":");
                var tabgen1 = "<table width='70%'><tr><th>Category</th><th>Edit</th><th>Delete</th></tr>";
                for (i = 0; i < catid.length - 1; i++) {
                    tabgen1 = tabgen1 + "<tr><td>" + cat[i] + "</td><td><input type='button' value='edit' onclick='editcat(" + catid[i] + ")'></td><td><input type='button' value='delete' onclick='deletecat(" + catid[i] + ")'></td></tr>";
                }
                tabgen1 = tabgen1 + "</table>";
                $("#ban3").html("" + tabgen1);
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            $("#use").click(function () {
                window.location.href = "user.php";

            });
            $("#cat").click(function () {
                window.location.href = "adminkapage.php";

            });
        });
    </script>
</head>
<body>
<div id='mainbody' style="display: inline">
    <div>
        <h1>Hello Admin,</h1>
    </div>
    <div>
        <div style="float: left">
            <form method="post">
                <div class="cat">
                    <div>
                        <label for="category">Category</label>
                    </div>
                    <div>
                        <input type="text" name="category" id='category'/>
                    </div>
                </div>
                <input type="button" value="Add Category" id='add' class="add" onclick="addcat();"/>
            </form>
            <div class="cat">
                <table id="ban3" cellspacing='0' cellpadding='5' border='2'>
                    <!--<tr><td></t</tr>-->
                </table>
            </div>
        </div>
        <div style="float:left; margin-left: 200px;">
            <form method="post" name="srch">
                <div class="cat">
                    <div><label>Select Category</label></div>
                    <div>
                        <select name="cat" id="cat">
                            <option value="0">Select</option>
                        </select>
                    </div>
                    <div>
                        <label for="subcategory">Sub-Category</label>
                    </div>
                    <div>
                        <input type="text" name="subcategory" id='subcategory'/><input type="text" id="sid"
                                                                                       hidden="true"/>
                    </div>
                </div>
                <input type="button" value="Add!" id='add1' onclick="addit();"/>
            </form>

            <div class="cat">
                <table id="ban" cellspacing='0' cellpadding='5' border='2'>
                    <!--<tr><td></t</tr>-->
                </table>
            </div>
        </div>
    </div>

</div>
<div id="user" hidden="true">

</div>
</body>
</html>