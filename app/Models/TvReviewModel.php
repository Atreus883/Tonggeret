<?php

namespace App\Models;

use CodeIgniter\Model;

class TvReviewModel extends Model
{
    protected $table = 'tv_reviews';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'tmdb_id', 'rating', 'review_text'];

    public function getUserReview($userId, $tmdbId)
    {
        return $this->where('user_id', $userId)->where('tmdb_id', $tmdbId)->first();
    }

    public function getAllReviewsWithUsername($tmdbId)
    {
        return $this->select('tv_reviews.*, users.username')
            ->join('users', 'users.id = tv_reviews.user_id')
            ->where('tmdb_id', $tmdbId)
            ->findAll();
    }
}
