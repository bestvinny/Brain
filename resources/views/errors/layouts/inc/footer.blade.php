<div id="footer">
	<div class="containe">
		<div class="copy-info text-center">
			{{ t('Copyright') }} &copy; {{ date('Y') }} <a href="{{ url('/') }}" style="padding: 0;"> | {{ config('settings.app_name') }}</a> |
			<a href="{{ lurl('page/privacy-privacy.html') }}">{{ t('Privacy Policy') }}</a> | <a href="{{ lurl('page/terms-of-use.html') }}">{{ t('Terms Of Use') }}</a> |
			@if (config('settings.show_powered_by'))
				{{ t('All Rights Reserved') }}.
			@endif
		</div>
	</div>

</div>
<!-- /.footer -->