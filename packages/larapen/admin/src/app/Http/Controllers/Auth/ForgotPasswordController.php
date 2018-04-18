<?php
/**
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
 */

namespace Larapen\Admin\app\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Larapen\Admin\app\Http\Controllers\Controller;

class ForgotPasswordController extends Controller
{
    protected $data = []; // the information we send to the view
    protected $redirectTo = 'admin/dashboard';

    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

	/**
	 * PasswordController constructor.
	 */
    public function __construct()
    {
        $this->middleware('guest');

		$this->redirectTo = config('larapen.admin.route_prefix', 'admin') . '/dashboard';

        parent::__construct();
    }

    // -------------------------------------------------------
    // Laravel overwrites for loading admin views
    // -------------------------------------------------------

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        $this->data['title'] = trans('admin::messages.reset_password'); // set the page title

        return view('admin::auth.passwords.email', $this->data);
    }
}
