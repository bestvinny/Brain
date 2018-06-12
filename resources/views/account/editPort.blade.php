{{--
 * Brain Train - Find the job you love!
 * Copyright (c) Brain Train Kenya. All Rights Reserved
 *
 * Website: http://www.braintrainke.com
 
--}}
@extends('layouts.master')

@section('content')
	<div class="main-container">
		<div class="container">
			<div class="row">
				<!--/.page-sidebar-->

				<div class="col-sm-9 page-content">

					@include('flash::message')

					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h5><strong>{{ t('Oops ! An error has occurred. Please correct the red fields in the form') }}</strong></h5>
							<ul class="list list-check">
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif


					<div class="inner-box">
						<h2 class="title-2"><strong> <i class="icon-docs"></i> {{ t('Add Portfolio') }}</strong></h2>
							
								       
								       <form name="settings" class="form-horizontal" role="form" method="POST"
											  action="{{ lurl('profile/insertport') }}">
											{!! csrf_field() !!}
											{!! method_field('PUT') !!}

											<div class="form-group required <?php echo ($errors->has('name')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('Project Title') }} <sup>*</sup></label>
												<div class="col-sm-9">
													<input id="portfolio_name" name="name" type="text" class="form-control" placeholder="Title of Work you did" value="{{ $port->name }}">
												</div>
											</div>

											<div class="form-group required <?php echo ($errors->has('description')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('Description') }} <sup>*</sup></label>
												<div class="col-sm-9">
													<textarea id="description" name="description" class="form-control">{{ $port->description }}</textarea>
												</div>
											</div>

											<div class="form-group <?php echo ($errors->has('link')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('Link') }}</label>
												<div class="col-sm-9">
													<input id="link" name="link" type="text" class="form-control" placeholder="Link to Your Works Online" value="{{ $port->link }}">
												</div>
											</div>

											<div class="form-group <?php echo ($errors->has('files')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('Upload a File') }}</label>
												<div class="col-sm-9">
													<input id="files" name="files" type="file" class="file">
												</div>
											</div>
											

											<div class="form-group">
												<div class="col-sm-offset-3 col-sm-9">
													<button type="submit" class="btn btn-primary">{{ t('Save') }}</button>
												</div>
											</div>
										</form>

								      
								   </div>

                       



						
				</div>
				<!--/.page-content-->
			</div>
			<!--/.row-->
		</div>
		<!--/.container-->
	</div>
	<!-- /.main-container -->


@endsection


