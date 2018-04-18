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
 * 	created	: 31 August, 2017
 *	version : 1.0
 * 	website : https://www.wanekeyasam.co.ke
 *	Email   : contact@wanekeyasam.co.ke
--}}
@extends('errors.layouts.master')

@section('search')
	@parent
	@include('errors.layouts.inc.search')
@endsection

@section('content')
	<div class="main-container inner-page">
		<div class="container">
			<div class="section-content">
				<div class="row">

					<div class="col-md-12 page-content">

						<div class="error-page" style="margin: 100px 0;">
							<h2 class="headline text-center" style="font-size: 180px; float: none;">@lang('global.Whoops !', [])</h2>
							<div class="text-center m-l-0" style="margin-top: 60px;">
								<h3 class="m-t-0"><i class="fa fa-warning"></i> Bad request.</h3>
								<p>
									@lang('global.We regret that we can not process your request at this time. Our engineers have been notified of this problem and will try to resolve it as soon as possible.', [])</p>
							</div>
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- /.main-container -->
@endsection
