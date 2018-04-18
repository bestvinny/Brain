<?php
$advertising = \App\Models\Advertising::where('slug', 'left side bar')->first();
?>
@if (!is_null($advertising))
	<div class="hidden-md hidden-sm hidden-xs">
		<div class="inner-box-content" style="width: 100%; height: 280px; text-align: center; display: inline-block; color: #bbb; font-family: 'Open Sans', sans-serif; font-weight: 700; font-size: 1.2rem; white-space: nowrap; padding: 5% 0; overflow: hidden;">
			{!! $advertising->tracking_code_large !!}
		</div>
	</div>
	<div class="hidden-lg hidden-xs">
		<div class="inner-box-content" style="width: 100%; height: 280px; text-align: center; display: inline-block; color: #bbb; font-family: 'Open Sans', sans-serif; font-weight: 700; font-size: 1.2rem; white-space: nowrap; padding: 5% 0; overflow: hidden;">
			{!! $advertising->tracking_code_medium !!}
		</div>
	</div>
	<div class="hidden-sm hidden-md hidden-lg">
		<div class="inner-box-content" style="width: 100%; height: 280px; text-align: center; display: inline-block; color: #bbb; font-family: 'Open Sans', sans-serif; font-weight: 700; font-size: 1.2rem; white-space: nowrap; padding: 5% 0; overflow: hidden;">
			{!! $advertising->tracking_code_small !!}
		</div>
	</div>
@endif