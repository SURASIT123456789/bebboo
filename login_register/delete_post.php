<?php
include("conn.php");
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql_check_post = "SELECT * FROM ceate_tb WHERE id = '$id'";
    $result_check_post = $conn->query($sql_check_post);
    if ($result_check_post->num_rows > 0) {
        $sql_delete_post = "DELETE FROM ceate_tb WHERE id = '$id'";
        if ($conn->query($sql_delete_post) === TRUE) {
            $sql_delete_comments = "DELETE FROM comment_tb WHERE post_id = '$id'";
            if ($conn->query($sql_delete_comments) === TRUE) {
                die(header('location:profile.php'));
            } else {
            }
        } else {

        }
    } else {
       
    }
} else {
}

?>
