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
                                <a href="./event.php?event=create_user">ایجاد کاربران</a>
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
        <?php }}}}?>
    </tbody>
</table>

                </div>
            </div>




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