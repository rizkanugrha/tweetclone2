<?php

namespace App\Controllers;

use App\Models\KomenModel;
use App\Models\ReplyModel;
use \App\Models\TweetModel;
use CodeIgniter\Validation\Validation;

use App\Models\LikeModel;

use CodeIgniter\API\ResponseTrait;

class Tweet extends BaseController
{

    use ResponseTrait;
    var $categories;
    var $sess;
    var $curUser;
    var $komenMdl;
    var $tweetMdl;
    var $profile;
    var $likesMdl;
    var $RepMdl;

    public function __construct()
    {
        $this->categories = (new \Config\AdtConfig())->getCategories();
        $this->sess = session();
        $this->curUser = $this->sess->get('currentuser');
        $this->likesMdl = new LikeModel();
        $this->komenMdl = new KomenModel();
        $this->tweetMdl = new TweetModel();
        $this->RepMdl = new ReplyModel();
        $userMdl = new \App\Models\UserModel();
        $this->profile = $userMdl->find($this->curUser['userid']);
    }

    public function index()
    {
        $data['categories'] = $this->categories;
        $data['judul'] = 'Tweet Terbaru';
        //  
        $data['profile'] = $this->profile;
        $data['tweets'] = $this->tweetMdl->getLatest();

        $cek = $this->tweetMdl->getLatest();
        $likeCounts = [];
        foreach ($cek as $tweet) {
            $likeCount = $this->likesMdl->getLikeCount($tweet->id);
            $likeCounts[$tweet->id] = $likeCount;
        }
        $data['likeCounts'] = $likeCounts;
        
        $komenCounts = [];
        foreach($cek as $tweet) {
            $komenCount = $this->komenMdl->komenCount($tweet->id);
            $komenCounts[$tweet->id] = $komenCount;
        }
        $data['komenCounts'] = $komenCounts;

        return view('tweet_home', $data);
    }

    public function category($category)
    {
        $data['categories'] = $this->categories;
        $data['judul'] = 'Tweet Terbaru';

        $data['profile'] = $this->profile;
        $data['tweets'] = $this->tweetMdl->getByCategory($category);
        $cek = $this->tweetMdl->getByCategory($category);

        $likeCounts = [];
        foreach ($cek as $tweet) {
            $likeCount = $this->likesMdl->getLikeCount($tweet->id);
            $likeCounts[$tweet->id] = $likeCount;
        }
        $data['likeCounts'] = $likeCounts;

        $komenCounts = [];
        foreach($cek as $tweet) {
            $komenCount = $this->komenMdl->komenCount($tweet->id);
            $komenCounts[$tweet->id] = $komenCount;
        }
        $data['komenCounts'] = $komenCounts;
        return view('tweet_home', $data);
    }

    public function editForm($tweet_id)
    {
        $getid = $this->tweetMdl->where('id', $tweet_id)->first();
        if ($getid->user_id != $this->curUser['userid']) {
            session()->setFlashdata('editsus', 'Gagal mengedit Tweet karena bukan Tweet Anda');
            return redirect()->to('/');
        }
        $data = [
            'id' => $getid->id,
            'categories' => $this->categories,
            'content' => $getid->content,
            'fototweet' => $getid->fototweet
        ];
        return view('tweet_edit', compact('data'));
    }

    public function editTweet($id)
    {
        $getid = $this->tweetMdl->where('id', $id)->first();
        //dd($getid);
        if ($getid->user_id != $this->curUser['userid']) {
            session()->setFlashdata('editsus', 'Gagal mengedit Tweet karena bukan Tweet Anda');
            return redirect()->to('/');
        }
        $foto = $this->request->getFile('fototweet');
        if ($this->validate($this->tweetMdl->rules)) {
            $data['content'] = stripslashes(htmlentities($this->request->getPost('content'), ENT_QUOTES));
            $data['category'] = stripslashes(htmlentities($this->request->getPost('category'), ENT_QUOTES));
            if ($foto->getError() == 4) {
                //jika user tidak upload foto tweet
                $namafoto = $getid->fototweet;
            } else {
                if ($foto->isValid() && !$foto->hasMoved()) {
                    //mengecek foto baru ke upload dan belum move ke folder
                    $namafoto = $foto->getRandomName();
                    $foto->move('asset/images/tweets', $namafoto);
                }
            }
            $data['fototweet'] = $namafoto;
            $res = $this->tweetMdl->update($id, $data);
            session()->setFlashdata('editsus', 'Berhasil mengupdate Tweet');
            return redirect()->to('/');
        } else {
            $data = [
                'id' => $getid->id,
                'categories' => $this->categories,
                'content' => $getid->content,
                'fototweet' => $getid->fototweet,
                'validation' => $this->validator
            ];
            return view('tweet_edit', compact('data'));
        }
    }

    public function addForm()
    {
        $data['categories'] = $this->categories;
        return view('tweet_add', $data);
    }

    public function addTweet()
    {
        $foto = $this->request->getFile('fototweet');
        //dd($foto);
        if ($this->validate($this->tweetMdl->rulesAdd)) {
            $data['content'] = stripslashes(htmlentities($this->request->getPost('content'), ENT_QUOTES));
            $data['category'] = htmlentities($this->request->getPost('category'), ENT_QUOTES);

            if ($foto->getError() == 4) {
                //jika user tidak upload foto tweet
                $namafoto = null;
            } else {
                if ($foto->isValid() && !$foto->hasMoved()) {
                    //mengecek foto baru ke upload dan belum move ke folder
                    $namafoto = $foto->getRandomName();
                    $foto->move('asset/images/tweets', $namafoto);
                }
            }
            $data['fototweet'] = $namafoto;
            $this->tweetMdl->newTweet($this->sess->get('currentuser'), $data);
            $this->sess->setFlashdata('addtweet', 'Berhasil Menambah Tweets');
            return redirect()->to('/');
        } else {
            $data['Validation'] = $this->validator;
            $data['categories'] = $this->categories;
            return view('tweet_add', $data);
        }
    }

    public function delTweet($tweet_id)
    {
        $getid = $this->tweetMdl->where('id', $tweet_id)->first();
        if ($getid->user_id != $this->curUser['userid']) {
            session()->setFlashdata('editsus', 'Gagal menghapus Tweet karena bukan Tweet Anda');
            return redirect()->to('/');
        }
        $this->tweetMdl->delete($tweet_id);
        session()->setFlashdata('berhapus', 'Berhasil menghapus Tweet');
        return redirect()->to('/');
    }

    public function detail($twtid)
    {
        $find = $this->tweetMdl->detailbyId($twtid);
        $user_id = $this->curUser['userid'];

        $likeCount = $this->likesMdl->getLikeCount($find->id); //getlike by id tweet
        $likeCounts[$find->id] = $likeCount;

        $komenCount = $this->komenMdl->komenCount($find->id);
        $komenCounts[$find->id] = $komenCount;

        //cek idkomen
        $komentar = $this->komenMdl->getKomentarByTweetId($find->id);

        $data = [
            'likeCounts' => $likeCounts[$find->id],
            'komenCounts' => $komenCounts[$find->id],
            'content' => $find->content,
            'id' => $find->id,
            'user_id' => $user_id,
            'username' => $find->username,
            'fullname' => $find->fullname,
            'category' => $find->category,
            'fototweet' => $find->fototweet,
            'created_at' => $find->created_at,
            'komentar' => $komentar
        ];

        // Mendapatkan reply berdasarkan id komentar
        $replyData = [];
        foreach ($komentar as $komen) {
            $replies = $this->RepMdl->getReplyByIdKomen($komen['id']);
            $replyData[$komen['id']] = $replies;
        }

        return view('tweet_detail', compact('data', 'replyData'));
    }

    public function addLike($tweet_id, $user_id)
    {
        $user_id = $this->curUser['userid'];
        $cekid = $this->likesMdl->where('tweet_id', $tweet_id)
            ->where('user_id', $user_id)
            ->first();
        if ($cekid === null) {
            $this->likesMdl->addLike($tweet_id, $user_id);
        } else {
            $this->likesMdl->unLike($tweet_id, $user_id);
        }

        return redirect()->to('/detail/' . $tweet_id);
    }
    public function addKomen($tweet_id)
    {
        $user_id = $this->curUser['userid'];
        //  $tweet_id = $this->request->getPost('tweet_id');

        if ($this->validate($this->komenMdl->ruleKomen)) {
            $data = [
                'komentar' => htmlentities($this->request->getPost('komentar'), ENT_QUOTES)
            ];
            $this->komenMdl->addKomen($user_id, $data, $tweet_id);

            $response = [
                'success' => true,
                'komentar' => $data['komentar'],
                'username' => $this->curUser['username']
            ];
            // return $this->response->setJSON($response);
            return redirect()->back()->with('sukeskom', $response);

        } else {
            $response = [
                'success' => false,
                'message' => $this->validator->getErrors()
            ];
            return redirect()->back()->with('errorkom', $response['message']);

        }
    }

    public function addReply($komens_id)
    {
        $komens_id = $this->komenMdl->where('id', $komens_id)->first();
        //dd($komens_id);
        $user_id = $this->curUser['userid'];
        if ($this->validate($this->RepMdl->ruleReply)) {
            $data = [
                'replies' => htmlentities($this->request->getPost('replies'), ENT_QUOTES)
            ];
            $this->RepMdl->addReply($user_id, $data, $komens_id['id']);

            $response = [
                'success' => true,
                'replies' => $data['replies'],
                'username' => $this->curUser['username']
            ];
            // return $this->response->setJSON($response);
            return redirect()->back()->with('suksesrep', $response);

        } else {
            $response = [
                'success' => false,
                'message' => $this->validator->getErrors()
            ];
            return redirect()->back()->with('errorrep', $response['message']);

        }
    }



}