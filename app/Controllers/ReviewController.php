<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ReviewModel;
use App\Models\MovieModel;

class ReviewController extends Controller
{
    public function index($tmdb_id)
    {
        $reviewModel = new ReviewModel();

        $reviews = $reviewModel->where('tmdb_id', $tmdb_id)->findAll();

        $apiKey = '247a53b2c562a91054f961f40c3bd6c4';
        $url = "https://api.themoviedb.org/3/movie/{$tmdb_id}?api_key={$apiKey}&language=en-US";
        $client = \Config\Services::curlrequest();
        $response = $client->get($url);
        $movie = json_decode($response->getBody(), true);

        return view('reviews/review', ['movie' => $movie, 'reviews' => $reviews, 'tmdb_id' => $tmdb_id]);
    }


    public function submit()
    {
        $reviewModel = new ReviewModel();
        $movieModel = new MovieModel();

        $tmdb_id = $this->request->getPost('tmdb_id');

        $movie = $movieModel->where('tmdb_id', $tmdb_id)->first();

        if (!$movie) {
            $apiKey = '247a53b2c562a91054f961f40c3bd6c4';
            $url = "https://api.themoviedb.org/3/movie/{$tmdb_id}?api_key={$apiKey}&language=en-US";
            $client = \Config\Services::curlrequest();
            $response = $client->get($url);
            $movieData = json_decode($response->getBody(), true);

            $movieModel->insert([
                'tmdb_id' => $movieData['id'],
                'title' => $movieData['title'],
                'release_date' => $movieData['release_date'],
                'poster_path' => $movieData['poster_path']
            ]);
        }

        $data = [
            'user_id' => session()->get('user_id'),
            'tmdb_id' => $tmdb_id,
            'rating' => $this->request->getPost('rating'),
            'review_text' => $this->request->getPost('review_text'),
        ];

        $reviewModel->insert($data);

        return redirect()->to(base_url('reviews/index/' . $tmdb_id))
            ->with('success', 'Your review has been submitted.');
    }
}
