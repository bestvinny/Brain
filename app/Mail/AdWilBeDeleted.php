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

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Ad;

class AdWilBeDeleted extends Mailable
{
    use Queueable, SerializesModels;

    public $ad;
    public $days;

    /**
     * Create a new message instance.
     *
     * @param Ad $ad
     * @param $days
     */
    public function __construct(Ad $ad, $days)
    {
        $this->ad = $ad;
        $this->days = $days;

        $this->to($ad->contact_email, $ad->contact_name);
        $this->subject(trans('mail.ad_will_be_deleted_title', [
            'title' => $ad->title,
            'days' => $days
        ]));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.ad.will-be-deleted');
    }
}
