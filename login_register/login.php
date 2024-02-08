<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="stye/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lemon&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20"></script>
</head>

<body>
    <?php
    include("conn.php");
    session_start();

    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email_account = mysqli_real_escape_string($conn, $_POST["email"]);
        $password_account = mysqli_real_escape_string($conn, $_POST["password"]);

        if (empty($email_account)) {
            showError("Email is required");
        }
        if (empty($password_account)) {
            showError("Password is required");
        }

        $check_account_query = "SELECT * FROM user_bebboo_tb WHERE email='$email_account' OR password_='$password_account'";
        $query = mysqli_query($conn, $check_account_query);
        $row = mysqli_fetch_assoc($query);

        if ($row) {
            $stored_password_hash = $row["password_"];
            if (password_verify($password_account, $stored_password_hash)) {
                $_SESSION["user_email"] = $email_account;

                if ($row['rule'] == 'admin') {
                    redirectTo("admin.php");
                } elseif ($row['rule'] == 'member') {
                    redirectTo("home.php");
                }
            } else {
                showError("Wrong password");
            }
        } else {
            showError("User not found");
        }
    }

    function showError($message)
    {
        $_SESSION["error"] = $message;
        echo '<script>
            Swal.fire({
                icon: "error",
                text: "' . $message . '",
            }).then(() => {
                window.location.href = "login.php";
            });
          </script>';
        exit();
    }

    function redirectTo($location)
    {
        echo '<script>
            Swal.fire({
                icon: "success",
                title: "Login Successful",
                showConfirmButton: false,
                timer: 1500,
            }).then(() => {
                window.location.href = "' . $location . '";
            });
          </script>';
        exit();
    }
    ?>
    <nav>
        <div class="tex_logo">
            <h1>BEBBOO</h1>
        </div>
    </nav>
    <div class="container">
        <header>LOGIN </header>
        <div class="wrapper">
            <form action="" method="post">
                <div class="Input_box">
                    <input name="email" type="email" placeholder="Email">
                    <i class='bx bxs-envelope' style='color:rgba(0,0,0,0.7)'></i>
                </div>
                <div class="Input_box">
                    <input name="password" type="password" placeholder="Password">
                    <i class='bx bxs-lock-alt' style='color:rgba(0,0,0,0.7)'></i>
                </div>
                <div class="forget_password">
                    <a href="forgetpass.php">Forgot Password ?</a>
                </div>
                <button class="buttot_sum" type="submit"> Sing in</button>
            </form>
            <div class="register">
                Are you a member yet ? <a href="register.php">Sing up</a>
            </div>
        </div>
    </div>
</body>

</html>