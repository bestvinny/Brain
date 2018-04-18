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

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $ad;

    /**
     * AdNotification constructor.
     * @param $ad
     * @param $adminUser
     */
    public function __construct($ad, $adminUser)
    {
        $this->ad = $ad;

        $this->to($adminUser->email, $adminUser->name);
        $this->subject(trans('mail.ad_notification_title'));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.ad.notification');
    }
}
