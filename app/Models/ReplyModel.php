<?php

namespace App\Models;

use App\Entities\Reply;
use CodeIgniter\Model;

class ReplyModel extends Model
{
    protected $table = 'reply';
    protected $primaryKey = 'id';
    protected $allowedFields = ['replies', 'komens_id', 'user_id'];
    public $ruleReply = [
        'replies' => [
            'rules' => 'required|max_length[250]|min_length[3]',
            'errors' => [
                'required' => 'Reply komentar masih kosong',
                'max_length' => 'Reply komentar terlalu panjang',
                'min_length' => 'Reply komentar terlalu pendek, minimal 3 karakter',
            ],
        ]
    ];

    public function addReply($user_id, $replies, $komens_id)
    {
        $data = [
            'user_id' => $user_id,
            'replies' => $replies,
            'komens_id' => $komens_id
        ];
        $this->insert($data);
    }
    public function getReplyByIdKomen($komen_id)
    {
        $query = $this->select('replies, reply.id, users.username, users.fullname, users.id as user_id')
            ->where('komens_id', $komen_id)
            ->join('users', 'users.id = reply.user_id')
            ->findAll();
    
        return $query;
    }
    
    

}