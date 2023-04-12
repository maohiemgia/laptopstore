<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Typhoon Store</title>

    {{-- favicon web --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon/favicon-16x16.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lightslider.min.css') }}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- nice select CSS -->
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="{{ asset('css/price_rangs.css') }}">

    @yield('style')
</head>

<body style="position: relative;">
    <!--::header part start::-->
    <header class="main_menu home_menu position-fixed sticky-top bg-white w-100" id="navbar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light justify-content-end">
                        <a class="navbar-brand bg-danger text-white text-uppercase px-3 mx-auto font-weight-bold d-none d-lg-block"
                            href="/">
                            typhoon
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"><i class="fas fa-bars"></i></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item w-100" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item d-block d-lg-none">
                                    <a class="nav-brand bg-danger text-white text-uppercase fa-2x px-3 mx-auto font-weight-bold"
                                        href="/">
                                        typhoon
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/product-list" role="button">
                                        Sản phẩm
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/find-order" role="button">
                                        Tra đơn
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/contact">Liên hệ</a>
                                </li>
                            </ul>
                        </div>
                        <div class="hearer_icon d-flex align-items-center">
                            <a id="search_1" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <div class="dropdown cart">
                                <a class="dropdown-toggle" href="/cart" role="button">
                                    <i class="fas fa-shopping-cart">
                                        <span id="cartcountdisplay"></span>
                                    </i>
                                </a>
                                {{-- @if (!isset(Auth::user()->name))
                                    <a class="dropdown-toggle" href="/cart" role="button">
                                        <i class="fas fa-cart-plus"></i>
                                    </a>
                                @else
                                    <a class="dropdown-toggle" href="#"
                                        onclick="updateCartAction({{ Auth::user()->id }})" role="button">
                                        <i class="fas fa-cart-plus"></i>
                                    </a>
                                @endif --}}

                                {{-- <a class="dropdown-toggle" href="#" id="navbarDropdown3" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cart-plus"></i>
                                </a> --}}
                                {{-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <div class="single_product">
                                    </div>
                                </div> --}}
                            </div>
                            @if (isset(Auth::user()->name))
                                <div class="nav-item dropdown">
                                    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"
                                        aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </button>
                                    <div class="dropdown-menu" style="width: 170px; left:-50px">
                                        <a class="dropdown-item" href="/dashboard">
                                            {{ __('Quản trị Web') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                            {{ __('Quản lý tài khoản') }}
                                        </a>
                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item" href="route('logout')"
                                                onclick="event.preventDefault();
                                 this.closest('form').submit();">
                                                {{ __('Đăng xuất') }}
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <a id="loginbtn" href="/login" title="đăng nhập">
                                    <i class="ti-user"></i>
                                </a>
                            @endif
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container ">
                <form class="d-flex justify-content-between search-inner">
                    <input type="text" class="form-control" id="search_input" placeholder="Nhập tìm kiếm">
                    <button type="submit" class="btn"></button>
                    <span class="ti-close" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </header>
    <!-- Header part end-->
    @yield('main-content')

    <!--::footer_part start::-->
    <footer class="footer_part">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-sm-6 col-lg-2">
                    <div class="single_footer_part">
                        <h4>Điều hướng</h4>
                        <ul class="list-unstyled">
                            <li><a href="/">Trang chủ</a></li>
                            <li><a href="/product-list">Mua sắm</a></li>
                            <li><a href="">Tra cứu đơn hàng</a></li>
                            <li><a href="">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-2">
                    <div class="single_footer_part">
                        <h4>Tin tức</h4>
                        <ul class="list-unstyled">
                            <li><a href="">Tin tức khuyến mãi</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="single_footer_part">
                        <h4>Điều khoản và bảo hành</h4>
                        <ul class="list-unstyled">
                            <li><a href="">Chính sách đổi trả hàng</a></li>
                            <li><a href="">Chính sách bảo hành</a></li>
                            <li><a href="">Chính sách vận chuyển</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-5">
                    <div class="single_footer_part">
                        <h4>Theo dõi chúng tôi</h4>
                        <p>
                            Đăng ký để nhận thông báo và mã giảm giá từ chúng tôi cho các sự kiện sắp tới qua email.
                        </p>
                        <div id="mc_embed_signup">
                            <form target="_blank"
                                action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                method="get" class="subscribe_form relative mail_part">
                                <input type="email" name="email" id="newsletter-form-email"
                                    placeholder="Địa chỉ email" class="placeholder hide-on-focus"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = ' Email Address '">
                                <button type="submit" name="submit" id="newsletter-submit"
                                    class="email_icon newsletter-submit button-contactForm">Theo dõi</button>
                                <div class="mt-10 info"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="copyright_part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="copyright_text">
                            <P>
                                Hân hạnh được phục vụ bạn ^_^
                            </P>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer_icon social_icon">
                            <ul class="list-unstyled">
                                <li>
                                    <a href="fb.com/nvantuan99" class="single_social_icon"><i
                                            class="fab fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="fb.com/nvantuan99" class="single_social_icon"><i
                                            class="fab fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="fb.com/nvantuan99" class="single_social_icon"><i
                                            class="fas fa-globe"></i></a>
                                </li>
                                <li>
                                    <a href="fb.com/nvantuan99" class="single_social_icon"><i
                                            class="fab fa-behance"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <button type="button" class="btn btn-secondary mx-auto d-block" id="addtocartnotification"
             data-toggle="popover" data-placement="right">
            Popover on right
        </button> --}}
    </footer>
    <!--::footer_part end::-->

    <script>
        // menu display when scroll event
        var prevScrollpos = window.pageYOffset;
        window.onscroll = function() {
            var currentScrollPos = window.pageYOffset;
            if (prevScrollpos > currentScrollPos) {
                document.getElementById("navbar").style.top = "0";
            } else {
                document.getElementById("navbar").style.top = "-100px";
            }
            prevScrollpos = currentScrollPos;
        }

        // display cart item length
        let cartCountDisplay = document.getElementById('cartcountdisplay');

        function updateDisplayCartLengthFunc() {
            cartCountDisplay.style.display = 'none';

            let localCart = JSON.parse(localStorage.getItem("cart"));
            if (localCart != null && localCart.length > 0) {
                cartCountDisplay.style.display = 'block';
                cartCountDisplay.innerText = localCart.length;
            }
        }

        // display add to cart notification
        window.addEventListener('DOMContentLoaded', function() {
            updateDisplayCartLengthFunc();
            let addtocartBtn = document.getElementById('addtocartbtn');

            $(addtocartBtn).popover({
                content: 'Thêm vào giỏ hàng thành công!',
                placement: 'right',
                trigger: 'click',
                container: 'body'
            });

            $(addtocartBtn).on('shown.bs.popover', function() {
                updateDisplayCartLengthFunc();

                setTimeout(function() {
                    $(addtocartBtn).popover('hide');
                }, 2000);
            });
        });

        // clear all cart item
        function cartClear() {
            let confirmDel = window.confirm("Xác nhận xóa hết");

            if (confirmDel) {
                localStorage.removeItem('cart');
                updateDisplayCartLengthFunc();

                location.reload();
            }
        }

        function displayAlert(textWantDisplay) {
            const notification = document.createElement("div");
            notification.className = "alert alert-success position-absolute";
            notification.style.cssText =
                "top: 4%; right: 1%; width: fit-content; max-width: 400px; z-index: 999;";
            notification.setAttribute("role", "alert");
            notification.textContent = textWantDisplay;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.classList.add("alert-fade-out");
                setTimeout(() => {
                    notification.remove();
                }, 1000); // Remove the element after the 1s fade-out animation is complete
            }, 3000); // Start the fade-out animation after 3 seconds
        }
    </script>


    <!-- jquery plugins here-->
    <script src="{{ asset('js/jquery-1.12.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- easing js -->
    <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset('js/lightslider.min.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset('js/swiper.min.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset('js/masonry.pkgd.js') }}"></script>
    <!-- particles js -->
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <!-- slick js -->
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/contact.js') }}"></script>
    <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('js/jquery.form.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/mail-script.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
