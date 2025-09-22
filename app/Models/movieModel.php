<?php

namespace App\Models;

use CodeIgniter\Model;

class MovieModel extends Model
{
    protected $table = 'movies';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tmdb_id', 'title', 'release_date', 'poster_url'];

    public function topRatedMovies()
    {
        return $this->select('movies.tmdb_id, movies.title, movies.poster_url, AVG(movie_reviews.rating) AS average_rating, COUNT(movie_reviews.id) AS total_reviews')
            ->join('movie_reviews', 'movie_reviews.tmdb_id = movies.tmdb_id')
            ->groupBy('movies.title, movies.release_date, movies.poster_url')
            ->orderBy('average_rating', 'DESC')
            ->limit(20)
            ->findAll();
    }
}
