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

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class CloseController extends AccountBaseController
{
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index()
    {
		view()->share('pagePath', 'close');
        return view('account.close');
    }

	/**
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
    public function submit()
    {
        if (Request::input('close_account_confirmation') == 1) {
            // Get User
            $user = User::find($this->user->id);
            if (is_null($user)) {
                abort(404);
            }

            // Don't delete admin users
            if ($user->is_admin or $user->is_admin == 1) {
                flash()->error("Admin users can't be deleted by this way.");
                return redirect($this->lang->get('abbr') . '/account');
            }
            
            // Delete User
            $user->delete();
            
            // Close User's session
            Auth::logout();
            
            flash()->success(t("Your account has been deleted. We regret you. <a href=\":url\">Re-register</a> if that is a mistake.", [
                'url' => lurl(trans('routes.signup'))
            ]));
        }
        
        return redirect($this->lang->get('abbr') . '/');
    }
}
