<?php

namespace App\Controllers;

use App\Models\MovieListModel;
use App\Models\TvListModel;
use App\Models\MovieModel;
use App\Models\TvModel;

class ListController extends BaseController
{
    protected $userMovieListModel;
    protected $movieModel;
    protected $tvModel;
    protected $userTvListModel;

    public function __construct()
    {
        $this->userMovieListModel = new MovieListModel();
        $this->userTvListModel = new TvListModel();
        $this->tvModel = new TvModel();
        $this->movieModel = new MovieModel();
        helper('tmdb');
    }

    public function addToUserList($tmdbId)
    {
        $userId = session()->get('id');
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
                $movie = $this->movieModel->where('tmdb_id', $tmdbId)->first();
            }
        }

        if ($this->userMovieListModel->isMovieInUserList($userId, $movie['id'])) {
            return redirect()->back()->with('message', 'Movie is already in your list.');
        }

        $this->userMovieListModel->save([
            'user_id' => $userId,
            'movie_id' => $movie['id'],
        ]);

        return redirect()->back()->with('message', 'Movie added to your list.');
    }

    public function removeFromUserList($tmdbId)
    {
        $userId = session()->get('id');
        if (!$userId) {
            return redirect()->to('/login');
        }

        $movie = $this->movieModel->where('tmdb_id', $tmdbId)->first();

        if ($movie) {
            $this->userMovieListModel
                ->where('user_id', $userId)
                ->where('movie_id', $movie['id'])
                ->delete();
        }

        return redirect()->back()->with('message', 'Movie removed from your list.');
    }

    public function addToUserTvList($tmdbId)
    {
        $userId = session()->get('id');
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
                $tv = $this->tvModel->where('tmdb_id', $tmdbId)->first();
            }
        }

        if ($this->userTvListModel->isTvInUserList($userId, $tv['id'])) {
            return redirect()->back()->with('message', 'TV show is already in your list.');
        }

        $this->userTvListModel->save([
            'user_id' => $userId,
            'tv_id' => $tv['id'],
        ]);

        return redirect()->back()->with('message', 'TV show added to your list.');
    }

    public function removeFromUserTvList($tmdbId)
    {
        $userId = session()->get('id');
        if (!$userId) {
            return redirect()->to('/login');
        }

        $tv = $this->tvModel->where('tmdb_id', $tmdbId)->first();

        if ($tv) {
            $this->userTvListModel
                ->where('user_id', $userId)
                ->where('tv_id', $tv['id'])
                ->delete();
        }

        return redirect()->back()->with('message', 'TV show removed from your list.');
    }

    public function userList()
    {
        $userId = session()->get('id');

        $movies = $this->userMovieListModel
            ->select('movies.*')
            ->join('movies', 'movies.id = user_movie_list.movie_id')
            ->where('user_id', $userId)
            ->findAll();

        $tvs = $this->userTvListModel
            ->select('tvs.*')
            ->join('tvs', 'tvs.id = user_tv_list.tv_id')
            ->where('user_id', $userId)
            ->findAll();

        $data = [
            'movies' => $movies,
            'tvs' => $tvs,
        ];

        return view('list/list', $data);
    }
}
