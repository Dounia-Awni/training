<?php

namespace App\Helper\libraries;

class notification
{

    /**
     * @param array $data
     * @param array $tokens
     * @return void
     */
    public static function pushNotification(array $data, array $tokens)
    {
        self::sendFirebasePush($tokens, $data);
    }

    /**
     * @param $tokens
     * @param $data
     * @return bool|string|void
     */
    public static function sendFirebasePush($tokens, $data)
    {
        $msg = [
            'message' => $data['message'],
            'user_id' => $data['user_id'],
            'icon' => $data['image'],
            'type' => $data['type'],
            "to_type" => $data['to_type']
        ];
        $notifyData = [
            "title" => $data['title'],
            "body" => $data['message'],
            "icon" => $data['image'],
            'type' => $data['type'],
            "to_type" => $data['to_type']
        ];
        $registrationIds = $tokens;
        if (count($tokens) > 1) {
            $fields = [
                'registration_ids' => $registrationIds,
                'notification' => $notifyData,
                'data' => $msg,
                'priority' => 'high'
            ];
        } else {
            $fields = [
                'to' => $registrationIds[0],
                'notification' => $notifyData,
                'data' => $msg,
                'priority' => 'high'
            ];
        }
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key=' . config('walaone.fcm.server_key');;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, config('walaone.fcm.url', 'https://fcm.googleapis.com/fcm/send'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
}
