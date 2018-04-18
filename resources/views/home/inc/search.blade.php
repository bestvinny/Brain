	<div class="intro jobs-intro hasOverly" >
		<div class="dtable hw100">
			<div class="dtable-cell hw100">
				<div class="container text-center">


					<h1 class="intro-title animated fadeInDown"> {{ t('Find the job you love!') }} </h1>
			<!--		<p class="sub animateme fittext3 animated fadeIn">
						{!! t('Search thousands of jobs in location, employeers and employees; get the inside scoop on companies with reviews, and more. Hiring? Post a job for free.', ['app_name' => mb_ucfirst(config('settings.app_name'))]) !!}
					</p>-->
					<div class="row search-row">
						<form id="seach" name="search" action="{{ lurl(trans('routes.v-search', ['countryCode' => $country->get('icode')])) }}"
							  method="GET">
							<div class="col-lg-5 col-sm-5 search-col relative">
								<i class="icon-docs icon-append"></i>
								<input type="text" name="q" class="form-control keyword has-icon" placeholder="{{ t('Job Title, Keywords or Company Name') }}" value="">
							</div>
							<div class="col-lg-5 col-sm-5 search-col relative locationicon">
								<i class="icon-location-2 icon-append"></i>
								<input type="hidden" id="l_search" name="l" value="">
								<input type="text" id="loc_search" name="location" class="form-control locinput input-rel searchtag-input has-icon"
									   placeholder="{{ t('City, County or Region') }}" value="">
							</div>
							<div class="col-lg-2 col-sm-2 search-col">
								<button class="btn btn-primary btn-search btn-block"><i class="icon-search"></i> <strong>{{ t('Search') }}</strong>
								</button>
							</div>
							{!! csrf_field() !!}
						</form>
					</div>

					<div class="resume-up animateme fittext3 animated fadeInDown">
						@if (!auth()->user())
						<a href="{{ lurl(trans('routes.signup')) . '?type=3' }}"><i class="fa fa-cloud-upload"></i>&nbsp;<b>{{ t('Upload Your Resume') }}</b></a> {{ t ('and easily apply for jobs from any device') }}
						@else
							@if (in_array($user->user_type_id, [1, 2]))
								<a href="{{ lurl(trans('routes.create')) }}">&nbsp;<b><i class="fa fa-briefcase"></i> {{ t('Post a Job') }}</b></a> {{ t ('and easily recruit qualified employees without the high costs') }}.
							@endif
						@endif

					</div>
				</div>
			</div>
		</div>
	</div>