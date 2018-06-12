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
						<h2 class="title-2"><strong> <i class="icon-docs"></i> {{ t('Edit Profile') }}</strong></h2>
							
								        <form name="details" class="form-horizontal" role="form" method="POST" action="{{ lurl('profile/update/'. $profile->user_id ) }}">
											{!! csrf_field() !!}
											{!! method_field('PUT') !!}

                                                <!-- Job Title -->
                                                <div class="form-group required <?php echo ($errors->has('title')) ? 'has-error' : ''; ?>">
                                                    <label class="col-sm-3 control-label">{{ t('Proffesion Title') }} <sup>*</sup></label>
                                                    <div class="col-sm-9">
                                                        <input name="title" type="text" class="form-control" placeholder="EXAMPLE: Web Developer" value="{{ $profile->title }}">
                                                    </div>
                                                </div>
    
                                                <!-- About you -->
                                                <div class="form-group required <?php echo ($errors->has('about')) ? 'has-error' : ''; ?>">
                                                    <label class="col-sm-3 control-label">{{ t('Describe your strengths') }} <sup>*</sup></label>
                                                    <div class="col-sm-9">
                                                        <textarea name="about" class="form-control" placeholder="EXAMPLE: Am web developer with experience working with PHP, SQL and Laravel framework together with front-end technologies like HTML5, CSS, Bootstrap, JQUERY and Vue.js.">{{ $profile->about }}</textarea>
                                                    </div>
                                                </div>

                                                 <!-- Skills -->
                                                <div class="form-group required <?php echo ($errors->has('name')) ? 'has-error' : ''; ?>">
                                                    <label class="col-sm-3 control-label">{{ t('Add Skills') }} <sup>*</sup></label>
                                                    <div class="col-sm-9">
                                                        <input name="skills" type="text" class="form-control" placeholder="EXAMPLE: Web Developer" value="{{ old('name', $user->name) }}">
                                                    </div>
                                                </div>                                            

											<div class="form-group">
												<div class="col-sm-offset-3 col-sm-9"></div>
											</div>
											<div class="form-group">
												<div class="col-sm-offset-3 col-sm-9">
													<button type="submit" class="btn btn-primary">{{ t('Update') }}</button>
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


