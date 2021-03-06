@if (Auth::check())
	<?php
    // Admin URL Base
    $adminBase = config('larapen.admin.route_prefix', 'admin');
    
	// Get site mini stats
	if (config('settings.ads_review_activation')) {
		$countUnactivatedAds = \App\Models\Ad::where('active', 0)->orWhere('reviewed', 0)->count();
		$countActivatedAds = \App\Models\Ad::where('active', 1)->where('reviewed', 1)->count();
	} else {
		$countUnactivatedAds = \App\Models\Ad::where('active', 0)->count();
		$countActivatedAds = \App\Models\Ad::where('active', 1)->count();
	}
	$countUnactivatedUsers = \App\Models\User::where('is_admin', 0)->where('active', 0)->count();
	$countActivatedUsers = \App\Models\User::where('is_admin', 0)->where('active', 1)->count();
	?>
    <style>
        #adminSidebar ul li span {
            text-transform:capitalize;
        }
    </style>
	<!-- Left side column. contains the sidebar -->
	<aside class="main-sidebar" id="adminSidebar">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

			<!-- Sidebar user panel -->
			<div class="user-panel">
				<div class="pull-left image">
					<img src="{{ url('images/user.jpg') }}" class="img-circle" alt="User Image">
		<!--			<img src="{{ Gravatar::fallback(url('images/user.jpg'))->get(Auth::user()->email) }}" class="img-circle" alt="User Image">-->
				</div>
				<div class="pull-left info">
					<p>{{ Auth::user()->name }}</p>
					<a href="#"><i class="fa fa-circle text-success"></i> {{ __t('Online') }}</a>
				</div>
			</div>

			<!-- sidebar menu: : style can be found in sidebar.less -->
			<ul class="sidebar-menu">
				<li class="header">{{ __t('administration') }}</li>
				<!-- ================================================ -->
				<!-- ==== Recommended place for admin menu items ==== -->
				<!-- ================================================ -->
				<li><a href="{{ url($adminBase . '/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ __t('dashboard') }}</span></a></li>

				<li class="treeview">
					<a href="#"><i class="fa fa-table"></i><span>{{ __t('ads') }}</span><i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li>
							<a href="{{ url($adminBase . '/ad') }}">
                                <i class="fa fa-table"></i> <span>{{ __t('list') }}</span>
								<span class="pull-right-container">
									<small class="label pull-right bg-green">{{ $countActivatedAds }}</small>
									<small class="label pull-right bg-red">{{ $countUnactivatedAds }}</small>
								</span>
							</a>
						</li>
                        <li><a href="{{ url($adminBase . '/category') }}"><i class="fa fa-folder"></i> <span>{{ __t('categories') }}</span></a></li>
						<li><a href="{{ url($adminBase . '/item_type') }}"><i class="fa fa-cog"></i> <span>{{ __t('ad types') }}</span></a></li>
					</ul>
				</li>

				<li>
					<a href="{{ url($adminBase . '/user') }}">
                        <i class="fa fa-users"></i> <span>{{ __t('users') }}</span>
						<span class="pull-right-container">
                            <small class="label pull-right bg-green">{{ $countActivatedUsers }}</small>
                            <small class="label pull-right bg-red">{{ $countUnactivatedUsers }}</small>
                        </span>
					</a>
				</li>

				<li class="treeview">
					<a href="#"><i class="fa fa-usd"></i> <span>{{ __t('payments') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
						<li><a href="{{ url($adminBase . '/payment') }}"><i class="fa fa-table"></i> <span>{{ __t('list') }}</span></a></li>
						<li><a href="{{ url($adminBase . '/package') }}"><i class="fa fa-pie-chart"></i> <span>{{ __t('packages') }}</span></a></li>
                        <li><a href="{{ url($adminBase . '/payment_method') }}"><i class="fa fa-credit-card"></i> <span>{{ __t('payment methods') }}</span></a></li>
					</ul>
				</li>

				<li><a href="{{ url($adminBase . '/advertising') }}"><i class="fa fa-life-ring"></i> <span>{{ __t('advertising') }}</span></a></li>

				<li class="treeview">
					<a href="#"><i class="fa fa-globe"></i> <span>{{ __t('international') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
                        <li><a href="{{ url($adminBase . '/language') }}"><i class="fa fa-circle-o"></i> <span>{{ __t('languages') }}</span></a></li>
						<li class="treeview">
							<a href="#"><i class="fa fa-globe"></i> <span>{{ __t('translations') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
							<ul class="treeview-menu">
                                <li><a href="{{ url($adminBase . '/item_type') }}"><i class="fa fa-language"></i> <span>{{ __t('ad types') }}</span></a></li>
                                <li><a href="{{ url($adminBase . '/category') }}"><i class="fa fa-language"></i> <span>{{ __t('categories') }}</span></a></li>
                                <li><a href="{{ url($adminBase . '/gender') }}"><i class="fa fa-language"></i> <span>{{ __t('titles') }}</span></a></li>
                                <li><a href="{{ url($adminBase . '/package') }}"><i class="fa fa-language"></i> <span>{{ __t('packages') }}</span></a></li>
                                <li><a href="{{ url($adminBase . '/report_type') }}"><i class="fa fa-language"></i> <span>{{ __t('report types') }}</span></a></li>
                                <li><a href="{{ url($adminBase . '/page') }}"><i class="fa fa-clone"></i> <span>{{ __t('pages') }}</span></a></li>
							</ul>
						</li>
                        <li><a href="{{ url($adminBase . '/country') }}"><i class="fa fa-circle-o"></i> <span>{{ __t('countries') }}</span></a></li>
                        <li><a href="{{ url($adminBase . '/currency') }}"><i class="fa fa-circle-o"></i> <span>{{ __t('currencies') }}</span></a></li>
                        <li><a href="{{ url($adminBase . '/time_zone') }}"><i class="fa fa-circle-o"></i> <span>{{ __t('time zones') }}</span></a></li>
					</ul>
				</li>

				<li><a href="{{ url($adminBase . '/setting') }}"><i class="fa fa-cog"></i> <span>{{ __t('settings') }}</span></a></li>
                <li><a href="{{ url($adminBase . '/blacklist') }}"><i class="fa fa-ban"></i> <span>{{ __t('blacklist') }}</span></a></li>

				<li class="treeview">
					<a href="#"><i class="fa fa-globe"></i> <span>{{ __t('locations') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
					<ul class="treeview-menu">
                        <li><a href="{{ url($adminBase . '/loc_admin1') }}"><i class="fa fa-circle-o"></i> <span>{{ __t('admin. divisions 1') }}</span></a></li>
                        <li><a href="{{ url($adminBase . '/loc_admin2') }}"><i class="fa fa-circle-o"></i> <span>{{ __t('admin. divisions 2') }}</span></a></li>
                        <li><a href="{{ url($adminBase . '/city') }}"><i class="fa fa-circle-o"></i> <span>{{ __t('cities') }}</span></a></li>
					</ul>
				</li>
				
				<li><a href="{{ url($adminBase . '/page') }}"><i class="fa fa-clone"></i> <span>{{ __t('pages') }}</span></a></li>
				<li><a href="{{ url($adminBase . '/plugin') }}"><i class="fa fa-cogs"></i> <span>{{ __t('plugins') }}</span></a></li>
				<li><a href="{{ url($adminBase . '/backup') }}"><i class="fa fa-hdd-o"></i> <span>{{ __t('backups') }}</span></a></li>


				<!-- ======================================= -->
				<li class="header">{{ __t('user_panel') }}</li>
				<li><a href="{{ url($adminBase . '/account') }}"><i class="fa fa-sign-out"></i> <span>{{ __t('my account') }}</span></a></li>
				<li><a href="{{ url($adminBase . '/logout') }}"><i class="fa fa-sign-out"></i> <span>{{ __t('logout') }}</span></a></li>
			</ul>

		</section>
		<!-- /.sidebar -->
	</aside>
@endif
