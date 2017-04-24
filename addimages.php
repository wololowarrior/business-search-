<?php
include 'include/connect.php';
$oid = $_GET['oid'];

?>
    <script src="jquery.js"></script>
    <script src="multifile-master/jquery.MultiFile.js"></script>

    <form method="post" enctype="multipart/form-data">
        <input id="file" type="file" name="file[]" multiple class="multi with-preview"/>
        <div id="imagePreview"></div>
        <input type="submit">
    </form>

<?php
if (isset($_FILES['file'])) {
//$oid = $_POST['oid'];
//echo $oid;
    $date1 = date("Y-m-d");
    foreach ($_FILES['file']['name'] as $key => $tmp_name) {
        $filename = $key . $_FILES['file']['name'][$key];
        if (move_uploaded_file($_FILES['file']['tmp_name'][$key], "img/" . $filename)) {
            if (mysqli_query($link, "insert into officeimage VALUES ('',$oid,'$filename','$date1')")) {
                header('location:userpage.php');
            }
        }
    }
}
?>