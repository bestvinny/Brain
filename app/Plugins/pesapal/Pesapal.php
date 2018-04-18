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
 * 	created	: 31 December, 2017
 *	version : 1.0
 * 	website : https://www.wanekeyasam.co.ke
 *	Email   : contact@wanekeyasam.co.ke
 */

namespace App\Plugins\pesapal;

use App\Models\Ad;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use App\Helpers\Payment;
use App\Models\Package;
use Illuminate\Support\Facades\Session;
use Omnipay\Omnipay;
use Illuminate\Support\Facades\Route;

class Pesapal extends Payment
{
    /**
     * @param Request $request
     * @param Ad $ad
     * @return bool
     */
    public static function postPayment(Request $request, Ad $ad)
    {
        // Get Pack infos
        $package = Package::find($request->input('package'));

        // Don't make a payment if 'price' = 0 or null
        if (empty($package) or $package->price <= 0) {
            return false;
        }

        $params = [
            'payment_method' => $request->get('payment_method'),
            'cancelUrl'      => url(parent::$lang->get('abbr') . '/create/cancel-payment'),
            'returnUrl'      => url(parent::$lang->get('abbr') . '/create/success-payment'),
            'name'           => $package->name,
            'description'    => $package->name,
            'amount'         => (!is_float($package->price)) ? floatval($package->price) : $package->price,
            'currency'       => $package->currency_code,
        ];

        // Set the API return URLs for update form
        if (str_contains(Route::currentRouteAction(), 'UpdateController')) {
            $params['cancelUrl'] = url(parent::$lang->get('abbr') . '/update/' . $ad->id . '/cancel-payment');
            $params['returnUrl'] = url(parent::$lang->get('abbr') . '/update/' . $ad->id . '/success-payment');
        }

        Session::put('params', array_merge($params, ['ad_id' => $ad->id, 'package_id' => $package->id]));
        Session::save();

        try {
            $gateway = Omnipay::create('PesaPal_Express');
            $gateway->setUsername(config('payment.pesapal.username'));
            $gateway->setPassword(config('payment.pesapal.password'));
            $gateway->setSignature(config('payment.pesapal.signature'));
            $gateway->setTestMode((config('payment.pesapal.mode') == 'sandbox') ? true : false);

            // Card data
            // $params['card'] = [];

            $response = $gateway->purchase($params)->send();

            // Payment by Credit Card when Card info are provide from the form.
            if ($response->isSuccessful()) {
                // Payment was successful: update database
                // print_r($response); // debug
            } elseif ($response->isRedirect()) {
                // Redirect to offsite payment gateway
                // Redirect to success URL to make the payment on the Pesapal website
                $response->redirect();
            } else {
                // Payment failed

                // Remove the entry
                parent::removeEntry($ad);

                // Return to form
                $msg = '';
                $msg .= parent::$msg['checkout']['error'];
                $msg .= '<br>' . $response->getMessage();
                flash()->error($msg);

                return false;
            }
        } catch (\Exception $e) {
            // Payment API error

            // Remove the entry
            parent::removeEntry($ad);

            Session::forget('params');

            // Return to Form
            flash()->error($e->getMessage());

            return false;
        }

        // If no errors found ...
        return true;
    }

    /**
     * @param $params
     * @param $ad
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public static function getSuccessPayment($params, $ad)
    {
        // Set form page URL
        parent::$uri['form'] = str_replace('#entryId', $ad->id, parent::$uri['form']);
        parent::$uri['success'] = str_replace('#entryId', $ad->id, parent::$uri['success']);

        // Try to make the payment
        try {
            $gateway = Omnipay::create('PesaPal_Express');
            $gateway->setUsername(config('payment.pesapal.username'));
            $gateway->setPassword(config('payment.pesapal.password'));
            $gateway->setSignature(config('payment.pesapal.signature'));
            $gateway->setTestMode((config('payment.pesapal.mode') == 'live') ? false : true);

            // Make the payment
            $response = $gateway->completePurchase($params)->send();
            $pesapal_response = $response->getData(); // this is the raw response object

            if (isset($pesapal_response['PAYMENTINFO_0_ACK']) && $pesapal_response['PAYMENTINFO_0_ACK'] === 'Success') {
                // Payment was successful: update database
                // Save the Payment in database
                $payment = parent::register($ad, $params);

                // Successful transaction
                flash()->success(parent::$msg['checkout']['success']);

                // Redirect
                return redirect(parent::$uri['success'])->with(['success' => 1, 'message' => parent::$msg['post']['success']]);
            } else {
                // Payment failed

                // Remove the entry
                parent::removeEntry($ad);

                // Return to Form
                flash()->error(parent::$msg['checkout']['error']);

                // Redirect
                return redirect(parent::$uri['form'] . '?error=payment')->withInput();
            }
        } catch (\Exception $e) {
            // Payment API error

            // Remove the entry
            parent::removeEntry($ad);

            // Return to Form
            flash()->error($e->getMessage());

            // Redirect
            return redirect(parent::$uri['form'] . '?error=paymentApi')->withInput();
        }
    }

    /**
     * @return bool
     */
    public static function installed()
    {
        $paymentMethod = PaymentMethod::active()->where('name', 'LIKE', 'pesapal')->first();
        if (empty($paymentMethod)) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public static function install()
    {
        // Remove the plugin entry
        self::uninstall();

        // Plugin data
        $data = [
            'id'           => 1,
            'name'         => 'pesapal',
            'display_name' => 'Pesapal',
            'description'  => 'Payment with Pesapal',
            'has_ccbox'    => 0,
            'lft'          => 0,
            'rgt'          => 0,
            'depth'        => 1,
            'active'       => 1,
        ];

        try {
            // Create plugin data
            $paymentMethod = PaymentMethod::create($data);
            if (empty($paymentMethod)) {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public static function uninstall()
    {
        $deletedRows = PaymentMethod::where('name', 'LIKE', 'pesapal')->delete();
        if ($deletedRows <= 0) {
            return false;
        }

        return true;
    }
}
