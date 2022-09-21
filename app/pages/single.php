<?php
include "../models/Connect.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $check = $connection->query("SELECT * FROM articles WHERE `status`=1 AND ID='$id'");
    if($check->num_rows > 0){
       $view = $connection->query("SELECT * FROM articles WHERE ID='$id'");
       while($db = $view->fetch_assoc()){
        $view_count = $db['views'];
        $view_count++;
        $update = $connection->query("UPDATE articles SET `views`='$view_count' WHERE ID='$id'");
       }
    }else {
        header("location:../../index.php");
    }
}else{
    header("location:../../index.php");
}

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/blog/public/styles/css/bootstrap.min.css">
    <link rel="stylesheet" href="/blog/public/styles/css/style.css">
    <!-- Css Reset -->
    <link rel="stylesheet" href="/blog/public/styles/css/reset.css">
    <!-- NavBar Style -->
    <link rel="stylesheet" href="/blog/public/styles/css/nav.css">
    <!-- Footer Style -->
    <link rel="stylesheet" href="/blog/public/styles/css/footer.css">
    <!-- Main Css -->
    <link rel="stylesheet" href="/blog/public/styles/css/single.css">
    <!-- Vazir Font -->
    <link rel="stylesheet" href="/blog/public/fonts/vazir.css">
    <!-- Fontawsome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>پست</title>
</head>
<body>
    <div class="modal fade" id="modalSearchBox">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="#" class="position-relative">
                    <input type="search" placeholder="جستجو ..." class="form-control searchField">
                    <button class="searchBtn"><i class="fas fa-search fs-6"></i></button>
                </form>
            </div>
        </div>
    </div>


    <nav class="navMenu navbar navbar-dark navbar-expand-lg align-items-center bg-primary fixed-top">
        <div class="container flex-row-reverse">
            <div class="d-flex align-items-center">
                <button type="button" class="search-icon" data-bs-toggle="modal" data-bs-target="#modalSearchBox">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
                <button id="switchTheme"></button>
                <a class="navbar-brand text-white fw-bold fs-5" href="../../index.php"><img src="https://codeyad.com/assets/images/logo.png?v=LeGU9ZpNcH1zdFN4EVqXRwoS_Iaehq3X46AqXt2uWPk" alt="Codeyad"></a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
                <i class="fas fa-bars fs-3"></i>
            </button>
            

            <div class="collapse navbar-collapse right-nav justify-content-start" id="navbar">
                <ul class="navbar-nav nav-left">
                    <li class="nav-item me-0">
                        <a class="nav-link mt-3 mt-lg-0" href="../../index.php">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>خانه</span>
                        </a>
                    </li>
                    <li class="nav-item me-0">
                        <a class="nav-link mt-3 mt-lg-0" href="./posts.php">
                            <i class="fas fa-list"></i>
                            <span>پست ها</span>
                        </a>
                    </li>
                   <?php
                   if(isset($_SESSION['user'])){
                   ?>
 
 <li class="nav-item me-0">
                        <a class="nav-link mt-3 mt-lg-0" href="../panel/index.php">
                            <i class="fa fa-sign-in ms-1"></i>
                            <span>خوش آمدید | <?php echo $_SESSION['user']['name'];?> </span>
                        </a>
                    </li>
                    <?php }else{?>

                        <li class="nav-item me-0">
                        <a class="nav-link mt-3 mt-lg-0" href="./login.php">
                            <i class="fa fa-user-plus ms-1"></i>
                            <span>عضویت</span>
                        </a>
                    </li>
                     


                        <li class="nav-item me-0">
                        <a class="nav-link mt-3 mt-lg-0" href="./register.php">
                            <i class="fa fa-user-plus ms-1"></i>
                            <span>عضویت</span>
                        </a>
                    </li>
                    <?php }?>
                   


                </ul>
            </div>

            
        </div>
    </nav>


    <main style="margin-top: 10rem; margin-bottom: 5rem;">
        <div class="post-container w-100 mx-auto">
            <div class="content bg-white">
                <?php 
                $result = $connection->query("SELECT * FROM articles WHERE status='1' AND ID='$id'");
                if($result->num_rows >0){
                    while($post = $result->fetch_assoc()){
                ?>
                <h4 class="title">article name: <?php echo $post['article_title']; ?></h4>
                <span class="date">created by: <?php echo $post['creator']; ?></span>
                <span class="date">view count: <?php echo $post['views']; ?></span>
                <span class="author">create time: <?php echo $post['create_time']; ?></span>

                <div class="img w-100">
                    <img src="/blog/public/uploads/<?php echo $post['image_src']; ?>" alt="<?php echo $post['image_alt']; ?>" class="w-100 rounded">
                </div>

                <p class="desc">
                    <?php echo $post['article_description']; ?>
                </p>
                    <?php }}?>
            </div>
        </div>
    </main>


    <footer class="footer">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            <p class="fw-bold text-white mb-3 mb-md-0 fs-6">تمامی حقوق برای کدیاد محفوظ می باشد &copy;</p>
            <button type="button" id="scrollUpBtn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                </svg>
            </button>
        </div>
    </footer>

    

    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/scrollToUp.js"></script>
    <script src="js/darkMode.js"></script>
</body>
</html>