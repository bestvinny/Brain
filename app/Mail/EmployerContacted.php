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
use App\Models\Ad;
use App\Models\Message;

class EmployerContacted extends Mailable
{
    use Queueable, SerializesModels;

    public $ad;
    public $msg;
    public $pathToFile;

    /**
     * Create a new message instance.
     *
     * @param Ad $ad
     * @param Message $msg
     * @param $pathToFile
     */
    public function __construct(Ad $ad, Message $msg, $pathToFile)
    {
        $this->ad = $ad;
        $this->msg = $msg;
        $this->pathToFile = $pathToFile;

        $this->to($ad->contact_email, $ad->contact_name);
        $this->replyTo($msg->email, $msg->name);
        $this->subject(trans('mail.ad_employer_contacted_title', [
            'title' => $ad->title,
            'app_name' => config('settings.app_name')
        ]));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Attachments
        if (file_exists($this->pathToFile)) {
            return $this->view('emails.ad.employer-contacted')->attach($this->pathToFile);
        } else {
            return $this->view('emails.ad.employer-contacted');
        }
    }
}
