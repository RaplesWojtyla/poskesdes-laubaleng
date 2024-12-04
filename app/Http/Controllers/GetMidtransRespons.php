<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GetMidtransRespons extends Controller
{
    public function getTransactionStatus($orderId)
    {
        $serverKey = config('midtrans.serverKey');
        $client = new Client();

        try {
            $response = $client->request('GET', "https://api.sandbox.midtrans.com/v2/{$orderId}/status", [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode($serverKey . ':'),
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            return $data;

        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }
}
