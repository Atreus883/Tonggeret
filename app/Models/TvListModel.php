<?php

namespace App\Models;

use CodeIgniter\Model;

class TvListModel extends Model
{
    protected $table = 'user_tv_list';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'tv_id', 'created_at'];

    public function isTvInUserList($userId, $tmdbId)
    {
        $tv = $this->db->table('tvs')->where('tmdb_id', $tmdbId)->get()->getRow();

        if ($tv) {
            return $this->where('user_id', $userId)->where('tv_id', $tv->id)->first() !== null;
        }
        return false;
    }
}
