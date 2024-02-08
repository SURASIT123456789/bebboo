<?php
include("conn.php");
session_start();

if (
    !empty($_POST["title"]) &&
    !empty($_POST["choose"]) &&
    !empty($_POST["content"]) &&
    !empty($_POST["recap"])
) {
    if (isset($_POST["title"]) && isset($_POST["choose"]) && isset($_POST["content"]) && isset($_POST["recap"])) {
        $email = $_SESSION["user_email"];
        $recapitulation = mysqli_real_escape_string($conn, $_POST["recap"]);
        $title = mysqli_real_escape_string($conn, $_POST["title"]);
        $choose = mysqli_real_escape_string($conn, $_POST["choose"]);
        $content = mysqli_real_escape_string($conn, $_POST["content"]);
        $date = date("Y-m-d H:i:s");

        $file_imgcover_tmp = $_FILES['file_imgcover']['tmp_name'];
        $file1_tmp = isset($_FILES['file_img1']['tmp_name']) ? $_FILES['file_img1']['tmp_name'] : null;
        $file2_tmp = isset($_FILES['file_img2']['tmp_name']) ? $_FILES['file_img2']['tmp_name'] : null;
        $file3_tmp = isset($_FILES['file_img3']['tmp_name']) ? $_FILES['file_img3']['tmp_name'] : null;

        $file_imgcover_name = $_FILES['file_imgcover']['name'];
        $file1_name = isset($_FILES['file_img1']['name']) ? $_FILES['file_img1']['name'] : null;
        $file2_name = isset($_FILES['file_img2']['name']) ? $_FILES['file_img2']['name'] : null;
        $file3_name = isset($_FILES['file_img3']['name']) ? $_FILES['file_img3']['name'] : null;

        $file_imgcover_size = $_FILES['file_imgcover']['size'];
        $file1_size = isset($_FILES['file_img1']['size']) ? $_FILES['file_img1']['size'] : null;
        $file2_size = isset($_FILES['file_img2']['size']) ? $_FILES['file_img2']['size'] : null;
        $file3_size = isset($_FILES['file_img3']['size']) ? $_FILES['file_img3']['size'] : null;

        $file_imgcover_ext = strtolower(pathinfo($file_imgcover_name, PATHINFO_EXTENSION));
        $file1_ext = isset($file1_name) ? strtolower(pathinfo($file1_name, PATHINFO_EXTENSION)) : null;
        $file2_ext = isset($file2_name) ? strtolower(pathinfo($file2_name, PATHINFO_EXTENSION)) : null;
        $file3_ext = isset($file3_name) ? strtolower(pathinfo($file3_name, PATHINFO_EXTENSION)) : null;

        $file_imgcover_path = 'img_post/' . $file_imgcover_name;
        $file1_path = isset($file1_name) ? 'img_post/' . $file1_name : null;
        $file2_path = isset($file2_name) ? 'img_post/' . $file2_name : null;
        $file3_path = isset($file3_name) ? 'img_post/' . $file3_name : null;

        move_uploaded_file($file_imgcover_tmp, $file_imgcover_path);
        if ($file1_tmp !== null) move_uploaded_file($file1_tmp, $file1_path);
        if ($file2_tmp !== null) move_uploaded_file($file2_tmp, $file2_path);
        if ($file3_tmp !== null) move_uploaded_file($file3_tmp, $file3_path);

        if (isset($_SESSION["user_email"])) {
            $user_login = $_SESSION["user_email"];
            $sql_get_data = "SELECT * FROM user_bebboo_tb WHERE email = '$user_login'";
            $result_get_data = $conn->query($sql_get_data);

            if ($result_get_data->num_rows > 0) {
                $row = $result_get_data->fetch_assoc();
                $email = $row['email'];
                $username = $row['username'];
            } else {
                echo "No data found for the user.";
            }
        } else {
            echo "User not logged in.";
        }

        $errors = [];

        if (empty($title)) {
            $errors[] = 'Please enter a title.';
        }

        if (empty($recapitulation)) {
            $errors[] = 'Please enter a recapitulation.';
        }

        if (empty($content)) {
            $errors[] = 'Please enter a content.';
        }

        if ($file1_size > 5000000 || $file2_size > 5000000 || $file3_size > 5000000 || $file_imgcover_size > 5000000) {
            $errors[] = "Sorry, your file is too large. Maximum file size is 5 MB.";
        }

        if (($file1_ext !== null && !in_array($file1_ext, ['png', 'jpg', 'jpeg'])) ||
            ($file2_ext !== null && !in_array($file2_ext, ['png', 'jpg', 'jpeg'])) ||
            ($file3_ext !== null && !in_array($file3_ext, ['png', 'jpg', 'jpeg'])) ||
            (!in_array($file_imgcover_ext, ['png', 'jpg', 'jpeg']))
        ) {
            $errors[] = "Sorry, only PNG, JPG, and JPEG files are allowed.";
        }

        if (!empty($errors)) {
            $_SESSION["error_crete"] = implode("<br>", $errors);
            header("Location:create.php");
            die();
        }

        $sql = "INSERT INTO ceate_tb (email, username, cover_photo	,img1, img2, img3, title, cetegory, content,recapitulation, date_) VALUES ('$email', '$username','$file_imgcover_path', '$file1_path', '$file2_path', '$file3_path', '$title', '$choose', '$content','$recapitulation', '$date')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION["success_create"] = "Post created successfully.";
            header("Location:create.php");
            die();
        } else {
            $_SESSION["error_crete"] = "Error: " . $conn->error;
            header("Location:create.php");
            die();
        }
    }
} else {
    $_SESSION["error_crete"] = "Please fill in all required fields.";
    header("Location:create.php");
    die();
}
