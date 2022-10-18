<?php
    require "config.php";
    if(isset($_POST['submit'])){
        $user_id = $_POST['username'];
        $password = $_POST['password'];
        $present = mysqli_query($connect, "SELECT * FROM sign_up WHERE username = '$user_id' OR email = '$user_id' ");
        $row = mysqli_fetch_assoc($present);
        if(mysqli_num_rows($present) > 0){
            if($password == $row["password"]){
                $_SESSION['login'] = true;
                $_SESSION["id"] = $row["id"];
                header('Location: dashboard.php');
            }else{
                echo "<script>
            alert('Password Incorrect');
                    </script>";
            }
        }else{
            echo "<script>
            alert('user does not exit');
        </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Here</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>Login</h1>
    <p class="text-center">If you dont have an acount <a href="signup.php">Sign Up </a></p>
    <div class="container">
        <form action="login_page.php" method="POST" autocomplete="off">
            <div class="row my-5 align-items-center  justify-content-center">
                <div class=" col-3 align-self-center text-end">
                    <label for="username">Username or email:</label>
                </div>
                <div class="col-6">
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
            </div>
            <div class="row my-5 align-items-center  justify-content-center">
                <div class="col-3 align-self-center text-end">
                    <label for="password">Password</label>
                </div>
                <div class="col-6">
                    <input type="password" name="password" id="password" class="form-control">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-6">
                    <input type="submit" name="submit" value="Login" class="btn btn-outline-primary white" required>
                </div>
            </div>

        </form>
    </div>

    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
</body>
</html>
