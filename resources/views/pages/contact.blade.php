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

<?php
// Get city for Google Maps
$city = \App\Models\City::where('country_code', $country->get('code'))->orderBy('population', 'desc')->first();
?>

@section('search')
	@parent
	@include('pages.inc.contact-intro')
@endsection

@section('content')
	<div class="main-container">
		<div class="container">
			<div class="row clearfix">
				
				@if (count($errors) > 0)
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


				<div class="col-md-4">
					<div class="contact_info">
						<h5 class="list-title gray"><strong>{{ t('Contact Information') }}</strong></h5>

						<div class="contact-info ">
							<div class="address">
								<div style="margin-bottom: 20px;">
									<p><strong>{{ t('Phone Number') }}:</strong> <a href="mailto:{{ config('settings.app_phone_number') }}">{{ config('settings.app_phone_number') }}</a></p>
									<p><strong>{{ t('Email') }}:</strong> <a href="mailto:{{ config('settings.app_email') }}">{{ config('settings.app_email') }}</a></p>
								</div>
							</div>
						</div>

						<div class="hero-subscribe">
							<h4 class="footer-title no-margin">{{ t('Connect With Us') }}</h4>
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
				<div class="col-md-8">
					<div class="contact-form">
						<h5 class="list-title gray"><strong>{{ t('Contact Us By Message') }}</strong></h5>

						<form class="form-horizontal" method="post" action="{{ lurl(trans('routes.contact')) }}">
							{!! csrf_field() !!}
							<fieldset>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group required <?php echo ($errors->has('first_name')) ? 'has-error' : ''; ?>">
											<div class="col-md-12">
												<input id="first_name" name="first_name" type="text" placeholder="{{ t('First Name') }}"
													   class="form-control" value="{{ old('first_name') }}">
											</div>
										</div>
									</div>

									<div class="col-sm-6">
										<div class="form-group required <?php echo ($errors->has('last_name')) ? 'has-error' : ''; ?>">
											<div class="col-md-12">
												<input id="last_name" name="last_name" type="text" placeholder="{{ t('Last Name') }}"
													   class="form-control" value="{{ old('last_name') }}">
											</div>
										</div>
									</div>

									<div class="col-sm-6">
										<div class="form-group required <?php echo ($errors->has('company_name')) ? 'has-error' : ''; ?>">
											<div class="col-md-12">
												<input id="company_name" name="company_name" type="text" placeholder="{{ t('Company Name') }}"
													   class="form-control" value="{{ old('company_name') }}">
											</div>
										</div>
									</div>

									<div class="col-sm-6">
										<div class="form-group required <?php echo ($errors->has('email')) ? 'has-error' : ''; ?>">
											<div class="col-md-12">
												<input id="email" name="email" type="text" placeholder="{{ t('Email Address') }}" class="form-control"
													   value="{{ old('email') }}">
											</div>
										</div>
									</div>

									<div class="col-lg-12">
										<div class="form-group required <?php echo ($errors->has('message')) ? 'has-error' : ''; ?>">
											<div class="col-md-12">
												<textarea class="form-control" id="message" name="message" placeholder="{{ t('Message') }}"
														  rows="7">{{ old('message') }}</textarea>
											</div>
										</div>

										<!-- Captcha -->
										@if (config('settings.activation_recaptcha'))
											<div class="form-group required <?php echo ($errors->has('g-recaptcha-response')) ? 'has-error' : ''; ?>">
												<div class="col-md-12 control-label" for="g-recaptcha-response">
													{!! Recaptcha::render(['lang' => $lang->get('abbr')]) !!}
												</div>
											</div>
										@endif

										<div class="form-group">
											<div class="col-md-12 ">
												<button type="submit" class="btn btn-primary btn-lg">{{ t('Submit') }}</button>
											</div>
										</div>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-footer">
@endsection

@section('after_scripts')
	<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.googlemaps.key') }}" type="text/javascript"></script>
	<script src="{{ url('assets/js/form-validation.js') }}"></script>
	<script>
		$(document).ready(function () {
			genGoogleMaps(
				'<?php echo config('services.googlemaps.key'); ?>',
				'<?php echo (!is_null($city)) ? $city->name . ', ' . $country->get('name') : $country->get('name') ?>',
				'<?php echo $lang->get('abbr'); ?>'
			);
		})
	</script>
@endsection
