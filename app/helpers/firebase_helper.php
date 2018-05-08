<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('sendFirebaseNotification')) {
    function sendFirebaseNotification($data, $target)
    {
        //FCM api URL
        $url = 'https://fcm.googleapis.com/fcm/send';
        //api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
        $server_key = 'AAAAn1w9ZrA:APA91bGB_yKGt-88NOHNj9roJZrwmcO9XO9lqlppZLXchL5xDJ8rLtD8lHSorA1J_2k4NkYEsOQulmUUmizC9Beta-ilOb-BvRnYQS3X3QWXw-SwGx2s1uR467MyjWi72ki6swrb1cKy';

        $fields         = array();
        $fields['data'] = $data;
        if (is_array($target)) {
            $fields['registration_ids'] = $target;
        } else {
            $fields['to'] = $target;
        }
        //header with content_type api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $server_key,
        );

        $ch      = curl_init();
        $options = array(
            CURLOPT_URL            => $url,
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS     => json_encode($fields),
        );
        curl_setopt_array($ch, $options);

        $result = curl_exec($ch);
        if ($result === false) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }
}

if (!function_exists('assocToArr')) {
    function assocToArr($data, $field = 'fcm_id')
    {
        $target = array();
        foreach ($data as $key => $value) {
            $target[] .= $value[$field];
        }
        return $target;
    }
}

if (!function_exists('addFirebase')) {
    function addFirebase($ids, $object, $code, $title)
    {
        $target = assocToArr($ids);
        $data   = array(
            'post_id'    => 201, //200 for insert
            'for_what'   => $code, //1 for subjects
            'action'     => 1, // 1 for insert
            'post_title' => $title,
        );

        $data = $data + $object;
        return sendFirebaseNotification($data, $target);
    }
}

if (!function_exists('editFirebase')) {
    function editFirebase($ids, $object, $code, $title)
    {
        $target = assocToArr($ids);
        $data   = array(
            'post_id'    => 202, //202 for edit
            'for_what'   => $code, //1 for subjects
            'action'     => 2, // 2 for edit
            'post_title' => $title,
        );

        $data = $data + $object;
        return sendFirebaseNotification($data, $target);
    }
}

if (!function_exists('deleteFirebase')) {
    function deleteFirebase($ids, $object, $code, $title)
    {
        $target = assocToArr($ids);
        $data   = array(
            'post_id'    => 203, //203 for delete
            'for_what'   => $code, //1 for subjects
            'action'     => 3, // 3 for delete
            'post_title' => $title,
        );

        $data = $data + $object;
        return sendFirebaseNotification($data, $target);
    }
}
