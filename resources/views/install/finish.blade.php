@extends('install.layouts.master')

@section('title', trans('messages.cron_jobs'))

@section('content')

    <h3 class="title-3 text-success">
        <i class="icon-check"></i> Congratulations, the script has successfully been installed on the server
    </h3>

    All major configurations have been saved in the <strong class="text-bold">[APP_ROOT]/.env</strong> file. This can be changed if need be.
    <br /><br />
    Access the Admin Panel using the link:
    <a class="text-bold" href="{{ url(config('larapen.admin.route_prefix', 'admin')) }}">{{ url(config('larapen.admin.route_prefix', 'admin')) }}</a>.<br>
    Visit the main website: <a class="text-bold" href="{{ url('/') }}" target="_blank">{{ url('/') }}</a>
    <br /><br />
    If you are having problems with the website's functionality, kindly contact <a class="text-bold" href="mailto:devroot@wanekeyasam.co.ke" target="_blank">Wanekeya Sam</a> or visit <a class="text-bold" href="https://www.wanekeyasam.co.ke" target="_blank">www.wanekeyasam.co.ke</a> for more support.
    <br><br>

    Thank you for working with <a href="https://www.wanekeyasam.co.ke" target="_blank">Sam Wanekeya</a>.
    <div class="clearfix"><!-- --></div>
    <br />

@endsection

@section('after_scripts')
    <script type="text/javascript" src="{{ URL::asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
@endsection
