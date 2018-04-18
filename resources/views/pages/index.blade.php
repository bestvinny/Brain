{{--
 * Brain Train - Find the job you love!
 * Copyright (c) Brain Train Kenya. All Rights Reserved
 *
 * Website: http://www.braintrainke.com
 *
 * CODED WITH LOVE
 * ---------------
 * 	@author : Wanekeya Sam
 *  Title   : Full-stack Developer
 * 	created	: 02 September, 2017
 *	version : 1.0
 * 	website : https://www.wanekeyasam.co.ke
 *	Email   : contact@wanekeyasam.co.ke
--}}
@extends('layouts.master')

@section('search')
	@parent
    @include('pages.inc.page-intro')
@endsection

@section('content')
	<div class="main-container inner-page">
		<div class="container">
			<div class="section-content">
				<div class="row">
                    
                    @if (empty($page->picture))
                        <h1 class="text-center title-1" style="color: {!! $page->name_color !!};"><strong>{{ $page->name }}</strong></h1>
                        <hr class="center-block small text-hr" style="background-color: {!! $page->name_color !!};">
                    @endif
                    
					<div class="col-md-12 page-content">
						<div class="inner-box relative">
							<div class="row">
								<div class="col-sm-12 page-content">
                                    @if (empty($page->picture))
									    <h3 style="text-align: center; color: {!! $page->title_color !!};">{{ $page->title }}</h3>
                                    @endif
									<div class="text-content text-left from-wysiwyg">
										{!! $page->content !!}
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>

				@include('layouts.inc.social.horizontal')

			</div>
		</div>
	</div>
	<div class="panel-footer">

@endsection

@section('info')
@endsection
