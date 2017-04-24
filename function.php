<?php

include 'include/connect.php';
$bleh = $_POST['bleh'];
if ($bleh == "cat") {
    $category = $_POST['category'];
    $result3 = mysqli_query($link, "select * from category");
    $r3 = mysqli_fetch_array($result3);
    if ($r3['category'] == $category) {

    } else {
        if (mysqli_query($link, "insert into category values('','$category')")) {
            echo "";
        }
    }
} elseif ($bleh == "show") {
    $result2 = mysqli_query($link, "select * from subcategory,category where category.cid=subcategory.cid");
    $cat = "";
    $subcat = "";
    $subcatid = "";
    while ($r2 = mysqli_fetch_array($result2)) {
        $subcat = $r2['subcategory'] . ":" . $subcat;
        $cat = $r2['category'] . ":" . $cat;
        $subcatid = $r2['sid'] . ":" . $subcatid;
    }
    echo $cat . "+" . $subcat . "+" . $subcatid;
} elseif ($bleh == "loadcat") {
    $result3 = mysqli_query($link, "select * from category");
    $c = "";
    $ci = "";
    while ($r3 = mysqli_fetch_array($result3)) {
        $ci = $r3['cid'] . ":" . $ci;
        $c = $r3['category'] . ":" . $c;
    }
    echo $ci . "+" . $c;
} elseif ($bleh == "Add!") {
    $catid = $_POST['category'];
    $subcat1 = $_POST['subcategory'];
    if (mysqli_query($link, "insert into subcategory values('',$catid,'$subcat1')")) {
        $result2 = mysqli_query($link, "select * from subcategory,category where category.cid=subcategory.cid");
        $cat = "";
        $subcat = "";
        $subcatid = "";
        while ($r2 = mysqli_fetch_array($result2)) {
            $subcat = $r2['subcategory'] . ":" . $subcat;
            $cat = $r2['category'] . ":" . $cat;
            $subcatid = $r2['sid'] . ":" . $subcatid;
        }
        echo $cat . "+" . $subcat . "+" . $subcatid;
    }
} elseif ($bleh == "Edit") {
    $catid = $_POST['category'];
    $subcat1 = $_POST['subcategory'];
    $sid = $_POST['sid'];
    if (mysqli_query($link, "update subcategory set subcategory='$subcat1' where sid=$sid")) {
        $result2 = mysqli_query($link, "select * from subcategory,category where category.cid=subcategory.cid");
        $cat = "";
        $subcat = "";
        $subcatid = "";
        while ($r2 = mysqli_fetch_array($result2)) {
            $subcat = $r2['subcategory'] . ":" . $subcat;
            $cat = $r2['category'] . ":" . $cat;
            $subcatid = $r2['sid'] . ":" . $subcatid;
        }
        echo $cat . "+" . $subcat . "+" . $subcatid;
    }
} elseif ($bleh == "edit") {
    $sub = $_POST['sub'];
    $re = mysqli_query($link, "select * from subcategory natural join category where sid='$sub'");
    $r = mysqli_fetch_array($re);
    echo $r['cid'] . "+" . $r['subcategory'] . "+" . $r['sid'];
} elseif ($bleh == "delete") {
    $subid = $_POST['subid'];
    if (mysqli_query($link, "delete from subcategory where sid='$subid'")) {
        $result2 = mysqli_query($link, "select * from subcategory,category where category.cid=subcategory.cid");
        $cat = "";
        $subcat = "";
        $subcatid = "";
        while ($r2 = mysqli_fetch_array($result2)) {
            $subcat = $r2['subcategory'] . ":" . $subcat;
            $cat = $r2['category'] . ":" . $cat;
            $subcatid = $r2['sid'] . ":" . $subcatid;
        }
        echo $cat . "+" . $subcat . "+" . $subcatid;
    }
} elseif ($bleh == "catshow") {
    if ($rez = mysqli_query($link, "select * from category")) {
        $cat = "";
        $catid = "";
        while ($rezz = mysqli_fetch_array($rez)) {
            $cat = $rezz['category'] . ":" . $cat;
            $catid = $rezz['cid'] . ":" . $catid;
        }
        echo $catid . "+" . $cat;
    }
} elseif ($bleh == "deletecat") {
    $catid = $_POST['catid'];
    if (mysqli_query($link, "delete from category where cid='$catid'")) {
        if ($rez = mysqli_query($link, "select * from category")) {
            $cat = "";
            $catid = "";
            while ($rezz = mysqli_fetch_array($rez)) {
                $cat = $rezz['category'] . ":" . $cat;
                $catid = $rezz['cid'] . ":" . $catid;
            }
            echo $catid . "+" . $cat;
        }
    }
} elseif ($bleh == "loadsub") {
    $catid = $_POST['subcat'];
    $rs = mysqli_query($link, "select * from subcategory where cid='$catid'");
    $sub = "";
    $subid = "";
    while ($rsq = mysqli_fetch_array($rs)) {
        $subid = $rsq['sid'] . ":" . $subid;
        $sub = $rsq['subcategory'] . ":" . $sub;
    }
    echo $subid . "+" . $sub;
} elseif ($bleh == "loaddata") {
    if ($d = mysqli_query($link, "")) {
        $oname = "";
        $contact = "";
        $email = "";
        $address = "";
        $sid = "";
        $stime = "";
        $etime = "";
        $oid="";
        $imagesrc="";

        while ($rd = mysqli_fetch_array($d)) {
            $oid=$rd['oid'].":".$oid;
            $oname = $rd['oname'] . ":" . $oname;
            $contact=$rd['contact'].":".$contact;
            $email=$rd['email'].":".$email;
            $address=$rd['address'].":".$address;
            $sid=$rd['sid'].":".$sid;
            $stime=$rd['stime'].":".$stime;
            $etime=$rd['etime'].":".$etime;
            $imagesrc=$rd['imagesrc'].":".$imagesrc;
        }
        echo $oid."+".$oname."+".$contact."+".$oid."+".$email."+".$address."+".$sid."+".$stime."+".$etime;
    }
}
elseif($bleh=="subcom"){
    $comment=$_POST['comment'];
    $oid=$_POST['oid'];
    if(mysqli_query($link,"insert into comment VALUES ('',$oid,'$comment')" )){
        echo $comment;
    }
}
elseif($bleh=='loadcom'){
    $oid=$_POST['oid'];
    if($r1=mysqli_query($link,"select * from comment where oid=$oid" )){
        $comment="";
        while($r1d=mysqli_fetch_array($r1)){
            $comment=$r1d['comment'].":".$comment;
        }
        echo $comment;
    }
}
elseif($bleh=="loaddetails"){
    $oid=$_POST['oid'];
    if($r=mysqli_query($link,"select * from officedetails natural join subcategory where oid=$oid" )){
          $r1=mysqli_fetch_array($r);
        echo $r1['oid']."+".$r1['oname']."+".$r1['contact']."+".$r1['email']."+".$r1['address']."+".$r1['sid']."+".$r1['cid']."+".$r1['stime']."+".$r1['etime'];
    }
}
?>