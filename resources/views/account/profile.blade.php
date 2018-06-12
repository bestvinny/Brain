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

						@if (isset($user) and in_array($user->user_type_id, [1, 3, 4]))
					 <!--Profile -->

							@if(empty($profile))

								<div class="panel panel-default">
								  <div class="panel-heading">
								  	<h5>Profile<span class="pull-right"><a href="{{ lurl('profile/addForm') }}" class="btn btn-default"><i class="fa fa-edit"></i>Add</a></span></h5>
								  </div>
								  <div class="panel-body">
								  	<div class="container">
								  		<h5>No information to display</h5>
								  	</div>
								 </div>
								</div>

							  @else

								<div class="panel panel-default">
									@foreach($profiles as $profile)
								  <div class="panel-heading">
								  	<h5>Profile<span class="pull-right"><a href="{{ lurl('profile/editForm/'. $profile->user_id) }}" class="btn btn-default"><i class="fa fa-edit"></i>Edit</a></span></h5>
								  </div>
								  <div class="panel-body">
								  	<div class="container">
										  <h4>{{ $profile->title }}</h4>
										  <p>{{ $profile->about }}</p>
								  	</div>
								 </div>
								 @endforeach
								</div>
							@endif


                            <!-- Education -->

							@if(empty($educa))

								<div class="panel panel-default">
								  <div class="panel-heading">
								  	<h5>Education<span class="pull-right"><a href="{{ lurl('profile/addeduform') }}" class="btn btn-default"><i class="fa fa-edit"></i>Add</a></span></h5>
								  </div>
								  <div class="panel-body">
								  	<div class="container">
								  		<h5>No information to display</h5>
								  	</div>
								 </div>
								</div>

							  @else

								<div class="panel panel-default">
									@foreach($educs as $educ)
								  <div class="panel-heading">
								  	<h5>Education<span class="pull-right"><a href="{{ lurl('profile/editedu/'. $educ->user_id) }}" class="btn btn-default"><i class="fa fa-edit"></i>Edit</a></span></h5>
								  </div>
								  <div class="panel-body">
								  	<div class="container">
										  <p>{{ $educ->education_level }}</p>
										  <p>{{ $educ->institution }}</p>
										  <p>{{ $educ->course }}</p>
										  <p>{{ $educ->qualification }}</p>
										  <p>{{ $educ->certfication }}</p>
								  	</div>
								 </div>
								 @endforeach
								</div>
							@endif          


							  <!-- Experience -->

							@if(empty($exp))

								<div class="panel panel-default">
								  <div class="panel-heading">
								  	<h5>Experience<span class="pull-right"><a href="{{ lurl('profile/addexpform') }}" class="btn btn-default"><i class="fa fa-edit"></i>Add</a></span></h5>
								  </div>
								  <div class="panel-body">
								  	<div class="container">
								  		<h5>No information to display</h5>
								  	</div>
								 </div>
								</div>

							  @else

								<div class="panel panel-default">
									@foreach($exps as $exp)
								  <div class="panel-heading">
								  	<h5>Experience<span class="pull-right"><a href="{{ lurl('profile/editexp/'. $exp->user_id) }}" class="btn btn-default"><i class="fa fa-edit"></i>Edit</a></span></h5>
								  </div>
								  <div class="panel-body">
								  	<div class="container">
										  <p>{{ $exp->company_name }}</p>
										  <p>{{ $exp->role }}</p>
										  <p>{{ $exp->description }}</p>
								  	</div>
								 </div>
								 @endforeach
								</div>
							@endif               


							  <!-- Portfolio -->

							@if(empty($port))

								<div class="panel panel-default">
								  <div class="panel-heading">
								  	<h5>Portfolio<span class="pull-right"><a href="{{ lurl('profile/addPortform') }}" class="btn btn-default"><i class="fa fa-edit"></i>Add</a></span></h5>
								  </div>
								  <div class="panel-body">
								  	<div class="container">
								  		<h5>No information to display</h5>
								  	</div>
								 </div>
								</div>

							  @else

								<div class="panel panel-default">
									@foreach($ports as $port)
								  <div class="panel-heading">
								  	<h5>Portfolio<span class="pull-right"><a href="{{ lurl('profile/editport/'. $port->user_id) }}" class="btn btn-default"><i class="fa fa-edit"></i>Edit</a></span></h5>
								  </div>
								  <div class="panel-body">
								  	<div class="container">
										  <p>{{ $port->name }}</p>
										  <p>{{ $port->description }}</p>
										  <p>{{ $port->link }}</p>
										  <p>{{ $port->files }}</p>
								  	</div>
								 </div>
								 @endforeach
								</div>
							@endif   

						@endif  


						@if (isset($user) and in_array($user->user_type_id, [1, 2]))    

						@if(empty($comp))

								<div class="panel panel-default">
								  <div class="panel-heading">
								  	<h5>Company Information<span class="pull-right"><a href="{{ lurl('profile/addCompform') }}" class="btn btn-default"><i class="fa fa-edit"></i>Add</a></span></h5>
								  </div>
								  <div class="panel-body">
								  	<div class="container">
								  		<h5>No information to display, please add.</h5>
								  	</div>
								 </div>
								</div>

							  @else

								<div class="panel panel-default">
									@foreach($company as $compa)
								  <div class="panel-heading">
								  	<h5>Company Information<span class="pull-right"><a href="{{ lurl('profile/editcomp/'. $comp->user_id) }}" class="btn btn-default"><i class="fa fa-edit"></i>Edit</a></span></h5>
								  </div>
								  <div class="panel-body">
								  	<div class="container">
										  <div>
										  	<span style="width: 20px;">
										  	<p>{{ $compa->company_name }}</p>
											  <p>{{ $compa->company_description }}</p>
											  <p>{{ $compa->about }}</p>
											  <p>{{ $compa->mission }}</p>
											  <p>{{ $compa->founded }}</p>
										  </span>
										  	  
										  </div>
								  	</div>
								 </div>
								 @endforeach
								</div>
							@endif   

						@endif    
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
