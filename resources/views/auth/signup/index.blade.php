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

				@if (isset($errors) and count($errors) > 0)
					<div class="col-lg-12">
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h5><strong>{{ t('Oops ! An error has occurred. Please correct the red fields in the form') }}</strong></h5>
							<ul class="list list-check">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					</div>
				@endif

				@if (Session::has('flash_notification.message'))
					<div class="container" style="margin-bottom: -10px; margin-top: -10px;">
						<div class="row">
							<div class="col-lg-12">
								@include('flash::message')
							</div>
						</div>
					</div>
				@endif

				<div class="col-md-8 page-content">
					<div class="inner-box category-content">
						<h2 class="title-2" id="acc"><strong> <i class="icon-user-add"></i> {{ t('Create your account, Its free') }}</strong></h2>
						<div class="row">
							@if (config('settings.activation_social_login'))
								<div class="text-center" style="margin-bottom: 30px;">
									<div class="row row-centered">
										<div class="btn btn-lg btn-fb  col-centered" style="margin-right: 4px;">
											<a href="{{ lurl('auth/facebook') }}" class="btn-fb"><i class="icon-facebook"></i> {!! t('Connect with Facebook') !!}</a>
										</div>
										<div class="btn btn-lg btn-danger  col-centered" style="margin-left: 4px;">
											<a href="{{ lurl('auth/google') }}" class="btn-danger"><i class="icon-googleplus-rect"></i> {!! t('Connect with Google+') !!}</a>
										</div>
									</div>

									<div class="row row-centered loginOr">
										<div class="col-xs-12 col-sm-12">
											<hr class="hrOr">
											<span class="spanOr rounded">{{ t('or') }}</span>
										</div>
									</div>
								</div>
							@endif
									

							<div class="col-sm-12">
								
								
								<div id="seekers">
									<div id="seekerinfo" class="content-subheading"><i class="icon-user fa"></i> <strong>Job seeker information</strong></div>
									<div id="highinfo" class="content-subheading"><i class="icon-user fa"></i> <strong>High school information</strong></div>
									
									<form id="signup_form" class="form-horizontal" method="POST" action="{{ lurl('signup/submit') }}" enctype="multipart/form-data">
									{!! csrf_field() !!}
									<fieldset>
										<?php
										/*
										<!-- Gender -->
										<div class="form-group required <?php echo (isset($errors) and $errors->has('gender')) ? 'has-error' : ''; ?>">
											<label class="col-md-4 control-label">{{ t('Gender') }} <sup>*</sup></label>
											<div class="col-md-6">
												<select name="gender" id="gender" class="form-control selecter">
													<option value="0"
															@if(old('gender')=='' or old('gender')==0)selected="selected"@endif> {{ t('Select') }} </option>
													@foreach ($genders as $gender)
														<option value="{{ $gender->tid }}" @if(old('gender')==$gender->tid)selected="selected"@endif>
															{{ $gender->name }}
														</option>
													@endforeach
												</select>
											</div>
										</div>
										*/
										?>

										<!-- User Type -->
										<div class="form-group required <?php echo (isset($errors) and $errors->has('user_type')) ? 'has-error' : ''; ?>">
											<label class="col-md-4 control-label">{{ t('You are a') }} <sup>*</sup></label>
											<div class="col-md-6">
												@foreach ($userTypes as $type)
													<label class="radio-inline" for="user_type-{{ $type->id }}">
														<input type="radio" name="user_type" id="user_type-{{ $type->id }}" class="user_type"
															   value="{{ $type->id }}" {{ (old('user_type', \Illuminate\Support\Facades\Input::get('type'))==$type->id) ? 'checked="checked"' : '' }}>
														{{ t('' . $type->name) }}
													</label>
												@endforeach
											</div>
										</div>

										<div id="ss">

											<!-- Name -->
										<div class="form-group required <?php echo (isset($errors) and $errors->has('first_name')) ? 'has-error' : ''; ?>">
											<label class="col-md-4 control-label">{{ t('First Name') }} <sup>*</sup></label>
											<div class="col-md-6">
												<input name="first_name" placeholder="{{ t('First Name') }}" class="form-control input-md" type="text"
													   value="{{ old('first_name') }}">
											</div>
										</div>

										<div class="form-group required <?php echo (isset($errors) and $errors->has('surname')) ? 'has-error' : ''; ?>">
											<label class="col-md-4 control-label">{{ t('Surname') }} <sup>*</sup></label>
											<div class="col-md-6">
												<input name="surname" placeholder="{{ t('Surname') }}" class="form-control input-md" type="text"
													   value="{{ old('surname') }}">
											</div>
										</div>

										<!-- Country -->
										@if (!$ip_country)
											<div class="form-group required <?php echo (isset($errors) and $errors->has('country')) ? 'has-error' : ''; ?>">
												<label class="col-md-4 control-label" for="country">{{ t('Your Country') }} <sup>*</sup></label>
												<div class="col-md-6">
													<select id="country" name="country" class="form-control sselecter">
														<option value="0" {{ (!old('country') or old('country')==0) ? 'selected="selected"' : '' }}>{{ t('Select') }}</option>
														@foreach ($countries as $code => $item)
															<option value="{{ $code }}" {{ (old('country', (!$country->isEmpty()) ? $country->get('code') : 0)==$code) ? 'selected="selected"' : '' }}>
																{{ $item->get('name') }}
															</option>
														@endforeach
													</select>
												</div>
											</div>
										@else
											<input id="country" name="country" type="hidden" value="{{ $country->get('code') }}">
										@endif

										<!-- date of Birth -->
										<div class="form-group required <?php echo (isset($errors) and $errors->has('dob')) ? 'has-error' : ''; ?>">
											<label class="col-md-4 control-label">{{ t('Date Of Birth') }} <sup>*</sup></label>
											<div class="col-md-6">
												<input name="dob" placeholder="{{ t('Date Of Birth') }}" class="form-control input-md" type="date"
													   value="{{ old('dob') }}">
											</div>
										</div>

										<!-- Current City -->
										@include('home.inc.city')


										<!-- Highest Level of Education -->
										<div id="seeker">
											<div class="form-group required <?php echo (isset($errors) and $errors->has('level')) ? 'has-error' : ''; ?>">
											<label class="col-md-4 control-label">{{ t('Highest Level of Education') }} <sup>*</sup></label>
											<div class="col-md-6">
												<select name="level" id="level" class="form-control selecter">
													<option value="0"
															@if(old('level')=='' or old('level')==0)selected="selected"@endif> {{ t('Select') }} </option>
													@foreach ($levels as $level)
														<option value="{{ $level->tid }}" @if(old('level')==$level->tid)selected="selected"@endif>
															{{ $level->level }}
														</option>
													@endforeach
												</select>
											</div>
										</div>
										</div>
										

										<!-- Name of High School -->
										<div id="stude">
											<div class="form-group required <?php echo (isset($errors) and $errors->has('school_name')) ? 'has-error' : ''; ?>">
											<label class="col-md-4 control-label">{{ t('Name of High School') }} <sup>*</sup></label>
											<div class="col-md-6">
												<input name="school_name" placeholder="{{ t('Name of High School') }}" class="form-control input-md" type="text"
													   value="{{ old('school_name') }}">
											</div>
										</div>
										</div>
										

										<!-- Phone Number -->
										<div class="form-group required <?php echo (isset($errors) and $errors->has('phone')) ? 'has-error' : ''; ?>">
											<label class="col-md-4 control-label">{{ t('Phone') }} <sup>*</sup></label>
											<div class="col-md-6">
												<div class="input-group"><span id="phone_country" class="input-group-addon"><i class="icon-mail"></i></span>
													<input name="phone" placeholder="{{ t('Phone Number') }}" class="form-control input-md"
														   type="text" value="{{ old('phone') }}">
												</div>
											</div>
										</div>

										<div class="form-group required <?php echo (isset($errors) and $errors->has('email')) ? 'has-error' : ''; ?>">
											<label class="col-md-4 control-label" for="email">{{ t('Email') }} <sup>*</sup></label>
											<div class="col-md-6">
												<div class="input-group">
													<span class="input-group-addon"><i class="icon-mail"></i></span>
													<input id="email" name="email" type="email" class="form-control" placeholder="{{ t('Email') }}"
														   value="{{ old('email') }}">
												</div>
											</div>
										</div>

										<div class="form-group required <?php echo (isset($errors) and $errors->has('password')) ? 'has-error' : ''; ?>">
											<label class="col-md-4 control-label" for="password">{{ t('Password') }} <sup>*</sup></label>
											<div class="col-md-6">
												<input id="password" name="password" type="password" class="form-control"
													   placeholder="{{ t('Password') }}">
												<br>
												<input id="password_confirmation" name="password_confirmation" type="password" class="form-control"
													   placeholder="{{ t('Password Confirmation') }}">
												<p class="help-block">{{ t('At least 5 characters') }}</p>
											</div>
										</div>

										<!-- Resume -->
										<div id="resumeBloc" class="form-group required <?php echo ($errors->has('filename')) ? 'has-error' : ''; ?>">
											<label class="col-md-4 control-label" for="filename"> {{ t('Your resume') }} </label>
											<div class="col-md-6">
												<div class="mb10">
													<input id="filename" name="filename" type="file" class="file">
												</div>
												<p class="help-block">{{ t('File types: :file_types', ['file_types' => showValidFileTypes('file')]) }}</p>
											</div>
										</div>

										<!-- Parent/Guardian Name -->
										<div id="parentBloc">
											
										<div class="form-group required <?php echo (isset($errors) and $errors->has('p_name')) ? 'has-error' : ''; ?>">
											<label class="col-md-4 control-label">{{ t('Parent/Guardian Name') }} <sup>*</sup></label>
											<div class="col-md-6">
												<input name="p_name" placeholder="{{ t('Parent/Guardian Name') }}" class="form-control input-md" type="text"
													   value="{{ old('p_name') }}">
											</div>

										</div>

										<div class="form-group required <?php echo (isset($errors) and $errors->has('email')) ? 'has-error' : ''; ?>">
											<label class="col-md-4 control-label" for="email">{{ t('Parent/Guardian Email') }} <sup>*</sup></label>
											<div class="col-md-6">
												<div class="input-group">
													<span class="input-group-addon"><i class="icon-mail"></i></span>
													<input id="p_email" name="p_email" type="email" class="form-control" placeholder="{{ t('Parent/Guardian Email') }}"
														   value="{{ old('p_email') }}">
												</div>
											</div>
										</div>

										<div class="form-group required <?php echo (isset($errors) and $errors->has('term')) ? 'has-error' : ''; ?>"
											 style="margin-top: -10px;">
											<label class="col-md-4 control-label"></label>
											<div class="col-md-8">
												<div class="termbox mb10">
													<label class="checkbox-inline" for="term">
														<input name="term" id="term" value="1" type="checkbox" {{ (old('parent-consent')=='1') ? 'checked="checked"' : '' }}>
														{!! t('I have read and agree to the <a href=":url"><strong>Parent/Guardian Consent</strong></a>', ['url' => getUrlPageByType('standard')]) !!}
													</label>
												</div>
												<div style="clear:both"></div>
											</div>
										</div>

										</div>

										@if (config('settings.activation_recaptcha'))
											<div class="form-group required <?php echo (isset($errors) and $errors->has('g-recaptcha-response')) ? 'has-error' : ''; ?>">
												<label class="col-md-4 control-label" for="g-recaptcha-response"></label>
												<div class="col-md-6">
													{!! Recaptcha::render(['lang' => $lang->get('abbr')]) !!}
												</div>
											</div>
										@endif

										<div class="form-group required <?php echo (isset($errors) and $errors->has('term')) ? 'has-error' : ''; ?>"
											 style="margin-top: -10px;">
											<label class="col-md-4 control-label"></label>
											<div class="col-md-8">
												<div class="termbox mb10">
													<label class="checkbox-inline" for="term">
														<input name="term" id="term" value="1" type="checkbox" {{ (old('term')=='1') ? 'checked="checked"' : '' }}>
														{!! t('I have read and agree to the <a href=":url"><strong>Terms & Conditions</strong></a>', ['url' => getUrlPageByType('terms')]) !!}
													</label>
												</div>
												<div style="clear:both"></div>
											</div>
										</div>
											
										</div>


										<!-- Button  -->
										<div class="form-group" id="btn">
											<label class="col-md-4 control-label"></label>
											<div class="col-md-8">
												<button id="signup_btn" class="btn btn-primary btn-lg"> {{ t('Register') }} </button>
											</div>
										</div>

										<div style="margin-bottom: 30px;"></div>

									</fieldset>
								</form>

								</div>


							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4 reg-sidebar">
					<div class="reg-sidebar-inner text-center">
						<div class="promo-text-box"><i class=" icon-briefcase fa fa-4x icon-color-1"></i>
							<h3><strong>{{ t('Post a Job') }}</strong></h3>
							<p>
								{{ t('Do you have a post to be filled within your company? Find the right candidate in a few clicks at :app_name',
								['app_name' => getDomain()]) }}
							</p>
						</div>
						<div class="promo-text-box"><i class=" icon-pencil-circled fa fa-4x icon-color-2"></i>
							<h3><strong>{{ t('Create and Manage Jobs') }}</strong></h3>
							<p>{{ t('Become a best company. Create and Manage your jobs. Repost your old jobs, etc.') }}</p>
						</div>
						<div class="promo-text-box"><i class="  icon-heart-2 fa fa-4x icon-color-3"></i>
							<h3><strong>{{ t('Create your Favorite jobs list.') }}</strong></h3>
							<p>{{ t('Create your Favorite jobs list, and save your searchs. Don\'t forget any opportunity!') }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-footer">

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
		var user_type = '<?php echo old('user_type', \Illuminate\Support\Facades\Input::get('type')); ?>';

		$(document).ready(function ()
		{
			/* Set user type */
			setUserType(user_type);
			$('.user_type').click(function () {
				setUserType($(this).val());
			});

			var countries = <?php echo (isset($countries)) ? $countries->toJson() : '{}'; ?>;
			var countryCode = '<?php echo old('country', ($country) ? $country->get('code') : 0); ?>';

			/* Set Country Phone Code */
			setCountryPhoneCode(countryCode, countries);
			$('#country').change(function () {
				setCountryPhoneCode($(this).val(), countries);
			});

			/* Submit Form */
			$("#signup_btn").click(function () {
				$("#signup_form").submit();
				return false;
			});
		});
	</script>
@endsection
