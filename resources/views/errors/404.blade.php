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

@section('title', t('Page not found', []))

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
							<h2 class="headline text-center" style="font-family: 'Montserrat', sans-serif; font-size: 180px; float: none;"> 404</h2>
							<div class="text-center m-l-0" style="margin-top: 60px;">
								<h3 class="m-t-0"><i class="fa fa-warning"></i> :-( {{ t('Page not found') }} !</h3>
								<p>
									<?php
                                    $default_error_message = t('Meanwhile, you may <a href=":url">return to homepage</a>', ['url' => url('/')]);
									?>
									{!! isset($exception) ? ($exception->getMessage() ? $exception->getMessage() : $default_error_message) : $default_error_message !!}
								</p>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!-- /.main-container -->
@endsection
