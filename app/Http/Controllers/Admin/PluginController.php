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

use Larapen\Admin\app\Http\Controllers\Controller;
use Prologue\Alerts\Facades\Alert;

class PluginController extends Controller
{
    public $data = [];

    public function __construct()
    {
        parent::__construct();

        $this->data['plugins'] = [];
    }

    public function index()
    {
        // Load all Plugins Services Provider
        $this->data['plugins'] = plugin_list();

        $this->data['title'] = 'Plugins';

        return view('admin::plugin', $this->data);
    }

    public function install($name)
    {
        // Get plugin details
        $plugin = plugin_load($name);

        // Install the plugin
        if (!empty($plugin)) {
            $res = call_user_func($plugin->class . '::install');

            // Result Notification
            if ($res) {
                Alert::success(__t('The plugin :plugin_name has been successfully installed', ['plugin_name' => $plugin->name]))->flash();
            } else {
                Alert::error(__t('Failed to install the plugin ":plugin_name"', ['plugin_name' => $plugin->name]))->flash();
            }
        }

        return redirect(config('larapen.admin.route_prefix', 'admin') . '/plugin');
    }

    public function uninstall($name)
    {
        // Get plugin details
        $plugin = plugin_load($name);

        // Uninstall the plugin
        if (!empty($plugin)) {
            $res = call_user_func($plugin->class . '::uninstall');

            // Result Notification
            if ($res) {
                Alert::success(__t('The plugin :plugin_name has been uninstalled', ['plugin_name' => $plugin->name]))->flash();
            } else {
                Alert::error(__t('Failed to Uninstall the plugin ":plugin_name"', ['plugin_name' => $plugin->name]))->flash();
            }
        }

        return redirect(config('larapen.admin.route_prefix', 'admin') . '/plugin');
    }

    public function delete($plugin)
    {
        // ...
        // Alert::success(__t('The plugin has been removed'))->flash();
        // Alert::error(__t('Failed to remove the plugin ":plugin_name"', ['plugin_name' => $plugin]))->flash();

        return redirect(config('larapen.admin.route_prefix', 'admin') . '/plugin');
    }
}
