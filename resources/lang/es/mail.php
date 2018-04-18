<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Emails Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the global website.
    |
    */

    // mail_footer
    'mail_footer_content'           => 'Brain Train, Kenya&#39;s Job & Career Platform',


    // ad_posted
    'ad_posted_title'               => 'Activate your ad ":title"',
    'ad_posted_content_1'           => 'Hi There, <br><br>Thank you for posting! Kindly click the button below to confirm your job posting ad:',    'ad_posted_content_2'           => 'Activate your Ad',
    'ad_posted_content_3'           => 'If the above button does not work, you can always paste the address below into your browser address bar:<br><a href=":activationLink">:activationLink</a><br><br>For validation and quality purposes your job vacancy ad will be reviewed by our editorial team before going live, This will take 2 hours or less. We will send you an email confirmation when your ad is visible for job seekers.<br><br>Thank you for using Brain Train<br><br>The <a href=":countryDomain">:domain</a> Team<br><a href=":domain">:domain</a><br><br><br><i>Please do not reply to this email. To get in touch with us, click <a href=":countryDomain/contact.html">Help & Contact</a>.',


    // ad_deleted
    'ad_deleted_title'              => 'Your job posting ad ":title" has been deleted',
    'ad_deleted_content'            => 'Hello,<br><br>Your job posting ad ":title" has been deleted from <a href=":countryDomain">:domain</a> at :now.<br><br>Thank you for using Brain Train<br><br>The <a href=":countryDomain">:domain</a> Team<br><a href=":domain">:domain</a><br><br><br><i>Please do not reply to this email. To get in touch with us, click <a href=":countryDomain/contact.html">Help & Contact</a>.</i>',


    // ad_employer_contacted
    'ad_employer_contacted_title'   => 'Your job posting ad ":title" on :app_name',
    'ad_employer_contacted_content' => '<strong>Contact Information :</strong><br>Name : :name<br>Email address : :email<br>Phone number : :phone<br><br>This email was sent to you about the job posting ad ":title" you posted on <a href=":countryDomain">:domain</a> : <a href=":urlAd">:urlAd</a><br><br><strong> NB : The person who contacted you does not know your email address as you will not reply to this email. </strong><br><br>Thank you for using Brain Train<br><br>The <a href=":countryDomain">:domain</a> Team<br><a href=":domain">:domain</a><br><br><br><i>Please do not reply to this email. To get in touch with us, click <a href=":countryDomain/contact.html">Help & Contact</a>.',


    // user_deleted
    'user_deleted_title'            => 'Your account has been deleted on :app_name',
    'user_deleted_content'          => 'Hello,<br><br>Your account has been deleted from <a href=":countryDomain">:domain</a> at :now.<br><br>Thank you for using Brain Train<br><br>The <a href=":countryDomain">:domain</a> Team<br><a href=":domain">:domain</a><br><br><br><i>Please do not reply to this email. To get in touch with us, click <a href=":countryDomain/contact.html">Help & Contact</a>.</i>',


    // user_registered
    'user_registered_title'         => 'Welcome to :app_name !',
    'user_registered_content_1'     => 'Welcome to :app_name :user_name !',
    'user_registered_content_2'     => 'Please activate your account by clicking on the button below.',
    'user_registered_content_3'     => 'Activate my account',
    'user_registered_content_4'     => 'If the above button does not work, you can always paste the address below into your browser address bar:<br><a href=":activationLink">:activationLink</a><br><br><strong>	NOTE : :app_name team recommends that you protect yourself against fraudulent and unsafe job hunting activity by reading our <a href=":countryDomain/page/anti-scam.html">ANTI-SCAM</a> guidelines. </strong> <br><br>	If you have any concerns over the legitimacy of a job ad, email or job seeker profile from :app_name, <a href=":countryDomain/contact.html">Report</a> it to us immediately, or use the "Report This Ad" button that appears on every ad.<br><br>The <a href=":countryDomain">:domain</a> Team<br><a href=":domain">:domain</a><br><br><br><i>Please do not reply to this email. To get in touch with us, click <a href=":countryDomain/contact.html">Help & Contact</a>.</i>',


    // reset_password
    'reset_password_title'          => 'Reset Your Password',
    'reset_password_content'        => 'Forgot your password? Let\'s get you a new one.',


    // contact_form
    'contact_form_title'            => 'New message from :app_name',
    'contact_form_content'          => ':app_name - New message',


    // ad_report_sent
    'ad_report_sent_title'          => 'New abuse report',
    'ad_report_sent_content'        => 'New Report Abuse - :app_name/:country_code',
    'Ad URL'                        => 'Ad URL',


    // ad archived
    'ad_archived_title'             => 'Your job posting ad ":title" has been archived',
    'ad_archived_content'           => 'Hello,<br><br>Your job posting ad ":title" has been archived from :domain at :now.<br><br>You can repost it by clicking here : :repostLink <br><br>If you do nothing your ad will be permanently deleted on :dateDel.<br><br>Thank you for using Brain Train<br><br>The Brain Train Team<br>:domain<br><br><br><i>Please do not reply to this email. To get in touch with us, click <a href=":countryDomain/contact.html">Help & Contact</a>.',


    // ad_will_be_deleted
    'ad_will_be_deleted_title'      => 'Your job posting ad ":title" will be deleted in :days days',
    'ad_will_be_deleted_content'    => '',


    // ad_sent_by_email
    'ad_sent_by_email_title'        => 'New Suggestion - :app_name/:country_code',
    'ad_sent_by_email_content'      => 'A user recommended you a job\'s link with the email address: :sender_email<br>Click below to see the details of the job offer.',
    'Job URL'                       => 'Job URL',


    // ad_notification
    'ad_notification_title'         => 'New Job Posting',
    'ad_notification_content'       => 'Yoh Admin,<br><br>The user :advertiser_name has just posted a new job.<br>The ad title: :title<br>Posted on: :now at :time<br><br>Kind Regards,<br><br>The Brain Train Team',


    // user_notification
    'user_notification_title'       => 'New User Registration',
    'user_notification_content'     => 'Yoh Admin,<br><br>:name has just registered.<br>Registered on: :now at :time<br>Email: <a href="mailto::email">:email</a><br><br>Kind Regards,<br><br>The Brain Train Team',


    // payment_sent
    'payment_sent_title'            => 'Thanks for your payment !',
    'payment_sent_content'          => 'Hello,<br><br>We have received your payment for the job posting ad ":title".<br><h1>Thank you !</h1><br>Kind Regards,<br><br>The Brain Train Team',


    // payment_notification
    'payment_notification_title'    => 'New payment has been sent',
    'payment_notification_content'  => 'Yoh Admin,<br><br>The user :advertiser_name has just paid a package for their job posting ad ":title".<br><br><strong>The Pack details</strong><br>Name: :name<br>Price: :price<br><br>Kind Regards,<br><br>The Brain Train Team',


];
