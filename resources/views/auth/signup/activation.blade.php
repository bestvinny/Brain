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
				<div class="col-md-12 page-content">

					@if ($error==0)
						<div class="inner-box category-content">
							<div class="row">
								<div class="col-lg-12">
									<div class="alert alert-success pgray  alert-lg" role="alert">
										<h2 class="no-margin no-padding">&#10004; {{ t('Congratulations!') }}</h2>
										<p>{{ $message }}</p>
									</div>
								</div>
							</div>
						</div>
					@else
						<div class="inner-box category-content">
							<div class="row">
								<div class="col-lg-12">
									<div class="alert alert-danger pgray  alert-lg" role="alert">
										<h2 class="no-margin no-padding">&#10004; {{ t('Oops!') }}</h2>
										<p>{{ $message }}</p>
									</div>
								</div>
							</div>
						</div>
					@endif

				</div>
			</div>
		</div>
	</div>
@endsection
