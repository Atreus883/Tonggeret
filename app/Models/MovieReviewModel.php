<?php

namespace App\Models;

use CodeIgniter\Model;

class MovieReviewModel extends Model
{
    protected $table = 'movie_reviews';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'tmdb_id', 'rating', 'review_text'];
    protected $validationRules = [
        'rating' => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[10]',
        'review_text' => 'required|string',
    ];

    public function getUserReview($userId, $tmdbId)
    {
        return $this->where('user_id', $userId)->where('tmdb_id', $tmdbId)->first();
    }

    public function getAllReviewsWithUsername($tmdbId)
    {
        return $this->select('movie_reviews.*, users.username')
                    ->join('users', 'users.id = movie_reviews.user_id')
                    ->where('tmdb_id', $tmdbId)
                    ->findAll();
    }
}
