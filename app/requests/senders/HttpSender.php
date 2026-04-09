<?php

namespace app\requests\senders;

use app\dto\ConfigDTO;
use app\dto\ResponseDTO;
use app\helpers\Helpers;
use app\helpers\Logger;

class HttpSender implements ISender
{
    public static function send(ConfigDTO $config, string $jsonData): ResponseDTO|false
    {
        $curl = curl_init();
        curl_setopt_array($curl,
            [
                CURLOPT_URL => $config->url,
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($jsonData)
                ],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $jsonData,
            ]
        );
        $response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($response === false) {
            $error = curl_error($curl);
            Logger::log('/logs/error.log', 'status: ' . $status . ' : ' . $error);
            
            return false;
        }

        Logger::log(
            '/logs/response.log',
            "status: $status : " . Helpers::getFirst($response, 100)
        );

        return new ResponseDTO(
            status: $status,
            response: $response,
        );
    }
}
