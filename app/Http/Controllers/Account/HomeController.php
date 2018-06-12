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

use App\Models\User;
use App\Models\EducationLevel;
use App\Models\ReportType;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Company;
use App\Models\Occupation;
use App\Models\Portfolio;
use App\Models\Category;
use App\Models\City;
use App\Models\Resume;
use App\Models\UserType;
use Creativeorange\Gravatar\Facades\Gravatar;
use App\Models\Ad;
use App\Models\SavedAd;
use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Torann\LaravelMetaTags\Facades\MetaTag;
use App\Helpers\Localization\Helpers\Country as CountryLocalizationHelper;
use App\Helpers\Localization\Country as CountryLocalization;

class HomeController extends AccountBaseController
{
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index()
    {
        $data = [];

        $data['educations'] = EducationLevel::all();

        $data['countries'] = CountryLocalizationHelper::transAll(CountryLocalization::getCountries(), $this->lang->get('abbr'));
        $data['genders'] = Gender::where('translation_lang', $this->lang->get('abbr'))->get();
        $data['userTypes'] = UserType::all();
        $data['gravatar'] = Gravatar::fallback(url('images/user.jpg'))->get($this->user->email);

        // Mini Stats
        $data['ad_counter'] = DB::table('ads')
            ->select('user_id', DB::raw('SUM(visits) as total_visits'))
            ->where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->groupBy('user_id')
            ->first();
        $data['countAds'] = Ad::where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->count();
        $data['countFavoriteAds'] = SavedAd::whereHas('ad', function($query) {
                $query->where('country_code', $this->country->get('code'));
            })
            ->where('user_id', $this->user->id)
            ->count();
        
        $data['resume'] = Resume::where('user_id', $this->user->id)->first();

        // Meta Tags
        MetaTag::set('title', t('My account'));
        MetaTag::set('description', t('My account on :app_name', ['app_name' => config('settings.app_name')]));

        return view('account.home', $data);
    }

     

     public function candidates()
    {
        $data = [];
        // Get Cities
        $data['cities'] = City::paginate(5);
        $data['users'] = User::all();
        $data['educations'] = Education::all();
        $data['occupations'] = Occupation::paginate();
        
        // Meta Tags
        MetaTag::set('title', t('My account'));
        MetaTag::set('description', t('My account on :app_name', ['app_name' => config('settings.app_name')]));

        return view('account.candidates', $data);
    }

    public function viewcandidate($id)
    {
        $data = [];
        // Get Cities
        $data['cities'] = City::paginate(5);
        $data['educations'] = Education::all();
        $data['occupations'] = Occupation::all();

        $data['occupation'] = Occupation::find($id);
        
        // Meta Tags
        MetaTag::set('title', t('My account'));
        MetaTag::set('description', t('My account on :app_name', ['app_name' => config('settings.app_name')]));

        return view('account.viewcandidate', $data);
    }

    public function searchCandidate(){
        $compa = Company::where('company_name',$request->input('ca'))->get();
        return view('account.viewcandidate', $compa);
    }




     public function companies()
    {
        $data = [];
        // Get Cities
        $data['cities'] = City::paginate(5);
        $data['users'] = User::all();
        $data['educations'] = Education::all();
        $data['occupations'] = Occupation::paginate();
        $data['companies'] = Company::paginate();
        
        // Meta Tags
        MetaTag::set('title', t('My account'));
        MetaTag::set('description', t('My account on :app_name', ['app_name' => config('settings.app_name')]));

        return view('account.companies', $data);
    }

    public function viewcompany($id)
    {
        $data = [];

        $data['report_types'] = ReportType::all();
        $data['cities'] = City::paginate(5);
        $data['educations'] = Education::all();
        $data['occupations'] = Occupation::all();
        $data['company'] = Company::find($id);

        $data['occupation'] = Occupation::find($id);
 
        // Meta Tags
        MetaTag::set('title', t('My account'));
        MetaTag::set('description', t('My account on :app_name', ['app_name' => config('settings.app_name')]));

        return view('account.viewcompany', $data);
    }

    public function searchCompany(){

        $co = Company::where('company_name',$request->input('co'))->get();
        return view('account.viewcompany', $co);
    }

    public function profile()
    {
        $data = [];

        $data['educations'] = EducationLevel::all();

        $data['countries'] = CountryLocalizationHelper::transAll(CountryLocalization::getCountries(), $this->lang->get('abbr'));
        $data['genders'] = Gender::where('translation_lang', $this->lang->get('abbr'))->get();
        $data['userTypes'] = UserType::all();
        $data['gravatar'] = Gravatar::fallback(url('images/user.jpg'))->get($this->user->email);

        // Mini Stats
        $data['ad_counter'] = DB::table('ads')
            ->select('user_id', DB::raw('SUM(visits) as total_visits'))
            ->where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->groupBy('user_id')
            ->first();
        $data['countAds'] = Ad::where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->count();
        $data['countFavoriteAds'] = SavedAd::whereHas('ad', function($query) {
                $query->where('country_code', $this->country->get('code'));
            })
            ->where('user_id', $this->user->id)
            ->count();
        
        $data['resume'] = Resume::where('user_id', $this->user->id)->first();

        $data['profiles'] = Occupation::where('user_id', Auth::user()->id)->get();
        $data['profile'] = Occupation::where('user_id', Auth::user()->id)->first();

        $data['educs'] = Education::where('user_id', Auth::user()->id)->get();
        $data['educa'] = Education::where('user_id', Auth::user()->id)->first();
     
        $data['exps'] = Experience::where('user_id', Auth::user()->id)->get();
        $data['exp'] = Experience::where('user_id', Auth::user()->id)->first();

        $data['ports'] = Portfolio::where('user_id', Auth::user()->id)->get();
        $data['port'] = Portfolio::where('user_id', Auth::user()->id)->first();

        $data['company'] = Company::where('user_id', Auth::user()->id)->get();
        $data['comp'] = Company::where('user_id', Auth::user()->id)->first();

        // Meta Tags
        MetaTag::set('title', t('My account'));
        MetaTag::set('description', t('My account on :app_name', ['app_name' => config('settings.app_name')]));

        return view('account.profile', $data);
    }

    public function addProfForm()
    {
        $data = [];

        $data['educations'] = EducationLevel::all();

        $data['countries'] = CountryLocalizationHelper::transAll(CountryLocalization::getCountries(), $this->lang->get('abbr'));
        $data['genders'] = Gender::where('translation_lang', $this->lang->get('abbr'))->get();
        $data['userTypes'] = UserType::all();
        $data['gravatar'] = Gravatar::fallback(url('images/user.jpg'))->get($this->user->email);

        // Mini Stats
        $data['ad_counter'] = DB::table('ads')
            ->select('user_id', DB::raw('SUM(visits) as total_visits'))
            ->where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->groupBy('user_id')
            ->first();
        $data['countAds'] = Ad::where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->count();
        $data['countFavoriteAds'] = SavedAd::whereHas('ad', function($query) {
                $query->where('country_code', $this->country->get('code'));
            })
            ->where('user_id', $this->user->id)
            ->count();
        
        $data['resume'] = Resume::where('user_id', $this->user->id)->first();

         $data['profile'] = Occupation::where('user_id', Auth::user()->id)->first();

        // Meta Tags
        MetaTag::set('title', t('My account'));
        MetaTag::set('description', t('My account on :app_name', ['app_name' => config('settings.app_name')]));

        return view('account.addProf', $data);
    }

    public function addProfile(Request $request)
    {
        // Form validation
        $validator = Validator::make($request->all(), Rules::Profile($request));
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        // Store User profile
        $profileInfo = [
             'user_id'      => Auth::user()->id,
             'title'        => $request->input('title'),
             'about'        => $request->input('about'),
             'skills'       => $request->input('skills')
        ];

         // dd($profileInfo);
         $profile = new Occupation($profileInfo);
         $profile->save();

         flash()->success(t("Your Profile has been added successfully."));

        return redirect($this->lang->get('abbr') . '/profile');

    }

    public function editForm()
    {
        $data = [];

        $data['educations'] = EducationLevel::all();

        $data['countries'] = CountryLocalizationHelper::transAll(CountryLocalization::getCountries(), $this->lang->get('abbr'));
        $data['genders'] = Gender::where('translation_lang', $this->lang->get('abbr'))->get();
        $data['userTypes'] = UserType::all();
        $data['gravatar'] = Gravatar::fallback(url('images/user.jpg'))->get($this->user->email);

        // Mini Stats
        $data['ad_counter'] = DB::table('ads')
            ->select('user_id', DB::raw('SUM(visits) as total_visits'))
            ->where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->groupBy('user_id')
            ->first();
        $data['countAds'] = Ad::where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->count();
        $data['countFavoriteAds'] = SavedAd::whereHas('ad', function($query) {
                $query->where('country_code', $this->country->get('code'));
            })
            ->where('user_id', $this->user->id)
            ->count();
        
        $data['resume'] = Resume::where('user_id', $this->user->id)->first();

         $data['profile'] = Occupation::where('user_id', Auth::user()->id)->first();

        // Meta Tags
        MetaTag::set('title', t('My account'));
        MetaTag::set('description', t('My account on :app_name', ['app_name' => config('settings.app_name')]));

        return view('account.editProf', $data);
    }

     public function editProfile(Request $request)
    {
        $this->validate($request,[
            'title' => 'Required',
            'about' => 'Required'
        ]);

        // Update User profile
        $profile = Occupation::where('user_id', Auth::user()->id)->first();
        $profile->title   = $request->input('title');
        $profile->about   = $request->input('about');
        $profile->save();
        // dd($profile);

         flash()->success(t("Your Profile has been updated successfully."));

        return redirect($this->lang->get('abbr') . '/profile');
    }


    public function addEduForm()
    {
        $data = [];

        $data['educations'] = EducationLevel::all();

        $data['countries'] = CountryLocalizationHelper::transAll(CountryLocalization::getCountries(), $this->lang->get('abbr'));
        $data['genders'] = Gender::where('translation_lang', $this->lang->get('abbr'))->get();
        $data['userTypes'] = UserType::all();
        $data['gravatar'] = Gravatar::fallback(url('images/user.jpg'))->get($this->user->email);

        // Mini Stats
        $data['ad_counter'] = DB::table('ads')
            ->select('user_id', DB::raw('SUM(visits) as total_visits'))
            ->where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->groupBy('user_id')
            ->first();
        $data['countAds'] = Ad::where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->count();
        $data['countFavoriteAds'] = SavedAd::whereHas('ad', function($query) {
                $query->where('country_code', $this->country->get('code'));
            })
            ->where('user_id', $this->user->id)
            ->count();
        
        $data['resume'] = Resume::where('user_id', $this->user->id)->first();

         $data['education'] = Education::where('user_id', Auth::user()->id)->first();

        // Meta Tags
        MetaTag::set('title', t('My account'));
        MetaTag::set('description', t('My account on :app_name', ['app_name' => config('settings.app_name')]));

        return view('account.addEdu', $data);
    }

    public function addEducation(Request $request)
    {
        $this->validate($request,[
            'education_level' => 'Required',
            'institution' => 'Required',
            'course' => 'Required',
            'qualification' => 'Required'
        ]);

         // Ad data
        $educationInfo = [
            'user_id'      => Auth::user()->id,
            'education_level'     => $request->input('education_level'),
            'institution'         => $request->input('institution'),
            'course'              => $request->input('course'),
            'qualification'       => $request->input('qualification'),
            'certification'       => $request->input('certification')
        ];

        // Save Ad to database
        $education = new Education($educationInfo);
        $education->save();

        flash()->success(t("Your Education has been added successfully."));

        return redirect($this->lang->get('abbr') . '/profile');

    }

    public function editEduForm()
    {
        $data = [];

        $data['educations'] = EducationLevel::all();

        $data['countries'] = CountryLocalizationHelper::transAll(CountryLocalization::getCountries(), $this->lang->get('abbr'));
        $data['genders'] = Gender::where('translation_lang', $this->lang->get('abbr'))->get();
        $data['userTypes'] = UserType::all();
        $data['gravatar'] = Gravatar::fallback(url('images/user.jpg'))->get($this->user->email);

        // Mini Stats
        $data['ad_counter'] = DB::table('ads')
            ->select('user_id', DB::raw('SUM(visits) as total_visits'))
            ->where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->groupBy('user_id')
            ->first();
        $data['countAds'] = Ad::where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->count();
        $data['countFavoriteAds'] = SavedAd::whereHas('ad', function($query) {
                $query->where('country_code', $this->country->get('code'));
            })
            ->where('user_id', $this->user->id)
            ->count();
        
        $data['resume'] = Resume::where('user_id', $this->user->id)->first();

         $data['educ'] = Education::where('user_id', Auth::user()->id)->first();

        // Meta Tags
        MetaTag::set('title', t('My account'));
        MetaTag::set('description', t('My account on :app_name', ['app_name' => config('settings.app_name')]));

        return view('account.editEdu', $data);
    }


     public function editEducation(Request $request)
    {
         $this->validate($request,[
            'education_level' => 'Required',
            'institution' => 'Required',
            'course' => 'Required',
            'qualification' => 'Required'
        ]);

        // Update User profile
        $education = Education::where('user_id', Auth::user()->id)->first();
        $education->education_level   = $request->input('education_level');
        $education->institution   = $request->input('institution');
        $education->course   = $request->input('course');
        $education->qualification   = $request->input('qualification');
        $education->save();
        // dd($profile);

         flash()->success(t("Your Education has been updated successfully."));

        return redirect($this->lang->get('abbr') . '/profile');

    }


     public function addExpForm()
    {
        $data = [];

        $data['educations'] = EducationLevel::all();

        $data['countries'] = CountryLocalizationHelper::transAll(CountryLocalization::getCountries(), $this->lang->get('abbr'));
        $data['genders'] = Gender::where('translation_lang', $this->lang->get('abbr'))->get();
        $data['userTypes'] = UserType::all();
        $data['gravatar'] = Gravatar::fallback(url('images/user.jpg'))->get($this->user->email);

        // Mini Stats
        $data['ad_counter'] = DB::table('ads')
            ->select('user_id', DB::raw('SUM(visits) as total_visits'))
            ->where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->groupBy('user_id')
            ->first();
        $data['countAds'] = Ad::where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->count();
        $data['countFavoriteAds'] = SavedAd::whereHas('ad', function($query) {
                $query->where('country_code', $this->country->get('code'));
            })
            ->where('user_id', $this->user->id)
            ->count();
        
        $data['resume'] = Resume::where('user_id', $this->user->id)->first();

         $data['education'] = Experience::where('user_id', Auth::user()->id)->first();

        // Meta Tags
        MetaTag::set('title', t('My account'));
        MetaTag::set('description', t('My account on :app_name', ['app_name' => config('settings.app_name')]));

        return view('account.addExp', $data);
    }



    public function addExperience(Request $request)
    {
        $this->validate($request,[
            'company_name' => 'Required',
            'role' => 'Required',
            'description' => 'Required',
        ]);

         // Ad data
        $experienceInfo = [
            'user_id'          => Auth::user()->id,
            'company_name'     => $request->input('company_name'),
            'role'             => $request->input('role'),
            'description'      => $request->input('description'),
        ];

        // Save Ad to database
        $experience = new Experience($experienceInfo);
        $experience->save();

        flash()->success(t("Your Experience has been added successfully."));

        return redirect($this->lang->get('abbr') . '/profile');
    }



     public function editExpForm()
    {
        $data = [];

        $data['educations'] = EducationLevel::all();

        $data['countries'] = CountryLocalizationHelper::transAll(CountryLocalization::getCountries(), $this->lang->get('abbr'));
        $data['genders'] = Gender::where('translation_lang', $this->lang->get('abbr'))->get();
        $data['userTypes'] = UserType::all();
        $data['gravatar'] = Gravatar::fallback(url('images/user.jpg'))->get($this->user->email);

        // Mini Stats
        $data['ad_counter'] = DB::table('ads')
            ->select('user_id', DB::raw('SUM(visits) as total_visits'))
            ->where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->groupBy('user_id')
            ->first();
        $data['countAds'] = Ad::where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->count();
        $data['countFavoriteAds'] = SavedAd::whereHas('ad', function($query) {
                $query->where('country_code', $this->country->get('code'));
            })
            ->where('user_id', $this->user->id)
            ->count();
        
        $data['resume'] = Resume::where('user_id', $this->user->id)->first();

         $data['exp'] = Experience::where('user_id', Auth::user()->id)->first();

        // Meta Tags
        MetaTag::set('title', t('My account'));
        MetaTag::set('description', t('My account on :app_name', ['app_name' => config('settings.app_name')]));

        return view('account.editExp', $data);
    }

     public function editExperience(Request $request)
    {
        $this->validate($request,[
            'company_name' => 'Required',
            'role' => 'Required',
            'description' => 'Required',
        ]);

        // Update User profile
        $exp = Experience::where('user_id', Auth::user()->id)->first();
        $exp->company_name   = $request->input('company_name');
        $exp->role   = $request->input('role');
        $exp->description   = $request->input('description');
        $exp->save();
        // dd($profile);

         flash()->success(t("Your Experience has been updated successfully."));

        return redirect($this->lang->get('abbr') . '/profile');
    }



     public function addPortForm()
    {
        $data = [];

        $data['educations'] = EducationLevel::all();

        $data['countries'] = CountryLocalizationHelper::transAll(CountryLocalization::getCountries(), $this->lang->get('abbr'));
        $data['genders'] = Gender::where('translation_lang', $this->lang->get('abbr'))->get();
        $data['userTypes'] = UserType::all();
        $data['gravatar'] = Gravatar::fallback(url('images/user.jpg'))->get($this->user->email);

        // Mini Stats
        $data['ad_counter'] = DB::table('ads')
            ->select('user_id', DB::raw('SUM(visits) as total_visits'))
            ->where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->groupBy('user_id')
            ->first();
        $data['countAds'] = Ad::where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->count();
        $data['countFavoriteAds'] = SavedAd::whereHas('ad', function($query) {
                $query->where('country_code', $this->country->get('code'));
            })
            ->where('user_id', $this->user->id)
            ->count();
        
        $data['resume'] = Resume::where('user_id', $this->user->id)->first();

         $data['portfolio'] = Portfolio::where('user_id', Auth::user()->id)->first();

        // Meta Tags
        MetaTag::set('title', t('My account'));
        MetaTag::set('description', t('My account on :app_name', ['app_name' => config('settings.app_name')]));

        return view('account.addPort', $data);
    }

    public function addPortfolio(Request $request)
    {
        $this->validate($request,[
            'name' => 'Required',
            'description' => 'Required',
        ]);

         // Ad data
        $portfolioInfo = [
            'user_id'          => Auth::user()->id,
            'name'             => $request->input('name'),
            'description'      => $request->input('description'),
            'link'             => $request->input('role'),
            'files'            => $request->input('files'),
        ];

        // Save Ad to database
        $portfolio = new Portfolio($portfolioInfo);
        $portfolio->save();

        flash()->success(t("Your Portfolio has been added successfully."));

        return redirect($this->lang->get('abbr') . '/profile');
    }


    public function editPortForm()
    {
        $data = [];

        $data['educations'] = EducationLevel::all();

        $data['countries'] = CountryLocalizationHelper::transAll(CountryLocalization::getCountries(), $this->lang->get('abbr'));
        $data['genders'] = Gender::where('translation_lang', $this->lang->get('abbr'))->get();
        $data['userTypes'] = UserType::all();
        $data['gravatar'] = Gravatar::fallback(url('images/user.jpg'))->get($this->user->email);

        // Mini Stats
        $data['ad_counter'] = DB::table('ads')
            ->select('user_id', DB::raw('SUM(visits) as total_visits'))
            ->where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->groupBy('user_id')
            ->first();
        $data['countAds'] = Ad::where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->count();
        $data['countFavoriteAds'] = SavedAd::whereHas('ad', function($query) {
                $query->where('country_code', $this->country->get('code'));
            })
            ->where('user_id', $this->user->id)
            ->count();
        
        $data['resume'] = Resume::where('user_id', $this->user->id)->first();

         $data['port'] = Portfolio::where('user_id', Auth::user()->id)->first();

        // Meta Tags
        MetaTag::set('title', t('My account'));
        MetaTag::set('description', t('My account on :app_name', ['app_name' => config('settings.app_name')]));

        return view('account.editPort', $data);
    }

     public function editPortfolio(Request $request)
    {
        $this->validate($request,[
            'company_name' => 'Required',
            'role' => 'Required',
            'description' => 'Required',
        ]);

        // Update User profile
        $exp = Experience::where('user_id', Auth::user()->id)->first();
        $exp->company_name   = $request->input('company_name');
        $exp->role   = $request->input('role');
        $exp->description   = $request->input('description');
        $exp->save();
        // dd($profile);

         flash()->success(t("Your Experience has been updated successfully."));

        return redirect($this->lang->get('abbr') . '/profile');
    }

     public function addCompform()
    {
        $data = [];

        $data['educations'] = EducationLevel::all();
        $data['categories'] = Category::all();

        $data['countries'] = CountryLocalizationHelper::transAll(CountryLocalization::getCountries(), $this->lang->get('abbr'));
        $data['genders'] = Gender::where('translation_lang', $this->lang->get('abbr'))->get();
        $data['userTypes'] = UserType::all();
        $data['gravatar'] = Gravatar::fallback(url('images/user.jpg'))->get($this->user->email);

        // Mini Stats
        $data['ad_counter'] = DB::table('ads')
            ->select('user_id', DB::raw('SUM(visits) as total_visits'))
            ->where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->groupBy('user_id')
            ->first();
        $data['countAds'] = Ad::where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->count();
        $data['countFavoriteAds'] = SavedAd::whereHas('ad', function($query) {
                $query->where('country_code', $this->country->get('code'));
            })
            ->where('user_id', $this->user->id)
            ->count();
        
        $data['resume'] = Resume::where('user_id', $this->user->id)->first();

         $data['company'] = Company::where('user_id', Auth::user()->id)->first();

        // Meta Tags
        MetaTag::set('title', t('My account'));
        MetaTag::set('description', t('My account on :app_name', ['app_name' => config('settings.app_name')]));

        return view('account.addCompInfo', $data);
    }



    //add company info to db
    public function addCompInfo(Request $request)
    {
        $this->validate($request,[
            'size' => 'Required',
            'about' => 'Required',
            'mission' => 'Required',
            'more_info' => 'Required'
        ]);

         // Ad data
        $companyInfo = [
            'size'                   => $request->input('size'),
            'about'                  => $request->input('about'),
            'mission'                => $request->input('mission'),
            'more_info'              => $request->input('more_info'),
            'business_type'          => $request->input('business_type'),
        ];

        //Save Ad to database
        $company = new Company($companyInfo);
        $company->save();

        flash()->success(t("Your Company information has been updated successfully."));

        return redirect('company/profile');

    }

     public function editCompForm()
    {
        $data = [];

        $data['educations'] = EducationLevel::all();
        $data['categories'] = Category::all();

        $data['countries'] = CountryLocalizationHelper::transAll(CountryLocalization::getCountries(), $this->lang->get('abbr'));
        $data['genders'] = Gender::where('translation_lang', $this->lang->get('abbr'))->get();
        $data['userTypes'] = UserType::all();
        $data['gravatar'] = Gravatar::fallback(url('images/user.jpg'))->get($this->user->email);

        // Mini Stats
        $data['ad_counter'] = DB::table('ads')
            ->select('user_id', DB::raw('SUM(visits) as total_visits'))
            ->where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->groupBy('user_id')
            ->first();
        $data['countAds'] = Ad::where('country_code', $this->country->get('code'))
            ->where('user_id', $this->user->id)
            ->count();
        $data['countFavoriteAds'] = SavedAd::whereHas('ad', function($query) {
                $query->where('country_code', $this->country->get('code'));
            })
            ->where('user_id', $this->user->id)
            ->count();
        
        $data['resume'] = Resume::where('user_id', $this->user->id)->first();

         $data['comp'] = Company::where('user_id', Auth::user()->id)->first();

        // Meta Tags
        MetaTag::set('title', t('My account'));
        MetaTag::set('description', t('My account on :app_name', ['app_name' => config('settings.app_name')]));

        return view('account.editCompInfo', $data);
    }


     public function editCompany(Request $request)
    {
       $this->validate($request,[
            'business_type' => 'Required',
            'size' => 'Required',
            'about' => 'Required',
            'mission' => 'Required',
            'more_info' => 'Required'
        ]);

        // Update User profile
        $comp = Company::where('user_id', Auth::user()->id)->first();
        $comp->business_type   = $request->input('business_type');
        $comp->size   = $request->input('size');
        $comp->about   = $request->input('about');
        $comp->mission   = $request->input('mission');
        $comp->more_info   = $request->input('more_info');
        $comp->save();
        // dd($profile);

         flash()->success(t("Your Company information has been updated successfully."));

        return redirect($this->lang->get('abbr') . '/profile');
    }

   

}
