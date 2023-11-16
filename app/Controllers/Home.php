<?php

namespace App\Controllers;

class Home extends BaseController
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
        }else{
            return redirect()->to('dashboard');
        }
    }
}
