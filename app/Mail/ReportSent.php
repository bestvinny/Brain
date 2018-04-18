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

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Helpers\Arr;
use App\Models\Ad;

class ReportSent extends Mailable
{
    use Queueable, SerializesModels;

    public $ad;
    public $report;

    /**
     * Create a new message instance.
     *
     * @param Ad $ad
     * @param $report
     * @param $recipient
     */
    public function __construct(Ad $ad, $report, $recipient)
    {
        $this->ad = $ad;
        $this->report = (is_array($report)) ? Arr::toObject($report) : $report;

		$this->to($recipient->email, $recipient->name);
		$this->replyTo($this->report->email, $this->report->email);
        $this->subject(trans('mail.ad_report_sent_title', [
            'app_name'      => config('settings.app_name'),
            'country_code'  => $ad->country_code
        ]));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.ad.report-sent');
    }
}
