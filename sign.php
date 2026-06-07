<?php
session_start();
include_once("sign/db_connect.php");

$error = false;
$success_message = '';
$error_message = '';

// Handle Sign Up
if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);	

    if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $uname_error = "Name must contain only alphabets and space";
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email ID";
    }
    if(strlen($password) < 6) {
        $error = true;
        $password_error = "Password must be minimum of 6 characters";
    }
    if($password != $cpassword) {
        $error = true;
        $cpassword_error = "Password and Confirm Password doesn't match";
    }
    if (!$error) {
        if(mysqli_query($conn, "INSERT INTO users(user, email, pass) VALUES('" . $name . "', '" . $email . "', '" . md5($password) . "')")) {
            $success_message = "Successfully Registered! Please login.";
        } else {
            $error_message = "Error in registering...Please try again later!";
        }
    }
}

// Handle Sign In
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $email . "' and pass = '" . md5($password) . "'");
    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['user_id'] = $row['uid'];
        $_SESSION['user_name'] = $row['user'];
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Invalid email or password";
    }
}

$user=$_POST['user'];
$pass=$_POST['pass'];
$emp_a="enter name and password";
$emp_u="plase neter your NAME";
$emp_p="plase neter your Password";

if($user==="fathey"&&$pass==="123654"){
        header("Location: protofly_user_f.html");
    }

    elseif($user==="ahmed"&&$pass==="123654"){
        header("Location: protofly_user_a.html");
    }

    elseif($user==="bassem"&&$pass==="123654"){
        header("Location: protofly_user_b.html");
    }

    elseif($user==="adham"&&$pass==="123654"){
        header("Location: protofly_user_l.html");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="pro/css/auth/auth.css">
    <link href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <title>Sign In / Sign Up - Artfolio</title>
</head>

<body>
    <div class="auth-container">
        <div class="auth-box">
            <!-- Sign In Form -->
            <div id="login-form">
                <div class="auth-header">
                    <h2>Welcome Back</h2>
                    <p>Sign in to continue</p>
                </div>
                <?php if($error_message) { ?>
                    <div class="error-message"><?php echo $error_message; ?></div>
                <?php } ?>
                <form class="auth-form" method="POST" action="">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit" name="login" class="auth-button">Sign In</button>
                </form>
                <div class="toggle-form">
                    Don't have an account? <a href="#" onclick="toggleForms()">Sign Up</a>
                </div>
            </div>

            <!-- Sign Up Form -->
            <div id="signup-form" style="display: none;">
                <div class="auth-header">
                    <h2>Create Account</h2>
                    <p>Sign up to get started</p>
                </div>
                <?php if($success_message) { ?>
                    <div class="success-message"><?php echo $success_message; ?></div>
                <?php } ?>
                <?php if($error_message) { ?>
                    <div class="error-message"><?php echo $error_message; ?></div>
                <?php } ?>
                <form class="auth-form" method="POST" action="">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" required>
                        <?php if(isset($uname_error)) { ?>
                            <div class="error-message"><?php echo $uname_error; ?></div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="signup-email">Email</label>
                        <input type="email" id="signup-email" name="email" required>
                        <?php if(isset($email_error)) { ?>
                            <div class="error-message"><?php echo $email_error; ?></div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="signup-password">Password</label>
                        <input type="password" id="signup-password" name="password" required>
                        <?php if(isset($password_error)) { ?>
                            <div class="error-message"><?php echo $password_error; ?></div>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" id="cpassword" name="cpassword" required>
                        <?php if(isset($cpassword_error)) { ?>
                            <div class="error-message"><?php echo $cpassword_error; ?></div>
                        <?php } ?>
                    </div>
                    <button type="submit" name="signup" class="auth-button">Sign Up</button>
                </form>
                <div class="toggle-form">
                    Already have an account? <a href="#" onclick="toggleForms()">Sign In</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleForms() {
            const loginForm = document.getElementById('login-form');
            const signupForm = document.getElementById('signup-form');
            
            if (loginForm.style.display === 'none') {
                loginForm.style.display = 'block';
                signupForm.style.display = 'none';
            } else {
                loginForm.style.display = 'none';
                signupForm.style.display = 'block';
            }
        }
    </script>
</body>

</html>
