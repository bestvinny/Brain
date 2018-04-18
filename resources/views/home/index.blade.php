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

@section('search')
	@parent
	@include('home.inc.search')
@endsection

@section('content')
	<div class="main-contain" id="homepage">
		<div class="container">
			<div class="row">
				@if (session('message'))
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						{{ session('message') }}
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
			</div>

			@include('home.inc.locations')
			@include('home.inc.companies')
			@include('home.inc.list')
			@include('home.inc.categories')
			@include('home.inc.blog-posts')
			@include('home.inc.bottom-info')
			@include('home.inc.other-stats')

		</div>
	</div>
	<div class="panel-footer">

	@endsection

@section('modal_location')
	@include('layouts.inc.modal.location')
@endsection

@section('after_scripts')
	<script>
		var stateId = '<?php echo (isset($city)) ? $country->get('code').'.'.$city->subadmin1_code : '0' ?>';
	</script>
	<script type="text/javascript" src="{{ url('assets/js/app/load.cities.js') }}"></script>
@endsection
