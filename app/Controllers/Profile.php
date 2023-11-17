<?php

namespace App\Controllers;

class Profile extends BaseController
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


        // jadiin satu
        $data = [
            'profile' => json_decode($profile)->data
        ];

        //render
        return view('profile', $data);
    }

    public function edit()
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
        // jadiin satu
        $data = [
            'profile' => json_decode($profile)->data
        ];

        //render
        return view('updateprofile', $data);
    }

    public function store()
    {
        try {
            $token = (session()->get('token'));
            if ($token == null) {
                return redirect()->to('login');
            }
            $data = [
                'first_name' => $this->request->getPost('firstname'),
                'last_name' => $this->request->getPost('lastname'),
            ];

            $validation = \Config\Services::validation();
            $valid = $this->validate(
                [
                    'firstname' => [
                        'label' => 'firstname',
                        'rules' => 'required',
                        'error' => '{field} harus diisi'
                    ],

                    'lastname' => [
                        'label' => 'lastname',
                        'rules' => 'required',
                        'error' => '{field} harus diisi'
                    ]
                ]
            );

            if (!$valid) {
                $session_error = [
                    'firstname' =>  $validation->getError('firstname'),
                    'lastname' =>  $validation->getError('lastname'),
                ];
                session()->setFlashdata(['alert' => $session_error]);
                return redirect()->to('account');
            } else {
                $profile =  $this->clientCurl->request('PUT', $_ENV['NUTECHAPI'] . '/profile/update', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                    'body' => json_encode($data)
                ])->getBody();
                $profile = json_decode($profile);
                if ($profile->status == 0) {
                    return redirect()->to('/account')->with('alert', $profile->message);
                } else {
                    return redirect()->to('/account')->with('alert', $profile->message);
                }
            }
        } catch (\Throwable $th) {
            return redirect()->to('/account')->with('alert', 'error tidak diketahui');
        }
    }
}
