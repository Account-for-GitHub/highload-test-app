<?php

namespace app\requests\senders;

use app\dto\ConfigDTO;
use app\dto\ResponseDTO;
use app\helpers\Logger;

class HttpSender implements ISender
{
    public static function send(ConfigDTO $config, string $json_data): ResponseDTO|false
    {
        $curl = curl_init();
        curl_setopt_array($curl,
            [
                CURLOPT_URL => $config->url,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($json_data)
                ],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $json_data,
            ]
        );
        $response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($response === false) {
            $error = curl_error($curl);
            Logger::log('error.log', 'status: ' . $status . ' : ' . $error);
            
            return false;
        }

        Logger::log(
            'response.log', 
            "status: $status : " . substr($response, 0, 100) . '...'
        );

        return new ResponseDTO(
            status: $status,
            responseJson: $response,
        );
    }
}
