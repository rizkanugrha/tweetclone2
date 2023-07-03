<?php

namespace App\Controllers;

use \App\Entities\User;
use \App\Models\UserModel;
use CodeIgniter\I18n\Time;

//use CodeIgniter\Validation\ValidationInterface\set_message;
//use CodeIgniter\Validation\ValidationInterface;

class Auth extends BaseController
{
    var $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        return view('auth/auth_login');
    }



    public function register()
    {
        $data = [
            'validation' => \Config\Services::validation()
        ];
        return view('auth/auth_register', $data);
    }

    public function addUser()
    {
        $userModel = new UserModel();
        //password_hash($this->request->getPost('password'), PASSWORD_BCRYPT)

        if ($this->validate($userModel->rules)) {
            $data = [
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'fullname' => $this->request->getPost('fullname'),
                'email' => $this->request->getPost('email')
            ];
            $result = $userModel->addUser($data);
            if ($result) {
                session()->setFlashdata('pesan', 'Berhasil registrasi');
                return redirect()->to('/auth');
            }
        } else {
            $data['validation'] = $this->validator;
            return view('auth/auth_register', $data);
        }
    }

    public function login()
    {
        $userMdl = new UserModel();
        //laadpgtmqvawshad
        if ($this->validate($userMdl->loginRules)) {
            $result = $userMdl->login(
                $this->request->getPost('username'),
                $this->request->getPost('password')
            );
            if ($result) {
                session()->set(
                    'currentuser',
                    ['username' => $result[0], 'userid' => $result[1]]
                );
                return redirect()->to('/');
            } else {
                session()->setFlashdata(
                    'login_error',
                    'Kombinasi Username &amp; Password tidak ditemukan'
                );
                return redirect()->to('/auth');
            }
        } else {
            $data['validation'] = $this->validator;

            return view('auth/auth_login', $data);
        }
    }

    public function logout()
    {
        session()->remove('currentuser');
        session()->setFlashdata('logout', 'success');
        return redirect()->to('/auth');
    }

    public function lupapas()
    {
        $data['validation'] = $this->validator;
        return view('auth/auth_fpass', $data);

    }

    public function sendResetLink()
    {
        $email = $this->request->getPost('email');

        // Cek apakah email ada dalam database
        $user = $this->userModel->where('email', $email)->first();
        //dd($user);
        //  $getid = $user['id'];
        if ($user) {
            // Generate token dan simpan dalam database
            $token = bin2hex(random_bytes(32));
            date_default_timezone_set('Asia/Jakarta');

            //$currentDateTime = date('Y-m-d H:i:s');
            $data = $user->toArray();
            $data['token'] = $token;
            // Save the updated data
            $this->userModel->save($data);
            // Kirim email dengan link reset password
            $emailBody = 'Klik tautan berikut untuk mereset password Anda: ' .
                base_url('lupa-password/ganti-password/' . $token);
            $emailService = \Config\Services::email();
            $emailService->setFrom('rizka8901@gmail.com', 'Kampret Senior');
            $emailService->setTo($email)
                ->setSubject('Reset Password')
                ->setMessage($emailBody);
            if ($emailService->send()) {

                session()->setFlashdata('ssendlink', 'Silakan periksa email Anda untuk langkah selanjutnya.');
                return redirect()->to('/lupa-password');
            } else {
                $data = $emailService->printDebugger(['headers']);
                session()->setFlashdata('errsendmail', 'ERROR');
                print_r($data);
            }
        } else {
            session()->setFlashdata('errsendlink', 'Email tidak ditemukan.');
            return redirect()->to('/lupa-password');
        }
    }



    public function resetPass($token)
    {
        date_default_timezone_set('Asia/Jakarta');
        $cektoken = $this->userModel->where('token', $token)
            ->first();

        if ($cektoken) {
            $data['token'] = $cektoken->token;
            //dd($data['token']);
            return view('auth/auth_gantipass', $data);
        } else {
            // Token tidak valid atau sudah expired
            session()->setFlashdata('tokennot', 'Token reset password tidak valid atau sudah kadaluarsa.');
            return redirect()->to('/lupa-password');
        }
    }

    public function updatePassword()
    {
        $token = $this->request->getPost('token');
        $password = $this->request->getPost('barupass');
        $cektoken = $this->userModel->where('token', $token)
            ->first();
        if ($cektoken) {
            if ($this->validate($this->userModel->rulGantiPass)) {
                // Update the user's password
                $this->userModel->update($cektoken->id, [
                    'password' => password_hash($password, PASSWORD_BCRYPT),
                    'token' => null
                ]);

                return redirect()->to('/auth')->with('succespass', 'Password berhasil diganti. Please log in.');
            } else {
                $data['validation'] = $this->validator;
                $data['token'] = $token; // Add this line to pass the token to the view
                return view('auth/auth_gantipass', $data);
            }
        }
        return redirect()->to('/lupa-password')->with('tokennot', 'Token reset password tidak valid atau sudah kadaluarsa.');
    }

}