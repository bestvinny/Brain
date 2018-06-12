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
						<h2 class="title-2"><strong> <i class="icon-docs"></i> {{ t('Edit Company Information') }}</strong></h2>

						<form name="details" class="form-horizontal" role="form" method="POST" action="{{ lurl('profile/updatecomp/'. $comp->user_id) }}">
											{!! csrf_field() !!}
											{!! method_field('PUT') !!}

													<!-- Business type -->
												
													<div class="form-group required <?php echo (isset($errors) and $errors->has('business_type')) ? 'has-error' : ''; ?>">
													<label class="col-md-3 control-label">{{ t('Business type') }} <sup>*</sup></label>
													<div class="col-md-9">
														<select name="business_type" id="business_type" class="form-control selecter">
															<option value="0"
																	@if(old('business_type')=='' or old('business_type')==0)selected="selected"@endif> {{ t('Select') }} </option>
															@foreach ($categories as $category)
																<option value="{{ $category->name }}" @if(old('business_type')==$category->name)selected="selected"@endif>
																	{{ $category->name }}
																</option>
															@endforeach
														</select>
													</div>
												</div>
												
                                            
                                               

                                                <!-- Company size -->
                                                <div class="form-group required <?php echo ($errors->has('size')) ? 'has-error' : ''; ?>">
                                                    <label class="col-sm-3 control-label">{{ t('Company Size') }} <sup>*</sup></label>
                                                    <div class="col-sm-9">
                                                        <input name="size" type="text" class="form-control" placeholder="EXAMPLE: 100 Employees" value="{{ $comp->size }}">
                                                    </div>
                                                </div>
    
                                                <!-- About -->
                                                <div class="form-group required <?php echo ($errors->has('about')) ? 'has-error' : ''; ?>">
                                                    <label class="col-sm-3 control-label">{{ t('About the Company') }} <sup>*</sup></label>
                                                    <div class="col-sm-9">
                                                        <textarea name="about" class="form-control" placeholder=".">{{ $comp->about }}</textarea>
                                                    </div>
                                                </div>

                                                 <!-- Mission -->
                                                <div class="form-group required <?php echo ($errors->has('mission')) ? 'has-error' : ''; ?>">
                                                    <label class="col-sm-3 control-label">{{ t('Mission') }} <sup>*</sup></label>
                                                    <div class="col-sm-9">
                                                        <textarea name="mission" class="form-control" placeholder="">{{ $comp->mission }}</textarea>
                                                    </div>
                                                </div>

                                                 <!-- More info -->
                                                <div class="form-group required <?php echo ($errors->has('more_info')) ? 'has-error' : ''; ?>">
                                                    <label class="col-sm-3 control-label">{{ t('Additional information') }} <sup>*</sup></label>
                                                    <div class="col-sm-9">
                                                        <textarea name="more_info" class="form-control" placeholder="">{{ $comp->more_info }}</textarea>
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


