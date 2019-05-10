<html>
 
<head>
	<title>{{$title}}</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('css/dashboard.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
	<link rel="stylesheet" href="{{ asset('css/sticky-footer.css')}}">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
    <script src="{{ mix('js/app.js') }}"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- <script src="{{ asset('js/getContacts.js') }}"></script> --}}

    <script>
        $(function(){
			let userInfo =  `<div class="text-center">
								{{ Auth::user()->name }}</br>
								{{ Auth::user()->position }}
							</div>
							<hr style="margin:0"/>
							<div class="pull-right">
								<a href="version2/userProfile">
									<i class="glyphicon glyphicon-user"></i>
									<span> Profile</span>
								</a>
							</div>
							<div style="clear:both"></div>
							<hr style="margin:0"/>
							<div class="pull-right" id="func8-disable-2point1">
								<a href="version2/getUser">
									<i class="glyphicon glyphicon-lock"></i>
									<span> User</span>
								</a>
							</div>
							<div style="clear:both"></div>
							<hr style="margin:0"/>
							<div class="pull-right">
								<a href="/logout">
									<i class="glyphicon glyphicon-log-out"></i>
									<span> Logout</span>
								</a>
							</div>`;
			$('#show').popover({
				animation:true, 
				content: userInfo,
				html:true,
				placement: 'bottom'
			});
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		});
		</script>
    <style>
        .nav-blue
			{
				background-color: #3b5998;
			}
			.nav-blue a
			{
				color: #fff !important;
			}
			.nav-blue a i
			{
				color: #000 !important;
			}
			.nav-blue a span
			{
				color: #000 !important;
			}
			.nav-blue li a:hover
			{
				color: white !important;
				text-decoration: underline;
			}
			.nav-blue .active a
			{
				background-color: #0b2968 !important;
			}
			.pad-10{
				padding: 10;
			}
		</style>
</head>

<body>
    <div class="loadingBackground" style="display:none">
        <div class="text-center">
            <img src="{{ asset('images/loading.gif') }}" id="loading_gif">
        </div>
    </div>
    <nav class="navbar navbar-expand-sm nav-blue fixed-top">
        <a class="navbar-brand" href="/">CRM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars text-light"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
				<li class="nav-item @if(Route::currentRouteName() == 'home') active @endif">
				<a href="{{ route('home') }}" class="nav-link">Home</a>
				</li>
				<li class="nav-item @if(Route::currentRouteName() == 'leads') active @endif">
					<a href="{{ route('leads') }}" class="nav-link">Lead Pipeline</a>
				</li>
				<li class="nav-item">
					<a href="version2/viewVip&page=1" class="nav-link">VIP</a>
				</li>
				<li class="nav-item">
					<a href="crm-email-blaster/?user=$_SESSION['admin']['id']" class="nav-link">Email Blaster</a>
				</li>
				<li class="nav-item">
					<a href="reports" class="nav-link">Reports</a>
				</li>
				
            </ul>
			<a class="form-inline my-2 my-lg-0 nav-link">
				<span id="show">
					<i class="fa fa-user iRound"></i>
				</span>
			</a>
        </div>
    </nav>