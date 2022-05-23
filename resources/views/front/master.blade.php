<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="SmartUniversity" />
    <title>{{ config('app.name') }} | @yield('page-title')</title>
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
	 
</head>
 <!-- END HEAD -->
<body class=" ">
    <div class="page-wrapper">
        
        @yield('middle-content')
       
        <!-- end footer -->
    </div>

    
    <!-- start js include path -->
    
  </body>
</html>