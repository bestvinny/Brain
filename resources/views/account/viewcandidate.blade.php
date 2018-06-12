

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
					<a href="{{ lurl('account/candidates') }}"><button class="button btn btn-default"><i class="fa fa-sign-in"></i>Back to Search</button></a>
				</div>
				
			 

			<div class="row">

				<div class="col-md-12">
													
					<div class="inner-box">

						<div class="row">
							<div class="col-md-4">
								<img src="{{ url('/images/equity_bank.png') }}">
								<img class="images" id="image" src="{{ asset($occupation->logo) }}" />

							</div>

							<div class="col-md-4">
							<!--	<h4>{{ $occupation->user->first_name }} {{ $occupation->user->surname }}</h4> -->
								<h4>{{ $occupation->name }}</h4>
								<h5>{{ $occupation->name }}</h5>
								<h5>{{ $occupation->name }}</h5>
							</div>



							<div class="col-md-4">
								<div style="padding-top: 15px;">
									<a href=""><button class="button btn btn-success pull-right">SEND JOB INVITE</button></a>
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

						<div class="row">
	                    
							<div class="col-md-7">
							<div class="row">
							<div class="col-md-12">
								<div class="inner-box">

									@if(empty($occupation->education->id))
									<h4 style="text-align: center;"><strong>Education</strong></h4>
									<p style="text-align: center;">No education information</p>

									@else
									<h4 style="text-align: center;"><strong>Education</strong></h4>
									<p style="text-align: center;">{{ $occupation->education->course }}</p>
									<p style="text-align: center;">{{ $occupation->education->institution }}</p>
									<p style="text-align: center;">{{ $occupation->education->qualification }}</p>
                                     @endif
								</div>	

								<div class="inner-box">

									@if(empty($occupation->experience->id))
									<h4 style="text-align: center;"><strong>Work Experience</strong></h4>
									<p style="text-align: center;">No experience information</p>

									@else
									<h4 style="text-align: center;"><strong>Work Experience</strong></h4>
									<p style="text-align: center;">{{ $occupation->experience->role }}</p>
									<p style="text-align: center;">{{ $occupation->experience->description }}</p>
                                     @endif

								</div>	

							</div>
						</div>
								
																			
									
							</div>

							<div class="col-md-5">
								
																
								<div class="inner-box">

									<h3>Skills And Abilities</h3>

								</div>			
									
							</div>
								

						</div>
				</div>

				<div class="container-fluid">
					<div class="inner-box">

					@if(empty($occupation->portfolio->id))
					<h4 style="text-align: center;"><strong>Portfolio</strong></h4>
					<p style="text-align: center;">No Portfolio information</p>

					@else
					<h4 style="text-align: center;"><strong>Portfolio</strong></h4>
					<p style="text-align: center;">{{ $occupation->portfolio->name }}</p>
					<p style="text-align: center;">{{ $occupation->portfolio->description }}</p>
					<p style="text-align: center;">{{ $occupation->portfolio->link }}</p>
					<p style="text-align: center;">{{ $occupation->portfolio->files }}</p>
                     @endif


				</div>
				</div>

                
							
			</div>

				</div>


		     </div>
		</div>
	</div>

	@endsection









