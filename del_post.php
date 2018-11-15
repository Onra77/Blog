<?php
 session_start();
    include_once("db.php");

//login not avalible yet.
/* if{!isset} ($_session['']) {
    header("location: login.php");
    return;
} */

if(!isset($_GET['pid'])) {
    header("location: index.php");
} else {
    $pid = $_GET['pid'];
    $sql = "DELETE FROM post WHERE id=$pid";
    mysqli_query($db, $sql);
    header ("location: index.php");
}
?>