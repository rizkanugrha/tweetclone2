<?php

namespace App\Models;

use App\Entities\User;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'password', 'fullname', 'email', 'token', 'fotoprofil'];
    protected $returnType = User::class;
    public $rules = [
        'username' => [
            'rules' => 'required|alpha_numeric|min_length[5]|is_unique[users.username]',
            'errors' => [
                'required' => 'Username tidak boleh kosong',
                'is_unique' => 'Username sudah terdaftar',
                'alpha_numeric' => 'Username harus kombinasi huruf dengan angka',
                'min_length' => 'Username minimal 5 karakter',
            ],
        ],
        'password' => [
            'rules' => 'required|min_length[8]|alpha_numeric',
            'errors' => [
                'required' => 'Password tidak boleh kosong',
                'min_length' => 'Password minimal 8 karakter',
                'alpha_numeric' => 'Password harus kombinasi huruf dengan angka',
            ],
        ],
        'confirmation' => [
            'rules' => 'required_with[password]|matches[password]',
            'errors' => [
                'required_with' => 'Konfirmasi password tidak boleh kosong',
                'matches' => 'Password tidak sama',
            ],
        ],
        'fullname' => [
            'rules' => 'required|min_length[4]',
            'errors' => [
                'required' => 'Nama lengkap tidak boleh kosong',
                'min_length' => 'Nama lengkap minimal 4 karakter',
            ],
        ],
        'email' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Email tidak boleh kosong',
                'valid_email' => 'Yang Anda inputkan bukan type email, contoh: abc@zxc.com',
            ],
        ],
    ];
    public $loginRules = [
        'username' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Username tidak boleh kosong',
            ],
        ],
        'password' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Password tidak boleh kosong',
            ],
        ]
    ];

    public $ProfilRules = [
        'confpassbaru' => [
            'rules' => 'required_with[passbaru]|matches[passbaru]',
            'errors' => [
                'required_with' => 'Konfirmasi password tidak boleh kosong',
                'matches' => 'Password baru tidak sama',
            ],
        ],
        'fotoprofil' => [
            'rules' => 'uploaded[fotoprofil]|max_size[fotoprofil,1024]|is_image[fotoprofil]|mime_in[fotoprofil,image/jpg,image/jpeg,image/png]',
            'errors' => [
                'uploaded' => 'Pilih foto profil terlebih dahulu',
                'max_size' => 'Ukuran gambar terlalu besar',
                'is_image' => 'Yang Anda pilih bukan gambar',
                'mime_in' => 'Yang Anda pilih bukan gambar',
            ],
        ],
    ];

    public $rulGantiPass = [
        'barupass' => [
            'rules' => 'required|min_length[8]|alpha_numeric',
            'errors' => [
                'required' => 'Password tidak boleh kosong',
                'min_length' => 'Password minimal 8 karakter',
                'alpha_numeric' => 'Password harus kombinasi huruf dengan angka',
            ],
        ],
        'conbarupass' => [
            'rules' => 'required_with[barupass]|matches[barupass]',
            'errors' => [
                'required_with' => 'Konfirmasi password tidak boleh kosong',
                'matches' => 'Password baru tidak sama',
            ],
        ],
    ];

    function addUser($data)
    {
        $user = new User();
        $user->username = $data['username'];
        $user->password = $data['password'];
        $user->fullname = $data['fullname'];
        $user->email = $data['email'];
        $this->save($user);
        return [$user->username, $this->getInsertID()];
    }

    function ubahPass($id, $data)
    {
        $user = new User();
        $user->password = $data['password'];
        $user->fotoprofil = $data['fotoprofil'];
        return $this->update($id, $data);
    }

    public function login($username, $password)
    {
        $user = $this->where('username', $username)->first();
        if ($user && password_verify($password, $user->password)) {
            return [$user->username, $user->id];
        } else {
            return false;
        }
    }
}

?>