<?php

namespace App\Controllers;

use App\Models\MovieListModel;
use App\Models\MovieReviewModel;

class MoviesController extends BaseController
{
    protected $userMovieListModel;
    protected $movieReviewModel;

    public function __construct()
    {
        $this->userMovieListModel = new MovieListModel();
        $this->movieReviewModel = new MovieReviewModel();
        helper('tmdb');
    }

    public function details($id)
    {
        $userId = session()->get('id');
        $movie = get_movie_details($id);
        $credits = get_movie_credits($id);
        $similar_movies = get_movies_similar($id);
        $reviews = $this->movieReviewModel->getAllReviewsWithUsername($id);
        $isInList = false;
        $userReview = null;

        if ($userId) {
            $isInList = $this->userMovieListModel->isMovieInUserList($userId, $id);
            $userReview = $this->movieReviewModel->getUserReview($userId, $id);
        }

        $data = [
            'movie' => $movie,
            'credits' => $credits,
            'similar_movies' => $similar_movies,
            'movieInList' => $isInList,
            'reviews' => $reviews,
            'userReview' => $userReview,
        ];

        if (empty($data['movie'])) {
            return redirect()->to('/dashboard')->with('error', 'Movie not found.');
        }

        return view('movies/details', $data);
    }
}
