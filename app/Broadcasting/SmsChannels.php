<?php

namespace App\Broadcasting;

use Illuminate\Notifications\Notification;
use Melipayamak\MelipayamakApi;
use App\Models\User;

class SmsChannels
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\User  $user
     * @return array|bool
     */
    public function join(User $user)
    {
        return true;
    }

    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSms($notifiable);
        
        
        try{
            $username = env('SMS_USERNAME');
            $password = env('SMS_PASS');
            $bodyId = env('SMS_BODY_ID');
            $api = new MelipayamakApi($username,$password);
            $sms = $api->sms('soap');
            $to = '0'.$notifiable->mobile;
            $from = env('SMS_FROM');
            $response = $sms->sendByBaseNumber([$message], $to, $bodyId);
            $json = json_decode($response);
            //echo $json->Value; //RecId or Error Number 
        }catch(Exception $e){
            
        }
    }
}
