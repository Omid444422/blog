<?php
session_start();
include "./app/models/Connect.php";



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
    <!-- Main Css -->
    <link rel="stylesheet" href="/blog/public/styles/css/style.css">
    <!-- Css Reset -->
    <link rel="stylesheet" href="/blog/public/styles/css/reset.css">
    <!-- NavBar Style -->
    <link rel="stylesheet" href="/blog/public/styles/css/nav.css">
    <!-- Footer Style -->
    <link rel="stylesheet" href="/blog/public/styles/css/footer.css">
    <!-- Posts Style -->
    <link rel="stylesheet" href="/blog/public/styles/css/posts.css">
    <!-- Categories -->
    <link rel="stylesheet" href="/blog/public/styles/css/categories.css">
    <!-- Header Style -->
    <link rel="stylesheet" href="/blog/public/styles/css/header.css">
    <!-- Vazir Font -->
    <link rel="stylesheet" href="/blog/public/fonts/vazir.css">
    <!-- Fontawsome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>وبلاگ | صفحه اصلی</title>
</head>

<body>
    <div class="modal fade" id="modalSearchBox">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="/blog/index.php" method="get" class="position-relative">
                    <input type="search" name="txt_search" id="txt_search" placeholder="جستجو ..." class="form-control searchField">
                    <button class="searchBtn"><i class="fas fa-search fs-6"></i></button>
                    <ul class="text-light">
                        <?php


                        if (isset($_GET['txt_search'])) {
                            $search = htmlspecialchars(trim($_GET['txt_search']));
                            $statment = $connection->query("SELECT ID,article_title FROM articles WHERE `article_title` LIKE '%$search%' OR `article_description` LIKE '%$search%'");

                            if ($statment->num_rows > 0) {
                                while ($result = $statment->fetch_assoc()) {
                        ?>

                                    <li class="ms-2 bg-secondary p-2 mt-2 text-light">
                                        <a class="nav-link" href="/blog/app/pages/single.php?id=<?php echo $result['ID'] ?>"><?php echo $result['article_title'];?></a>
                                    </li>
                        <?php }
                            } else {
                                echo "<span class='alert-danger m-2 p-2'>هیچ نتیجه ای یافت نشد</span>";
                            }
                        } ?>
                    </ul>
                </form>
            </div>
        </div>
    </div>



    <nav class="navMenu navbar navbar-dark navbar-expand-lg align-items-center fixed-top">
        <div class="container flex-row-reverse">
            <div class="d-flex align-items-center">
                <button type="button" id="search_icon" class="search-icon" data-bs-toggle="modal" data-bs-target="#modalSearchBox">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </button>
                <button id="switchTheme"></button>
                <a class="navbar-brand text-white fw-bold fs-5" href="/index.php">Localhost</a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
                <i class="fas fa-bars fs-3"></i>
            </button>


            <div class="collapse navbar-collapse right-nav justify-content-start" id="navbar">
                <ul class="navbar-nav nav-left">
                    <li class="nav-item me-0">
                        <a class="nav-link mt-3 mt-lg-0" href="/blog/index.php">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>خانه</span>
                        </a>
                    </li>
                    <li class="nav-item me-0">
                        <a class="nav-link mt-3 mt-lg-0" href="/blog/app/pages/posts.php">
                            <i class="fas fa-list"></i>
                            <span>پست ها</span>
                        </a>
                    </li>

                    <?php
                    if (isset($_SESSION['user'])) { ?>

                        <li class="nav-item me-0">
                            <a class="nav-link mt-3 mt-lg-0" href="/blog/app/panel/index.php">
                                <i class="fa fa-sign-in ms-1"></i>
                                <span>پنل کاربری | <?php echo $_SESSION['user']['name'];?></span>
                            </a>
                        </li>

                    <?php } else {
                    ?>

                        <li class="nav-item me-0">
                            <a class="nav-link mt-3 mt-lg-0" href="/blog/app/pages/login.php">
                                <i class="fa fa-sign-in ms-1"></i>
                                <span>ورود</span>
                            </a>
                        </li>

                        <li class="nav-item me-0">
                            <a class="nav-link mt-3 mt-lg-0" href="/blog/app/pages/register.php">
                                <i class="fa fa-user-plus ms-1"></i>
                                <span>عضویت</span>
                            </a>
                        </li>
                    <?php } ?>

                </ul>
            </div>


        </div>
    </nav>

    <header class="header">
        <div id="overlay"></div>
        <div class="container header__container">
            <div class="header__content">
                <h1 class="header__title">وبلاگ کدیاد</h1>
                <p class="header__desc">
                    لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی‌معنی در صنعت چاپ، صفحه‌آرایی و طراحی گرافیک گفته می‌شود. طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده استفاده می نماید، تا از نظر گرافیکی نشانگر چگونگی نوع و اندازه فونت و ظاهر متن باشد.
                </p>
                <div class="mt-3">
                    <a href="/blog/app/pages/posts.php" class="btn btn-secondary">پست ها</a>
                </div>
            </div>
        </div>
    </header>



    <main class="my-5">
        <div class="container row align-items-start mx-auto mt-4">
            <div id="posts" class="mb-5 col-lg-9">
                <h4 class="posts__title">پست ها</h4>
                <div class="row">

                        <?php   
                        if(!isset($_GET['cat'])){
                    $data = $connection->query("SELECT * FROM articles WHERE status = 1 ORDER BY article_title DESC LIMIT 6");
                    if($data->num_rows > 0){
                        while($result = $data->fetch_assoc()){  
                        ?>

                    <div class="col-md-6 col-lg-4 mt-3">
                        <div class="post">
                            <div class="post__img">
                                <a href="/blog/app/pages/single.php?id=<?php echo $result['ID']?>">
                                    <img src="/blog/public/uploads/<?php echo $result["image_src"] ?>" class="w-100 rounded" alt="<?php echo $result['image_alt'];?>">
                                </a>
                            </div>
                            <h4 class="">
                                <a href="/blog/app/pages/single.php?id=<?php echo $result['ID']?>" class="post__title d-block"><?php echo $result['article_title']; ?></a>
                            </h4>
                            <p class="post__desc">
                                <?php echo show_text($result['article_description']); ?>
                            </p>

                            <a href="/blog/app/pages/single.php?id=<?php echo $result['ID']?>" class="post__link">مشاهده پست</a>
                        </div>
                    </div>
                    <?php }}}?>
                        
                            <?php
                            // category top articles
                                if(isset($_GET['cat']) && $_GET['cat'] === "top"){
                                    $result = $connection->query("SELECT * FROM articles WHERE status = 1 ORDER BY views ASC LIMIT 6");
                                    if($result->num_rows > 0){
                                        while($data = $result->fetch_assoc()){
                            ?>
                            <div class="col-md-6 col-lg-4 mt-3">
                        <div class="post">
                            <div class="post__img">
                                <a href="/blog/app/pages/single.php?id=<?php echo $data['ID']?>">
                                    <img src="/blog/public/uploads/<?php echo $data["image_src"] ?>" class="w-100 rounded" alt="<?php echo $data['image_alt'];?>">
                                </a>
                            </div>
                            <h4 class="">
                                <a href="/blog/app/pages/single.php?id=<?php echo $data['ID']?>" class="post__title d-block"><?php echo $data['article_title']; ?></a>
                            </h4>
                            <p class="post__desc">
                                <?php echo show_text($data['article_description']); ?>
                            </p>

                            <a href="/blog/app/pages/single.php?id=<?php echo $data['ID']?>" class="post__link">مشاهده پست</a>
                        </div>
                    </div>
                            <?php }}}?>



                            <?php
                            // category new articles
                                if(isset($_GET['cat']) && $_GET['cat'] === "new"){
                                    $result = $connection->query("SELECT * FROM articles WHERE status = 1 ORDER BY create_time DESC LIMIT 6");
                                    if($result->num_rows > 0){
                                        while($data = $result->fetch_assoc()){
                            ?>
                            <div class="col-md-6 col-lg-4 mt-3">
                        <div class="post">
                            <div class="post__img">
                                <a href="/blog/app/pages/single.php?id=<?php echo $data['ID']?>">
                                    <img src="/blog/public/uploads/<?php echo $data["image_src"] ?>" class="w-100 rounded" alt="<?php echo $data['image_alt'];?>">
                                </a>
                            </div>
                            <h4 class="">
                                <a href="/blog/app/pages/single.php?id=<?php echo $data['ID']?>" class="post__title d-block"><?php echo $data['article_title']; ?></a>
                            </h4>
                            <p class="post__desc">
                                <?php echo show_text($data['article_description']); ?>
                            </p>

                            <a href="/blog/app/pages/single.php?id=<?php echo $data['ID']?>" class="post__link">مشاهده پست</a>
                        </div>
                    </div>
                            <?php }}}?>



                            <?php
                            // category old articles
                                if(isset($_GET['cat']) && $_GET['cat'] === "old"){
                                    $result = $connection->query("SELECT * FROM articles WHERE status = 1 ORDER BY ID ASC LIMIT 6");
                                    if($result->num_rows > 0){
                                        while($data = $result->fetch_assoc()){
                            ?>
                            <div class="col-md-6 col-lg-4 mt-3">
                        <div class="post">
                            <div class="post__img">
                                <a href="/blog/app/pages/single.php?id=<?php echo $data['ID']?>">
                                    <img src="/blog/public/uploads/<?php echo $data["image_src"] ?>" class="w-100 rounded" alt="<?php echo $data['image_alt'];?>">
                                </a>
                            </div>
                            <h4 class="">
                                <a href="/blog/app/pages/single.php?id=<?php echo $data['ID']?>" class="post__title d-block"><?php echo $data['article_title']; ?></a>
                            </h4>
                            <p class="post__desc">
                                <?php echo show_text($data['article_description']); ?>
                            </p>

                            <a href="/blog/app/pages/single.php?id=<?php echo $data['ID']?>" class="post__link">مشاهده پست</a>
                        </div>
                    </div>
                            <?php }}}?>



                </div>
            </div>
            <aside class="categories col-lg-3 mt-5 mt-md-0">
                <h4 class="categories__title">
                    دسته بندی
                </h4>
                <ul class="categories__list">
                    <li class="categories__item"><a href="/blog/index.php?cat=top" class="categories__link">بیشترین بازدید</a></li>
                    <li class="categories__item"><a href="/blog/index.php?cat=new" class="categories__link">جدیدترین ها</a></li>
                    <li class="categories__item"><a href="/blog/index.php?cat=old" class="categories__link">قدیمی ترین ها</a></li>
                </ul>
            </aside>
        </div>
    </main>


    <footer class="footer">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            <p class="fw-bold text-white mb-3 mb-md-0 fs-6">Lorem ipsum dolor sit amet.</p>
            <button type="button" id="scrollUpBtn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff" class="bi bi-arrow-up-circle" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
                </svg>
            </button>
        </div>
    </footer>


    <script src="/blog/public/js/bootstrap.bundle.js"></script>
    <script src="/blog/public/js/scrollToUp.js"></script>
    <script src="/blog/public/js/darkMode.js"></script>

    <script>
        const search_button = document.getElementById("search_icon");

        var url = window.location.href;
        var param = url.split("?");

        if (param[1] != null && param[1].indexOf("cat", 0) || param[1] == "") {
            search_button.click();
        }
    </script>
</body>

</html>