{{--
 * Brain Train - Find the job you love!
 * Copyright (c) Brain Train Kenya. All Rights Reserved
 *
 * Website: http://www.braintrainke.com
 *
 * CODED WITH LOVE
 * ---------------
 * 	@author : Wanekeya Sam
 *  Title   : Full-stack Developer
 * 	created	: 02 September, 2017
 *	version : 1.0
 * 	website : https://www.wanekeyasam.co.ke
 *	Email   : contact@wanekeyasam.co.ke
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
									<h4 class="panel-title"><a href="#collapseB1" data-toggle="collapse"> {{ t('My details') }} </a></h4>
								</div>
								<div class="panel-collapse collapse in" id="collapseB1">
									<div class="panel-body">
										<form name="details" class="form-horizontal" role="form" method="POST" action="{{ lurl('account/details') }}" enctype="multipart/form-data">
											{!! csrf_field() !!}
                                            
                                            @if (empty($user->user_type_id) or $user->user_type_id == 0)
                                                
                                                <!-- User Type -->
                                                <div class="form-group required <?php echo (isset($errors) and $errors->has('user_type')) ? 'has-error' : ''; ?>">
                                                    <label class="col-sm-3 control-label">{{ t('You are a') }} <sup>*</sup></label>
                                                    <div class="col-sm-9">
                                                        <select name="user_type" id="user_type" class="form-control selecter">
                                                            <option value="0" @if (old('user_type')=='' or old('user_type')==0)selected="selected"@endif>
                                                                {{ t('Select') }}
                                                            </option>
                                                            @foreach ($userTypes as $type)
                                                                <option value="{{ $type->id }}" @if (old('user_type', $user->user_type_id)==$type->id)selected="selected"@endif>
                                                                    {{ t($type->name) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                    
                                            @else

                                                <!-- Gender -->
                                                <div class="form-group required <?php echo ($errors->has('gender')) ? 'has-error' : ''; ?>">
                                                    <label class="col-md-3 control-label">{{ t('Gender') }} <sup>*</sup></label>
                                                    <div class="col-md-9">
                                                        @if ($genders->count() > 0)
                                                            @foreach ($genders as $gender)
                                                                <label class="radio-inline" for="gender">
                                                                    <input name="gender" id="gender-{{ $gender->tid }}" value="{{ $gender->tid }}"
                                                                           type="radio" {{ (old('gender', $user->gender_id)==$gender->tid) ? 'checked="checked"' : '' }}>
                                                                    {{ $gender->name }}
                                                                </label>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
    
                                                <!-- Name -->
                                                <div class="form-group required <?php echo ($errors->has('name')) ? 'has-error' : ''; ?>">
                                                    <label class="col-sm-3 control-label">{{ t('Name') }} <sup>*</sup></label>
                                                    <div class="col-sm-9">
                                                        <input name="name" type="text" class="form-control" placeholder="" value="{{ old('name', $user->name) }}">
                                                    </div>
                                                </div>
    
                                                <!-- Email -->
                                                <div class="form-group required <?php echo ($errors->has('email')) ? 'has-error' : ''; ?>">
                                                    <label class="col-sm-3 control-label">{{ t('Email') }} <sup>*</sup></label>
                                                    <div class="col-sm-9">
                                                        <input id="email" name="email" type="email" class="form-control" placeholder=""
                                                               value="{{ old('email', $user->email) }}">
                                                    </div>
                                                </div>
    
                                                <!-- Resume -->
                                                <div id="resumeBloc" class="form-group <?php echo ($errors->has('filename')) ? 'has-error' : ''; ?>">
                                                    <label class="col-sm-3 control-label" for="filename"> {{ t('Your resume') }} </label>
                                                    <div class="col-sm-9">
                                                        <div class="mb10">
                                                            <input id="filename" name="filename" type="file" class="file">
                                                        </div>
                                                        <p class="help-block">{{ t('File types: :file_types', ['file_types' => showValidFileTypes('file')]) }}</p>
                                                        @if (!empty($resume) and !empty($resume->filename) and file_exists(public_path($resume->filename)))
                                                            <div>
                                                                <a class="btn btn-default" href="{{ url($resume->filename) }}" target="_blank">
                                                                    <i class="icon-attach-2"></i> {{ t('Donwload current Resume') }}
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
    
                                                <!-- Country -->
                                                <?php
                                                /*
                                                <div class="form-group required <?php echo ($errors->has('country')) ? 'has-error' : ''; ?>">
                                                    <label class="col-md-3 control-label" for="country">{{ t('Your Country') }} <sup>*</sup></label>
                                                    <div class="col-md-9">
                                                        <select id="country" name="country" class="form-control">
                                                            <option value="0" {{ (!old('country') or old('country')==0) ? 'selected="selected"' : '' }}>
                                                                Select your Country...
                                                            </option>
                                                            @foreach ($countries as $item)
                                                                <option value="{{ $item->get('code') }}" {{ (old('country', $user->country_code)==$item->get('code')) ? 'selected="selected"' : '' }}>
                                                                    {{ $item->get('name') }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                */
                                                ?>
                                                <input id="country" name="country" type="hidden" value="{{ $user->country_code }}">
    
                                                <!-- Phone -->
                                                <div class="form-group required <?php echo ($errors->has('phone')) ? 'has-error' : ''; ?>">
                                                    <label for="phone" class="col-sm-3 control-label">{{ t('Phone') }} <sup>*</sup></label>
                                                    <div class="col-sm-6">
                                                        <div class="input-group"><span id="phone_country" class="input-group-addon">+000</span>
                                                            <input id="phone" name="phone" type="text" class="form-control" placeholder=""
                                                                   value="{{ old('phone', $user->phone) }}">
                                                        </div>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input name="phone_hidden" type="checkbox"
                                                                       value="1" {{ (old('phone_hidden', $user->phone_hidden)=='1') ? 'checked="checked"' : '' }}>
                                                                <small> {{ t('Hide the phone number on the published ads.') }}</small>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            @endif

											<div class="form-group">
												<div class="col-sm-offset-3 col-sm-9"></div>
											</div>
											<div class="form-group">
												<div class="col-sm-offset-3 col-sm-9">
													<button type="submit" class="btn btn-primary">{{ t('Update') }}</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>



							<!--Settings -->

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#collapseB2" data-toggle="collapse"> {{ t('Settings') }} </a></h4>
								</div>
								<div class="panel-collapse collapse <?php echo ($errors->has('pass')) ? 'in' : ''; ?>" id="collapseB2">
									<div class="panel-body">
										<form name="settings" class="form-horizontal" role="form" method="POST"
											  action="{{ lurl('account/settings/update') }}">
											{!! csrf_field() !!}
											<input name="_method" type="hidden" value="PUT">
											<div class="form-group">
												<div class="col-sm-12">
													<div class="checkbox">
														<label>
															<input id="disable_comments" name="disable_comments" value="1"
																   type="checkbox" {{ ($user->disable_comments==1) ? 'checked' : '' }}>
															{{ t('Disable comments on my ads') }}
														</label>
													</div>
												</div>
											</div>

											<div class="form-group <?php echo ($errors->has('pass')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('New Password') }}</label>
												<div class="col-sm-9">
													<input id="password" name="password" type="password" class="form-control" placeholder="Password">
												</div>
											</div>

											<div class="form-group <?php echo ($errors->has('pass')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('Confirm Password') }}</label>
												<div class="col-sm-9">
													<input id="password_confirmation" name="password_confirmation" type="password"
														   class="form-control" placeholder="Password confirmation">
												</div>
											</div>

											<div class="form-group">
												<div class="col-sm-offset-3 col-sm-9">
													<button type="submit" class="btn btn-primary">{{ t('Update') }}</button>
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
