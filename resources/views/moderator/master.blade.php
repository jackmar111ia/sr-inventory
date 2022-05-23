<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="SmartUniversity" />
    <title>Moderator -{{ config('app.name') }} | @yield('page-title')</title>
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
	<!-- icons -->
    <link href="{{ asset('backends') }}/assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backends') }}/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<!--bootstrap -->
	<link href="{{ asset('backends') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Material Design Lite CSS -->
	<link rel="stylesheet" href="{{ asset('backends') }}/assets/plugins/material/material.min.css">
	<link rel="stylesheet" href="{{ asset('backends') }}/assets/css/material_style.css">
	<!-- animation -->
	<link href="{{ asset('backends') }}/assets/css/pages/animate_page.css" rel="stylesheet">
	<!-- Template Styles -->
    <link href="{{ asset('backends') }}/assets/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backends') }}/assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backends') }}/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backends') }}/assets/css/theme-color.css" rel="stylesheet" type="text/css" />
	<!-- favicon -->
	<link rel="shortcut icon" href="{{ asset('backends') }}/favico.png" /> 
 

	<style>
      
	  fieldset 
	  {
		   border: 1px dotted #999 !important; 
		  margin: 0;
		  xmin-width: 0;
		  padding: 10px;       
		  position: relative;
		  border-radius:4px;
		  background-color:#ffffff;
		  padding-left:10px!important;
		  
		 
	  }	
	 
	  legend
	  {
		  font-size:14px;
		  font-weight:bold;
		  color:green;
		  text-transform:uppercase;
		  margin-bottom: 0px; 
		  width:auto; 
		
		  padding: 5px 5px 5px 10px; 
		   
		  
		  
	  }
	  label {
		padding:2px;
	 }
	 
	 </style>


</head>
 <!-- END HEAD -->
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white dark-sidebar-color logo-dark">
    <div class="page-wrapper">
        <!-- start header -->
		<div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner ">
                <!-- logo start -->
                <div class="page-logo">
                    <a href="{{ route('moderator.dashboard')}}">
                     
                    <span class="logo-default" >{{ config('app.name') }}</span> </a>
                </div>
                <!-- logo end -->
				<ul class="nav navbar-nav navbar-left in">
					<li><a href="#" class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
				</ul>
                 
                
                <!-- start mobile menu -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                    <span></span>
                </a>
               <!-- end mobile menu -->
                <!-- start header menu -->
               @include('moderator.includes.topnav')
            </div>
        </div>
        <!-- end header -->
        <!-- start page container -->
        <div class="page-container">
 			<!-- start sidebar menu -->
			 @php $guardName = "moderator"; @endphp
 			@include('moderator.includes.leftnav')
			 <!-- end sidebar menu -->
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">@yield('title')</div>
                            </div>
							@include('moderator.includes.breadcrumb')
                        </div>
                    </div>
                   <!-- start widget -->
	              @yield('middle-content')
                </div>
            </div>
            <!-- end page content -->
            <!-- start chat sidebar -->
             
            <!-- end chat sidebar -->
        </div>
        <!-- end page container -->
        <!-- start footer -->
        @include('moderator.includes.footer')
        <!-- end footer -->
    </div>
    <!-- start js include path -->
    <script src="{{ asset('backends') }}/assets/plugins/jquery/jquery.min.js" ></script>
    <script src="{{ asset('backends') }}/assets/plugins/popper/popper.min.js" ></script>
    <script src="{{ asset('backends') }}/assets/plugins/jquery-blockui/jquery.blockui.min.js" ></script>
	<script src="{{ asset('backends') }}/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- bootstrap -->
    <script src="{{ asset('backends') }}/assets/plugins/bootstrap/js/bootstrap.min.js" ></script>
    <!-- counterup -->
    <script src="{{ asset('backends') }}/assets/plugins/counterup/jquery.waypoints.min.js" ></script>
    <script src="{{ asset('backends') }}/assets/plugins/counterup/jquery.counterup.min.js" ></script>
    <!-- Common js-->
	<script src="{{ asset('backends') }}/assets/js/app.js" ></script>
    <script src="{{ asset('backends') }}/assets/js/layout.js" ></script>
    <script src="{{ asset('backends') }}/assets/js/theme-color.js" ></script>
    <!-- material -->
    <script src="{{ asset('backends') }}/assets/plugins/material/material.min.js"></script>
	<!-- animation -->
	<script src="{{ asset('backends') }}/assets/js/pages/ui/animations.js" ></script>
    <!-- chart js -->
    <script src="{{ asset('backends') }}/assets/plugins/chart-js/Chart.bundle.js" ></script>
    <script src="{{ asset('backends') }}/assets/plugins/chart-js/utils.js" ></script>
    <script src="{{ asset('backends') }}/assets/js/pages/chart/chartjs/home-data2.js" ></script>
    <!-- sparkline -->
    <script src="{{ asset('backends') }}/assets/plugins/sparkline/jquery.sparkline.min.js" ></script>
	<script src="{{ asset('backends') }}/assets/js/pages/sparkline/sparkline-data.js" ></script>
    <!-- end js include path -->
  </body>
</html>