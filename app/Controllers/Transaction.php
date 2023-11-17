<?php

namespace App\Controllers;

class Transaction extends BaseController
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
    public function index($page)
    {
        $token = (session()->get('token'));
        if ($token == null) {
            return redirect()->to('login');
        }

        if ($page == '$1') {
            $page = 0;
        }
        $offSet = 0;
        intval($page);
        if ($page > 0) {
            $offSet = $page * 5 + 1; 
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
        $transaction = $this->clientCurl->request('GET', $_ENV['NUTECHAPI'] . '/transaction/history?offset='.$offSet.'&limit=5', [
            'headers' => [
                'Authorization' => 'Bearer ' . session()->get('token'),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]
        ])->getBody();
        // jadiin satu
        $data = [
            'profile' => json_decode($profile)->data,
            'balance' => json_decode($balance)->data,
            'transaction' => json_decode($transaction)->data->records,
            'page' => $page
        ];

        //render
        return view('transaction', $data);
    }
}
