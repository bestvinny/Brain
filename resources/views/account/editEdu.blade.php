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
						<h2 class="title-2"><strong> <i class="icon-docs"></i> {{ t('Edit Education') }}</strong></h2>
							
								        <form name="settings" class="form-horizontal" role="form" method="POST"
											  action="{{ lurl('profile/updateedu/'. $educ->user_id) }}">
											{!! csrf_field() !!}
											{!! method_field('PUT') !!}
											

											<div class="form-group required <?php echo ($errors->has('education_level')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('Highest Level Of Education') }} <sup>*</sup></label>
												<div class="col-sm-9">
													<select id="country" name="education_level" class="form-control">
                                                            <option value="0">
                                                                Select your Education Level...
                                                            </option>
                                                            @foreach ($educations as $education)
                                                                <option value="{{ $education->level }}">
                                                                    {{ $education->level }}
                                                                </option>
                                                            @endforeach
                                                        </select>
												</div>
											</div>

											<div class="form-group required <?php echo ($errors->has('institution')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('Name of Institution') }} <sup>*</sup></label>
												<div class="col-sm-9">
													<input id="institution" name="institution" type="text" class="form-control" placeholder="University Of Nairobi" value="{{ $educ->institution }}">
												</div>
											</div>

											<div class="form-group required <?php echo ($errors->has('course')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('Course Studied') }} <sup>*</sup></label>
												<div class="col-sm-9">
													<input id="course" name="course" type="text" class="form-control" placeholder="E.g Bsc Computer cience" value="{{ $educ->course }}">
												</div>
											</div>

											<div class="form-group required <?php echo ($errors->has('qualification')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('Qualification') }} <sup>*</sup></label>
												<div class="col-sm-9">
													<input id="qualification" name="qualification" type="text" class="form-control" placeholder="E.g First Class" value="{{ $educ->qualification }}">
												</div>
											</div>

											<div class="form-group <?php echo ($errors->has('certification')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('Certification') }}</label>
												<div class="col-sm-9">
													<input id="certification" name="certification" type="text" class="form-control" placeholder="E.g CCNA" value="{{ $educ->certification }}">
												</div>
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


