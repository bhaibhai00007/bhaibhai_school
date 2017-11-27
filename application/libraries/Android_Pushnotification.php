<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    /**
     * Common library function goes here
     */
    class Android_Pushnotification
    {

        private $_CI;    // CodeIgniter instance

        public function __construct()
        {
            $this->_CI = & get_instance();
        }

        function sendNotification($registrationIds, $message)
        {
            define('API_ACCESS_KEY', 'AIzaSyCYVk1VAmfDETGiGJBAmKQklipo22jOAcw');
            $msg = array
                (
                'message' => $message,
                'title' => 'Android Push Notification using Google Cloud Messaging',
                'subtitle' => 'www.simplifiedcoding.net',
                'tickerText' => 'Ticker text here...Ticker text here...Ticker text here',
                'vibrate' => 1,
                'sound' => 1,
                'largeIcon' => 'large_icon',
                'smallIcon' => 'small_icon'
            );

            $fields = array
                (
                'registration_ids' => $registrationIds,
                'data' => $msg
            );

            $headers = array
                (
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json'
            );
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            
            curl_close($ch);

            $res = json_decode($result);
            $flag = $res->success;
            if ($flag >= 1)
            {
                $return = true;
            }
            else
            {
                $return = false;
            }

            return $return;
        }

    }
    