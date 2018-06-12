{{--
 * Brain Train - Find the job you love!
 * Copyright (c) Brain Train Kenya. All Rights Reserved
 *
 * Website: http://www.braintrainke.com
 *
--}}
@extends('layouts.master')

@section('content')

	<div class="main-container">

		<div class="container-fluid">
		       
				<div style="padding-bottom: 20px;">
					<a href="{{ lurl('account/companies') }}"><button class="button btn btn-default"><i class="fa fa-sign-in"></i>Back to Search</button></a>
				</div>
				

			<div class="row">

				<div class="col-md-12">
													
					<div class="inner-box">

						<div class="row">
							<div class="col-md-2">
								<img src="{{ url('/images/equity_bank.png') }}">
								<img class="images" id="image" src="{{ asset($company->logo) }}" />

							</div>

							<div class="col-md-2">
								<h4>{{ $company->company_name }}</h4>
								<h5>{{ $company->company_name }}</h5>
							</div>

							<div class="col-md-3" style="padding-top: 40px;">
								<a href="{{ $company->company_website }}"><button class="button btn btn-default"><h5>Company Website</h5></button></a>		
							</div>

							<div class="col-md-3" style="padding-top: 40px;">
								

								    <div class="img-circular">
								    	<div>3</div>
								    </div>
								    <div>
										<div><h4>Vacancies</h4></div>
								    </div>
									

									<style type="text/css">
										
											.img-circular{
												 width: 50px;
												 height: 50px;
												 background-size: cover;
												 display: block;
												 background: grey;
												 border-radius: 100px;
												 -webkit-border-radius: 100px;
												 -moz-border-radius: 100px;
												}
											.img-circular div {
											    float:left;
											    width:100%;
											    padding-top:50%;
											    line-height:1em;
											    margin-top:-0.5em;
											    text-align:center;
											    color:white;
											}
									</style>
								
							</div>


							<div class="col-md-2">
								<div style="padding-top: 50px;">
									<a href=""><button class="button btn btn-success">RECEIVE JOB ALERTS</button></a>
								</div>
								
							</div>
						</div>			
						
					</div>
					



			</div>
		</div>



		<div class="container">
			

			<div class="row">

				<div class="col-sm-12 page-content">

					<div class="container-fluid">

					<nav class="navbar navbar-default" id="company-nav">
						<div class="container-fluid">
							<div>
								<ul class="nav navbar-nav">
								  <li><a href="">OVERVIEW</a></li>
								  <li><a href="">JOBS</a></li>
								  <li><a href="">PHOTOS</a></li>
							    </ul>
							</div>
						</div>

					</nav>
					
					<style type="text/css">
						#company-nav{
							background-color: white;
							width: 260px;
							height: 20px; 
		
						}

					</style>

						<div class="row">
	                    
							<div class="col-md-8">
							<div class="row">
							<div class="col-md-12">
								<div class="inner-box">
									<div class="row">
										<div class="col-md-6">
											<p><strong>Size:</strong> {{ $company->size }}</p>
									        <p><strong>Business Type:</strong> {{ $company->business_type }}</p>
										</div>

										<div class="col-md-6">
											<p><strong>Founded:</strong> {{ $company->founded }}</p>
									        <p><strong>Headquarters:</strong> {{ $company->headquarters }}</p>
										</div>
									</div>


								</div>	

								<div class="inner-box">

									<h4 style="text-align: center;"><strong>About {{ $company->company_name }}</strong></h4>
									<p>{{ $company->about }}</p>

									<h4 style="text-align: center;"><strong>Mission</strong></h4>
									<p>{{ $company->mission }}</p>

								</div>	

							</div>
						</div>
								
																
								<div class="inner-box">

									<h4 style="text-align: center;"><strong>More Info</strong></h4>
									<p>{{ $company->more_info }}</p>


								</div>			
									
							</div>

							<div class="col-md-4">
								
																
								<div class="inner-box">

									<h3>Google map</h3>
									<div id="map">
										hkhh
									</div>

								</div>			
									
							</div>

							<div class="col-md-3">
										<div style="padding-top: 50px;">
											<a href="#report_abuse" data-toggle="modal"><button class="button btn btn-danger">REPORT BUSINESS</button></a>
										</div>
										
									</div>
								

						</div>
				</div>


							
			</div>

				</div>


		     </div>
		</div>
	</div>

	@endsection

	@section('modal_abuse')
     	@include('account.inc.modal-abuse')
    @endsection


@section('after_scripts')
    @if (config('services.googlemaps.key'))
        <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.googlemaps.key') }}" type="text/javascript"></script>
    @endif
    
	<script src="{{ url('assets/plugins/bxslider/jquery.bxslider.min.js') }}"></script>
	<script>
		var stateId = '<?php echo (isset($city)) ? $country->get('code') . '.' . $city->subadmin1_code : '0' ?>';

		/* JS translation */
		var lang = {
			loginToSaveAd: "@lang('global.Please log in to save your favourite job posting ads.')",
			loginToSaveSearch: "@lang('global.Please log in to save your search.')",
			confirmationSaveSearch: "@lang('global.Search saved successfully !')",
			confirmationRemoveSaveSearch: "@lang('global.Search deleted successfully !')"
		};

		$('.bxslider').bxSlider({
			pagerCustom: '#bx-pager',
			controls: true,
			nextText: " @lang('global.Next') &raquo;",
			prevText: "&laquo; @lang('global.Previous') "
		});

		$(document).ready(function () {
			@if (count($errors) > 0)
				@if (count($errors) > 0 and old('msg_form')=='1')
					$('#applyJob').modal();
				@endif
				@if (count($errors) > 0 and old('abuse_form')=='1')
					$('#report_abuse').modal();
				@endif
			@endif
			@if (config('settings.show_ad_on_googlemap'))
				genGoogleMaps(
				'<?php echo config('services.googlemaps.key'); ?>',
				'<?php echo (isset($ad->city) and !is_null($ad->city)) ? addslashes($ad->city->name) . ',' . $country->get('name') : $country->get('name') ?>',
				'<?php echo $lang->get('abbr'); ?>'
				);
			@endif
		})
	</script>
	<script src="{{ url('assets/js/form-validation.js') }}"></script>
	<script src="{{ url('assets/js/app/show.phone.js') }}"></script>
	<script type="text/javascript" src="{{ url('assets/js/app/make.favorite.js') }}"></script>
@endsection