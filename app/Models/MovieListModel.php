<?php

namespace App\Models;

use CodeIgniter\Model;

class MovieListModel extends Model
{
    protected $table = 'user_movie_list';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'movie_id', 'created_at'];

    public function isMovieInUserList($userId, $tmdbId)
    {
        $movie = $this->db->table('movies')->where('tmdb_id', $tmdbId)->get()->getRow();

        if ($movie) {
            return $this->where('user_id', $userId)->where('movie_id', $movie->id)->first() !== null;
        }
        return false;
    }
}
