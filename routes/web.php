<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Installation
|--------------------------------------------------------------------------
|
| The install process routes
|
*/
Route::group([
    'middleware' => ['web', 'installChecker'],
    'namespace'  => 'App\Http\Controllers',
], function() {
    Route::get('install', 'InstallController@starting');
    Route::get('install/site_info', 'InstallController@siteInfo');
    Route::post('install/site_info', 'InstallController@siteInfo');
    Route::get('install/system_compatibility', 'InstallController@systemCompatibility');
    Route::get('install/database', 'InstallController@database');
    Route::post('install/database', 'InstallController@database');
    Route::get('install/database_import', 'InstallController@databaseImport');
    Route::get('install/cron_jobs', 'InstallController@cronJobs');
    Route::get('install/finish', 'InstallController@finish');
});


/*
|--------------------------------------------------------------------------
| Back-end
|--------------------------------------------------------------------------
|
| The admin panel routes
|
*/
Route::group([
    'middleware' => ['admin', 'bannedUser', 'installChecker'],
    'prefix'     => config('larapen.admin.route_prefix', 'admin'),
    'namespace'  => 'App\Http\Controllers\Admin',
], function() {
    CRUD::resource('ad', 'AdController');
    CRUD::resource('category', 'CategoryController');
    CRUD::resource('picture', 'PictureController');
    CRUD::resource('item_type', 'AdTypeController');
    CRUD::resource('salary_type', 'SalaryTypeController');
    CRUD::resource('user', 'UserController');
    CRUD::resource('gender', 'GenderController');
    CRUD::resource('advertising', 'AdvertisingController');
    CRUD::resource('package', 'PackageController');
    CRUD::resource('page', 'PageController');
    CRUD::resource('payment', 'PaymentController');
    CRUD::resource('payment_method', 'PaymentMethodController');
    CRUD::resource('report_type', 'ReportTypeController');
    CRUD::resource('blacklist', 'BlacklistController');
    CRUD::resource('loc_admin1', 'SubAdmin1Controller');
    CRUD::resource('loc_admin2', 'SubAdmin2Controller');
    CRUD::resource('city', 'CityController');
    CRUD::resource('country', 'CountryController');
    CRUD::resource('currency', 'CurrencyController');
    CRUD::resource('time_zone', 'TimeZoneController');
    Route::get('account', 'UserController@account');
    Route::post('ajax/{table}/{field}', 'AjaxController@saveAjaxRequest');

    // Plugins
    Route::get('plugin', 'PluginController@index');
    Route::get('plugin/{plugin}/install', 'PluginController@install');
    Route::get('plugin/{plugin}/uninstall', 'PluginController@uninstall');
    Route::get('plugin/{plugin}/delete', 'PluginController@delete');
});


/*
|--------------------------------------------------------------------------
| Front-end
|--------------------------------------------------------------------------
|
| The not translated front-end routes
|
*/
Route::group([
    'middleware' => ['web', 'installChecker'],
    'namespace'  => 'App\Http\Controllers',
], function($router) {
    // AJAX
    Route::group(['prefix' => 'ajax'], function($router) {
        Route::get('places/countries/{code}/locations', 'Ajax\PlacesController@getLocations');
        Route::get('places/locations/{code}/sub-locations', 'Ajax\PlacesController@getSubLocations');
        Route::get('places/sub-locations/{code}/cities', 'Ajax\PlacesController@getCities');
        Route::post('autocomplete/city', 'Ajax\AutocompleteController@getCities');
        Route::post('category/sub-categories', 'Ajax\CategoryController@getSubCategories');
        Route::post('state/cities', 'Ajax\StateCitiesController@getCities');
        Route::post('save/ad', 'Ajax\AdController@saveAd');
        Route::post('save/search', 'Ajax\AdController@saveSearch');
        Route::get('json/countries.js', 'Ajax\JsonController@getCountries');
        Route::post('ad/phone', 'Ajax\AdController@getPhone');
    });

    // SEO
    Route::get('robots.txt', 'RobotsController@index');
    Route::get('sitemaps.xml', 'SitemapsController@index');

});


/*
|--------------------------------------------------------------------------
| Front-end
|--------------------------------------------------------------------------
|
| The translated front-end routes
|
*/


Route::group([
    'prefix'     => LaravelLocalization::setLocale(),
    'middleware' => ['local'],
    'namespace'  => 'App\Http\Controllers',
], function($router) {
    Route::group(['middleware' => ['web', 'installChecker']], function($router) {
        // HOMEPAGE
        Route::group(['middleware' => 'httpCache:yes'], function($router) {
            Route::get('/', 'HomeController@index');
            Route::get('candidates', 'HomeController@candidates');
            Route::get(LaravelLocalization::transRoute('routes.countries'), 'CountriesController@index');
        });


        // AUTH
        Route::auth();
        Route::group(['middleware' => ['guest']], function() {
            //Display landing page as it is being developed
            Route::get('/landing', 'LandingpageController@showLandingPage');

            // Registration Routes
            Route::get(LaravelLocalization::transRoute('routes.signup'), ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
            Route::post('signup/submit', ['as' => 'register.post', 'uses' => 'Auth\RegisterController@register']);
            Route::get('registerCompany', 'Auth\RegisterController@showCompRegForm');
            Route::post('signupcomp/submit', ['as' => 'registerComp.post', 'uses' => 'Auth\RegisterController@registerComp']);
            Route::get('signup/success', 'Auth\RegisterController@success');

            // Login Routes
            Route::get(LaravelLocalization::transRoute('routes.login'), ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
            Route::post(LaravelLocalization::transRoute('routes.login'), ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);

            // Activation
            Route::get('user/activation/{token}', 'Auth\RegisterController@activation');

            // Social Authentication
            Route::get('auth/facebook', 'Auth\SocialController@redirectToProvider');
            Route::get('auth/facebook/callback', 'Auth\SocialController@handleProviderCallback');
            Route::get('auth/google', 'Auth\SocialController@redirectToProvider');
            Route::get('auth/google/callback', 'Auth\SocialController@handleProviderCallback');
            Route::get('auth/twitter', 'Auth\SocialController@redirectToProvider');
            Route::get('auth/twitter/callback', 'Auth\SocialController@handleProviderCallback');
        });
        Route::get(LaravelLocalization::transRoute('routes.logout'), 'Auth\LoginController@logout');


        // ADS
        $router->pattern('id', '[0-9]+');
        Route::get(LaravelLocalization::transRoute('routes.create'), 'Ad\PostController@getForm');

        Route::get('create/candidates', 'Ad\PostController@candidates');

        Route::post('create/submit', 'Ad\PostController@postForm');
        Route::get('create/success', 'Ad\PostController@success');
        Route::get('create/success-payment', 'Ad\PostController@getSuccessPayment');
        Route::get('create/cancel-payment', 'Ad\PostController@cancelPayment');
        Route::get('create/activation/{token}', 'Ad\PostController@activation');
        Route::group(['middleware' => 'auth'], function($router) {
            $router->pattern('id', '[0-9]+');
            Route::get('update/{id}', ['as' => 'adUpdateHelper', 'uses' => 'Ad\UpdateController@getForm']);
            Route::post('update/{id}', ['as' => 'adUpdateSubmitHelper', 'uses' => 'Ad\UpdateController@postForm']);
            Route::get('update/{id}/success', ['as' => 'adUpdateSuccessHelper', 'uses' => 'Ad\UpdateController@success']);
            Route::get('update/{id}/success-payment', 'Ad\UpdateController@getSuccessPayment');
            Route::get('update/{id}/cancel-payment', 'Ad\UpdateController@cancelPayment');
        });
        Route::get('{title}/{id}.html', ['as' => 'adHelper', 'uses' => 'Ad\DetailsController@index']);
        Route::post('{id}/contact', ['as' => 'adContactHelper', 'uses' => 'Ad\DetailsController@sendMessage']);
        Route::post('{id}/report', ['as' => 'adReportHelper', 'uses' => 'Ad\DetailsController@sendReport']);
        Route::post('send-by-email', ['as' => 'adSendByEmailHelper', 'uses' => 'SearchController@sendByEmail']);


        // ACCOUNT
        Route::group(['middleware' => ['auth', 'bannedUser'], 'namespace' => 'Account'], function($router) {
            $router->pattern('id', '[0-9]+');

            Route::get('account', 'HomeController@index');

            //Jobseeker and student routes
            Route::get('profile', 'HomeController@profile');
            Route::get('profile/addForm', 'HomeController@addProfForm');
            Route::post('profile/details', 'HomeController@addProfile');
            Route::get('profile/editForm/{id}', 'HomeController@editForm');
            Route::put('profile/update/{id}', 'HomeController@editProfile');

            Route::get('profile/addeduform', 'HomeController@addEduForm');
            Route::post('profile/insertedu', 'HomeController@addEducation');
            Route::get('profile/editedu/{id}', 'HomeController@editEduForm');
            Route::put('profile/updateedu/{id}', 'HomeController@editEducation');

            Route::get('profile/addexpform', 'HomeController@addExpForm');
            Route::post('profile/insertexp', 'HomeController@addExperience');
            Route::get('profile/editexp/{id}', 'HomeController@editExpForm');
            Route::put('profile/updateexp/{id}', 'HomeController@editExperience');

            Route::get('profile/addPortform', 'HomeController@addPortform');
            Route::post('profile/insertport', 'HomeController@addPortfolio');
            Route::get('profile/editport/{id}', 'HomeController@editPortForm');
            Route::put('profile/updateport/{id}', 'HomeController@editPortfolio');

            Route::get('profile/addCompform', 'HomeController@addCompform');
            Route::post('profile/insertcomp', 'HomeController@addCompInfo');
            Route::get('profile/editcomp/{id}', 'HomeController@editCompForm');
            Route::put('profile/updatecomp/{id}', 'HomeController@editCompany');


            //Company profile routes
            Route::get('company/profile', 'HomeController@info');
            Route::post('company/profile/add', 'HomeController@addinfo');

            Route::post('account/details', 'EditController@details');
            Route::put('account/resume/update', 'EditController@resume');
            Route::put('account/settings/update', 'EditController@settings');
            Route::post('account/preferences', 'EditController@preferences');
            Route::post('account/education', 'EditController@education');
            Route::post('account/experience', 'EditController@experience');
            Route::post('account/portfolio', 'EditController@portfolio');
            Route::post('account/skills', 'EditController@skills');

            Route::get('account/home', 'HomeController@index');

            Route::get('account/candidates', 'HomeController@candidates');
            Route::get('account/candidate/{id}', 'HomeController@viewcandidate');
            Route::get('account/companies', 'HomeController@companies');
            Route::get('account/companies/search', 'HomeController@searchCompany');
            Route::get('account/company/{id}', 'HomeController@viewcompany');

            Route::get('account/saved-search', 'AdsController@getSavedSearch');

            $router->pattern('pagePath', '(myads|archived|favourite|pending-approval|saved-search)+');
            Route::get('account/{pagePath}', ['as' => 'adListHelper', 'uses' => 'AdsController@getPage']);
            // archived only
            Route::get('account/{pagePath}/repost/{id}', ['as' => 'adArchivedRepostHelper', 'uses' => 'AdsController@getArchivedAds']);

            // delete
            Route::get('account/{pagePath}/delete/{id}', ['as' => 'adGroupDeleteHelper', 'uses' => 'AdsController@delete']);
            Route::post('account/{pagePath}/delete', ['as' => 'adGroupDeleteSubmitHelper', 'uses' => 'AdsController@delete']);

            // close an user's account
            Route::get('account/close', 'CloseController@index');
            Route::post('account/close', 'CloseController@submit');
        });


        // Country Code Pattern
        $countries = new \App\Helpers\Localization\Helpers\Country();
        $country_code_pattern = implode('|', array_map('strtolower', array_keys($countries->all())));
        $router->pattern('countryCode', $country_code_pattern);


        // XML SITEMAPS
        Route::get('{countryCode}/sitemaps.xml', 'SitemapsController@site');
        Route::get('{countryCode}/sitemaps/pages.xml', 'SitemapsController@pages');
        Route::get('{countryCode}/sitemaps/categories.xml', 'SitemapsController@categories');
        Route::get('{countryCode}/sitemaps/cities.xml', 'SitemapsController@cities');
        Route::get('{countryCode}/sitemaps/ads.xml', 'SitemapsController@ads');


        // STATICS PAGES
        Route::group(['middleware' => 'httpCache:yes'], function($router) {
            Route::get(LaravelLocalization::transRoute('routes.page'), ['as' => 'pageHelper', 'uses' => 'PageController@index']);
            Route::get(LaravelLocalization::transRoute('routes.contact'), 'PageController@contact');
            Route::post(LaravelLocalization::transRoute('routes.contact'), 'PageController@contactPost');
            Route::get(LaravelLocalization::transRoute('routes.sitemap'), 'SitemapController@index');
        });


        // DYNAMIC URL PAGES
        $router->pattern('id', '[0-9]+');
        Route::get(LaravelLocalization::transRoute('routes.search'), ['as' => 'searchHelper', 'uses' => 'SearchController@index']);
        Route::get(LaravelLocalization::transRoute('routes.search-user'), ['as' => 'searchUserHelper', 'uses' => 'SearchController@user']);
        Route::get(LaravelLocalization::transRoute('routes.search-company'), ['as' => 'searchCompanyHelper', 'uses' => 'SearchController@company']);
        Route::get(LaravelLocalization::transRoute('routes.search-location'), ['as' => 'searchLocationHelper', 'uses' => 'SearchController@location']);
        Route::get(LaravelLocalization::transRoute('routes.search-subCat'), ['as' => 'searchSubCatHelper', 'uses' => 'SearchController@subCategory']);
        Route::get(LaravelLocalization::transRoute('routes.search-cat'), ['as' => 'searchCatHelper', 'uses' => 'SearchController@category']);
    });
});


