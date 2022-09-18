<?php
session_start();
include "../models/Connect.php";
include "../../public/library/jdf.php";

if(isset($_SESSION['user'])){
    header("location:../../index.php");
}

$error = "";
$success = "";

if(isset($_POST['btn_submit'])){
    if(isset($_POST['txt_email']) & $_POST['txt_email'] !== '' && isset($_POST['txt_password']) && $_POST['txt_password'] !== ""){
        $email = htmlspecialchars($_POST['txt_email']);
        $password = htmlspecialchars($_POST['txt_password']);
        $time = jdate('H:i:s ,Y/n/j');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "$email ایمیل معتبر نمی باشد";
          } 

          if(preg_match_all("/select/i",$email) == true || preg_match_all("/insert/i",$email) == true || preg_match_all("/update/i",$email) == true || preg_match_all("/drop/i",$error) == true){
          $email= preg_replace('/select/i','#',$email);
          $email= preg_replace("/insert/i",'#',$email);
          $email=  preg_replace("/update/i",'#',$email);
          $email= preg_replace("/drop/i",'#',$email);    
          }

          $result = $connection->query("SELECT * FROM users WHERE Email ='$email' AND `Password`='$password'");
          if($result->num_rows > 0){
            while($user = $result->fetch_assoc()){
                $_SESSION['user'] = array("id"=>$user['ID'],"name"=>$user['Name'],"role"=>$user['Role']);
                $update = $connection->query("UPDATE users SET last_login='$time',`status`='1' WHERE Email='$email' AND `Password`='$password'");
               $connection->close();
                header("location:../../index.php");
            }
          }else {
            $error  = "نام کاربری و یا رمز عبور اشتباه است";
          }

    }else {
        $error = "لطفا فرم را کامل پر کنید";
    }
}

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Favicon -->
     <link rel="shortcut icon" href="/blog/public/images/favicon.png" type="image/x-icon">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/blog/public/styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="/blog/public/styles/css/style.css">
    <link rel="stylesheet" href="/blog/public/styles/css/auth.css">
    <!-- Css Reset -->
    <link rel="stylesheet" href="/blog/public/styles/css/reset.css">
    <!-- Vazir Font -->
    <link rel="stylesheet" href="/blog/public/fonts/vazir.css">
    <!-- Fontawsome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>ورود به حساب کاربری</title>
</head>
<body>
    <section class="d-flex justify-content-center align-items-center min-h-screen bg">
        <div id="overlay"></div>
        <div class="form-container">
            <form action="/blog/app/pages/login.php" method="POST">
                <h1 class="title">ورود به حساب کاربری</h1>
                <div class="mt-3 position-relative">
                    <input type="text" name="txt_email" class="field" placeholder="ایمیل ...">
                    <i class="fa fa-user field_icon"></i>
                </div>
                <div class="mt-3 position-relative">
                    <input type="password" name="txt_password" class="field" id="fieldPass" placeholder="رمز عبور ...">
                    <i class="fa fa-lock field_icon"></i>
                    <button type="button" id="showPass"></button>
                </div>
                <div class="mt-3">
                    <button type="submit" name="btn_submit" class="btn-submit bg-primary">
                        <i class="fa fa-sign-in ms-1"></i>
                        <span>ورود به حساب کاربری</span>
                    </button>
                </div>

                <p class="text">
                    حساب کاربری ندارید ؟ <a href="/blog/app/pages/register.php" class="text-primary">یکی بسازید</a>
                </p>
            </form>
            <br>

            <?php if(isset($error) && $error !== "" && $success === ""){?>
                <span class="alert alert-danger text-danger p-2 m-2"><?php echo $error;?></span>
                <?php }?>

                <?php if(isset($success) && $success !== "" && $error === ""){?>
                <span class="alert alert-success text-success p-2 m-2"><?php echo $success;?></span>
                <?php }?>

        </div>
    </section>

    <script src="/blog/public/js/showPassword.js"></script>
    <script src="/blog/public/js/darkMode.js"></script>
</body>
</html>