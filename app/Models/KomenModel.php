<?php

namespace App\Models;

use App\Entities\Komen;
use CodeIgniter\Model;


class KomenModel extends Model
{
    protected $table = 'komens';
    protected $primaryKey = 'id';
    protected $allowedFields = ['komentar', 'tweet_id', 'user_id'];
    public $ruleKomen = [
        'komentar' => [
            'rules' => 'required|max_length[250]|min_length[3]',
            'errors' => [
                'required' => 'Komentar masih kosong',
                'max_length' => 'Komentar terlalu panjang',
                'min_length' => 'Komentar terlalu pendek, minimal 3 karakter',
            ],
        ]
    ];



    public function addKomen($user_id, $komen, $tweet_id)
    {
        $data = [
            'user_id' => $user_id,
            'komentar' => $komen,
            'tweet_id' => $tweet_id
        ];

        $this->insert($data);
    }

    public function komenCount($tweet_id)
    {
        return $this->where('tweet_id', $tweet_id)
            ->countAllResults();
    }

    public function getKomentarByTweetId($tweet_id)
    {
        $query = $this->select('komentar, komens.id, users.username,users.fotoprofil, users.fullname, users.id as user_id')
            ->where('tweet_id', $tweet_id)
            ->join('users', 'users.id = komens.user_id')
            ->findAll();
    
        return $query;
    }
    
}