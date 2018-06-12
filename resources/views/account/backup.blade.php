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
				<div class="col-sm-3 page-sidebar">
					@include('account/inc/sidebar-left')
				</div>
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
						<div class="row">
							<div class="col-md-5 col-xs-4 col-xxs-12">
								<h3 class="no-padding text-center-480 useradmin">
									<a href="">
										<img class="userImg" src="{{ url('images/user.jpg') }}" alt="{{ $user->name }}">&nbsp;
								<!--		<img class="userImg" src="{{ $gravatar }}" alt="user">-->&nbsp;
										{{ $user->first_name }}
									</a>
								</h3>
							</div>
							<div class="col-md-7 col-xs-8 col-xxs-12">
								<div class="header-data text-center-xs">
									@if (isset($user) and in_array($user->user_type_id, [1, 2]))
									<!-- Traffic data -->
									<div class="hdata">
										<div class="mcol-left">
											<!-- Icon with red background -->
											<i class="fa fa-eye ln-shadow"></i>
										</div>
										<div class="mcol-right">
											<!-- Number of visitors -->
											<p>
												<a href="{{ lurl('account/myads') }}">
                                                    {{ $countAdsVisits->total_visits or 0 }}
												    <em>{{ trans_choice('global.count_visits', (isset($countAdsVisits) ? getPlural($countAdsVisits->total_visits) : getPlural(0))) }}</em>
                                                </a>
											</p>
										</div>
										<div class="clearfix"></div>
									</div>
								
									<!-- Ads data -->
									<div class="hdata">
										<div class="mcol-left">
											<!-- Icon with green background -->
											<i class="icon-th-thumb ln-shadow"></i>
										</div>
										<div class="mcol-right">
											<!-- Number of ads -->
											<p>
												<a href="{{ lurl('account/myads') }}">
                                                    {{ $countAds }}
												    <em>{{ trans_choice('global.count_ads', getPlural($countAds)) }}</em>
                                                </a>
											</p>
										</div>
										<div class="clearfix"></div>
									</div>
									@endif
                                    
                                    @if (isset($user) and in_array($user->user_type_id, [1, 3]))
									<!-- Favorites data -->
									<div class="hdata">
										<div class="mcol-left">
											<!-- Icon with blue background -->
											<i class="fa fa-user ln-shadow"></i>
										</div>
										<div class="mcol-right">
											<!-- Number of favorites -->
											<p>
												<a href="{{ lurl('account/favourite') }}">
                                                    {{ $countFavoriteAds }}
												    <em>{{ trans_choice('global.count_favorites', getPlural($countFavoriteAds)) }} </em>
                                                </a>
											</p>
										</div>
										<div class="clearfix"></div>
									</div>
                                    @endif
								</div>
							</div>
						</div>
					</div>


					<div class="inner-box">
						<div class="welcome-msg">
							<h3 class="page-sub-header2 clearfix no-padding">{{ t('Hello') }} {{ $user->first_name }} ! </h3>
							<span class="page-sub-header-sub small">
                                {{ t('You last logged in at') }}: {{ $user->last_login_at->format('d-m-Y H:i:s') }}
                            </span>
						</div>


                            <!--Profile -->

							@if(empty($profiles))
								<div class="panel panel-default">
								  <div class="panel-heading">
								  	<h5>Profile<span class="pull-right"><a href="" class="btn btn-default" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>Add</a></span></h5>
								  </div>
								  <div class="panel-body">
								  	<div class="container">
								  		<h5>No information to display</h5>
								  	</div>
								 </div>
								</div>

							  @else

								<div class="panel panel-default">
								  <div class="panel-heading">
								  	<h5>Profile<span class="pull-right"><a href="" class="btn btn-default" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i>Edit</a></span></h5>
								  </div>
								  <div class="panel-body">
								  	<div class="container">
								  		@foreach($profiles as $profile)
										  <h4>{{ $profile->title }}</h4>
										  <p>{{ $profile->about }}</p>
										 @endforeach
								  	</div>
								 </div>
								</div>
							@endif


								<!-- Edit Modal -->
								<div id="myModal" class="modal fade" role="dialog">

								  <div class="modal-dialog modal-lg">

								    <!-- Modal content-->
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">Edit Profile</h4>
								      </div>
								      <div class="modal-body">
								        <form name="details" class="form-horizontal" role="form" method="POST" action="{{ lurl('profile/details') }}">
											{!! csrf_field() !!}

                                                <!-- Job Title -->
                                                <div class="form-group required <?php echo ($errors->has('name')) ? 'has-error' : ''; ?>">
                                                    <label class="col-sm-3 control-label">{{ t('Proffesion Title') }} <sup>*</sup></label>
                                                    <div class="col-sm-9">
                                                        <input name="title" type="text" class="form-control" placeholder="EXAMPLE: Web Developer" value="{{ old('name', $user->name) }}">
                                                    </div>
                                                </div>
    
                                                <!-- About you -->
                                                <div class="form-group required <?php echo ($errors->has('email')) ? 'has-error' : ''; ?>">
                                                    <label class="col-sm-3 control-label">{{ t('Describe your strengths') }} <sup>*</sup></label>
                                                    <div class="col-sm-9">
                                                        <textarea name="about" class="form-control" placeholder="EXAMPLE: Am web developer with experience working with PHP, SQL and Laravel framework together with front-end technologies like HTML5, CSS, Bootstrap, JQUERY and Vue.js."></textarea>
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
													<button type="submit" class="btn btn-primary">{{ t('Save') }}</button>
												</div>
											</div>
										
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								      </div>
								      </form>
								    </div>

								  </div>
								</div>



                       


							


							<!--Education -->

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#collapseB3" data-toggle="collapse"> {{ t('Education') }} </a></h4>
								</div>
								<div class="panel-collapse collapse <?php echo ($errors->has('pass')) ? 'in' : ''; ?>" id="collapseB3">
									<div class="panel-body">
										<form name="settings" class="form-horizontal" role="form" method="POST"
											  action="{{ lurl('education/details') }}">
											{!! csrf_field() !!}
											

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
													<input id="institution" name="institution" type="text" class="form-control" placeholder="University Of Nairobi">
												</div>
											</div>

											<div class="form-group required <?php echo ($errors->has('course')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('Course Studied') }} <sup>*</sup></label>
												<div class="col-sm-9">
													<input id="course" name="course" type="text" class="form-control" placeholder="E.g Bsc Computer cience">
												</div>
											</div>

											<div class="form-group required <?php echo ($errors->has('qualification')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('Qualification') }} <sup>*</sup></label>
												<div class="col-sm-9">
													<input id="qualification" name="qualification" type="text" class="form-control" placeholder="E.g First Class">
												</div>
											</div>

											<div class="form-group <?php echo ($errors->has('certification')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('Certification') }}</label>
												<div class="col-sm-9">
													<input id="certification" name="certification" type="text" class="form-control" placeholder="E.g CCNA">
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
							</div>

							<!--Experience -->

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#collapseB4" data-toggle="collapse"> {{ t('Experience') }} </a></h4>
								</div>
								<div class="panel-collapse collapse required <?php echo ($errors->has('pass')) ? 'in' : ''; ?>" id="collapseB4">
									<div class="panel-body">
										<form name="settings" class="form-horizontal" role="form" method="POST"
											  action="{{ lurl('experience/details') }}">
											{!! csrf_field() !!}

											<div class="form-group <?php echo ($errors->has('company_name')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('Name of Company') }} <sup>*</sup></label>
												<div class="col-sm-9">
													<input id="company_name" name="company_name" type="text" class="form-control" placeholder="E.g Braintrain">
												</div>
											</div>

											<div class="form-group required <?php echo ($errors->has('role')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('Role at Workplace') }} <sup>*</sup></label>
												<div class="col-sm-9">
													<input id="role" name="role" type="text" class="form-control" placeholder="E.g Web Developer">
												</div>
											</div>

											<div class="form-group <?php echo ($errors->has('description')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('Job Description') }}</label>
												<div class="col-sm-9">
													<textarea id="description" name="description" class="form-control"></textarea>
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
							</div>


							<!--Portfolio -->

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#collapseB5" data-toggle="collapse"> {{ t('Portfolio') }} </a></h4>
								</div>
								<div class="panel-collapse collapse <?php echo ($errors->has('pass')) ? 'in' : ''; ?>" id="collapseB5">
									<div class="panel-body">
										<form name="settings" class="form-horizontal" role="form" method="POST"
											  action="{{ lurl('portfolio/details') }}">
											{!! csrf_field() !!}

											<div class="form-group required <?php echo ($errors->has('portfolio_name')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('Project Title') }} <sup>*</sup></label>
												<div class="col-sm-9">
													<input id="portfolio_name" name="portfolio_name" type="text" class="form-control" placeholder="Title of Work you did">
												</div>
											</div>

											<div class="form-group required <?php echo ($errors->has('description')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('Description') }} <sup>*</sup></label>
												<div class="col-sm-9">
													<textarea id="description" name="description" class="form-control"></textarea>
												</div>
											</div>

											<div class="form-group <?php echo ($errors->has('link')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('Link') }}</label>
												<div class="col-sm-9">
													<input id="link" name="link" type="text" class="form-control" placeholder="Link to Your Works Online">
												</div>
											</div>

											<div class="form-group <?php echo ($errors->has('filename')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('Upload a File') }}</label>
												<div class="col-sm-9">
													<input id="filename" name="filename" type="file" class="file">
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
							</div>

							<!--Settings -->

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#collapseB2" data-toggle="collapse"> {{ t('Settings') }} </a></h4>
								</div>
								<div class="panel-collapse collapse <?php echo ($errors->has('pass')) ? 'in' : ''; ?>" id="collapseB2">
									<div class="panel-body">
										<form name="settings" class="form-horizontal" role="form" method="POST"
											  action="{{ lurl('account/settings/update') }}">
											{!! csrf_field() !!}
											<input name="_method" type="hidden" value="PUT">
											<div class="form-group">
												<div class="col-sm-12">
													<div class="checkbox">
														<label>
															<input id="disable_comments" name="disable_comments" value="1"
																   type="checkbox" {{ ($user->disable_comments==1) ? 'checked' : '' }}>
															{{ t('Disable comments on my ads') }}
														</label>
													</div>
												</div>
											</div>

											<div class="form-group <?php echo ($errors->has('pass')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('New Password') }}</label>
												<div class="col-sm-9">
													<input id="password" name="password" type="password" class="form-control" placeholder="Password">
												</div>
											</div>

											<div class="form-group <?php echo ($errors->has('pass')) ? 'has-error' : ''; ?>">
												<label class="col-sm-3 control-label">{{ t('Confirm Password') }}</label>
												<div class="col-sm-9">
													<input id="password_confirmation" name="password_confirmation" type="password"
														   class="form-control" placeholder="Password confirmation">
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
							</div>

						</div>
						<!--/.row-box End-->

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

@section('after_scripts')
	<script src="{{ url('/assets/js/fileinput.min.js') }}" type="text/javascript"></script>
	@if (file_exists(public_path() . '/assets/js/fileinput_locale_'.$lang->get('abbr').'.js'))
		<script src="{{ url('/assets/js/fileinput_locale_'.$lang->get('abbr').'.js') }}" type="text/javascript"></script>
	@endif
	<script language="javascript">
		/* initialize with defaults (resume) */
		$('#filename').fileinput(
		{
			'showPreview': false,
			'allowedFileExtensions': {!! getUploadFileTypes('file', true) !!},
			'browseLabel': '{!! t("Browse") !!}',
			'showUpload': false,
			'showRemove': false,
			'maxFileSize': {{ (int)config('settings.upload_max_file_size', 1000) }}
		});
	</script>
	<script language="javascript">
		var user_type = '<?php echo old('user_type', $user->user_type_id); ?>';

		$(document).ready(function ()
		{
			/* Set user type */
			setUserType(user_type);
			$('#user_type').change(function () {
				setUserType($(this).val());
			});

			var countries = <?php echo (isset($countries)) ? $countries->toJson() : '{}'; ?>;
			var countryCode = $('#country').val();

			/* Set Country Phone Code */
			setCountryPhoneCode(countryCode, countries);
			$('#country').change(function () {
				setCountryPhoneCode($(this).val(), countries);
			});


			// Add skill tags
			$('#skill_tags').tokenfield({
				autocomplete:{
					source:['HTML','CSS','PHP','javascript','Mysql','Laravel'],
					delay:100
				},
				showAutocompleteOnFocus: true
			});

			

		});


	</script>

	s
@endsection
