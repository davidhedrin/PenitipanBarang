@php
    $url = '';
    
    try {
        $url .= $_SERVER['REQUEST_URI'];
    } catch (Exception $ex) {
        $error_msg = $ex->getMessage();
        CommonFunction::insertLogError('ExceptionGuide', 'GetDataCurrentServer', 'Exception', $error_msg);
    }
    $url = str_replace('/', '', $url);
@endphp
<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
    <title>Penitipan Barang</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assetc/css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('assetc/css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('assetc/css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('assetc/css/responsive.css') }}" rel="stylesheet" />
    @livewireStyles
</head>

<body>
    <div class="hero_area_nav">
        <!-- header section strats -->
        <header class="header_section">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a href="{{ route('home') }}">
                        <img width="220" src="{{ asset('assets/img/icons/AsputBox.svg') }}" alt="AsputBox" />
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item {{ $url == '' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('home') }}">Home <span
                                        class="sr-only">(current)</span></a>
                            </li>
                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages <span
                                            class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="about.html">About</a></li>
                                    <li><a href="testimonial.html">Testimonial</a></li>
                                </ul>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" href="product.html">Products</a>
                            </li>
                            @if (!Auth::user())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"
                                        style="text-decoration: underline">Register's</a>
                                </li>
                            @endif
                            {{-- <li class="nav-item">
                                <form class="form-inline">
                                    <button class="btn my-2 my-sm-0 nav_search-btn" type="button">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </li> --}}
                            @if (!Auth::user())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        Login <i class="fa fa-sign-in" aria-hidden="true" style="font-size: 20px"></i>
                                    </a>
                                </li>
                            @elseif (Auth::user())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout') }}">
                                        Logout <i class="fa fa-sign-out" aria-hidden="true" style="font-size: 20px"></i>
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user())
                                <li class="nav-item">
                                    <a class="nav-link" href="#" style="padding-left: 0px">
                                        <i class='fa fa-shopping-basket' aria-hidden="true" style="font-size: 18px"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="" style="padding-left: 0px">
                                        <i class='fa fa-user-circle-o' aria-hidden="true" style="font-size: 20px"></i>
                                        Hi, {{ Auth::user()->name }}
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->
    </div>

    {{ $slot }}

    <!-- footer start -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="full">
                        <div class="logo_footer">
                            <a href="#"><img width="310" src="{{ asset('assets/img/icons/AsputBox.svg') }}"
                                    alt="#" /></a>
                        </div>
                        <div class="information_f">
                            <p><strong>ADDRESS:</strong> 28 White tower, Street Name New York City, USA</p>
                            <p><strong>TELEPHONE:</strong> +91 987 654 3210</p>
                            <p><strong>EMAIL:</strong> yourmain@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="widget_menu">
                                        <h3>Menu</h3>
                                        <ul>
                                            <li><a href="#">Home</a></li>
                                            <li><a href="#">About</a></li>
                                            <li><a href="#">Services</a></li>
                                            <li><a href="#">Testimonial</a></li>
                                            <li><a href="#">Blog</a></li>
                                            <li><a href="#">Contact</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="widget_menu">
                                        <h3>Account</h3>
                                        <ul>
                                            <li><a href="#">Account</a></li>
                                            <li><a href="#">Checkout</a></li>
                                            <li><a href="#">Login</a></li>
                                            <li><a href="#">Register</a></li>
                                            <li><a href="#">Shopping</a></li>
                                            <li><a href="#">Widget</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="widget_menu">
                                <h3>Newsletter</h3>
                                <div class="information_f">
                                    <p>Subscribe by our newsletter and get update protidin.</p>
                                </div>
                                <div class="form_sub">
                                    <form>
                                        <fieldset>
                                            <div class="field">
                                                <input type="email" placeholder="Enter Your Mail" name="email" />
                                                <input type="submit" value="Subscribe" />
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto">© <span id="displayYear"></span> Asrama Putra
            <a href="https://html.design/">
                Universitas Advent Indonesia
            </a>
        </p>
    </div>
    <!-- jQery -->
    <script src="{{ asset('assetc/js/jquery-3.4.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="{{ asset('assetc/js/popper.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('assetc/js/bootstrap.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('assetc/js/custom.js') }}"></script>
    @stack('scripts')
    @livewireScripts
</body>

</html>
