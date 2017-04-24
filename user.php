<?php
include 'include/navbar.php';
include 'include/connect.php';
?>
     <script>
            $(document).ready(function () {
                $("#use").click(function () {
                    window.location.href="user.php";

                });
                $("#cat").click(function () {
                    window.location.href="adminkapage.php";

                });
            });
        </script>
<style>
    th{
        font-family: tahoma;
        font-weight: 100;
        font-size: 20px;
        text-align: left; 
    }
</style>
<table width="100%  ">
    <tr>
        <th>
            Name
        </th>
        <th>
            Contact
        </th>
        <th>
            Email
        </th>
        <th>
            Address
        </th>
        <th>
            Dob
        </th>
        <th>
            Date Created
        </th>
        <th>
            Activate
        </th>
        <th>
            Ban User
        </th>
    </tr>
    <?php
    $rw = mysqli_query($link, "select * from registration");
    while ($r = mysqli_fetch_array($rw)) {
        ?>
        <tr>
            <td><?php echo $r['name'] ?></td>
            <td><?php echo $r['contact']; ?></td>
            <td><?php echo $r['email'] ?></td>
            <td><?php echo $r['address'] ?></td>
            <td><?php echo $r['dob'] ?></td>
            <td><?php echo $r['datecreated'] ?></td>
            <td><?php if ($r['flag'] == 0) {
            ?>
                    <a href="activate.php?rid=<?php echo$r['rid'] ?>">Activate</a>
                    <?php
                } elseif ($r['flag'] == 1) {
                    ?>
                    Active
                    <?php
                }
                ?></td>
            <td><?php
            if($r['flag']==1){
                ?>
                <a href="ban.php?rid=<?php echo $r['rid']?>">Ban</a>
                <?php
            }else{
                ?>Not Active
                    <?php
            }
            ?></td>
        </tr>
                <?php
            }
            ?>
</table>