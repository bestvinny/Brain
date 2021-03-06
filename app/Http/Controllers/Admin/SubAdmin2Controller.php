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

use Larapen\Admin\app\Http\Controllers\PanelController;
use App\Http\Requests\Admin\SubAdmin2Request as StoreRequest;
use App\Http\Requests\Admin\SubAdmin2Request as UpdateRequest;

class SubAdmin2Controller extends PanelController
{
    public function __construct()
    {
        parent::__construct();

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->xPanel->setModel('App\Models\SubAdmin2');
        $this->xPanel->setRoute(config('larapen.admin.route_prefix', 'admin') . '/loc_admin2');
        $this->xPanel->setEntityNameStrings(__t('admin. division 2'), __t('admin. divisions 2'));
        $this->xPanel->enableAjaxTable();

        /*
        |--------------------------------------------------------------------------
        | COLUMNS AND FIELDS
        |--------------------------------------------------------------------------
        */
        // COLUMNS
        $this->xPanel->addColumn([
            'name'  => 'code',
            'label' => __t("Code"),
        ]);
        $this->xPanel->addColumn([
            'name'  => 'name',
            'label' => __t("Local Name"),
        ]);
        $this->xPanel->addColumn([
            'name'  => 'asciiname',
            'label' => __t("Name"),
        ]);
        $this->xPanel->addColumn([
            'name'          => 'active',
            'label'         => __t("Active"),
            'type'          => 'model_function',
            'function_name' => 'getActiveHtml',
        ]);

        // FIELDS
        $this->xPanel->addField([
            'name'       => 'code',
            'label'      => __t('Code'),
            'type'       => 'text',
            'attributes' => [
                'placeholder' => __t('Admin1 code (example: CA.08) (dot) Admin2 code (example: 5883638) => Example: CA.08.5883638'),
            ],
            'hint'       => __t('Please check the admin2 code format here:') . ' <a href="//download.geonames.org/export/dump/admin2Codes.txt" target="_blank">http://download.geonames.org/export/dump/admin2Codes.txt</a>',
        ]);
        $this->xPanel->addField([
            'name'       => 'name',
            'label'      => __t("Local Name"),
            'type'       => 'text',
            'attributes' => [
                'placeholder' => __t("Local Name"),
            ],
        ]);
        $this->xPanel->addField([
            'name'       => 'asciiname',
            'label'      => __t("Name"),
            'type'       => 'text',
            'attributes' => [
                'placeholder' => __t('Enter the country name (In English)'),
            ],
        ]);
        $this->xPanel->addField([
            'name'  => 'active',
            'label' => __t("Active"),
            'type'  => 'checkbox',
        ]);
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
