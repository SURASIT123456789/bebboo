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
        $tel = $row['tel'];
        $img = $row['avatar'];
    } else {
        echo "No data found for the user.";
    }
} else {
    echo "User not logged in.";
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["userdata"])) {
    $search_email = $_POST["userdata"];
    $sql_fetch_users = "SELECT * FROM user_bebboo_tb WHERE email LIKE '%$search_email%'";
} else {
    $sql_fetch_users = "SELECT * FROM user_bebboo_tb";
}

$result_fetch_users = $conn->query($sql_fetch_users);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteUserId"])) {
    $delete_user_id = $_POST["deleteUserId"];

    
    $sql_delete_user = "DELETE FROM user_bebboo_tb WHERE id = ?";
    $stmt = $conn->prepare($sql_delete_user);
    $stmt->bind_param("i", $delete_user_id);
    
  
    if ($stmt->execute()) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . $conn->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .center-table {
            margin: 50px 0 0 500px;
            width: 500px;
            height: 100%;
        }

        .tr_box {
            background-color: #17202A;
            font-weight: 700;
            font-size: 20px;
            color: white;
        }

        .profile_and {
            font-weight: 800;
            font-family: Georgia, 'Times New Roman', Times, serif;
            font-size: 20px;
            display: flex;
            height: 80px;
            margin: 0 0 0 5px;
        }

        .profile_and img {
            width: 50px;
            height: 100%;
            border-radius: 15px;
        }

        .profile_and p {
            font-size: 20px;
            margin: 30px 0 0 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <div class="profile_and">
                <a href="admin.php"><img src="<?php echo $img ?>" alt=""></a>
                <p><?php echo $username ?></p>
            </div>
            <form action="admin.php" class="d-flex" method="post" id="searchForm">
                <input name="userdata" class="form-control me-2" type="search" placeholder="Search Email" aria-label="Search" id="searchEmail">
            </form>
            <a href="login.php"><button type="button" class="btn btn-outline-danger">Logout</button></a>
        </div>
    </nav>
    <table class="table center-table">
        <thead>
            <tr class="tr_box">
                <th scope="col">Id</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Rule</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <form action="" method="post" id="deleteForm">
                <?php
                if ($result_fetch_users->num_rows > 0) {
                    while ($user_row = $result_fetch_users->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $user_row['id'] . "</th>";
                        echo "<td>" . $user_row['username'] . "</td>";
                        echo "<td>" . $user_row['email'] . "</td>";
                        echo "<td>" . $user_row['rule'] . "</td>";
                        echo "<td><button type='button' class='btn btn-danger delete-btn' data-user-id='" . $user_row['id'] . "'>Delete</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No users found.</td></tr>";
                }
                ?>
            </form>
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            var typingTimer;
            var doneTypingInterval = 1000; 

            $("#searchEmail").on("keydown", function(e) {
                clearTimeout(typingTimer);
                if (e.key === 'Enter') {
                    $("#searchForm").submit();
                } else {
                   
                    typingTimer = setTimeout(doneTyping, doneTypingInterval);
                }
            });

            function doneTyping() {
                $("#searchForm").submit();
            }

            $(".delete-btn").on("click", function() {
                var userId = $(this).data("user-id");

                var confirmDelete = confirm("Are you sure you want to delete this user?");
                if (confirmDelete) {
                    $("#deleteForm").append("<input type='hidden' name='deleteUserId' value='" + userId + "'>");
                    $("#deleteForm").submit();
                }
            });
        });
    </script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
