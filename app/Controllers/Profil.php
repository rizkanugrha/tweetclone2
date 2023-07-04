<?php

namespace App\Controllers;

use \App\Models\TweetModel;

use \App\Models\UserModel;

class Profil extends BaseController
{

    var $categories;
    var $sess;
    var $curUser;
    var $tweetMdl;
    var $profile;
    var $userMdl;
    public function __construct()
    {
        $this->categories = (new \Config\AdtConfig())->getCategories();
        $this->sess = session();
        $this->curUser = $this->sess->get('currentuser');
        $this->tweetMdl = new TweetModel();
        $this->userMdl = new UserModel();
        $this->profile = $this->userMdl->find($this->curUser['userid']);
    }

    public function profil()
    {
        $data['profile'] = $this->profile;
        //  dd($this->profile);
        return view('profil/profil', $data);
    }

    public function ubahprofils($id)
    { //get

        $data['profile'] = $this->profile;
        return view('/profil/ubah_profil', $data);
    }

    public function ubahprofil($id)
{
    $foto = $this->request->getFile('fotoprofil');
    
    if ($this->validate($this->userMdl->ProfilRules)) {
        $data['password'] = htmlentities($this->request->getPost('passbaru'));

        if ($foto->getError() == 4 && empty($this->profile->fotoprofil)) {
            // Jika tidak ada foto baru diunggah dan profil tidak memiliki foto sebelumnya
            $namafoto = 'download.png';
        } else {
            if ($foto->isValid() && !$foto->hasMoved()) {
                // Mengecek foto baru yang diunggah dan belum dipindahkan ke folder
                $namafoto = $foto->getRandomName();
                $foto->move('asset/images/profil', $namafoto);
                
                if (!empty($this->profile->fotoprofil) && $this->profile->fotoprofil != 'download.png') {
                    // Menghapus foto profil sebelumnya jika ada
                    $pathFoto = FCPATH . 'asset/images/profil/' . $this->profile->fotoprofil;
                    if (file_exists($pathFoto)) {
                        unlink($pathFoto);
                    }
                }
            } else {
                // Jika ada kesalahan dalam unggah foto baru, tetap gunakan foto profil sebelumnya
                $namafoto = $this->profile->fotoprofil;
            }
        }
        
        $data['fotoprofil'] = $namafoto;
        $this->userMdl->ubahProfil($id, $data);
        
        session()->setFlashdata('psnpass', 'Berhasil mengganti profil baru');
        return redirect()->to('/profil/' . $this->profile->username);
    } else {
        $data['profile'] = $this->profile;
        $data['Validation'] = $this->validator;
        return view('profil/ubah_profil', $data);
    }
}


    public function delfotprofl($id)
    {
        //dd($id);
        if (!empty($this->profile->fotoprofil)) {
            $data['fotoprofil'] = 'download.png';
            $pathFoto = FCPATH . 'asset/images/profil/' .$this->profile->fotoprofil;
            if (file_exists($pathFoto)) {
                unlink($pathFoto);
            }
            $this->userMdl->update($id, $data);
            session()->setFlashdata('berhapusfotpr', 'Berhasil menghapus foto profil');
            return redirect()->to('/profil/' . $this->profile->username);
        }
        return redirect()->to('/profil/' . $this->profile->username);
    }

    public function salah()
    {
        return redirect()->to('/');
    }
}