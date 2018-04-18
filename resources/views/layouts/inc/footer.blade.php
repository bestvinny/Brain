<footer class="main-footer">
	<div class="footer-content">
		<div class="container">
			<div class="row">
				<div class=" col-lg-3 col-md-3 col-sm-3 col-xs-9 ">
					<div class="footer-col row">
						<div class="col-sm-12 col-xs-6 col-xxs-12 no-padding-lg">
							<div class="mobile-app-content">
								<div class="row ">
									<div class="col-xs-12 col-sm-6 ">
										<a class="app-icon" href="{{ lurl('/') }}">
											<img src="{{ \Storage::url(config('settings.app_logo')) }}" style="width:auto; height:50px; float:left; margin:0 5px 0 0;"
												 alt="{{ strtolower(config('settings.app_name')) }}" class="tooltipHere" title="" data-placement="bottom"
												 data-toggle="tooltip" type="button"
												 data-original-title="{{ config('settings.app_name') . ((isset($country) and $country->has('name')) ? ' ' . $country->get('name') : '') }}"/>
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-xs-6 col-xxs-12 no-padding-lg">
							<div class="hero-subscribe">
								<h4 class="footer-title no-margin">{{ t('Follow us on') }}</h4>
								<ul class="list-unstyled list-inline footer-nav social-list-footer social-list-color footer-nav-inline">
									<li><a class="icon-color fb" title="{{ t('Like Us On Facebook') }}" data-placement="top" data-toggle="tooltip" href="{{ config('settings.facebook_page_url') }}" target="_blank"><i class="fa fa-facebook"></i> </a></li>
									<li><a class="icon-color tw" title="{{ t('Follow Us On Twitter') }}" data-placement="top" data-toggle="tooltip" href="{{ config('settings.twitter_url') }}" target="_blank"><i class="fa fa-twitter"></i> </a></li>
									<!--			<li><a class="icon-color gp" title="Google+" data-placement="top" data-toggle="tooltip" href="#"><i class="fa fa-google-plus"></i> </a></li>
                                                <li><a class="icon-color lin" title="LinkedIn" data-placement="top" data-toggle="tooltip" href="#"><i class="fa fa-linkedin"></i> </a></li>
                                                <li><a class="icon-color pin" title="Pinterest" data-placement="top" data-toggle="tooltip" href="#"><i class="fa fa-pinterest-p"></i> </a></li>-->
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class=" col-lg-2 col-md-2 col-sm-2 col-xs-6 ">
					<div class="footer-col">
						<h4 class="footer-title">{{ t('About us') }}</h4>
						<ul class="list-unstyled footer-nav">
							<li><a href="{{ lurl('page/about-company.html') }}">{{ t('About Company') }}</a></li>
							<li><a href="{{ lurl(trans('routes.signup')) . '?type=4' }}">{{ t('For Employers') }}</a></li>
							<li><a href="{{ lurl(trans('routes.signup')) . '?type=3' }}">{{ t('For Job Seeker') }}</a></li>
							<li><a href="{{ lurl('page/our-partners.html') }}">{{ t('Our Partners') }}</a></li>
						</ul>
					</div>
				</div>
				<div class=" col-lg-2 col-md-2 col-sm-2 col-xs-6 ">
					<div class="footer-col">
						<h4 class="footer-title">{{ t('Help &amp; Contact') }}</h4>
						<ul class="list-unstyled footer-nav">
							<li><a href="{{ lurl(trans('routes.contact')) }}"> {{ t('Contact') }}</a></li>
							<li><a href="{{ lurl('page/stay-safe-online.html') }}">{{ t('Stay Safe Online') }}</a></li>
							<li><a href="{{ lurl('page/terms-of-use.html') }}">{{ t('Terms Of Use') }}</a></li>
							<li><a href="{{ lurl('page/privacy-privacy.html') }}">{{ t('Privacy Policy') }}</a></li>
						</ul>
					</div>
				</div>
				<div class=" col-lg-2 col-md-2 col-sm-2 col-xs-6 ">
					<div class="footer-col">
						<h4 class="footer-title">{{ t('More From Us') }}</h4>
						<ul class="list-unstyled footer-nav">
							<li><a href="{{ lurl('page/faq.html') }}">{{ t('FAQ') }}</a></li>
							<li><a href="{{ lurl('/blog') }}">{{ t('Blog') }}</a></li>
							<li>
								<a href="{{ lurl(trans('routes.v-sitemap', ['countryCode' => $country->get('icode')])) }}"> {{ t('Sitemap') }} </a>
								@if (\App\Models\Country::where('active', 1)->count() > 1)
									<a href="{{ lurl(trans('routes.countries')) }}"> {{ t('Countries') }} </a>
								@endif
							</li>
							<li><a href="{{ lurl('page/advertise-with-us.html') }}">{{ t('Advertise With Us') }}</a></li>
						</ul>
					</div>
				</div>
				<div class=" col-lg-2 col-md-2 col-sm-2 col-xs-6 ">
					<div class="footer-col">
						<h4 class="footer-title">{{ t('Account') }}</h4>
						<ul class="list-unstyled footer-nav">
							<li><a href="{{ lurl('account') }}">{{ t('Manage Account') }}
								</a></li>
							@if (!auth()->user())
								<li><a href="{{ lurl(trans('routes.login')) }}"> {{ t('Login') }}</a></li>
								@else (isset($user))
									<li><a href="{{ lurl(trans('routes.logout')) }}">{{ t('Signout') }} </a></li>
								@endif
							<li><a href="{{ lurl('account/myads') }}"> {{ t('My ads') }}
								</a></li>
							<li><a href="{{ lurl('account') }}">{{ t('Profile') }}
								</a></li>
						</ul>
					</div>
				</div>

				<div style="clear: both"></div>
				<div class="col-lg-12">
					<div class=" text-center paymanet-method-logo">
						<img alt="Master Card" src="{{ url('/images/master_card.png') }}">
						<img alt="Visa Card" src="{{ url('/images/visa_card.png') }}">
						<img alt="Paypal" src="{{ url('/images/paypal.png') }}">
						<img alt="American Express Card" src="{{ url('/images/american_express_card.png') }}">
						<img alt="MPesa" src="{{ url('/images/mpesa.png') }}">
						<img alt="Airtel Money" src="{{ url('/images/airtel_money.png') }}">
						<img alt="Equity Bank" src="{{ url('/images/equity_bank.png') }}">
						<img alt="Cooperative Bank" src="{{ url('/images/coop_bank.png') }}">
					</div>
					<div class="copy-info text-center">
						{{ t('Copyright') }} &copy; {{ date('Y') }} <a href="{{ url('/') }}" style="padding: 0;"> | {{ config('settings.app_name') }}</a> |
							@if (config('settings.show_powered_by'))
									{{ t('All Rights Reserved') }}.
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
</div>

