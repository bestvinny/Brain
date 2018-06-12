{{--
 * Brain Train - Find the job you love!
 * Copyright (c) Brain Train Kenya. All Rights Reserved
 *
 * Website: http://www.braintrainke.com
 
--}}
@extends('layouts.master')

@section('content')
	<div class="main-container">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 page-sidebar">
					@include('account/inc/sidebar-left')
				</div>
				<!--/.page-sidebar-->

				<div class="col-sm-9 page-content">

					@include('flash::message')

					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h5><strong>{{ t('Oops ! An error has occurred. Please correct the red fields in the form') }}</strong></h5>
							<ul class="list list-check">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<div class="inner-box">
						<div class="row">
							<div class="col-md-5 col-xs-4 col-xxs-12">
								<h3 class="no-padding text-center-480 useradmin">
									<a href="">
										<img class="userImg" src="{{ url('images/user.jpg') }}" alt="{{ $user->name }}">&nbsp;
								<!--		<img class="userImg" src="{{ $gravatar }}" alt="user">-->&nbsp;
										{{ $user->first_name }}
									</a>
								</h3>
							</div>
							<div class="col-md-7 col-xs-8 col-xxs-12">
								<div class="header-data text-center-xs">
									@if (isset($user) and in_array($user->user_type_id, [1, 2]))
									<!-- Traffic data -->
									<div class="hdata">
										<div class="mcol-left">
											<!-- Icon with red background -->
											<i class="fa fa-eye ln-shadow"></i>
										</div>
										<div class="mcol-right">
											<!-- Number of visitors -->
											<p>
												<a href="{{ lurl('account/myads') }}">
                                                    {{ $countAdsVisits->total_visits or 0 }}
												    <em>{{ trans_choice('global.count_visits', (isset($countAdsVisits) ? getPlural($countAdsVisits->total_visits) : getPlural(0))) }}</em>
                                                </a>
											</p>
										</div>
										<div class="clearfix"></div>
									</div>
								
									<!-- Ads data -->
									<div class="hdata">
										<div class="mcol-left">
											<!-- Icon with green background -->
											<i class="icon-th-thumb ln-shadow"></i>
										</div>
										<div class="mcol-right">
											<!-- Number of ads -->
											<p>
												<a href="{{ lurl('account/myads') }}">
                                                    {{ $countAds }}
												    <em>{{ trans_choice('global.count_ads', getPlural($countAds)) }}</em>
                                                </a>
											</p>
										</div>
										<div class="clearfix"></div>
									</div>
									@endif
                                    
                                    @if (isset($user) and in_array($user->user_type_id, [1, 3]))
									<!-- Favorites data -->
									<div class="hdata">
										<div class="mcol-left">
											<!-- Icon with blue background -->
											<i class="fa fa-user ln-shadow"></i>
										</div>
										<div class="mcol-right">
											<!-- Number of favorites -->
											<p>
												<a href="{{ lurl('account/favourite') }}">
                                                    {{ $countFavoriteAds }}
												    <em>{{ trans_choice('global.count_favorites', getPlural($countFavoriteAds)) }} </em>
                                                </a>
											</p>
										</div>
										<div class="clearfix"></div>
									</div>
                                    @endif
								</div>
							</div>
						</div>
					</div>

					<div class="inner-box">
						<div class="welcome-msg">
							<h3 class="page-sub-header2 clearfix no-padding">{{ t('Hello') }} {{ $user->first_name }} ! </h3>
							<span class="page-sub-header-sub small">
                                {{ t('You last logged in at') }}: {{ $user->last_login_at->format('d-m-Y H:i:s') }}
                            </span>
						</div>
						<div id="accordion" class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#collapseB1" data-toggle="collapse"> {{ t('Company profile') }} </a></h4>
								</div>
								<div class="panel-collapse collapse in" id="collapseB1">
									<div class="panel-body">
										<form name="details" class="form-horizontal" role="form" method="POST" action="{{ lurl('company/profile/add') }}">
											{!! csrf_field() !!}

													<!-- Business type -->
												
													<div class="form-group required <?php echo (isset($errors) and $errors->has('business_type')) ? 'has-error' : ''; ?>">
													<label class="col-md-3 control-label">{{ t('Business type') }} <sup>*</sup></label>
													<div class="col-md-9">
														<select name="business_type" id="business_type" class="form-control selecter">
															<option value="0"
																	@if(old('business_type')=='' or old('business_type')==0)selected="selected"@endif> {{ t('Select') }} </option>
															@foreach ($categories as $category)
																<option value="{{ $category->name }}" @if(old('business_type')==$category->name)selected="selected"@endif>
																	{{ $category->name }}
																</option>
															@endforeach
														</select>
													</div>
												</div>
												
                                            
                                               

                                                <!-- Company size -->
                                                <div class="form-group required <?php echo ($errors->has('size')) ? 'has-error' : ''; ?>">
                                                    <label class="col-sm-3 control-label">{{ t('Company Size') }} <sup>*</sup></label>
                                                    <div class="col-sm-9">
                                                        <input name="size" type="text" class="form-control" placeholder="EXAMPLE: 100 Employees" value="{{ old('size') }}">
                                                    </div>
                                                </div>
    
                                                <!-- About -->
                                                <div class="form-group required <?php echo ($errors->has('about')) ? 'has-error' : ''; ?>">
                                                    <label class="col-sm-3 control-label">{{ t('About the Company') }} <sup>*</sup></label>
                                                    <div class="col-sm-9">
                                                        <textarea name="about" class="form-control" placeholder=".">{{ old('about') }}</textarea>
                                                    </div>
                                                </div>

                                                 <!-- Mission -->
                                                <div class="form-group required <?php echo ($errors->has('mission')) ? 'has-error' : ''; ?>">
                                                    <label class="col-sm-3 control-label">{{ t('Mission') }} <sup>*</sup></label>
                                                    <div class="col-sm-9">
                                                        <textarea name="mission" class="form-control" placeholder="">{{ old('mission') }}</textarea>
                                                    </div>
                                                </div>

                                                 <!-- More info -->
                                                <div class="form-group required <?php echo ($errors->has('more_info')) ? 'has-error' : ''; ?>">
                                                    <label class="col-sm-3 control-label">{{ t('Additional information') }} <sup>*</sup></label>
                                                    <div class="col-sm-9">
                                                        <textarea name="more_info" class="form-control" placeholder="">{{ old('more_info') }}</textarea>
                                                    </div>
                                                </div>
                                           

											<div class="form-group">
												<div class="col-sm-offset-3 col-sm-9"></div>
											</div>
											<div class="form-group">
												<div class="col-sm-offset-3 col-sm-9">
													<button type="submit" class="btn btn-primary">{{ t('Save') }}</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>




						</div>
						<!--/.row-box End-->

					</div>
				</div>
				<!--/.page-content-->
			</div>
			<!--/.row-->
		</div>
		<!--/.container-->
	</div>
	<!-- /.main-container -->


@endsection

@section('after_scripts')
	<script src="{{ url('/assets/js/fileinput.min.js') }}" type="text/javascript"></script>
	@if (file_exists(public_path() . '/assets/js/fileinput_locale_'.$lang->get('abbr').'.js'))
		<script src="{{ url('/assets/js/fileinput_locale_'.$lang->get('abbr').'.js') }}" type="text/javascript"></script>
	@endif
	<script language="javascript">
		/* initialize with defaults (resume) */
		$('#filename').fileinput(
		{
			'showPreview': false,
			'allowedFileExtensions': {!! getUploadFileTypes('file', true) !!},
			'browseLabel': '{!! t("Browse") !!}',
			'showUpload': false,
			'showRemove': false,
			'maxFileSize': {{ (int)config('settings.upload_max_file_size', 1000) }}
		});
	</script>
	<script language="javascript">
		var user_type = '<?php echo old('user_type', $user->user_type_id); ?>';

		$(document).ready(function ()
		{
			/* Set user type */
			setUserType(user_type);
			$('#user_type').change(function () {
				setUserType($(this).val());
			});

			var countries = <?php echo (isset($countries)) ? $countries->toJson() : '{}'; ?>;
			var countryCode = $('#country').val();

			/* Set Country Phone Code */
			setCountryPhoneCode(countryCode, countries);
			$('#country').change(function () {
				setCountryPhoneCode($(this).val(), countries);
			});


			// Add skill tags
			$('#skill_tags').tokenfield({
				autocomplete:{
					source:['HTML','CSS','PHP','javascript','Mysql','Laravel'],
					delay:100
				},
				showAutocompleteOnFocus: true
			});

			

		});


	</script>

	s
@endsection
