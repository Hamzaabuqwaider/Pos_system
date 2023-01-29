<?php

use Core\Helpers\Helper;
use Core\Model\User;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;1,900&family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;1,900&family=Open+Sans&family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/Images/pos20.png">
    <link rel="stylesheet" href="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/css/media.css">

</head>

<body class="admin-view">
    <nav class="navbar navbar-dark">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Navbar brand -->
            <a class="navbar-brand" style="color:white; font-size: 2rem; font-family: fantasy;" href=""><span style="color:red;">POS</span> System</a>

            <!-- Collapsible wrapper -->
            <div id="navbarSupportedContent">
                <!-- Left links -->
                <ul class="navbar-nav d-flex flex-row mt-3 mt-lg-0">
                    <?php
                    $id = $_SESSION['user']['user_id'];
                    // $sql = "SELECT img FROM users WHERE id = $id";
                    $user = new User();
                    $user_info = $user->get_by_id($id);
                    ?>
                    <div class="pe-3">
                        <a href="/user/profile"><img src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/Images/<?= $user_info->img ?>" style="width: 45px; height: 45px;outline: 4px solid white;" class="rounded-circle" alt=""></a>
                    </div>
                </ul>
            </div>
        </div>
    </nav>

    <div id="admin-area" class="row">
        <div class="col-2 admin-links admin-web pe-0 pt-4">
            <div class="nav-menu">
                <ul>
                    <?php if (Helper::check_permission(['user:read'])) : ?>
                        <li class="pb-2"><a href="/dashboard"><i class="fas fa-home fa-lg mb-1 pe-4"></i>Home</a></li>
                    <?php endif; ?>
                    <?php if (Helper::check_permission(['item:read'])) : ?>
                        <li class="pb-2"><a href="/items"><i class="fa-solid fa-layer-group pe-4"></i>Items</a></li>
                    <?php endif;
                    if (Helper::check_permission(['item:create'])) :
                    ?>
                        <li class="pb-2"><a href="/items/create"><i class="fa-solid fa-plus pe-4"></i>Add Items</a></li>
                    <?php endif;
                    if (Helper::check_permission(['user:read'])) :
                    ?>
                        <li class="pb-2"><a href="/users"><i class="fa-solid fa-users pe-4"></i>Users</a></li>
                    <?php endif;
                    if (Helper::check_permission(['user:create'])) :
                    ?>
                        <li class="pb-2"><a href="/users/create"><i class="fa-solid fa-user-plus pe-4"></i>Add Users</a></li>
                    <?php endif;
                    if (Helper::check_permission(['seller:read'])) :
                    ?>
                        <li class="pb-2"><a href="/transactions/page"><i class="fa-solid fa-cart-shopping pe-4"></i>Selling</a></li>
                    <?php endif;

                    if (Helper::check_permission(['account:read'])) :
                    ?>
                        <li class="pb-2"><a href="/accounts/page"><i class="fa-solid fa-file-invoice-dollar pe-4"></i>Accounts</a></li>
                    <?php endif; ?>
                    <?php if (Helper::check_permission(['user:read'])) : ?>

                        <li class="pb-2"><a href="/list/message"><i class="fa-solid fa-envelope pe-4"></i>Emails</a></li>
                    <?php endif; ?>
                    <?php if (!(Helper::check_permission(['user:read']))) : ?>

                        <li class="pb-2"><a href="/contact/page"><i class="fa-solid fa-pen-nib pe-4"></i>Contact Admin</a></li>
                    <?php endif; ?>
                    <li class="pb-2 mt-4"><a href="/logout"><i class="fa-solid fa-right-from-bracket pe-4"></i>Logout</a></li>

                </ul>
            </div>

        </div>


        <!-- Mobile  -->
        <div class="col-2 admin-links admin-mobile pe-0 pt-4 d-none">
            <div class="nav-menu-mobile">
                <ul>
                    <?php if (Helper::check_permission(['user:read'])) : ?>
                        <li class="pb-2"><a href="/dashboard"><i class="fas fa-home fa-lg mb-1 pe-4"></i></a></li>
                    <?php endif; ?>
                    <?php if (Helper::check_permission(['item:read'])) : ?>
                        <li class="pb-2"><a href="/items"><i class="fa-solid fa-layer-group pe-4"></i></a></li>
                    <?php endif;
                    if (Helper::check_permission(['item:create'])) :
                    ?>
                        <li class="pb-2"><a href="/items/create"><i class="fa-solid fa-plus pe-4"></i></a></li>
                    <?php endif;
                    if (Helper::check_permission(['user:read'])) :
                    ?>
                        <li class="pb-2"><a href="/users"><i class="fa-solid fa-users pe-4"></i></a></li>
                    <?php endif;
                    if (Helper::check_permission(['user:create'])) :
                    ?>
                        <li class="pb-2"><a href="/users/create"><i class="fa-solid fa-user-plus"></i></a></li>
                    <?php endif;
                    if (Helper::check_permission(['seller:read'])) :
                    ?>
                        <li class="pb-2"><a href="/transactions/page"><i class="fa-solid fa-cart-shopping"></i></a></li>
                    <?php endif;

                    if (Helper::check_permission(['account:read'])) :
                    ?>
                        <li class="pb-2"><a href="/accounts/page"><i class="fa-solid fa-file-invoice-dollar pe-4"></i></a></li>
                    <?php endif; ?>

                    <?php if (Helper::check_permission(['user:read'])) : ?>

                        <li class="pb-2"><a href="/list/message"><i class="fa-solid fa-envelope pe-4"></i></a></li>
                    <?php endif; ?>
                    <?php if (!(Helper::check_permission(['user:read']))) : ?>

                        <li class="pb-2"><a href="/contact/page"><i class="fa-solid fa-pen-nib pe-4"></i></a></li>
                    <?php endif; ?>

                    <li class="pb-2 mt-4"><a href="/logout"><i class="fa-solid fa-right-from-bracket pe-4"></i></a></li>

                </ul>
            </div>

        </div>




        <div class="col-10 admin-area-content">
            <div class="my-5">