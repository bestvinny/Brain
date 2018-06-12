	<div class="intro jobs-intro hasOverly" >
		<div class="dtable hw100">
			<div class="dtable-cell hw100">
				<div class="container text-center">


					<div class="row search-row">
						<form id="seach" name="search" action="{{ lurl(trans('routes.v-search', ['countryCode' => $country->get('icode')])) }}"
							  method="GET">
							<div class="col-md-10 col-sm-10 search-col relative">
								<i class="icon-docs icon-append"></i>
								<input type="text" name="q" class="form-control keyword has-icon" placeholder="{{ t('Job Title, Keywords or Company Name') }}" value="">
							</div>
							
							<div class="col-md-2 col-sm-2 search-col">
								<button class="btn btn-primary btn-search btn-block"><i class="icon-search"></i> <strong>{{ t('Search') }}</strong>
								</button>
							</div>
							{!! csrf_field() !!}
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>