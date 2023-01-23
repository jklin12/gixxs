<div id="header" class="header navbar-default">
	<!-- begin navbar-header -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed navbar-toggle-left" data-click="sidebar-minify">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a href="index.html" class="navbar-brand">
			<b class="mr-1 text-green">{{ config('site.site_name');  }}</b>
			 
		</a>
		<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	<!-- end navbar-header --><!-- begin header-nav -->
	<ul class="navbar-nav d-flex flex-grow-1">
		<li class="navbar-form flex-grow-1">
			
		</li>
		<li class="dropdown">
			 
		</li>
		<li class="dropdown navbar-user">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<img src="../assets/img/user/user-13.jpg" alt="" />
				<span class="d-none d-md-inline">{{ Auth::user()->name;}}</span> <b class="caret"></b>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<a href="{{ route('logout') }}" class="dropdown-item">Log Out</a>
			</div>
		</li>
	</ul>
	<!-- end header-nav -->
</div>