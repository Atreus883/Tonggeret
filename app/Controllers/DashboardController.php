<?php

namespace App\Controllers;

use App\Models\MovieModel;
use App\Models\TvModel;

class DashboardController extends BaseController
{
    protected $moviesController;
    protected $movieModel;
    protected $topRatedMovies;
    protected $tvModel;
    protected $topRatedTvs;
    public function __construct()
    {
        $this->movieModel = new MovieModel();
        $this->tvModel = new TvModel();
        helper('tmdb');
    }

    public function index()
    {
        // =================================================================
        // KODE BARU UNTUK MEMBUAT SESI PALSU (UNTUK PORTOFOLIO)
        // =================================================================

        // Cek jika sesi 'logged_in' belum ada atau false
        if (!session()->get('logged_in')) {
            // Buat data user palsu untuk ditampilkan di dashboard
            $fakeUserData = [
                'id'         => 999, // ID fiktif
                'username'   => 'admin',
                'logged_in'  => true,
            ];

            // Simpan data palsu ke dalam sesi
            session()->set($fakeUserData);
        }

        // =================================================================
        // AKHIR DARI KODE BARU
        // =================================================================


        // Kode asli Anda di bawah ini akan tetap berjalan normal
        $query = $this->request->getGet('query');


        if ($query) {
            $movies = search_movies($query);
            $tvs    = search_tvs($query);
        } else {
            $movies = get_movies();
            $tvs    = get_tvs();
            $topRatedMovies = $this->movieModel->topRatedMovies();
        }

        $topRatedMovies = $this->movieModel->topRatedMovies();
        $topRatedTvs = $this->tvModel->topRatedTvs();

        $data = [
            'username' => session()->get('username'),
            'id'       => session()->get('id'),
            'movies' => $movies,
            'topRatedMovies' => $topRatedMovies,
            'topRatedTvs' => $topRatedTvs,
            'tvs'   => $tvs,
            'query' => $query
        ];

        return view('dashboard', $data);
    }
}