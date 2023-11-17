<?php

namespace App\Controllers;

class Dashboard extends BaseController
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

        //get services
        $services = $this->clientCurl->request('GET', $_ENV['NUTECHAPI'] . '/services', [
            'headers' => [
                'Authorization' => 'Bearer ' . session()->get('token'),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ]
        ])->getBody();
        
        //get banner
        $banners = $this->clientCurl->request('GET', $_ENV['NUTECHAPI'] . '/banner', [
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
            'services' => json_decode($services)->data,
            'banners' => json_decode($banners)->data
        ];

        //render
        return view('dashboard', $data);
    }
}
