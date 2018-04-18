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
use App\Helpers\Arr;
use App\Models\Ad;

class AdSentByEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $ad;
    public $mailData;

    /**
     * Create a new message instance.
     *
     * @param Ad $ad
     * @param $mailData
     */
    public function __construct(Ad $ad, $mailData)
    {
        $this->ad = $ad;
        $this->mailData = (is_array($mailData)) ? Arr::toObject($mailData) : $mailData;

        $this->to($this->mailData->recipient_email, $this->mailData->recipient_email);
		$this->replyTo($this->mailData->sender_email, $this->mailData->sender_email);
        $this->subject(trans('mail.ad_sent_by_email_title', [
            'app_name' => config('settings.app_name'),
            'country_code' => $ad->country_code
        ]));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.ad.sent-by-email');
    }
}
