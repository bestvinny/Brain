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
		<div class="container">
		
			@section('search')
				@parent
				@include('account.inc.company-search')
		    @endsection
			<div class="row">

				<div class="col-sm-3 page-sidebar">
					@include('account.inc.sidebar-left2')
				</div>

				<div class="col-sm-9 page-content">
					@if (session('message'))
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							{{ session('message') }}
						</div>
					@endif

                <div class="container-fluid">
					<div class="row">
						
                      @foreach($companies as $company)
						<div class="col-md-12">
															
							<div class="inner-box">

								<div class="row">
									<div class="col-md-3">
										<img src="{{ url('/images/equity_bank.png') }}">
										<img src="{{ url('../') }}/public/images/{{ $company->company_name }}">

									</div>

									<div class="col-md-3">
										<h4>{{ $company->company_name }}</h4>
										<h5>Industry</h5>
										<h6>{{ $company->location }}</h6>
										<a href="{{ lurl('account/company/' . $company->id) }}"><button class="button btn btn-primary">View Company</button></a>
									</div>

									<div class="col-md-3" style="padding-top: 40px;">
										

										    <div class="img-circular">
										    	<div>{{ $company->vacancies }}</div>
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


									<div class="col-md-3">
										<div style="padding-top: 50px;">
											<a href=""><button class="button btn btn-success">RECEIVE JOB ALERTS</button></a>
										</div>
										
									</div>
								</div>			
								
							</div>
							

						</div>
						@endforeach

						{{ $companies->links() }}


					</div>
					</div>

				</div>


		     </div>
		</div>
	</div>

	@endsection



	



