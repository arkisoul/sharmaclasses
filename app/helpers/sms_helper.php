<?php
defined('BASEPATH') or exit('No direct script access allowed');

# SMS URL
if (!function_exists('smsURL')) {
    function smsURL($mobile, $msg)
    {
        $username = 'edsq-satyadhi';
        $password = 'sharma12';
        $des      = $mobile;

        $message = urlencode($msg);

        $url = "http://103.16.101.52:2345/bulksms/bulksms?username=$username&password=$password&type=0&dlr=1&destination=$des&source=EDUSQR&message=$message";

        return $url;
    }
}

if (!function_exists('openURL')) {
    # cURL
    function openURL($url)
    {
        $ch = curl_init();

        //header with content_type api key
        $headers = array(
            'Content-Type:application/json',
        );

        $options = array(
            CURLOPT_URL            => $url,
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => "",
        );

        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo curl_error($ch);
            curl_close($ch);
            exit();
        }
        curl_close($ch);

        return $response;
    }
}
