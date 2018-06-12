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
								
								
								<div id="seekerss">
									<div id="companyinfo" class="content-subheading"><i class="icon-user fa"></i> <strong>Company information</strong></div>

								<div id="companyy">

									<form id="signup_form" class="form-horizontal" method="POST" action="{{ lurl('signupcomp/submit') }}" enctype="multipart/form-data">
									{!! csrf_field() !!}
									<fieldset>


										<!-- Company Name -->
										<div class="form-group required <?php echo ($errors->has('company_name')) ? 'has-error' : ''; ?>">
											<label class="col-md-3 control-label" for="company_name">{{ t('Company Name') }} <sup>*</sup></label>
											<div class="col-md-8">
												<input id="company_name" name="company_name" placeholder="{{ t('Company Name') }}" class="form-control input-md" type="text" value="{{ old('company_name') }}">
											</div>
										</div>

										<!-- Company Description -->
										<div class="form-group required <?php echo ($errors->has('company_description')) ? 'has-error' : ''; ?>">
											<label class="col-md-3 control-label" for="company_description">{{ t('Company Description') }} <sup>*</sup></label>
											<div class="col-md-8">
												<textarea class="form-control" id="company_description" name="company_description" rows="5">{{ old('company_description') }}</textarea>
												<p class="help-block">{{ t('Describe the company') }}</p>
											</div>
										</div>

										
										<!-- Company Website -->
										<div class="form-group <?php echo ($errors->has('company_website')) ? 'has-error' : ''; ?>">
											<label class="col-md-3 control-label" for="company_website">{{ t('Company Website') }} </label>
											<div class="col-md-8">
												<input id="company_website" name="company_website" placeholder="{{ t('Company Website') }}" class="form-control input-md" type="text" value="{{ old('company_website') }}">
											</div>
										</div>

										<!-- Country -->
										@if (!$ip_country)
											<div class="form-group required <?php echo ($errors->has('country')) ? 'has-error' : ''; ?>">
												<label class="col-md-3 control-label" for="country">{{ t('Your Country') }} <sup>*</sup></label>
												<div class="col-md-8">
													<select id="country" name="country1" class="form-control sselecter">
														<option value="0" {{ (!old('country') or old('country')==0) ? 'selected="selected"' : '' }}> {{ t('Select your Country') }} </option>
														@foreach ($countries as $item)
															<option value="{{ $item->get('code') }}" {{ (old('country', ($country) ? $country->get('code') : 0)==$item->get('code')) ? 'selected="selected"' : '' }}>{{ $item->get('name') }}</option>
														@endforeach
													</select>
												</div>
											</div>
										@else
											<input id="country" name="country" type="hidden" value="{{ $country->get('code') }}">
										@endif

									

										<!-- Location -->
										@include('home.inc.city2')

											<div class="form-group required <?php echo ($errors->has('contact_name')) ? 'has-error' : ''; ?>">
												<label class="col-md-3 control-label" for="contact_name">{{ t('Contact Name') }} <sup>*</sup></label>
												<div class="col-md-8">
													<div class="input-group">
														<span class="input-group-addon"><i class="icon-user"></i></span>
														<input id="contact_name" name="contact_name" placeholder="{{ t('Contact Name') }}"
														   class="form-control input-md" type="text" value="{{ old('contact_name') }}">
													</div>
												</div>
											</div>

										<!-- Contact Email -->
											<div class="form-group required <?php echo ($errors->has('contact_email')) ? 'has-error' : ''; ?>">
												<label class="col-md-3 control-label" for="contact_email"> {{ t('Contact Email') }} <sup>*</sup></label>
												<div class="col-md-8">
													<div class="input-group">
														<span class="input-group-addon"><i class="icon-mail"></i></span>
														<input id="contact_email" name="contact_email" class="form-control"
															   placeholder="{{ t('Contact Email') }}" type="text" value="{{ old('contact_email') }}">
													</div>
												</div>
											</div>

										<!-- Phone Number -->
										<div class="form-group required <?php echo ($errors->has('contact_phone')) ? 'has-error' : ''; ?>">
											<label class="col-md-3 control-label" for="contact_phone">{{ t('Phone Number') }}</label>
											<div class="col-md-8">
												<div class="input-group">
													<span id="phone_country" class="input-group-addon">
														<i class="icon-phone-1"></i>
													</span>
													<input id="contact_phone" name="contact_phone"
														   placeholder="{{ t('Phone Number (in local format)') }}"
														   class="form-control input-md" type="text"
														   value="{{ old('contact_phone', ((Auth::check() and isset($user->phone)) ? $user->phone : '')) }}">
												</div>
												
											</div>
										</div>

										<div class="form-group required <?php echo (isset($errors) and $errors->has('pass')) ? 'has-error' : ''; ?>">
											<label class="col-md-3 control-label" for="password">{{ t('Password') }} <sup>*</sup></label>
											<div class="col-md-8">
												<input id="password" name="pass" type="password" class="form-control"
													   placeholder="{{ t('Password') }}">
												<br>
												<input id="password_confirmation" name="pass_confirmation" type="password" class="form-control"
													   placeholder="{{ t('Password Confirmation') }}">
												<p class="help-block">{{ t('At least 5 characters') }}</p>
											</div>
										</div>



                                        
										@if (config('settings.activation_recaptcha'))
                                            <!-- Captcha -->
											<div class="form-group required <?php echo ($errors->has('g-recaptcha-response')) ? 'has-error' : ''; ?>">
												<label class="col-md-3 control-label" for="g-recaptcha-response"></label>
												<div class="col-md-8">
													{!! Recaptcha::render(['lang' => $lang->get('abbr')]) !!}
												</div>
											</div>
										@endif

										
										<div style="margin-bottom: 30px;"></div>

										<!-- Button  -->
										<div class="form-group" id="btnn">
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
