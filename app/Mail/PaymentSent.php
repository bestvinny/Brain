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

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Ad;

class PaymentSent extends Mailable
{
    use Queueable, SerializesModels;

    public $payment;
    public $ad;

    /**
     * PaymentSent constructor.
     * @param Payment $payment
     * @param Ad $ad
     */
    public function __construct(Payment $payment, Ad $ad)
    {
        $this->payment = $payment;
        $this->ad = $ad;

        $this->to($ad->seller_email, $ad->seller_name);
        $this->subject(trans('mail.payment_sent_title'));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.payment.sent');
    }
}
