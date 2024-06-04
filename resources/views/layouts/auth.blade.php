<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Fastkart admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Fastkart admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('frontend/assets/logos/logos_foods.png') }}" type="image/x-icon">
    <title>Asian food museum</title>

    <!-- Google font -->

    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">

    <!-- Template css -->

    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/style.css') }}">

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/remixicon.css') }}">

    <!-- Fontawesome css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/font-awesome.css') }}">

    <!-- Themify icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/themify.css') }}">

    <!-- ratio css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/ratio.css') }}">

    <!-- Feather icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/feather-icon.css') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/animate.css') }}">

    <!-- datepicker css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/date-picker.css') }}">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/bootstrap.css') }}">

    <!-- vector map css  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vector-map.css') }}">

    <!-- slick slider css-->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/vendors/slick.css') }}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/style.css') }}">
    {{-- <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/style.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/custom-css.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/input-tags/css/tagsinput.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/bootstrap_toggle/bootstrap-toggle.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/toastr/toastr.css') }}">

</head>

<body>
    <!-- tap on top start -->
    <div class="tap-top">
        <span class="lnr lnr-chevron-up"></span>
    </div>
    <!-- tap on tap end -->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-header">
            <div class="header-wrapper m-0">
                <div class="header-logo-wrapper p-0">
                    <div class="logo-wrapper">
                        <a href="{{route('admin.dashboard')}}">
                            <img class="img-fluid main-logo" src="{{ asset('images/logos/logo-h4.png') }}" alt="logo">

                        </a>
                    </div>
                    <div class="toggle-sidebar">
                        <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
                        <a href="{{route('admin.dashboard')}}">
                            <img src="{{ asset('images/logos/logo-h4.png') }}" class="img-fluid" alt="">
                        </a>
                    </div>
                </div>

                @if (request()->is('admin/shoplist') ||
                    request()->is('admin/product') ||
                    request()->is('admin/category') ||
                    request()->is('admin/all/blog') ||
                    request()->is('admin/indexfaq') ||
                    request()->is('admin/coupon') ||
                    request()->is('admin/orderlist') ||
                    request()->is('admin/review/product') ||
                    request()->is('admin/all/users'))
                <div class="search-box">
                    <form id="mainSearchForm" action="{{ url()->current() }}" method="GET">
                        <div class="input-group">
                            <input type="search" class="form-control" name="mainSearch" placeholder="I'm searching for...">
                            <button class="btn" type="submit" id="button-addon2">
                                <i data-feather="search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                @endif

                <div class="nav-right col-6 pull-right right-header p-0">
                    <ul class="nav-menus">
                        <li>
                            <span class="header-search">
                                <i class="ri-search-line"></i>
                            </span>
                        </li>
                        <li class="onhover-dropdown">
                            <div class="notification-box">
                                <i class="ri-notification-line"></i>
                                <span id="notification-badge" class="badge rounded-pill badge-theme">{{ $notiCount }}</span>
                            </div>
                            <ul class="onhover-show-div" >
                                <li style="display:block">
                                    <i class="ri-notification-line"></i>
                                    <h6 class="f-18 mb-0">Notitications</h6>
                                </li>
                                @php
                                    $iro = ["#0da487","#9e65c2","#a927f9","#6670bd","#6670bd","#a927f9","#6670bd","#6670bd"];
                                @endphp

                                @foreach($notifications as $key => $notify)
                                @if(!empty($notify->time))
                                <li >
                                    <p>

                                        <i class="fa fa-circle me-2 font-primary notification-circle" style="font-size:11px;color: {{ $iro[$key] }} !important"></i>{{ $notify->message }}<span
                                            class="pull-right">&nbsp;&nbsp;&nbsp;{{ \Carbon\Carbon::parse($notify->time)->format('y-m-d H:i') }}</span>
                                    </p>
                                </li>
                                @endif
                                @endforeach
                                <li style="display:block">
                                    <a class="btn btn-primary mx-auto" href="javascript:void(0)" onclick="checkAllNotifications()">Check all notification</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <div class="mode">
                                <i class="ri-moon-line"></i>
                            </div>
                        </li>
                        <li class="profile-nav onhover-dropdown pe-0 me-0">
                            <div class="media profile-media">
                                <img src="{{ (!empty(Auth::user()->user_photo)) ? url('images/'.Auth::user()->user_photo) : url('backend/assets/images/users/4.jpg') }}" class="user-profile rounded-circle">

                                <div class="user-name-hide media-body">
                                    <span>{{ auth()->user()->name }}</span>
                                </div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div">
                                    <li>
                                        <a href="{{ url('/edit/'.auth()->user()->role.'/'.rand ( 10000 , 99999 )) }}">
                                            <i data-feather="user"></i>
                                                <span>Profile</span>
                                        </a>
                                    </li><br>
                                    <li>
                                        <a data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                            href="javascript:void(0)">
                                            <i data-feather="log-out"></i>
                                            <span>Log out</span>
                                        </a>
                                    </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Page Header Ends-->

        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="sidebar-wrapper">
                <div id="sidebarEffect"></div>
                <div>
                    <div class="logo-wrapper logo-wrapper-center">
                        <a href="{{route('admin.dashboard')}}" data-bs-original-title="" title="">
                            <img class="img-fluid for-white" src="{{ asset('images/logos/logo-h4.png') }}" alt="logo">
                        </a>
                        <div class="back-btn">
                            <i class="fa fa-angle-left"></i>
                        </div>
                        <div class="toggle-sidebar">
                            <i class="ri-apps-line status_toggle middle sidebar-toggle"></i>
                        </div>
                    </div>
                    <nav class="sidebar-main">
                        <div class="left-arrow" id="left-arrow">
                            <i data-feather="arrow-left"></i>
                        </div>

                        <div id="sidebar-menu">
                            <ul class="sidebar-links" id="simple-bar">
                                <li class="back-btn"></li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.dashboard') }}">
                                        <i class="ri-home-line"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.all.shop') }}">
                                        <img style="width:20px;color:white"  src="{{ asset('backend/assets/images/icon/shop.png') }}" alt="logo">
                                        &nbsp;  &nbsp;<span>Shops</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.all.product') }}">
                                        <i class="ri-store-3-line"></i>
                                        <span>Products</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.category') }}">
                                        <img style="width:22px;color:white"  src="{{ asset('backend/assets/images/icon/category.png') }}" alt="logo">
                                        &nbsp;  &nbsp;<span>Categories</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('orderlist') }}">
                                        <i class="ri-archive-line"></i>
                                        <span>Orders</span>
                                    </a>
                                </li>

                                 <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.all.blog') }}">
                                        <i class="ri-newspaper-line"></i>
                                        <span>News</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ url('/admin/top') }}">
                                        <img style="width:25px;color:white"  src="{{ asset('backend/assets/images/icon/top.png') }}" alt="logo">
                                        &nbsp;  &nbsp;<span>Top</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ url('/admin/coupon') }}">
                                        <img style="width:20px;color:white"  src="{{ asset('backend/assets/images/icon/coupon.png') }}" alt="logo">
                                        &nbsp;  &nbsp;<span>Coupon</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.product.review') }}">
                                        <i class="ri-star-line"></i>
                                        <span>Review</span>
                                    </a>
                                </li>

                                 <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.all.users') }}">
                                        <i class="ri-file-user-line"></i>
                                        <span>Users</span>
                                    </a>
                                </li>
                                @if(auth()->user()->id == '1')
                                <li class="sidebar-list">

                                    <a class="sidebar-link sidebar-title link-nav" href="{{ url('/admin/subadmin') }}">
                                        <i class="ri-admin-line"></i>
                                        <span>SubAdmin</span>
                                    </a>
                                </li>
                                @endif

                                <li class="sidebar-list">
                                   <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.bank_account') }}">
                                       <i class="ri-file-user-line"></i>
                                       <span>Bank Account</span>
                                   </a>
                               </li>

                                <li class="sidebar-list">

                                    <a class="sidebar-link sidebar-title link-nav" href="{{ url('/admin/faq') }}">
                                        <img style="width:20px;color:white"  src="{{ asset('backend/assets/images/icon/faq.png') }}" alt="logo">
                                        &nbsp;  &nbsp;<span>FAQ</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ route('admin.indexhelp') }}">
                                        <img style="width:20px;color:white"  src="{{ asset('backend/assets/images/icon/help.png') }}" alt="logo">
                                        &nbsp;  &nbsp;<span>Contact</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ url('/admin/indexcustomer') }}">
                                        <img style="width:20px;color:white"  src="{{ asset('backend/assets/images/icon/customer.png') }}" alt="logo">
                                        &nbsp;  &nbsp;<span>Customer</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ url('admin/newsletter') }}">
                                        <img style="width:20px;color:white"  src="{{ asset('backend/assets/images/icon/newsletter.png') }}" alt="logo">
                                        &nbsp;  &nbsp;<span>NewsLetter</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav" href="{{ url('/edit/'.auth()->user()->role.'/'.rand ( 10000 , 99999 )) }}">
                                        <i class="ri-profile-line"></i>
                                        <span>Profile</span>
                                    </a>
                               </li>
                            </ul>
                        </div>

                        <div class="right-arrow" id="right-arrow">
                            <i data-feather="arrow-right"></i>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- Page Sidebar Ends-->

           {{$slot}}

           <!-- footer start-->
            <div class="container-fluid">
                <footer class="footer">
                    <div class="row">
                        <div class="col-md-12 footer-copyright text-center">
                            <p class="mb-0">©2024 Asia Human Development, Inc. All rights reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- footer End-->

        </div>
        <!-- Page Body End-->
    </div>
    <!-- page-wrapper End-->

    <div class="modal fade theme-modal remove-coupon" id="staticBackdrop" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-block text-center">
                    <h5 class="modal-title w-100" id="exampleModalLabel22">Logging Out</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="remove-box">
                        <p>Are you sure you want to log out?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('adminlogout')}}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </form>
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <!-- latest js -->
    <script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('backend/assets/input-tags/js/tagsinput.js') }}"></script>
    <script src="{{ asset('backend/assets/bootstrap_toggle/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/toastr/toastr.min.js') }}"></script>

    <!-- Bootstrap js -->
    <script src="{{ asset('backend/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>

    <!-- feather icon js -->
    <script src="{{ asset('backend/assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/icons/feather-icon/feather-icon.js') }}"></script>

    <!-- scrollbar simplebar js -->
    <script src="{{ asset('backend/assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('backend/assets/js/scrollbar/custom.js') }}"></script>

    <!-- Sidebar js -->
    <script src="{{ asset('backend/assets/js/config.js') }}"></script>

    <!-- tooltip init js -->
    <script src="{{ asset('backend/assets/js/tooltip-init.js') }}"></script>

    <!-- Plugins js -->
    <script src="{{ asset('backend/assets/js/sidebar-menu.js') }}"></script>
    {{-- <script src="{{ asset('backend/assets/js/notify/bootstrap-notify.min.js') }}"></script> --}}
    <script src="{{ asset('backend/assets/js/notify/index.js') }}"></script>

    <!-- Apexchar js -->
    <script src="{{ asset('backend/assets/js/chart/apex-chart/apex-chart1.js') }}"></script>
    <script src="{{ asset('backend/assets/js/chart/apex-chart/moment.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('backend/assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('backend/assets/js/chart/apex-chart/chart-custom.js') }}"></script>

    <!-- ratio js -->
    <script src="{{ asset('backend/assets/js/ratio.js') }}"></script>

    <!-- sidebar effect -->
    <script src="{{ asset('backend/assets/js/sidebareffect.js') }}"></script>

    <!-- Theme js -->
    <script src="{{ asset('backend/assets/js/script.js') }}"></script>
    <script>
        // Assuming you have some JavaScript code to handle deletion
        document.querySelector('.delete-icon').addEventListener('click', function() {
          // Code to delete the store goes here
          // For demonstration, let's just remove the entire store element
          document.getElementById('store').remove();
        });
      </script>
      <script>
        function checkAllNotifications() {
            var notificationCircles = document.querySelectorAll('.notification-circle');
            notificationCircles.forEach(function(circle) {
                circle.style.setProperty('color', '#ffffff', 'important');
            });
            var badge = document.getElementById('notification-badge');
            if (badge) {
                badge.style.display = 'none';
            }
        }
    </script>
</body>

</html>
