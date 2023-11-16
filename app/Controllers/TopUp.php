<?php

namespace App\Controllers;

class TopUp extends BaseController
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
    public function index()
    {
        $token = (session()->get('token'));
        if ($token == null) {
            return redirect()->to('login');
        }
        //get profile
        $profile = $this->clientCurl->request('GET', getenv('NUTECHAPI') . '/profile', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]
        ])->getBody();

        //get balance
        $balance = $this->clientCurl->request('GET', getenv('NUTECHAPI') . '/balance', [
            'headers' => [
                'Authorization' => 'Bearer ' . session()->get('token'),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]
        ])->getBody();

        //jadiin satu
        $data = [
            'profile' => json_decode($profile)->data,
            'balance' => json_decode($balance)->data,
        ];

        //render
        return view('topup', $data);
    }
    public function store()
    {
        try {
            $token = (session()->get('token'));
            if ($token == null) {
                return redirect()->to('login');
            }
            $nilai = intval($this->request->getPost('nilai'));
            if ($nilai <= 10000 && $nilai >= 1000000) {
                return redirect()->to('/topup')->with('alert', 'nominal top up tidak valid');
            }
            $topup =  $this->clientCurl->request('POST', getenv('NUTECHAPI') . '/topup', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode([
                    "top_up_amount" => $nilai
                ])
            ])->getBody();
            $topup = json_decode($topup);
            if ($topup->status == 0) {
                return redirect()->to('/topup')->with('alert', $topup->message);
            } else {
                return redirect()->to('/topup')->with('alert', $topup->message);
            }
        } catch (\Throwable $th) {
            return redirect()->to('/topup')->with('alert', 'error tidak diketahui');
        }
    }
}
