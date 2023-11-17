<?php

namespace App\Controllers;

class Register extends BaseController
{
    public $session;
    public $options;
    public $clientCurl;
    function __construct()
    {
        $this->options = [
            'verify' => false
        ];
        $this->clientCurl = \Config\Services::curlrequest($this->options);
        $this->session = session();
    }
    public function index()
    {
        $token = (session()->get('token'));
        if ($token != null) {
            return redirect()->to('dashboard');
        }
        return view('register');
    }

    public function store()
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'first_name' => $this->request->getPost('firstname'),
            'last_name' => $this->request->getPost('lastname'),
            'password' => $this->request->getPost('password'),
        ];

        $validation = \Config\Services::validation();
        $valid = $this->validate(
            [
                'email' =>  [
                    'label' => 'email',
                    'rules' => 'required|valid_email',
                    'error' => '{field} harus valid'
                ],
                'firstname' => [
                    'label' => 'firstname',
                    'rules' => 'required',
                    'error' => '{field} harus diisi'
                ],
                'lastname' => [
                    'label' => 'lastname',
                    'rules' => 'required',
                    'error' => '{field} harus diisi'
                ],
                'password' => [
                    'label' => 'password',
                    'rules' => 'required|min_length[8]',
                    'error' => '{field} harus diisi|{field} harus min 8 char'
                ],
                're-password' => [
                    'label' => 're-password',
                    'rules' => 'required|matches[password]',
                    'error' => '{field} harus diisi'
                ]
            ]
        );

        if (!$valid) {
            $session_error = [
                'email' => $validation->getError('email'),
                'firstname' =>  $validation->getError('firstname'),
                'lastname' =>  $validation->getError('lastname'),
                'password' =>  $validation->getError('password'),
                're-password' =>  $validation->getError('re-password'),
            ];
            session()->setFlashdata(['error' => $session_error]);
            return redirect()->to('register');
        }
        else{
            try {
                $response = $this->clientCurl->request('POST', $_ENV['NUTECHAPI'] . '/registration',[
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json'
                    ],
                    'body'=> json_encode($data)
                ]);
                if ($response->getStatusCode() == 200) {
                    return redirect()->to('register')->with('success', 'Registrasi Berhasil');
                }else{
                    return redirect()->to('register')->with('error', 'Registrasi Gagal');
                }
            } catch (\Throwable $th) {
                return redirect()->to('register')->with('error', 'Registrasi Gagal');
            }

        }
    }
}
