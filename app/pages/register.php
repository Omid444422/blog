<?php
session_start();
include '../models/Connect.php';
include '../../public/library/jdf.php';

if(isset($_SESSION['user'])){
    header("location:../../index.php");
}

$error = "";
$success = "";

if(isset($_POST['btn_submit'])){
    if(isset($_POST['txt_name']) & $_POST['txt_name'] !== '' && isset($_POST['txt_email']) & $_POST['txt_email'] !== '' & isset($_POST['txt_password']) & $_POST['txt_password'] !== '' & isset($_POST['txt_repassword']) & $_POST['txt_repassword'] !== ''){

        $email = trim(htmlspecialchars($_POST['txt_email']));
        $name = trim(htmlspecialchars($_POST['txt_name']));
        $password = htmlspecialchars($_POST['txt_password']);
        $time = jdate('H:i:s ,Y/n/j');

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
           
            if($password === $_POST['txt_repassword']){
          
                if(preg_match_all("/select/i",$email) == true || preg_match_all("/insert/i",$email) == true || preg_match_all("/update/i",$email) == true || preg_match_all("/drop/i",$error) == true){
                    $email= preg_replace('/select/i','#',$email);
                    $email= preg_replace("/insert/i",'#',$email);
                    $email=  preg_replace("/update/i",'#',$email);
                    $email= preg_replace("/drop/i",'#',$email);    
                    }

                    if(preg_match_all("/select/i",$name) == true || preg_match_all("/insert/i",$name) == true || preg_match_all("/update/i",$name) == true || preg_match_all("/drop/i",$name) == true){
                        $name= preg_replace('/select/i','user',$name);
                        $name= preg_replace("/insert/i",'user',$name);
                        $name=  preg_replace("/update/i",'user',$name);
                        $name= preg_replace("/drop/i",'user',$name);    
                        }


                        $user = $connection->query("SELECT * FROM users WHERE `Email`='$email' AND `Password`='$password'");

                        if($user->num_rows > 0){
                            $error = "$email این ایمیل قبلا ثبت شده";
                        }else{
        
                        $result = $connection->query("INSERT INTO users (`ID`,`Name`,`Email`,`Password`,`Role`,`create_time`,`last_login`,`status`,`creator`) VALUES (NULL,'$name','$email','$password',1,'$time',NULL,0,'system')");
        
                        $connection->close();
                        header("location:../../index.php");
                        }
            }else {
              $error = "پسورد و تکرار پسورد برابر نیستند";
            }
          }else {
            $error = "$email ایمیل معتبر نمی باشد";
          }              
    }else {
        $error = "لطفا فرم را کاملا پر کنید";
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
  <link rel="shortcut icon" href="/blog/public/images/favicon.png" />
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
    <title>ثبت نام</title>
</head>
<body>
    <section class="d-flex justify-content-center align-items-center min-h-screen bg">
        <div id="overlay"></div>
        <div class="form-container">
            <form action="register.php" method="POST">
                <h1 class="title">ثبت نام در وبلاگ</h1>
                <div class="mt-3 position-relative">
                    <input type="text" name="txt_name" class="field" placeholder="نام ...">
                    <i class="fa fa-user-plus field_icon"></i>
                </div>
                <div class="mt-3 position-relative">
                    <input type="text" name="txt_email" class="field" placeholder="ایمیل ...">
                    <i class="fa fa-envelope field_icon" aria-hidden="true"></i>
                </div>
                <div class="mt-3 position-relative">
                    <input type="password" name="txt_password" class="field" id="fieldPass" placeholder="رمز عبور ...">
                    <i class="fa fa-lock field_icon"></i>
                    <button type="button" id="showPass"></button>
                </div>
                <div class="mt-3 position-relative">
                    <input type="password" name="txt_repassword" class="field" id="fieldPass" placeholder="تکرار رمز عبور ...">
                    <i class="fa fa-check field_icon"></i>
                    <button type="button" id="showPass"></button>
                </div>
                <div class="mt-3">
                    <button type="submit" name="btn_submit" class="btn-submit bg-primary">
                        <i class="fa fa-user-plus ms-1"></i>
                        <span>ثبت نام</span>
                    </button>
                </div>
        
                <p class="text">
                    قبلا ثبت نام کرده اید ؟ <a href="/login.html" class="text-primary">ورود</a>
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
    <script src="/blog/public/js/scroll.js"></script>
</body>
</html>