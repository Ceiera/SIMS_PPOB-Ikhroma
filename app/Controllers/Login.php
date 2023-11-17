<?php

namespace App\Controllers;

class Login extends BaseController
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
        return view('login');
    }
    public function validation()
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password')
        ];
        $validation = \Config\Services::validation();
        $valid = $this->validate(
            [
                'email' =>  [
                    'label' => 'email',
                    'rules' => 'required|valid_email',
                    'error' => '{field} harus valid'
                ],
                'password' => [
                    'label' => 'password',
                    'rules' => 'required',
                    'error' => '{field} harus diisi'
                ]
            ]
        );

        if (!$valid) {
            $session_error = [
                'email' => $validation->getError('email'),
                'password' =>  $validation->getError('password'),
            ];
            session()->setFlashdata(['error' => $session_error]);
            return redirect()->to('login');
        } else {
            try {
                $response = $this->clientCurl->request('POST', $_ENV['NUTECHAPI'] . '/login', [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json'
                    ],
                    'body' => json_encode($data)
                ]);
                if ($response->getStatusCode() != 200) {
                    session()->setFlashdata([
                        'error' => [
                            'email' => 'Email atau password salah'
                        ]
                    ]);
                    return redirect()->to('login');
                } else {
                    $response = json_decode($response->getBody());
                    $token = $response->data->token;
                    session()->set(['token' => $token]);
                    return redirect()->to('dashboard');
                }
            } catch (\Throwable $th) {
                $session_error = [
                    'email' => 'Email atau password salah'
                ];  
                session()->setFlashdata(['error' => $session_error]);
                return redirect()->to('login');
            }
        }
    }
    public function logout(){
        session()->destroy();
        return redirect()->to('login');
    }
}
