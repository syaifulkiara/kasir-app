<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="{{ asset('aaem/images/favicon.png') }}">
    <title>Aaem - Cafe & Restaurant Mobile Template</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{ asset('aaem/css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('aaem/css/loaders.css') }}">
    <link rel="stylesheet" href="{{ asset('aaem/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('aaem/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('aaem/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('aaem/css/style.css') }}">

</head>
<body>

    <!-- preloader -->
    <div class="preloader">
        <div class="spinner"></div>
    </div>
    <!-- end preloader -->

    <!-- navbar -->
    <div class="navbar">
        <div class="container">
            <div class="row">
                <div class="col s3">
                    <div class="content-left">
                        <a href="#slide-out" data-target="slide-out" class="sidenav-trigger"><i class="fa fa-bars"></i></a>
                        
                    </div>
                </div>
                <div class="col s6">
                    <div class="content-center">
                        <a href="index.html"><h1>Seblak</h1></a>
                    </div>
                </div>
                <div class="col s3">
                    <div class="content-right">
                        <a href="reservation.html"><i class="fa fa-clipboard"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end navbar -->

    <!-- sidebar -->
    <div class="sidebar-panel">
        <ul id="slide-out" class="collapsible sidenav side-left side-nav">
            <li>
                <div class="user-view">
                    <h2><span>S</span>eblak</h2>
                    <p>Cafe & Restaurant</p>
                </div>
            </li>
            <li><a href="#!"><i class="fa fa-home"></i>Home</a></li>
            <li>
                <div class="collapsible-header">
                    <i class="fa fa-list"></i>Menu<span><i class="fa fa-caret-right right"></i></span>
                </div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="menu-list.html">Menu</a></li>
                        <li><a href="menu-details.html">Menu Details</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header">
                    <i class="fa fa-user-circle-o"></i>Chef<span><i class="fa fa-caret-right right"></i></span>
                </div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="chef.html">Chef</a></li>
                        <li><a href="chef-details.html">Chef Details</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header">
                    <i class="fa fa-user"></i>Profile<span><i class="fa fa-caret-right right"></i></span>
                </div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="edit-profile.html">Edit Profile</a></li>
                        <li><a href="forgot-password.html">Forgot Password</a></li>
                        <li><a href="reset-password.html">Reset Password</a></li>
                        <li><a href="login.html">Sign In</a></li>
                        <li><a href="#!.html">Logout</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header">
                    <i class="fa fa-file"></i>Pages<span><i class="fa fa-caret-right right"></i></span>
                </div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="about.html">About</a></li>
                        <li><a href="gallery.html">Gallery</a></li>
                        <li><a href="testimonial.html">Testimonial</a></li>
                        <li><a href="pricing-table.html">Pricing Table</a></li>
                        <li><a href="login.html">Login</a></li>
                        <li><a href="register.html">Register</a></li>
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header">
                    <i class="fa fa-tags"></i>Category<span><i class="fa fa-caret-right right"></i></span>
                </div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="category.html">Category</a></li>
                        <li><a href="category-details.html">Category Details</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header">
                    <i class="fa fa-shopping-cart"></i>Shop<span><i class="fa fa-caret-right right"></i></span>
                </div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="category.html">Category</a></li>
                        <li><a href="cart.html">Cart</a></li>
                        <li><a href="checkout.html">Checkout</a></li>
                        <li><a href="done-process.html">Done</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header">
                    <i class="fa fa-rss"></i>Blog<span><i class="fa fa-caret-right right"></i></span>
                </div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="blog-single.html">Blog Single</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="reservation.html"><i class="fa fa-book"></i>Reservation</a></li>
            <li><a href="open-hours.html"><i class="fa fa-clock-o"></i>Open Hours</a></li>
            <li><a href="contact.html"><i class="fa fa-envelope"></i>Contact</a></li>
            <li><a href="login.html"><i class="fa fa-sign-in"></i>Login</a></li>
            <li><a href="register.html"><i class="fa fa-user-plus"></i>Register</a></li>
            <li><a href="#!"><i class="fa fa-sign-out"></i>Logout</a></li>
        </ul>
    </div>
    <!-- end sidebar -->

    @yield('content')

    <!-- footer -->
    <footer>
        <div class="container">
            <div class="desc">
                <p>58 Poland Street, London</p>
                <span>United Kingdom</span>
            </div>
            <ul>
                <li><a href=""><i class="fa fa-facebook"></i></a></li>
                <li><a href=""><i class="fa fa-twitter"></i></a></li>
                <li><a href=""><i class="fa fa-google"></i></a></li>
                <li><a href=""><i class="fa fa-instagram"></i></a></li>
            </ul>
            <p>Copyright © All Right Reserved</p>
        </div>
    </footer>
    <!-- end footer -->


    <script src="{{ asset('aaem/js/jquery.min.js') }}"></script>
    <script src="{{ asset('aaem/js/materialize.min.js') }}"></script>
    <script src="{{ asset('aaem/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('aaem/js/main.js') }}"></script>


</body>
</html>