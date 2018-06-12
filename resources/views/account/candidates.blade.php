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
				@include('account.inc.candidate-search')
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
                      @foreach($occupations as $occupation)
						<div class="col-md-6">
							
															
							<div class="inner-box">

								<div class="row">
									<div class="col-md-4">
										<img src="{{ url('/images/equity_bank.png') }}">
										<p>{{ $occupation->first_name }}</p>
									</div>

									<div class="col-md-8">
										<h4>{{ $occupation->name }}</h4>
										<h5>{{ $occupation->industry }}</h5>
										<h6>{{ $occupation->location }}</h6>
										<p>skills</p>
										<a href="{{ lurl('account/candidate/' . $occupation->id) }}"><button class="button btn btn-primary">View Candidate</button></a>
									</div>
								</div>			
								
							</div>
							

						</div>
						@endforeach

						{{ $occupations->links() }}


					</div>
					</div>

				</div>


		     </div>
		</div>
	</div>

	@endsection



