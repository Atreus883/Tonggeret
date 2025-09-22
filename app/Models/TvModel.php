<?php

namespace App\Models;

use CodeIgniter\Model;

class TvModel extends Model
{
    protected $table = 'tvs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tmdb_id', 'original_name', 'first_air_date', 'poster_url'];

    public function topRatedTvs()
    {
        return $this->select('tvs.tmdb_id, tvs.original_name, tvs.poster_url, AVG(tv_reviews.rating) AS average_rating, COUNT(tv_reviews.id) AS total_reviews')
            ->join('tv_reviews', 'tv_reviews.tmdb_id = tvs.tmdb_id')
            ->groupBy('tvs.original_name, tvs.first_air_date, tvs.poster_url')
            ->orderBy('average_rating', 'DESC')
            ->limit(20)
            ->findAll();
    }
}
