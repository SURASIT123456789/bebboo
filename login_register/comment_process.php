<?php
include("conn.php");
session_start();

if (isset($_SESSION["user_email"])) {
    $user_login = $_SESSION["user_email"];
    $sql_get_data = "SELECT * FROM user_bebboo_tb WHERE email = '$user_login'";
    $result_get_data = $conn->query($sql_get_data);

    if ($result_get_data->num_rows > 0) {
        $row = $result_get_data->fetch_assoc();
        $email = $row['email'];
        $username = $row['username'];
        $avatar = $row['avatar'];
    } else {
        echo "No data found for the user.";
    }
} else {
    echo "User not logged in.";
}

if (isset($_POST["id"]) && isset($_POST["comment"])) {
    $id = $_POST['id'];
    $comment = mysqli_real_escape_string($conn, $_POST["comment"]);
    $date = date("Y-m-d H:i:s");

    if (empty($comment)) {
        header('location: content.php?id=' . $id);
        $_SESSION['error'] = 'Enter your text';
    } else {
        $sql_add_comment = "INSERT INTO comment_tb (username, avartar, commen, post_id, date_) VALUES ('$username', '$avatar', '$comment', '$id', '$date')";

        if ($conn->query($sql_add_comment) === TRUE) {
            echo "Comment added successfully.";
            header('location: content.php?id=' . $id);
            exit;
        } else {
            echo "Error: " . $sql_add_comment . "<br>" . $conn->error;
        }
    }
} else {
}
