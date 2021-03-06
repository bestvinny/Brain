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
use App\Http\Requests\Admin\SubAdmin1Request as StoreRequest;
use App\Http\Requests\Admin\SubAdmin1Request as UpdateRequest;

class SubAdmin1Controller extends PanelController
{
    public function __construct()
    {
        parent::__construct();

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->xPanel->setModel('App\Models\SubAdmin1');
        $this->xPanel->setRoute(config('larapen.admin.route_prefix', 'admin') . '/loc_admin1');
        $this->xPanel->setEntityNameStrings(__t('admin. division 1'), __t('admin. divisions 1'));
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
                'placeholder' => __t('Country code (example: CA) (dot) Admin1 code (example: 08) => Example: CA.08'),
            ],
            'hint'       => __t('Please check the admin1 code format here:') . ' <a href="//download.geonames.org/export/dump/admin1CodesASCII.txt" target="_blank">http://download.geonames.org/export/dump/admin1CodesASCII.txt</a>',
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
