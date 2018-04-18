<!DOCTYPE html>
<html>
<head>
	<title>Braintrain Sign Up</title>
</head>
<body>

	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<script src="https://use.fontawesome.com/1dec14be15.js"></script>
    <div class="container-fluid stylish-form">
      <h2 class="text-center">CREATE YOUR ACCOUNT, IT'S 100% FREE</h2>
      <div class="row mar20" >
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="inner-section">


            <form method="POST" action="https://google.co.in">
              <div class="mar20 inside-form">
                <div class="row">
              	<div class="col-md-2 col-md-offset-3">
              		<header role="banner">
						<nav id="navbar-primary" class="navbar" role="navigation">
						  <div class="container-fluid">
						    <div class="collapse navbar-collapse" id="navbar-primary-collapse">
						      <ul class="nav navbar-nav">
						        <li><a href="#"><img id="logo-navbar-middle" src="{{ url('/images/logo.png') }}" width="200" alt="Logo Thing main logo"></a></li>
						      </ul>
						    </div><!-- /.navbar-collapse -->
						  </div><!-- /.container-fluid -->
						</nav>
				</header><!-- header role="banner" -->
              	</div>
              </div>


                <h2 class="font_black text-center">SIGN UP</h2>

                <div class="row">
                	
				    <div class="input-group col-md-6 col-md-offset-4">
				    	<label class="radio-inline">
					      <input type="radio" name="optradio">Employer
					    </label>
					    <label class="radio-inline">
					      <input type="radio" name="optradio">Job Seeker
					    </label>
					    <label class="radio-inline">
					      <input type="radio" name="optradio">Student 
					    </label>
				    </div>

                </div>

                <br>

                <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Address 2</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
  </div>


  <div class="col-md-8 page-content">
					<div class="inner-box category-content">
						<h2 class="title-2"><strong> <i class="icon-user-add"></i> {{ t('Create your account, Its free') }}</strong></h2>
						<div class="row">
							@if (config('settings.activation_social_login'))
								<div class="text-center" style="margin-bottom: 30px;">
									<div class="row row-centered">
										<div class="btn btn-lg btn-fb  col-centered" style="margin-right: 4px;">
											<a href="{{ lurl('auth/facebook') }}" class="btn-fb"><i class="icon-facebook"></i> {!! t('Connect with Facebook') !!}</a>
										</div>
										<div class="btn btn-lg btn-danger  col-centered" style="margin-left: 4px;">
											<a href="{{ lurl('auth/google') }}" class="btn-danger"><i class="icon-googleplus-rect"></i> {!! t('Connect with Google+') !!}</a>
										</div>
									</div>

									<div class="row row-centered loginOr">
										<div class="col-xs-12 col-sm-12">
											<hr class="hrOr">
											<span class="spanOr rounded">{{ t('or') }}</span>
										</div>
									</div>
								</div>
							@endif
							<div class="col-sm-12">
								<form id="signup_form" class="form-horizontal" method="POST" action="{{ lurl('signup/submit') }}" enctype="multipart/form-data">
									{!! csrf_field() !!}
									<fieldset>
										<?php
										/*
										<!-- Gender -->
										<div class="form-group required <?php echo (isset($errors) and $errors->has('gender')) ? 'has-error' : ''; ?>">
											<label class="col-md-4 control-label">{{ t('Gender') }} <sup>*</sup></label>
											<div class="col-md-6">
												<select name="gender" id="gender" class="form-control selecter">
													<option value="0"
															@if(old('gender')=='' or old('gender')==0)selected="selected"@endif> {{ t('Select') }} </option>
													@foreach ($genders as $gender)
														<option value="{{ $gender->tid }}" @if(old('gender')==$gender->tid)selected="selected"@endif>
															{{ $gender->name }}
														</option>
													@endforeach
												</select>
											</div>
										</div>
										*/
										?>

										<!-- Name -->
										<div class="form-group required <?php echo (isset($errors) and $errors->has('name')) ? 'has-error' : ''; ?>">
											<label class="col-md-4 control-label">{{ t('Name') }} <sup>*</sup></label>
											<div class="col-md-6">
												<input name="name" placeholder="{{ t('Name') }}" class="form-control input-md" type="text"
													   value="{{ old('name') }}">
											</div>
										</div>

										<!-- User Type -->
										<div class="form-group required <?php echo (isset($errors) and $errors->has('user_type')) ? 'has-error' : ''; ?>">
											<label class="col-md-4 control-label">{{ t('You are a') }} <sup>*</sup></label>
											<div class="col-md-6">
												@foreach ($userTypes as $type)
													<label class="radio-inline" for="user_type-{{ $type->id }}">
														<input type="radio" name="user_type" id="user_type-{{ $type->id }}" class="user_type"
															   value="{{ $type->id }}" {{ (old('user_type', \Illuminate\Support\Facades\Input::get('type'))==$type->id) ? 'checked="checked"' : '' }}>
														{{ t('' . $type->name) }}
													</label>
												@endforeach
											</div>
										</div>

										<!-- Country -->
										@if (!$ip_country)
											<div class="form-group required <?php echo (isset($errors) and $errors->has('country')) ? 'has-error' : ''; ?>">
												<label class="col-md-4 control-label" for="country">{{ t('Your Country') }} <sup>*</sup></label>
												<div class="col-md-6">
													<select id="country" name="country" class="form-control sselecter">
														<option value="0" {{ (!old('country') or old('country')==0) ? 'selected="selected"' : '' }}>{{ t('Select') }}</option>
														@foreach ($countries as $code => $item)
															<option value="{{ $code }}" {{ (old('country', (!$country->isEmpty()) ? $country->get('code') : 0)==$code) ? 'selected="selected"' : '' }}>
																{{ $item->get('name') }}
															</option>
														@endforeach
													</select>
												</div>
											</div>
										@else
											<input id="country" name="country" type="hidden" value="{{ $country->get('code') }}">
										@endif

										<!-- Phone Number -->
										<div class="form-group required <?php echo (isset($errors) and $errors->has('phone')) ? 'has-error' : ''; ?>">
											<label class="col-md-4 control-label">{{ t('Phone') }} <sup>*</sup></label>
											<div class="col-md-6">
												<div class="input-group"><span id="phone_country" class="input-group-addon"><i class="icon-mail"></i></span>
													<input name="phone" placeholder="{{ t('Phone Number') }}" class="form-control input-md"
														   type="text" value="{{ old('phone') }}">
												</div>
											</div>
										</div>

										<div class="form-group required <?php echo (isset($errors) and $errors->has('email')) ? 'has-error' : ''; ?>">
											<label class="col-md-4 control-label" for="email">{{ t('Email') }} <sup>*</sup></label>
											<div class="col-md-6">
												<div class="input-group">
													<span class="input-group-addon"><i class="icon-mail"></i></span>
													<input id="email" name="email" type="email" class="form-control" placeholder="{{ t('Email') }}"
														   value="{{ old('email') }}">
												</div>
											</div>
										</div>

										<div class="form-group required <?php echo (isset($errors) and $errors->has('password')) ? 'has-error' : ''; ?>">
											<label class="col-md-4 control-label" for="password">{{ t('Password') }} <sup>*</sup></label>
											<div class="col-md-6">
												<input id="password" name="password" type="password" class="form-control"
													   placeholder="{{ t('Password') }}">
												<br>
												<input id="password_confirmation" name="password_confirmation" type="password" class="form-control"
													   placeholder="{{ t('Password Confirmation') }}">
												<p class="help-block">{{ t('At least 5 characters') }}</p>
											</div>
										</div>

										<!-- Resume -->
										<div id="resumeBloc" class="form-group required <?php echo ($errors->has('filename')) ? 'has-error' : ''; ?>">
											<label class="col-md-4 control-label" for="filename"> {{ t('Your resume') }} </label>
											<div class="col-md-6">
												<div class="mb10">
													<input id="filename" name="filename" type="file" class="file">
												</div>
												<p class="help-block">{{ t('File types: :file_types', ['file_types' => showValidFileTypes('file')]) }}</p>
											</div>
										</div>

										<!-- Parent/Guardian Name -->
										<div id="parentBloc" class="form-group required <?php echo (isset($errors) and $errors->has('name')) ? 'has-error' : ''; ?>">
											<label class="col-md-4 control-label">{{ t('Parent/Guardian Name') }} <sup>*</sup></label>
											<div class="col-md-6">
												<input name="name" placeholder="{{ t('Name') }}" class="form-control input-md" type="text"
													   value="{{ old('name') }}">
											</div>

											<label class="col-md-4 control-label">{{ t('Email') }} <sup>*</sup></label>
											<div class="col-md-6">
												<input name="email" placeholder="{{ t('Email') }}" class="form-control input-md" type="text"
													   value="{{ old('email') }}">
											</div>
										</div>

										@if (config('settings.activation_recaptcha'))
											<div class="form-group required <?php echo (isset($errors) and $errors->has('g-recaptcha-response')) ? 'has-error' : ''; ?>">
												<label class="col-md-4 control-label" for="g-recaptcha-response"></label>
												<div class="col-md-6">
													{!! Recaptcha::render(['lang' => $lang->get('abbr')]) !!}
												</div>
											</div>
										@endif

										<div class="form-group required <?php echo (isset($errors) and $errors->has('term')) ? 'has-error' : ''; ?>"
											 style="margin-top: -10px;">
											<label class="col-md-4 control-label"></label>
											<div class="col-md-8">
												<div class="termbox mb10">
													<label class="checkbox-inline" for="term">
														<input name="term" id="term" value="1" type="checkbox" {{ (old('term')=='1') ? 'checked="checked"' : '' }}>
														{!! t('I have read and agree to the <a href=":url"><strong>Terms & Conditions</strong></a>', ['url' => getUrlPageByType('terms')]) !!}
													</label>
												</div>
												<div style="clear:both"></div>
											</div>
										</div>

										<!-- Button  -->
										<div class="form-group">
											<label class="col-md-4 control-label"></label>
											<div class="col-md-8">
												<button id="signup_btn" class="btn btn-primary btn-lg"> {{ t('Register') }} </button>
											</div>
										</div>

										<div style="margin-bottom: 30px;"></div>

									</fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>                
               

                <div class="footer text-center">
                  <a href="http://vijender.in/" class="btn btn-neutral btn-round btn-lg">Create Account</a>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
      <h2 class="text-center font_white">Thank You For Visiting Braintrain</h2>
    </div>

    <style type="text/css">
    	.stylish-form 
    {
      background-image:url('https://lut.im/cOs9CbKe42/DT8DT06CeJkRsyWC.jpg'); 
      padding:10px;
    }
    .stylish-form h2 {
      color:#f96332;
      margin-top:50px;
      
    }
    .font_black {
      color:black !important;
    }
    .mar20 
    {
      margin:20px;
    }
    .inner-section {
      background-color:white;
      width:750px;
      display:block;
      margin:0 auto;
    }
    .inside-form{
      border-radius:8px;
      padding-top:30px;
      padding-bottom:30px;
    }
    .inside-form h2 {
      font-weight:700;
    }
    .inside-form ul {
      list-style-type:none;
      text-align:center;
      margin-top:30px;
    }
    .inside-form ul >li {
      display:inline-block;
    }
    .inside-form ul >li > i {
      margin-top:18px;
    }
    .icon-holder {
      background: #fff;
      border-radius: 50%;
      vertical-align: middle;
      height: 50px;
      width: 50px;
      text-align: center;
      margin-right: 20px;
    }

    .dsp-flex {
      display: -webkit-box; /* OLD - iOS 6-, Safari 3.1-6 */
      display: -moz-box; /* OLD - Firefox 19- (buggy but mostly works) */
      display: -ms-flexbox; /* TWEENER - IE 10 */
      display: -webkit-flex; /* NEW - Chrome */
      display: flex; /* NEW, Spec - Opera 12.1, Firefox 20+ */
      align-items: center;
      -webkit-align-items: center;
      justify-content: center
    }
    .input-group, .form-group {
      margin-bottom: 10px;
    }
    .input-group-addon {
      background-color: rgba(255, 255, 255, 0.1);
      border: none;
      color: #black;
      border-radius:25px;
    }
    .form-control,.form-control:focus,.form-control:hover
    {
      background-color: rgba(255, 255, 255, 0.1);
      color: black;
      border-radius:25px;
      border:none;
      font-size:14px;
    }
    ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
      color: black !important;
    }
    ::-moz-placeholder { /* Firefox 19+ */
      color: #fff !important;
    }
    :-ms-input-placeholder { /* IE 10+ */
      color: black !important;
    }
    :-moz-placeholder { /* Firefox 18- */
      color: #grey !important;
    }
    .footer {
      margin-top:40px;
      margin-bottom:40px;
    }
    input::placeholder {
      color: black !important;
    }
    .btn-lg {
      font-size: 1em;
      border-radius: 0.25rem;
      padding: 15px 48px;
    }
    .btn-round {
      border-width: 1px;
      border-radius: 30px !important;
      padding: 11px 23px;
    }
    .btn-neutral,.btn-neutral:focus,.btn-neutral:hover {
      background-color: #001b4d;
      color: #white;
    }
    </style>

</body>
</html>