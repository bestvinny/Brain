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
 * 	created	: 31 August, 2017
 *	version : 1.0
 * 	website : https://www.wanekeyasam.co.ke
 *	Email   : contact@wanekeyasam.co.ke
 */

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prologue\Alerts\Facades\Alert;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];
    
    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }
    
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        // Show HTTP exceptions
        if ($this->isHttpException($e)) {
            return $this->renderHttpException($e);
        }
        
        // Show DB exceptions
        if ($e instanceof \PDOException) {
            /*
             * DB Connection Error:
             * http://dev.mysql.com/doc/refman/5.7/en/error-messages-server.html
             */
            $dbErrorCodes = ['mysql' => ['1042', '1044', '1045', '1046', '1049'], 'standardized' => ['08S01', '42000', '28000', '3D000', '42000', '42S22'],];
            $tableErrorCodes = ['mysql' => ['1051', '1109', '1146'], 'standardized' => ['42S02'],];
            
            // Database errors
            if (in_array($e->getCode(), $dbErrorCodes['mysql']) or in_array($e->getCode(), $dbErrorCodes['standardized'])) {
                $msg = '';
                $msg .= '<html><head><title>SQL Error</title></head><body>';
                $msg .= '<pre>';
                $msg .= '<h3>SQL Error</h3>';
                $msg .= '<br>Code error: ' . $e->getCode() . '.';
                $msg .= '<br><br><blockquote>' . $e->getMessage() . '</blockquote>';
                $msg .= '</pre>';
                $msg .= '</body></html>';
                echo $msg;
                exit();
            }
            
            // Tables and fields errors
            if (in_array($e->getCode(), $tableErrorCodes['mysql']) or in_array($e->getCode(), $tableErrorCodes['standardized'])) {
                $msg = '';
                $msg .= '<html><head><title>Installation - Brain Train</title></head><body>';
                $msg .= '<pre>';
                $msg .= '<h3>There were errors during the installation process</h3>';
                $msg .= 'Some tables in the database are absent.';
                $msg .= '<br><br><blockquote>' . $e->getMessage() . '</blockquote>';
                $msg .= '<br>1/ Perform the database installation manually with the sql files:';
                $msg .= '<ul>';
                $msg .= '<li><code>/storage/database/schema.sql</code> (required)</li>';
                $msg .= '<li><code>/storage/database/data.sql</code> (required)</li>';
                $msg .= '<li><code>/storage/database/data/geonames/countries/[country_code].sql</code> (required during installation)</li>';
                $msg .= '</ul>';
                $msg .= '<br>2/ Or perform a resettlement:';
                $msg .= '<ul>';
                $msg .= '<li>Delete the installation backup file at: <code>/storage/installed</code> (required before re-installation)</li>';
                $msg .= '<li>and reload this page -or- go to install URL: <a href="' . url('install') . '">' . url('install') . '</a>.</li>';
                $msg .= '</ul>';
                $msg .= '<br>BE CAREFUL: If your site is already in production, you will lose all your data in both cases.';
                $msg .= '</body></html>';
                echo $msg;
                exit();
            }
        }
        
        // Show Token exceptions
        if ($e instanceof TokenMismatchException) {
            $message = t('Your session has expired. Please try again.');
            flash()->error($message); // front
            Alert::error($message)->flash(); // admin
            if (!str_contains(URL::previous(), 'CsrfToken')) {
                return redirect(URL::previous() . '?error=CsrfToken')->withInput();
            } else {
                return redirect(URL::previous())->withInput();
            }
        }
        
        // Show MethodNotAllowed HTTP exceptions
        if ($e instanceof MethodNotAllowedHttpException) {
            $message = "Opps! Seems you use a bad request method. Please try again.";
            flash()->error($message);
            if (!str_contains(URL::previous(), 'MethodNotAllowed')) {
                return redirect(URL::previous() . '?error=MethodNotAllowed');
            } else {
                return redirect(URL::previous())->withInput();
            }
        }
        
        // Original Code
        return parent::render($request, $e);
    }

	/**
	 * Convert an authentication exception into an unauthenticated response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Illuminate\Auth\AuthenticationException  $exception
	 * @return \Illuminate\Http\Response
	 */
	protected function unauthenticated($request, AuthenticationException $exception)
	{
		if ($request->expectsJson()) {
			return response()->json(['error' => 'Unauthenticated.'], 401);
		}

		return redirect()->guest('login');
	}
}
