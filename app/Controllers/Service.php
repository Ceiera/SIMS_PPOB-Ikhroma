<?php

namespace App\Controllers;

class Service extends BaseController
{
    public $options;
    public $clientCurl;
    function __construct()
    {
        $this->options = [
            'verify' => false
        ];
        $this->clientCurl = \Config\Services::curlrequest($this->options);
    }
    public function index($param)
    {
        $token = (session()->get('token'));
        if ($token == null) {
            return redirect()->to('login');
        }
        if ($param == null) {
            return redirect()->to('dashboard');
        }
        //get profile
        $profile = $this->clientCurl->request('GET', $_ENV['NUTECHAPI'] . '/profile', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]
        ])->getBody();

        //get balance
        $balance = $this->clientCurl->request('GET', $_ENV['NUTECHAPI'] . '/balance', [
            'headers' => [
                'Authorization' => 'Bearer ' . session()->get('token'),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]
        ])->getBody();

        //ambil data service
        $services = $this->clientCurl->request('GET', $_ENV['NUTECHAPI'] . '/services', [
            'headers' => [
                'Authorization' => 'Bearer ' . session()->get('token'),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]
        ])->getBody();
        $array = [];
        //berhubung tidak ada endpoint khusus service code, jadi pakai filter
        $cekService = json_decode($services)->data;
        //paksa param ke uppercase, sebenarnya tidak ada rulesya
        foreach ($cekService as $key) {
            if ($key->service_code == strtoupper($param)) {
                $array = [
                    'service_code' => $key->service_code,
                    'service_name' => $key->service_name,
                    'service_icon' => $key->service_icon,
                    'service_tariff' => $key->service_tariff,
                ];
            }
        }

        if ($array == null) {
            return redirect()->to('dashboard');
        }
        // jadiin satu
        $data = [
            'profile' => json_decode($profile)->data,
            'balance' => json_decode($balance)->data,
            'service' => json_decode(json_encode($array))
        ];

        //render
        return view('service', $data);
    }
    public function store($param)
    {
        try {
            $token = (session()->get('token'));
            if ($token == null) {
                return redirect()->to('login');
            }
            //cek service code
            if ($param == null) {
                return redirect()->to('dashboard');
            }
            $transaction =  $this->clientCurl->request('POST', $_ENV['NUTECHAPI'] . '/transaction', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode([
                    "service_code" => strtoupper($param),
                ])
            ])->getBody();
            $transaction = json_decode($transaction);
            if ($transaction->status == 0) {
                return redirect()->to('/service'. '/' . $param)->with('alert', $transaction->message);
            } else {
                return redirect()->to('/service'. '/' . $param)->with('alert', $transaction->message);
            }
        } catch (\Throwable $th) {
            return redirect()->to('/service'. '/' . $param)->with('alert', 'error tidak diketahui');
        }
    }
}
