<div class="container">
	<div class="header">
		<nav class="navbar navbar-site navbar-default" role="navigation">
			<div class="container" style="padding-left: 0; padding-right: 0;">
				<div class="navbar-header">
					<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="{{ lurl('/') }}" class="navbar-brand logo logo-title">
						<img src="{{ \Storage::url(config('settings.app_logo')) }}" style="width:auto; height:40px; float:left; margin:0 5px 0 0;"
							 alt="{{ strtolower(config('settings.app_name')) }}" class="tooltipHere" title="" data-placement="bottom"
							 data-toggle="tooltip" type="button"
							 data-original-title="{{ config('settings.app_name') . ((isset($country) and $country->has('name')) ? ' ' . $country->get('name') : '') }}"/>
					</a>
					@if (config('settings.activation_country_flag'))
						@if (isset($country) and !$country->isEmpty())
							@if (file_exists(public_path() . '/images/flags/32/'.strtolower($country->get('code')).'.png'))
								<span class="navbar-brand logo logo-title hidden-sm hidden-xs">
								@if (\App\Models\Country::where('active', 1)->count() > 1)
										<a href="{{ lurl(trans('routes.countries')) }}" title="{{ t('Countries') }}">
										<img src="{{ url('images/flags/32/'.strtolower($country->get('code')).'.png') }}" style="float: left; margin: 6px 0 0 5px;">
									</a>
									@else
										<img src="{{ url('images/flags/32/'.strtolower($country->get('code')).'.png') }}" style="float: left; margin: 6px 0 0 5px;">
									@endif
							</span>
							@endif
						@endif
					@endif
				</div>
				<div class="navbar-collapse collapse">

					<ul class="nav navbar-nav navbar-right">
						@if (!auth()->user())
							<li><a href="{{ url(config('app.locale') . '/' . trans('routes.login')) }}"><i class="fa fa-sign-in"></i> {{ t('Login') }}</a></li>
							<li><a href="{{ url(config('app.locale') . '/' . trans('routes.signup')) }}"><i class="icon-user-add fa"></i> {{ t('Signup') }}</a></li>
							<li class="postadd">
								<a class="btn btn-block btn-post btn-darkblue" href="{{ url(trans('routes.create')) }}"> {{ t('Create a Job ad') }}</a>
							</li>
						@else
							@if (isset($user))
								<li><a href="{{ url(config('app.locale') . '/logout') }}">{{ t('Signout') }} <i class="glyphicon glyphicon-off"></i>
									</a></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<span>{{ $user->name }}</span>
										<i class="icon-user fa"></i>
										<i class=" icon-down-open-big fa"></i>
									</a>
									<ul class="dropdown-menu user-menu">
										<li class="active"><a href="{{ url(config('app.locale') . '/account') }}"><i class="icon-home"></i> {{ t('Personal Home') }} </a></li>
                                        @if (in_array($user->user_type_id, [1, 2]))
											<li><a href="{{ url(config('app.locale') . '/account/myads') }}"><i class="icon-th-thumb"></i> {{ t('My ads') }} </a></li>
                                            <li><a href="{{ url(config('app.locale') . '/account/pending-approval') }}"><i class="icon-hourglass"></i> {{ t('Pending approval') }} </a></li>
											<li><a href="{{ url(config('app.locale') . '/account/archived') }}"><i class="icon-folder-close"></i> {{ t('Archived ads') }} </a></li>
										@endif
                                        @if (in_array($user->user_type_id, [1, 3]))
											<li><a href="{{ url(config('app.locale') . '/account/favourite') }}"><i class="icon-heart"></i> {{ t('Favourite ads') }} </a></li>
											<li><a href="{{ url(config('app.locale') . '/account/saved-search') }}"><i class="icon-star-circled"></i> {{ t('Saved search') }} </a></li>
										@endif
									</ul>
								</li>
                                @if (in_array($user->user_type_id, [1, 2]))
								<li class="postadd">
									<a class="btn btn-block btn-post btn-darkblue" href="{{ url(config('app.locale') . '/' . trans('routes.create')) }}"> {{ t('Create a Job ad') }}</a>
								</li>
                                @endif
							@endif
						@endif

						@if (isset($lang))
							@if (count(LaravelLocalization::getSupportedLocales()) > 1)
								<!-- Language selector -->
								<div class="dropdown hidden-sm hidden-xs" style="float:right; margin: 0 0 0 10px;">
									<button class="btn dropdown-toggle btn-default-lite" type="button" id="dropdownMenu1" data-toggle="dropdown" style="padding: 9px;">
										{{ strtoupper(config('app.locale')) }}
										<span class="caret" style="margin-left: 5px;"></span>
									</button>
									<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
										@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
											@if (strtolower($localeCode) != strtolower($lang->get('abbr')))
												<?php
												// Controller parameters
												$params = [
														'countryCode' 	=> (isset($country) and !$country->isEmpty()) ? $country->get('icode') : '',
														'catSlug' 		=> (isset($uriPathCatSlug) ? $uriPathCatSlug : null),
														'subCatSlug' 	=> (isset($uriPathSubCatSlug) ? $uriPathSubCatSlug : null),
														'cityName' 		=> (isset($uriPathCityName) ? $uriPathCityName : null),
														'cityId' 		=> (isset($uriPathCityId) ? $uriPathCityId : null),
                                                        'pageSlug' 		=> (isset($uriPathPageSlug) ? $uriPathPageSlug : null),
												];
												// Default
												$link       = LaravelLocalization::getLocalizedURL($localeCode, null, [], $params);
												$localeCode = strtolower($localeCode);
												?>
												<li role="presentation">
													<a role="menuitem" tabindex="-1" rel="alternate" hreflang="{{ $localeCode }}" href="{{ $link }}">
														{{{ $properties['native'] }}}
													</a>
												</li>
											@endif
										@endforeach
									</ul>
								</div>
							@endif
						@endif
					</ul>

				</div>
			</div>
		</nav>
	</div>
</div>