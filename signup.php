<?php
    require "config.php";
    if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $re_password = $_POST['repassword'];
            $duplicate = mysqli_query($connect, "SELECT * FROM sign_up WHERE username = '$username' OR email = '$email'");
            if(mysqli_num_rows($duplicate) > 0){
                echo "<script>
                    alert('Username or email entered has already been taken')
                </script>";
            }else if($password == $re_password){
                $query = "INSERT INTO sign_up VALUES('', '$name', '$username', '$email', '$password')";
                mysqli_query($connect, $query);
                echo "<script>
                    alert('Registered successfully')
                </script>";
                session_start();
                header("Location: login_page.php");
            }else{
                echo "<script>
                    alert('Passwords do not match)
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
    <title>Sgn up or Login</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>Sign Up or <a href="login_page.php">Login</a></h1>
    <div class="container border">
        <form action="" method="POST" autocomplete="off">
            <div class="row my-5 align-items-center justify-content-center">
                    <div class="col-3 align-self-center text-end">
                        <label for="name" class="form-label">Full-Name:</label>
                    </div>
                    <div class="col-6">
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
            </div>
            <div class="row my-5 align-items-center  justify-content-center">
                    <div class="col-3 align-self-center text-end">
                        <label for="username" class="form-label">Username:</label>
                    </div>
                    <div class="col-6">
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
            </div>
            <div class="row my-5 align-items-center justify-content-center">
                <div class="col-3 align-self-center text-end">
                    <label for="email" class="form-label">Email:</label>
                </div>
                <div class="col-6">
                    <input type="text" name="email" id="email" class="form-control" required>
                </div>
            </div>
            <div class="row my-5 align-items-center  justify-content-center">
                <div class="col-3 align-self-center text-end">
                    <label for="password" class="form-label">Password:</label>
                </div>
                <div class="col-6">
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
            </div>
            <div class="row my-5 align-items-center  justify-content-center">
                <div class="col-3 align-self-center text-end">
                    <label for="password" class="form-label">Re-type Password:</label>
                </div>
                <div class="col-6">
                    <input type="password" name="repassword" id="re-password" class="form-control" required>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-6">
                    <input type="submit" name="submit" id="register" value="Sign Up" class="btn btn-outline-primary white">
                </div>
            </div>
        </form>
        
    </div>

    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(function(){

            $('#register').click(function(){
                var valid = this.form.checkValidity();
                if(valid){

                var name        = $('#name').val();
                var username    = $('#username').val();
                var email       = $('#email').val();
                var password    = $('#password').val();
                var repassword  = $('#re-password').val();
                    
                e.preventDefault();

                $.ajax({
                    type:'POST',
                    url:'process.php',
                    data:{name: name,username: username, email:email, password:password, repassword:repassword},
                    succes: function(data){
                        Swal.fire({
                            'title':"Thank you for registering with our company",
                            'text':data,
                            'type':'success'
                        })
                    },
                    error: function(data){
                        Swal.fire({
                            'title':"Errors",
                            'text':"Please check your credentials",
                            'type':'error'
                        })
                    }
                    
                });
            }else{

            }
        })
    })
    </script>
</body>
</html>