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

    <title>codeyad blog</title>
</head>

<body>

    <section x-data="toggleSidebar" class="bg-info">
        <section x-cloak class="sidebar bg-light" :class="open || 'inactive'">
            <div class="d-flex align-items-center justify-content-between justify-content-lg-center">
                <h4 class="fw-bold">codeyad blog</h4>
                <i @click="toggle" class="d-lg-none fs-1 bi bi-x"></i>
            </div>
            <div class="mt-4">
                <ul class="list-unstyled">
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="./index.html">
                            <i class="me-2 bi bi-grid-fill"></i>
                            <span>داشبورد</span>
                        </a>
                    </li>

                    <li x-data="dropdown" class="sidebar-item">
                        <div @click="toggle" class="sidebar-link">
                            <i class="me-2 bi bi-shop"></i>
                            <span>فروشگاه</span>
                            <i class="ms-auto bi bi-chevron-down"></i>
                        </div>
                        <ul x-show="open" x-transition class="submenu">
                            <li class="submenu-item">
                                <a href="#">لیست فروشگاه ها</a>
                            </li>
                            <li class="submenu-item">
                                <a href="#">ایجاد فروشگاه</a>
                            </li>
                            <li class="submenu-item">
                                <a href="#">ویرایش فروشگاه</a>
                            </li>
                        </ul>
                    </li>

                    <li x-data="dropdown" class="sidebar-item">
                        <div @click="toggle" class="sidebar-link">
                            <i class="me-2 bi bi-box-seam"></i>
                            <span>محصولات</span>
                            <i class="ms-auto bi bi-chevron-down"></i>
                        </div>
                        <ul x-show="open" x-transition class="submenu">
                            <li class="submenu-item">
                                <a href="./products_index.html">لیست محصولات</a>
                            </li>
                            <li class="submenu-item">
                                <a href="#">ایجاد محصول</a>
                            </li>
                            <li class="submenu-item">
                                <a href="#">ویرایش محصول</a>
                            </li>
                        </ul>
                    </li>

                    <li x-data="dropdown" class="sidebar-item">
                        <div @click="toggle" class="sidebar-link">
                            <i class="me-2 bi bi-basket-fill"></i>
                            <span>سفارشات</span>
                            <i class="ms-auto bi bi-chevron-down"></i>
                        </div>
                        <ul x-show="open" x-transition class="submenu">
                            <li class="submenu-item">
                                <a href="#">لیست سفارشات</a>
                            </li>
                            <li class="submenu-item">
                                <a href="#">سفارشات تایید شده</a>
                            </li>
                            <li class="submenu-item">
                                <a href="#">سفارشات تایید نشده</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="me-2 bi bi-percent"></i>
                            <span>تخفیف ها</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="me-2 bi bi-chat-right-dots-fill"></i>
                            <span>تیکت</span>
                        </a>
                    </li>

                    <li x-data="dropdown" class="sidebar-item">
                        <div @click="toggle" class="sidebar-link">
                            <i class="me-2 bi bi-people-fill"></i>
                            <span>کاربران</span>
                            <i class="ms-auto bi bi-chevron-down"></i>
                        </div>
                        <ul x-show="open" x-transition class="submenu">
                            <li class="submenu-item">
                                <a href="#">لیست کاربران</a>
                            </li>
                            <li class="submenu-item">
                                <a href="#">ایجاد کاربران</a>
                            </li>
                            <li class="submenu-item">
                                <a href="#">ویرایش کاربران</a>
                            </li>
                        </ul>
                    </li>

                    <li x-data="dropdown" class="sidebar-item">
                        <div @click="toggle" class="sidebar-link">
                            <i class="me-2 bi bi-power"></i>
                            <span> خروج</span>
                            <i class="ms-auto bi "></i>
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