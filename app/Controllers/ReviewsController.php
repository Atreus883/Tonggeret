<?php

namespace App\Controllers;

use App\Models\TvReviewModel;
use App\Models\MovieReviewModel;
use App\Models\MovieModel;
use App\Models\TvModel;

class ReviewsController extends BaseController
{
    protected $movieReviewModel;
    protected $tvReviewModel;
    protected $movieModel;
    protected $tvModel;

    public function __construct()
    {
        $this->movieReviewModel = new MovieReviewModel();
        $this->tvReviewModel = new TvReviewModel();
        $this->movieModel = new MovieModel();
        $this->tvModel = new TvModel();
        helper('tmdb');
    }

    public function index()
    {
        $userId = session()->get('id');
        $movies = $this->movieModel->select('movies.*, movie_reviews.rating')
            ->join('movie_reviews', 'movies.tmdb_id = movie_reviews.tmdb_id')
            ->where('movie_reviews.user_id', $userId)
            ->findAll();

        $tvs = $this->tvModel->select('tvs.*, tv_reviews.rating')
            ->join('tv_reviews', 'tvs.tmdb_id = tv_reviews.tmdb_id')
            ->where('tv_reviews.user_id', $userId)
            ->findAll();

        $data = [
            'tvs' => $tvs,
            'movies' => $movies,
        ];
        return view('reviews/user_review', $data);
    }

    public function addMovieReview($tmdbId)
    {
        $userId = session()->get('id');
        $existingReview = $this->movieReviewModel->where('user_id', $userId)->where('tmdb_id', $tmdbId)->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'You have already reviewed this movie.');
        }

        $movie = $this->movieModel->where('tmdb_id', $tmdbId)->first();

        if (!$movie) {
            $movieDetails = get_movie_details($tmdbId);
            if ($movieDetails) {
                $this->movieModel->save(
                    [
                        'tmdb_id' => $movieDetails['id'],
                        'title' => $movieDetails['title'],
                        'release_date' => $movieDetails['release_date'],
                        'poster_url' => $movieDetails['poster_path'],
                    ]
                );
            }
        }

        $data = [
            'user_id' => $userId,
            'tmdb_id' => $tmdbId,
            'rating' => $this->request->getPost('rating'),
            'review_text' => $this->request->getPost('review_text'),
        ];

        $this->movieReviewModel->save($data);
        return redirect()->back()->with('success', 'Review added successfully.');
    }

    public function addTvReview($tmdbId)
    {
        $userId = session()->get('id');
        $existingReview = $this->tvReviewModel->where('user_id', $userId)->where('tmdb_id', $tmdbId)->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'You have already reviewed this movie.');
        }

        $tv = $this->tvModel->where('tmdb_id', $tmdbId)->first();

        if (!$tv) {
            $tvDetails = get_tv_details($tmdbId);
            if ($tvDetails) {
                $this->tvModel->save(
                    [
                        'tmdb_id' => $tvDetails['id'],
                        'original_name' => $tvDetails['original_name'],
                        'first_air_date' => $tvDetails['first_air_date'],
                        'poster_url' => $tvDetails['poster_path'],
                    ]
                );
            }
        }

        $data = [
            'user_id' => $userId,
            'tmdb_id' => $tmdbId,
            'rating' => $this->request->getPost('rating'),
            'review_text' => $this->request->getPost('review_text'),
        ];

        $this->tvReviewModel->save($data);
        return redirect()->back()->with('success', 'Review added successfully.');
    }

    public function updateMovieReview($id)
    {
        $data = [
            'rating' => $this->request->getPost('rating'),
            'review_text' => $this->request->getPost('review_text'),
        ];
        $this->movieReviewModel->update($id, $data);
        return redirect()->back()->with('success', 'Review updated successfully.');
    }

    public function updateTvReview($id)
    {
        $data = [
            'rating' => $this->request->getPost('rating'),
            'review_text' => $this->request->getPost('review_text'),
        ];
        $this->tvReviewModel->update($id, $data);
        return redirect()->back()->with('success', 'Review updated successfully.');
    }

    public function deleteMovieReview($id)
    {
        $this->movieReviewModel->delete($id);
        return redirect()->back()->with('success', 'Review deleted successfully.');
    }

    public function deleteTvReview($id)
    {
        $this->tvReviewModel->delete($id);
        return redirect()->back()->with('success', 'Review deleted successfully.');
    }
}
