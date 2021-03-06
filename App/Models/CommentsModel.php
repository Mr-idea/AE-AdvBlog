<?php

namespace App\Models;

use System\Model;

class CommentsModel extends Model
{

    /**
     * Table name
     * @var string
     */
    protected $table = 'comments';

    /**
     * Get all comments
     *
     * @return array
     */
    public function all()
    {
        return $this->db
                        ->select('comments.*', 'posts.title AS `title`', 'posts.status AS post_status', 'u.name AS `author`', 'u.status AS `author_status`')
                        ->from('comments')
                        ->joins('LEFT JOIN u ON comments.uid = u.id')
                        ->joins('LEFT JOIN posts ON comments.post_id = posts.id')
                        ->orderBy('comments.id', 'DESC')
                        ->fetchAll();
    }

}
