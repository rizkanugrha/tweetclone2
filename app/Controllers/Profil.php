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

    // public function index()
    // {
    //     $data['categories'] = $this->categories;
    //     $data['judul'] = 'Tweet Terbaru';

    //     $data['profile'] = $this->profile;
    //     $data['tweets'] = $this->tweetMdl->getLatest();

    //     return view('tweet_home', $data);
    // }
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
        //$cekid = $this->userMdl->where('id', $id)->first();
        // $passold = $this->request->getPost('passold');
        $foto = $this->request->getFile('fotoprofil');
        if ($this->validate($this->userMdl->ProfilRules)) {

            $data['password'] = $this->request->getPost('passbaru');

            if ($foto->isValid() && !$foto->hasMoved()) {
                //mengecek foto ke upload dan belum move ke folder
                $namafoto = $foto->getRandomName();
                $foto->move('asset/images', $namafoto);
                $data['fotoprofil'] = $namafoto;
            }
            //dd($foto->getError());
            $this->userMdl->ubahProfil($id, $data);

            session()->setFlashdata('psnpass', 'Berhasil ganti password baru');
            return redirect()->to('/profil/' . $this->profile->username);

        } else {
            $data['profile'] = $this->profile;
            $data['Validation'] = $this->validator;
            return view('profil/ubah_profil', $data);
        }
    }


    public function salah()
    {
        return redirect()->to('/');
    }
}