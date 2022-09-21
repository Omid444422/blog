<?php
session_start();
include '../models/Connect.php';
include '../../public/library/jdf.php';

if(!isset($_SESSION['user'])){
    header("location:../../index.php");
    exit();
}

if(isset($_GET['event']) && $_GET['event'] === 'sign_out'){
    $user_id = $_SESSION['user']['id'];
    $exit = $connection->query("UPDATE users SET `status`=0 WHERE ID='$user_id'");
    unset($_SESSION['user']);
    if(!isset($_SESSION['user'])){
        header("location:../../index.php");
        exit();
    }else {
        unset($_SESSION['user']);
        header("location:../../index.php");
        exit();
    }
}




?>



<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-beJoAY4VI2Q+5IPXjI207/ntOuaz06QYCdpWfWRv4lSFDyUSqsM0W+wiAMr2I185" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="/blog/public/styles/css/main.css">

    <title>پنل کاربری: <?php echo $_SESSION['user']['name']; ?></title>
</head>

<body>

    <section x-data="toggleSidebar" class="bg-info">
        <section x-cloak class="sidebar bg-light" :class="open || 'inactive'">
            <div class="d-flex align-items-center justify-content-between justify-content-lg-center">
                <h4 class="fw-bold">localhost blog</h4>
                <i @click="toggle" class="d-lg-none fs-1 bi bi-x"></i>
            </div>
            <div class="mt-4">
                <ul class="list-unstyled">
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="./index.php">
                            <i class="me-2 bi bi-grid-fill"></i>
                            <span>داشبورد</span>
                        </a>
                    </li>


                   <?php if($_SESSION['user']['role'] >=5){?>

                    <li x-data="dropdown" class="sidebar-item">
                        <div @click="toggle" class="sidebar-link">
                            <i class="me-2 bi bi-box-seam"></i>
                            <span>مقالات</span>
                            <i class="ms-auto bi bi-chevron-down"></i>
                        </div>
                        <ul x-show="open" x-transition class="submenu">
                            <li class="submenu-item">
                                <a href="./products_index.html">لیست مقاله ها</a>
                            </li>
                            <li class="submenu-item">
                                <a href="#">ایجاد مقاله</a>
                            </li>
                            <li class="submenu-item">
                                <a href="#">ویرایش مقاله</a>
                            </li>
                        </ul>
                    </li>
                    <?php }?>

                    <?php if($_SESSION['user']['role'] >= 10){?>

                        <li x-data="dropdown" class="sidebar-item">
                        <div @click="toggle" class="sidebar-link">
                            <i class="me-2 bi bi-basket-fill"></i>
                            <span>درخواست ها</span>
                            <i class="ms-auto bi bi-chevron-down"></i>
                        </div>
                        <ul x-show="open" x-transition class="submenu">
                            <li class="submenu-item">
                                <a href="./index.php?event=request_list">لیست درخواست ها</a>
                            </li>
                            <li class="submenu-item">
                                <a href="./index.php?event=accepted_requests">درخواست تایید شده</a>
                            </li>
                            <li class="submenu-item">
                                <a href="./index.php?event=wait_requests">درخواست تایید نشده</a>
                            </li>
                        </ul>
                    </li>

                    <li x-data="dropdown" class="sidebar-item">
                        <div @click="toggle" class="sidebar-link">
                            <i class="me-2 bi bi-people-fill"></i>
                            <span>کاربران</span>
                            <i class="ms-auto bi bi-chevron-down"></i>
                        </div>
                        <ul x-show="open" x-transition class="submenu">
                            <li class="submenu-item">
                                <a href="./index.php?event=users">لیست کاربران</a>
                            </li>
                            <li class="submenu-item">
                                <a href="./index.php?event=create_user">ایجاد کاربران</a>
                            </li>
                            <li class="submenu-item">
                                <a href="./index.php?event=users">ویرایش کاربران</a>
                            </li>
                        </ul>
                    </li>
                    <?php }?>



                    <li x-data="dropdown" class="sidebar-item">
                     
                        <div @click="toggle" class="sidebar-link btn-danger">
                            <i class="me-2 bi bi-power"></i>
                            <a class="nav-link text-body p-0 m-0" href="./index.php?event=sign_out">
                            <span> خروج</span>
                            </a>
                            <i class="ms-auto bi"></i>
                        </div>
                        <ul x-show="open" x-transition class="submenu">
                           
                        </ul>
                    </li>
                </ul>
            </div>
        </section>

        <section class="main" :class="open || 'active'">
         
        </section>
    </section>


    <?php if(isset($_GET['event']) & $_SESSION['user']['role'] >= 10){ 
            if($_GET['event'] === 'users'){?>
            <div class="row mt-5 justify-content-center">
                <div class="col-6 mt-5">
                     
                <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col">register time</th>
      <th scope="col">last login</th>
      <th scope="col">status</th>
      <th scope="col">events</th>
      <th scope="col">events</th>

    </tr>
  </thead>
  <tbody>
    <?php 
        $result = $connection->query("SELECT * FROM users");
        if($result->num_rows > 0){
            while($users = $result->fetch_assoc()){

    ?>
  <tr>
      <th scope="row"><?php echo $users['ID'];?></th>
      <td><?php echo $users['Name']; ?></td>
      <td><?php echo $users['Email']; ?></td>
        <td><?php
        if($users['Role'] == 1){
            echo "user";
        }elseif ($users['Role'] > 1 & $users['Role'] <10){
            echo "writter";
        }elseif($users['Role'] >= 10) {
            echo "admin";
        }
        ?></td>
      <td><?php echo $users['create_time']; ?></td>
      <td><?php echo $users['last_login']; ?></td>
      <td><?php $users['status'] === 0?"offline":"online"; ?></td>
      <td>
        <a class="btn btn-warning" href="./event.php?event=edit&id=<?php echo $users['ID'];?>">Edit</a>
      </td>
      <td>
      <a class="btn btn-danger" href="./event.php?event=delete&id=<?php echo $users['ID'];?>">Delete</a>
      </td>
    </tr>
        <?php }}?>
    </tbody>
</table>

                </div>
            </div>
            <?php }}?>


            <?php
                // for create user

$error = "";
$success = "";

            if(isset($_POST['btn_submit'])){
                if(isset($_POST['txt_name']) & $_POST['txt_name'] !== '' & isset($_POST['txt_email']) & $_POST['txt_email'] != '' & isset($_POST['txt_password']) & $_POST['txt_password'] !== ''){
                    $name = $_POST['txt_name'];
                    $email = $_POST['txt_email'];
                    $password = $_POST['txt_password'];
                    $time = jdate('H:i:s ,Y/n/j');
                    $creator = $_SESSION['user']['id'];
                    $check_user = $connection->query("SELECT * FROM users WHERE `Email`='$email'");
                    if($check_user->num_rows > 0){
                        $error = "this user is exist";
                    }else {
                        $result = $connection->query("INSERT INTO users (`ID`,`Name`,`Email`,`Password`,`Role`,`create_time`,`last_login`,`status`,`Edited_by`,`creator`) VALUES (NULL,'$name','$email','$password',1,'$time',NULL,0,NULL,'$creator')");
                        $connection->close();
                        $success = "user created";
                    }

                }else {
                    $error = "please fill out the form";
                }
            }
            
            
            ?>


                
            <?php
                // for create user
            if(isset($_GET['event']) & $_SESSION['user']['role'] >= 10){
                if($_GET['event'] === 'create_user'){ ?>
                <div class="row justify-content-center">
                <div class="col-6">
                    <form action="./index.php?event=create_user" method="post">
                        <label class="form-label" for="txt_name">username:</label>
                        <input type="text" name="txt_name" class="form-control">
                        <br>
                        <label class="form-label" for="txt_email">email:</label>
                        <input type="email" name="txt_email" class="form-control">
                        <br>
                        <label class="form-label" for="txt_password">password:</label>
                        <input type="password" name="txt_password" class="form-control">
                        <br>
                        <button name="btn_submit" class="btn btn-success" type="submit">submit</button>
                    </form>
                    <br>
                    <?php if(isset($error) && $error !== ""){?>
                <span class="alert alert-danger text-danger p-2 m-2"><?php echo $error;?></span>
                <?php }?>

                <?php if(isset($success) && $success !== "" & $error === ""){?>
                <span class="alert alert-success text-success p-2 m-2"><?php echo $success;?></span>
                <?php }?>
                </div>
            </div>
                <?php }}?>



                    <?php
                    // select all articles without any filters
                    if(isset($_GET['event']) & $_SESSION['user']['role'] >= 10){
                        if($_GET['event'] === 'request_list'){
                    ?>
                        <div class="row justify-content-center">
                            <div class="col-6">

                                    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">description</th>
        <th scope="col">status</th>
        <th scope="col">create time</th>
        <th scope="col">views</th>
        <th scope="col">image</th>
        <th scope="col">creator</th>
        <th>events</th>
    </tr>
  </thead>
  <tbody>
        
            <?php 
                //  ////////// select all without any filter
              $result = $connection->query("SELECT * FROM articles");
              if($result->num_rows > 0){
                  while($articles = $result->fetch_assoc()){
            ?>
            <tr>
                <th scope="col"><?php echo $articles['ID']; ?></th>
                <td><?php echo $articles['article_title']; ?></td>
                <td><a href="../pages/single.php?id=<?php echo $articles['ID'];?>">description</a></td>
                <td><?php echo $articles['status'] ==0 ?"waiting":"accepted";?></td>
                <td><?php echo $articles['create_time']; ?></td>
                <td><?php echo $articles['views']; ?></td>
                <td><a href="/blog/public/uploads/<?php echo $articles['image_src']; ?>">image</a></td>
                <td>
                    <?php
                    $creator_name = $connection->query("SELECT * FROM users WHERE ID='$articles[creator]'");
                    if($creator_name->num_rows > 0){
                        while($name = $creator_name->fetch_assoc()){
                            echo  "id= $articles[creator] name: $name[Name]";
                        }
                    }
                    ?>
                </td>
                <td>
                    <a class="btn btn-danger" href="./event.php?article_id=<?php echo $articles['ID'];?>&event=delete">delete</a>
                </td>
            </tr>
                    <?php }}?>
  </tbody>
</table>
        
                            </div>
                        </div>
                            <?php }}?>





                            <?php
                            // select accepted articles
                    if(isset($_GET['event']) & $_SESSION['user']['role'] >= 10){
                        if($_GET['event'] === 'accepted_requests'){
                    ?>
                        <div class="row justify-content-center">
                            <div class="col-6">

                                    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">description</th>
        <th scope="col">status</th>
        <th scope="col">create time</th>
        <th scope="col">views</th>
        <th scope="col">image</th>
        <th scope="col">creator</th>
    </tr>
  </thead>
  <tbody>
        
            <?php 
                //  ////////// select accepted articles
              $result = $connection->query("SELECT * FROM articles WHERE `status`=1");
              if($result->num_rows > 0){
                  while($articles = $result->fetch_assoc()){
            ?>
            <tr>
                <th scope="col"><?php echo $articles['ID']; ?></th>
                <td><?php echo $articles['article_title']; ?></td>
                <td><a href="../pages/single.php?id=<?php echo $articles['ID'];?>">description</a></td>
                <td><?php echo $articles['status'] ==0 ?"waiting":"accepted";?></td>
                <td><?php echo $articles['create_time']; ?></td>
                <td><?php echo $articles['views']; ?></td>
                <td><a href="/blog/public/uploads/<?php echo $articles['image_src']; ?>">image</a></td>
                <td>
                    <?php
                    $creator_name = $connection->query("SELECT * FROM users WHERE ID='$articles[creator]'");
                    if($creator_name->num_rows > 0){
                        while($name = $creator_name->fetch_assoc()){
                            echo  "id= $articles[creator] name: $name[Name]";
                        }
                    }
                    ?>
                </td>
            </tr>
                    <?php }}?>
  </tbody>
</table>
        
                            </div>
                        </div>
                            <?php }}?>




                            <?php
                            // select waiting articles
                    if(isset($_GET['event']) & $_SESSION['user']['role'] >= 10){
                        if($_GET['event'] === 'wait_requests'){
                    ?>
                        <div class="row justify-content-center">
                            <div class="col-6">

                                    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">description</th>
        <th scope="col">status</th>
        <th scope="col">create time</th>
        <th scope="col">views</th>
        <th scope="col">image</th>
        <th scope="col">creator</th>
        <th scope="col">events</th>
        <th scope="col">events</th>
    </tr>
  </thead>
  <tbody>
        
            <?php 
                //  ////////// select waiting articles
              $result = $connection->query("SELECT * FROM articles WHERE `status`=0");
              if($result->num_rows > 0){
                  while($articles = $result->fetch_assoc()){
            ?>
            <tr>
                <th scope="col"><?php echo $articles['ID']; ?></th>
                <td><?php echo $articles['article_title']; ?></td>
                <td><a href="../pages/single.php?id=<?php echo $articles['ID'];?>">description</a></td>
                <td><?php echo $articles['status'] ==0 ?"waiting":"accepted";?></td>
                <td><?php echo $articles['create_time']; ?></td>
                <td><?php echo $articles['views']; ?></td>
                <td><a href="/blog/public/uploads/<?php echo $articles['image_src']; ?>">image</a></td>
                <td>
                    <?php
                    $creator_name = $connection->query("SELECT * FROM users WHERE ID='$articles[creator]'");
                    if($creator_name->num_rows > 0){
                        while($name = $creator_name->fetch_assoc()){
                            echo  "id= $articles[creator] name: $name[Name]";
                        }
                    }
                    ?>
                </td>
                <td>
                    <a class="btn btn-success" href="./event.php?article_id=<?php echo $articles['ID'];?>&event=accept">accpet</a>
                </td>

                <td>
                    <a class="btn btn-danger" href="./event.php?article_id=<?php echo $articles['ID'];?>&event=delete">remove</a>
                </td>
            </tr>
                    <?php }}?>
  </tbody>
</table>
        
                            </div>
                        </div>
                            <?php }}?>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
        </script>

    <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs/dist/purecounter_vanilla.js"></script>

    <script defer src="https://unpkg.com/alpinejs@3.3.4/dist/cdn.min.js"></script>

    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

    <script src="/blog/public/js/charts/chart1.js"></script>
    <script src="/blog/public/js/charts/chart2.js"></script>
    <script src="/blog/public/js/alpineComponents.js"></script>

</body>

</html>