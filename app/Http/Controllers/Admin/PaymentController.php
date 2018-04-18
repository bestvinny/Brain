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

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use Larapen\Admin\app\Http\Controllers\PanelController;
use Larapen\Admin\app\Http\Requests\Request as StoreRequest;
use Larapen\Admin\app\Http\Requests\Request as UpdateRequest;

class PaymentController extends PanelController
{
    public function __construct()
    {
        parent::__construct();

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->xPanel->setModel('App\Models\Payment');
        $this->xPanel->setRoute(config('larapen.admin.route_prefix', 'admin') . '/payment');
        $this->xPanel->setEntityNameStrings(__t('payment'), __t('payments'));
        $this->xPanel->denyAccess(['create', 'update', 'delete']);
        $this->xPanel->orderBy('created_at', 'DESC');

        /*
        |--------------------------------------------------------------------------
        | COLUMNS AND FIELDS
        |--------------------------------------------------------------------------
        */
        // COLUMNS
        $this->xPanel->addColumn([
            'name'  => 'id',
            'label' => "ID",
        ]);
        $this->xPanel->addColumn([
            'name'  => 'created_at',
            'label' => __t("Date"),
        ]);
        $this->xPanel->addColumn([
            'name'          => 'ad_id',
            'label'         => __t("Ad"),
            'type'          => 'model_function',
            'function_name' => 'getAdTitleHtml',
        ]);
        $this->xPanel->addColumn([
            'name'          => 'package_id',
            'label'         => __t("Package"),
            'type'          => 'model_function',
            'function_name' => 'getPackNameHtml',
        ]);
        $this->xPanel->addColumn([
            'name'      => 'payment_method_id',
            'label'     => __t("Payment Method"),
            'type'          => 'model_function',
            'function_name' => 'getPaymentMethodNameHtml',
        ]);

        // FIELDS
    }

    public function store(StoreRequest $request)
    {
        return parent::storeCrud();
    }

    public function update(UpdateRequest $request)
    {
        return parent::updateCrud();
    }
}
