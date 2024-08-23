<!DOCTYPE html>
<html lang="en" data-menu-color="light">

<head>
	<meta charset="utf-8" />
	<title>Purity</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
	<meta content="Techzaa" name="author" />

	<!-- App favicon -->
	<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

	<!-- Daterangepicker css -->
	<link rel="stylesheet" href="{{ asset('assets/vendor/daterangepicker/daterangepicker.css') }}">

	<!-- Vector Map css -->
	<link rel="stylesheet" href="{{ asset('assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}">
    
	<!-- Theme Config Js -->
	<script src="{{ asset('assets/js/config.js') }}"></script>

	<!-- App css -->
	<link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

	<!-- Icons css -->
	<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!--toaster -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
   
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    
    @yield('css')
   
   
</head>

<body>
	<!-- Begin page -->
	<div class="wrapper">

		<!-- ========== Topbar Start ========== -->
<div class="navbar-custom">
    <div class="topbar container-fluid">
        <div class="d-flex align-items-center gap-1">

            <!-- Topbar Brand Logo -->
            <div class="logo-topbar">
                <!-- Logo light -->
                <a href="index.html" class="logo-light">
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo">
                    </span>
                </a>

                <!-- Logo Dark -->
                <a href="index.html" class="logo-dark">
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-dark.png') }}" alt="dark logo">
                    </span>
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo">
                    </span>
                </a>
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="mdi mdi-menu"></i>
            </button>

            <!-- Page Title -->
            <h4 class="page-title d-none d-sm-block">Admin</h4>
        </div>

        <ul class="topbar-menu d-flex align-items-center gap-3">
            <li class="dropdown d-lg-none">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="mdi mdi-magnify fs-2"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                    <form class="p-3">
                        <input type="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                    </form>
                </div>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ asset('assets/images/flags/us.jpg') }}" alt="user-image" class="me-0 me-sm-1" height="12">
                    <span class="align-middle d-none d-lg-inline-block">English</span>
                    <span class="mdi mdi-chevron-down fs-22 d-none d-sm-inline-block align-middle"></span>

                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">
                        <img src="{{ asset('assets/images/flags/germany.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">
                        <img src="{{ asset('assets/images/flags/italy.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">
                        <img src="{{ asset('assets/images/flags/spain.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">
                        <img src="{{ asset('assets/images/flags/russia.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                    </a>

                </div>
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="ri-mail-line fs-22"></i>

                    <span class="noti-icon-badge badge text-bg-purple">4</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                    <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0 fs-16 fw-semibold"> Messages</h6>
                            </div>
                            <div class="col-auto">
                                <a href="javascript: void(0);" class="text-dark text-decoration-underline">
                                    <small>Clear All</small>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div style="max-height: 300px;" data-simplebar>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item read-noti card m-0 shadow-none">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="notify-icon">
                                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" class="img-fluid rounded-circle" alt="" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-truncate ms-2">
                                        <h5 class="noti-item-title fw-semibold fs-14">Cristina Pride <small class="fw-normal text-muted float-end ms-1">1 day ago</small></h5>
                                        <small class="noti-item-subtitle text-muted">Hi, How are you? What about our
                                            next meeting</small>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item read-noti card m-0 shadow-none">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="notify-icon">
                                            <img src="{{ asset('assets/images/users/avatar-2.jpg') }}" class="img-fluid rounded-circle" alt="" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-truncate ms-2">
                                        <h5 class="noti-item-title fw-semibold fs-14">Sam Garret <small class="fw-normal text-muted float-end ms-1">2 day ago</small></h5>
                                        <small class="noti-item-subtitle text-muted">Yeah everything is fine</small>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item read-noti card m-0 shadow-none">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="notify-icon">
                                            <img src="{{ asset('assets/images/users/avatar-3.jpg') }}" class="img-fluid rounded-circle" alt="" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-truncate ms-2">
                                        <h5 class="noti-item-title fw-semibold fs-14">Karen Robinson <small class="fw-normal text-muted float-end ms-1">2 day ago</small></h5>
                                        <small class="noti-item-subtitle text-muted">Wow that's great</small>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item read-noti card m-0 shadow-none">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="notify-icon">
                                            <img src="{{ asset('assets/images/users/avatar-4.jpg') }}" class="img-fluid rounded-circle" alt="" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-truncate ms-2">
                                        <h5 class="noti-item-title fw-semibold fs-14">Sherry Marshall <small class="fw-normal text-muted float-end ms-1">3 day ago</small></h5>
                                        <small class="noti-item-subtitle text-muted">Hi, How are you? What about our
                                            next meeting</small>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item p-0 notify-item read-noti card m-0 shadow-none">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="notify-icon">
                                            <img src="{{ asset('assets/images/users/avatar-5.jpg') }}" class="img-fluid rounded-circle" alt="" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 text-truncate ms-2">
                                        <h5 class="noti-item-title fw-semibold fs-14">Shawn Millard <small class="fw-normal text-muted float-end ms-1">4 day ago</small></h5>
                                        <small class="noti-item-subtitle text-muted">Yeah everything is fine</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary text-decoration-underline fw-bold notify-item border-top border-light py-2">
                        View All
                    </a>

                </div>
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="ri-notification-3-line fs-22"></i>
                    <span class="noti-icon-badge badge text-bg-pink">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                    <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0 fs-16 fw-semibold"> Notification</h6>
                            </div>
                            <div class="col-auto">
                                <a href="javascript: void(0);" class="text-dark text-decoration-underline">
                                    <small>Clear All</small>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div style="max-height: 300px;" data-simplebar>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-primary-subtle">
                                <i class="mdi mdi-account text-primary"></i>
                            </div>
                            <p class="notify-details">Caleb Flakelar commented on Admin
                                <small class="noti-time">1 min ago</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-warning-subtle">
                                <i class="mdi mdi-account-plus text-warning"></i>
                            </div>
                            <p class="notify-details">New user registered.
                                <small class="noti-time">5 hours ago</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-danger-subtle">
                                <i class="mdi mdi-heart text-danger"></i>
                            </div>
                            <p class="notify-details">Carlos Crouch liked
                                <small class="noti-time">3 days ago</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-pink-subtle">
                                <span class="mdi mdi-account-box text-pink"></span>
                            </div>
                            <p class="notify-details">Caleb Flakelar commented on Admi
                                <small class="noti-time">4 days ago</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-purple-subtle">
                                <i class="mdi mdi-account-plus text-purple"></i>
                            </div>
                            <p class="notify-details">New user registered.
                                <small class="noti-time">7 days ago</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-success-subtle text-success">
                            </div>
                            <p class="notify-details">Carlos Crouch liked <b>Admin</b>.
                                <small class="noti-time">Carlos Crouch liked</small>
                            </p>
                        </a>
                    </div>

                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary text-decoration-underline fw-bold notify-item border-top border-light py-2">
                        View All
                    </a>

                </div>
            </li>

            <li class="d-none d-sm-inline-block">
                <a class="nav-link" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
                    <span class="ri-settings-3-line fs-22"></span>
                </a>
            </li>

            <li class="d-none d-sm-inline-block">
                <div class="nav-link" id="light-dark-mode">
                    <i class="ri-moon-line fs-22"></i>
                </div>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle arrow-none nav-user" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="account-user-avatar">
                        <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-image" width="32" class="rounded-circle">
                    </span>
                    <span class="d-lg-block d-none">
                        @if(Auth::check())
                        <h5 class="my-0 fw-normal">{{ Auth::user()->name }}<i class="ri-arrow-down-s-line fs-22 d-none d-sm-inline-block align-middle"></i></h5>
                       @endif</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="pages-profile.html" class="dropdown-item">
                        <i class="ri-account-pin-circle-line fs-16 align-middle me-1 "></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="pages-profile.html" class="dropdown-item">
                        <i class="ri-settings-4-line fs-16 align-middle me-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="pages-faq.html" class="dropdown-item">
                        <i class="ri-customer-service-2-line fs-16 align-middle me-1"></i>
                        <span>Support</span>
                    </a>

                    <!-- item-->
                    <a href="auth-lock-screen.html" class="dropdown-item">                
                        <i class="ri-lock-line fs-16 align-middle me-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="{{ route('logout') }}" class="dropdown-item">
                        <i class="ri-logout-circle-r-line align-middle me-1"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- ========== Topbar End ========== -->

		<!-- Left Sidebar Start -->
		<div class="leftside-menu">

		    <!-- Logo Light -->
		    <a href="index.html" class="logo logo-light">
		        <span class="logo-lg">
		            <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
		        </span>
		        <span class="logo-sm">
		            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo">
		        </span>
		    </a>

		    <!-- Logo Dark -->
		    <a href="index.html" class="logo logo-dark">
		        <span class="logo-lg">
		            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="dark logo">
		        </span>
		        <span class="logo-sm">
		            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo">
		        </span>
		    </a>

		    <!-- Sidebar -->
		    <div data-simplebar>
		        <ul class="side-nav">
		            

		            <li class="side-nav-item">
		                <a href="{{ route('admin.index') }}" class="side-nav-link">
		                    <i class="ri-dashboard-2-line"></i>
		                    <span> Dashboard </span>
		                    <span class="badge bg-success float-end"></span>
		                </a>
		            </li> 
                    {{-- <li class="side-nav-item">
		                <a href="{{ route('admin.datatable') }}" class="side-nav-link">
		                    <i class="ri-dashboard-2-line"></i>
		                    <span> check data table </span>
		                    <span class="badge bg-success float-end"></span>
		                </a>
		            </li>  --}}
                  
                    <li class="side-nav-item">
		                <a href="{{ route('admin.viewUser') }}" class="side-nav-link">
                        <i class="ri-account-circle-line 3x"></i>
		                    <span> Staff </span>
		                    <span class="badge bg-success float-end"></span>
		                </a>
                       
	                </li>

    <li class="side-nav-item">
		                <a data-bs-toggle="collapse" href="#sidebarPagesinvoice" aria-expanded="false" aria-controls="sidebarPagesinvoice" class="side-nav-link">
		                    <i class="ri-article-line"></i>
		                    <span>Purchase</span>
		                    <span class="menu-arrow"></span>

		                </a>
		                <div class="collapse" id="sidebarPagesinvoice">
		                    <ul class="side-nav-second-level">
		                        <li class="side-nav-item">
		                            <a class="side-nav-link" href="{{ route('viewIndividualPurchase') }}">Personal</a>
		                        </li>
		                        <li class="side-nav-item">
		                            <a class="side-nav-link" href="{{ route('admin.corporate.purchase') }}">Corporate</a>
		                        </li>
		                    </ul>
		                </div>
		            </li>
                    <!-- <li class="side-nav-item">
		                <a href="{{ route('admin.subcategory') }}" class="side-nav-link">
                        <i class="ri-store-line"></i>
		                    <span> Sub category </span>
		                    <span class="badge bg-success float-end"></span>
		                </a>
                       
	</li> -->
	<li class="side-nav-item">
		                <a href="{{ route('admin.getAddProduct') }}" class="side-nav-link">
                        <i class="ri-store-line"></i>
		                    <span> Products </span>
		                    <span class="badge bg-success float-end"></span>
		                </a>
                       
	</li>
    <li class="side-nav-item">
        <a href="{{ route('admin.getInstallationPage') }}" class="side-nav-link">
        <i class="ri-article-line"></i>
            <span> Installations </span>
            <span class="badge bg-success float-end"></span>
        </a>
       
    </li>
  
    <li class="side-nav-item">
		                <a href="{{ route('admin.getServicePage')}}" class="side-nav-link">
                        <i class="ri-article-line"></i>
		                    <span> Services </span>
		                    <span class="badge bg-success float-end"></span>
		                </a>
                       
	</li>
    <li class="side-nav-item">
		                <a href="{{ route('admin.partsViewPage')}}" class="side-nav-link">
                        <i class="ri-article-line"></i>
		                    <span> Parts </span>
		                    <span class="badge bg-success float-end"></span>
		                </a>
                       
	</li>
                    

		        </ul>
		    </div>
		</div>
		<!-- Left Sidebar End -->
		

		<!-- ============================================================== -->
		<!-- Start Page Content here -->
		<!-- ============================================================== -->

		<div class="content-page">
			<div class="content">

				<!-- Start Content-->
		
<div class="container-fluid">         
    <div class="row">
        <div class="col-10"></div>
        <div class="col-2 mb-1">
            @yield('user_modal')
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-10"></div>
                <div class="col-2 mb-2">
                    @yield('modal')
                </div>
            </div>
          
        </div>
    </div>

                        <!-- product -->
                         <div class="row">
                            <div class="col-2"></div>
                            <div class="col-5 col-xs-12">
                            @yield('content') 
                            </div>
                         </div>
			</div>
            <div class="container-fluid">
                        
                        @yield('data_table')
                    </div>
				<!-- end container -->

				<!-- Footer Start -->
				<footer class="footer">
				    <div class="container-fluid">
				        <div class="row">
				            <div class="col-12 text-center">
				                <script>document.write(new Date().getFullYear())</script> © Purity - Theme by <b>digibeat</b>
				            </div>
				        </div>
				    </div>
				</footer>
				<!-- end Footer -->

			</div>
			<!-- content -->
		</div>

		<!-- ============================================================== -->
		<!-- End Page content -->
		<!-- ============================================================== -->

	</div>
	<!-- END wrapper -->

	<!-- Theme Settings -->
	<div class="offcanvas offcanvas-end" tabindex="-1" id="theme-settings-offcanvas">
	    <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
	        <h5 class="text-white m-0">Theme Settings</h5>
	        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	    </div>

	    <div class="offcanvas-body p-0">
	        <div data-simplebar class="h-100">
	            <div class="p-3">
	                <h5 class="mb-3 fs-16 fw-semibold">Color Scheme</h5>

	                <div class="row">
	                    <div class="col-6">
	                        <div class="form-check mb-1">
	                            <input class="form-check-input border-secondary" type="radio" name="data-bs-theme" id="layout-color-light" value="light">
	                            <label class="form-check-label" for="layout-color-light">Light</label>
	                        </div>
	                    </div>

	                    <div class="col-6">
	                        <div class="form-check mb-1">
	                            <input class="form-check-input border-secondary" type="radio" name="data-bs-theme" id="layout-color-dark" value="dark">
	                            <label class="form-check-label" for="layout-color-dark">Dark</label>
	                        </div>
	                    </div>
	                </div>

	                <div id="layout-width">
	                    <h5 class="my-3 fs-16 fw-semibold">Layout Mode</h5>

	                    <div class="row">
	                        <div class="col-6">
	                            <div class="form-check mb-1">
	                                <input class="form-check-input border-secondary" type="radio" name="data-layout-mode" id="layout-mode-fluid" value="fluid">
	                                <label class="form-check-label" for="layout-mode-fluid">Fluid</label>
	                            </div>
	                        </div>

	                        <div class="col-6">
	                            <div id="layout-boxed">
	                                <div class="form-check mb-1">
	                                    <input class="form-check-input border-secondary" type="radio" name="data-layout-mode" id="layout-mode-boxed" value="boxed">
	                                    <label class="form-check-label" for="layout-mode-boxed">Boxed</label>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>

	                <h5 class="my-3 fs-16 fw-semibold">Topbar Color</h5>

	                <div class="row">
	                    <div class="col-6">
	                        <div class="form-check mb-1">
	                            <input class="form-check-input border-secondary" type="radio" name="data-topbar-color" id="topbar-color-light" value="light">
	                            <label class="form-check-label" for="topbar-color-light">Light</label>
	                        </div>
	                    </div>

	                    <div class="col-6">
	                        <div class="form-check mb-1">
	                            <input class="form-check-input border-secondary" type="radio" name="data-topbar-color" id="topbar-color-dark" value="dark">
	                            <label class="form-check-label" for="topbar-color-dark">Dark</label>
	                        </div>
	                    </div>
	                </div>

	                <div>
	                    <h5 class="my-3 fs-16 fw-semibold">Menu Color</h5>

	                    <div class="row">
	                        <div class="col-6">
	                            <div class="form-check mb-1">
	                                <input class="form-check-input border-secondary" type="radio" name="data-menu-color" id="leftbar-color-light" value="light">
	                                <label class="form-check-label" for="leftbar-color-light">Light</label>
	                            </div>
	                        </div>

	                        <div class="col-6">
	                            <div class="form-check mb-1">
	                                <input class="form-check-input border-secondary" type="radio" name="data-menu-color" id="leftbar-color-dark" value="dark">
	                                <label class="form-check-label" for="leftbar-color-dark">Dark</label>
	                            </div>
	                        </div>
	                    </div>
	                </div>

	                <div id="sidebar-size">
	                    <h5 class="my-3 fs-16 fw-semibold">Sidebar Size</h5>

	                    <div class="row gap-2">
	                        <div class="col-12">
	                            <div class="form-check mb-1">
	                                <input class="form-check-input border-secondary" type="radio" name="data-sidenav-size" id="leftbar-size-default" value="default">
	                                <label class="form-check-label" for="leftbar-size-default">Default</label>
	                            </div>
	                        </div>

	                        <div class="col-12">
	                            <div class="form-check mb-1">
	                                <input class="form-check-input border-secondary" type="radio" name="data-sidenav-size" id="leftbar-size-compact" value="compact">
	                                <label class="form-check-label" for="leftbar-size-compact">Compact</label>
	                            </div>
	                        </div>

	                        <div class="col-12">
	                            <div class="form-check mb-1">
	                                <input class="form-check-input border-secondary" type="radio" name="data-sidenav-size" id="leftbar-size-small" value="condensed">
	                                <label class="form-check-label" for="leftbar-size-small">Condensed</label>
	                            </div>
	                        </div>


	                        <div class="col-12">
	                            <div class="form-check mb-1">
	                                <input class="form-check-input border-secondary" type="radio" name="data-sidenav-size" id="leftbar-size-full" value="full">
	                                <label class="form-check-label" for="leftbar-size-full">Full Layout</label>
	                            </div>
	                        </div>
	                    </div>
	                </div>

	                <div id="layout-position">
	                    <h5 class="my-3 fs-16 fw-semibold">Layout Position</h5>

	                    <div class="row">
	                        <div class="col-6">
	                            <div class="form-check">
	                                <input type="radio" class="form-check-input" name="data-layout-position" id="layout-position-fixed" value="fixed">
	                                <label class="form-check-label" for="layout-position-fixed">Fixed</label>
	                            </div>
	                        </div>
	                        <div class="col-6">
	                            <div class="form-check">
	                                <input type="radio" class="form-check-input" name="data-layout-position" id="layout-position-scrollable" value="scrollable">
	                                <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="offcanvas-footer border-top p-3 text-center">
	        <div class="row">
	            <div class="col-6">
	                <button type="button" class="btn btn-light w-100" id="reset-layout">Reset</button>
	            </div>
	            <div class="col-6">
	                <a href="#" role="button" class="btn btn-primary w-100">Buy Now</a>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Vendor js -->
	<script src="{{ asset('assets/js/vendor.min.js') }}"></script>









	<script src="{{ asset('assets/vendor/lucide/umd/lucide.min.js') }}"></script>

	<!-- Apex Charts js -->
	<script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>

	<!-- Vector Map js -->
	<script src="{{ asset('assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  
   
	<!-- Dashboard App js -->
	<script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

	<!-- App js -->
	<script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script>
     axios.interceptors.response.use(null, function (error) {
    if (error.response.status === 401) {
        window.location.href = '/';
    }
    return Promise.reject(error);
});

    </script>
	@stack('scripts')
   
</body>

</html>