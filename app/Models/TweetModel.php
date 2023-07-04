<?php

namespace App\Models;

use App\Entities\Tweet;

use CodeIgniter\Model;

class TweetModel extends Model
{
    protected $table = 'tweets';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['user_id', 'content', 'category', 'fototweet'];
    protected $returnType = Tweet::class;

    public $rules = [
        'content' => [
            'rules' => 'required|is_unique[tweets.content]',
            'errors' => [
                'required' => 'Tweet masih kosong',
                'is_unique' => 'Tweet belum diubah'
            ],
        ],
        'category' => 'required',
        'fototweet' => [
            'rules' => 'max_size[fototweet,1024]|is_image[fototweet]|mime_in[fototweet,image/jpg,image/jpeg,image/png]',
            'errors' => [
                'max_size' => 'Ukuran gambar terlalu besar',
                'is_image' => 'Yang Anda pilih bukan gambar',
                'mime_in' => 'Yang Anda pilih bukan gambar',
            ],
        ],
    ];

    public $rulesAdd = [
        'content' => [
            'rules' => 'required|is_unique[tweets.content]',
            'errors' => [
                'required' => 'Tweet masih kosong',
            ],
        ],
        'category' => 'required',
        'fototweet' => [
            'rules' => 'max_size[fototweet,1024]|is_image[fototweet]|mime_in[fototweet,image/jpg,image/jpeg,image/png]',
            'errors' => [
                'max_size' => 'Ukuran gambar terlalu besar',
                'is_image' => 'Yang Anda pilih bukan gambar',
                'mime_in' => 'Yang Anda pilih bukan gambar',
            ],
        ],
    ];

    public function newTweet($curUser, $post)
    {
        $tweets = new Tweet();
        $tweets->user_id = $curUser['userid'];
        $tweets->content = $post['content'];
        $tweets->category = $post['category'];
        $tweets->fototweet = $post['fototweet'];
        $this->save($tweets);

    }

    public function getLatest()
    {
        $query = $this->select('tweets.id, user_id, username, fotoprofil, fullname, content, fototweet, category, created_at, , updated_at')
            ->orderBy('updated_at', 'desc')
            ->join('users', 'users.id = tweets.user_id');
        return $query->findAll();
    }

    public function getByCategory($category)
    {
        $category = $this->escapeString($category);    
        $query = $this->select('tweets.id, user_id, username, fotoprofil, fullname, content, fototweet, category, created_at, updated_at')
            ->where('category', $category)->orderBy('updated_at', 'desc')
            ->join('users', 'users.id = tweets.user_id');
        return $query->findAll();
    }

    public function detailbyId($id)
    {
        $id = $this->escapeString($id);
        $query = $this->select('tweets.id, user_id, username, fotoprofil, fullname, fototweet, content, category, created_at')
            ->where('tweets.id', $id)
            ->join('users', 'users.id = tweets.user_id');
        return $query->where('tweets.id', $id)->first();
    }
// Model komenMdl


}

?>