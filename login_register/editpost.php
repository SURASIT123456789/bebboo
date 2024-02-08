<?php
include("conn.php");
session_start();

// Check if post ID is set
if (isset($_GET["id"])) {
    $post_id = $_GET["id"];

    // Fetch existing post data
    $sql_get_data = "SELECT * FROM ceate_tb WHERE id = '$post_id'";
    $result_get_data = $conn->query($sql_get_data);

    if ($result_get_data->num_rows > 0) {
        $row = $result_get_data->fetch_assoc();
        $img1 = $row['img1'];
        $img2 = $row['img2'];
        $img3 = $row['img3'];
        $cetegory = $row['cetegory'];
        $title = $row['title'];
        $recap = $row['recapitulation'];
        $content = $row['content'];
    } else {
        // Handle case where post ID is not found
        header("Location: home.php"); // Redirect to home page or display an error message
        exit();
    }
} else {
    // Handle case where post ID is not set
    header("Location: home.php"); // Redirect to home page or display an error message
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
</head>
<style>
  body {
            background-color: #F7F9F9;
        }

        .container-fluid a {
            margin: 10px;
            font-size: 30px;
            font-weight: 600;
        }

        .container {
            margin: 50px auto;
        }

        .container-fluid {
            display: flex;
            justify-content: space-between;
        }

        .btn-outline-info {
            margin-top: 8px;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        .img {
            margin: 20px 0 0 0;
        }

        .Img_bar,
        .choose_,
        .content {
            margin-bottom: 20px;
        }

        p {
            font-family: sans-serif;
            font-weight: 600;
            font-size: 15px;
        }

        .text {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .content {
            margin: 10px 0 0 0;
        }

        .content textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            resize: vertical;
            max-height: 300px;
        }

        .buttot_sum {
            background-color: #44f26f;
            color: #fff;
            padding: 15px 20px;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            margin: 20px auto;
            width: 100%;
        }

        .buttot_sum:hover {
            background-color: #27ca58af;
        }

        .container-fluid a {
            font-size: 30px;
            font-weight: 700;
        }

        .container header {
            text-align: center;
            font-size: 30px;
            font-weight: 700;
            border-bottom: 2px solid rgb(130, 128, 128);
        }

        .error_text {
            margin: 5px 0 0 0;
            text-align: center;
            color: antiquewhite;
            background-color: red;
            font-size: 20px;
            font-family: monospace;
        }

        .confirmpass {
            margin: 5px 0 0 0;
            text-align: center;
            color: rgb(255, 255, 255);
            background-color: rgb(27, 249, 68);
            font-size: 20px;
            font-family: monospace;
        }

        .titel {
            margin: 20px 0 0 0;
        }

        .recapitulation {
            margin: 10px 0 0 0;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container {
                margin: 20px auto;
            }

            form {
                max-width: 100%;
            }
        }
</style>

<body>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="home.php">BEBBOO</a>
        </div>
    </nav>
    <div class="container">
        <form action="editpost_process.php?id=<?php echo $post_id; ?>" method="post" enctype="multipart/form-data">
            <header>Edit post</header>
            <!-- Your existing session error and success handling code -->
            <div class="form-check">
                <div class="img">
                    <div class="Img_bar">
                        <label for="file_imgcover" class="form-label">Cover photo</label>
                        <input type="file" class="form-control" id="file_imgcover" name="file_imgcover" />
                        <!-- Display existing cover photo -->
                        <img src="<?php echo $img1; ?>" alt="Cover Photo" width="100" height="100">
                    </div>
                    <div class="Img_bar">
                        <label for="file_img1" class="form-label">Insert a picture</label>
                        <input type="file" class="form-control" id="file_img1" name="file_img1" />
                        <!-- Display existing image 1 -->
                        <img src="<?php echo $img2; ?>" alt="Image 1" width="100" height="100">
                    </div>
                    <div class="Img_bar">
                        <label for="file_img2" class="form-label">Insert a picture</label>
                        <input type="file" class="form-control" id="file_img2" name="file_img2" />
                        <!-- Display existing image 2 -->
                        <img src="<?php echo $img3; ?>" alt="Image 2" width="100" height="100">
                    </div>
                    <div class="Img_bar">
                        <label for="file_img3" class="form-label">Insert a picture</label>
                        <input type="file" class="form-control" id="file_img3" name="file_img3" />
                        <!-- Display existing image 3 -->
                        <img src="<?php echo $img3; ?>" alt="Image 3" width="100" height="100">
                    </div>
                </div>
                <div class="choose_">
                    <p>Choose Category</p>
                    <!-- Your existing category selection radio buttons -->
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>">
                </div>
                <div class="mb-3">
                    <label for="recap" class="form-label">Recapitulation</label>
                    <input type="text" class="form-control" id="recap" name="recap" value="<?php echo $recap; ?>">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="8" style="resize: vertical;"><?php echo $content; ?></textarea>
                </div>
                <button class="btn btn-primary" type="submit"> Update</button>
            </div>
        </form>
    </div>
</body>

</html>