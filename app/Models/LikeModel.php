<?php

namespace App\Models;

use CodeIgniter\Model;

class LikeModel extends Model
{
    protected $table = 'likes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tweet_id', 'user_id'];

    public function addLike($tweet_id, $user_id)
    {
        $data = [
            'tweet_id' => $tweet_id,
            'user_id' => $user_id
        ];
       $this->save($data);
    }

    public function unLike($tweet_id, $user_id)
    {
      $this->where('tweet_id', $tweet_id)
            ->where('user_id', $user_id)
            ->delete();
    }

    public function getLikeCount($tweet_id)
    {
        return $this->where('tweet_id', $tweet_id)
            ->countAllResults();
    }

    public function LikebyIdTwt($tweet_id)
    {
        $query = $this->select('likes.id, users.username,users.fotoprofil, users.fullname, users.id as user_id')
            ->where('tweet_id', $tweet_id)
            ->join('users', 'users.id = likes.user_id')
            ->findAll();
    
        return $query;
    }

}
