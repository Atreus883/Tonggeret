<?php

use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

if (!function_exists('tmdb_api_request')) {
    function get_tmdb_api_key()
    {
        return getenv('TMDB_API_KEY');
    }
}

if (!function_exists('get_movies')) {
    function get_movies($page = 1)
    {
        $client = Services::curlrequest();
        $apiKey = get_tmdb_api_key();
        $url = "https://api.themoviedb.org/3/discover/movie";
        
        try {
            $response = $client->get($url, [
                'query' => [
                    'api_key' => $apiKey,
                    'language' => 'en-US',
                    'page' => $page
                    ]
            ]);
            
            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            log_message('error', 'Error fetching popular movies: ' . $e->getMessage());
            return null;
        }
    }
}

if (!function_exists('get_movies_similar')) {
    function get_movies_similar($movieId, $page = 1)
    {
        $client = Services::curlrequest();
        $apiKey = get_tmdb_api_key();
        $url = "https://api.themoviedb.org/3/movie/" . $movieId . "/similar";

        try {
            $response = $client->get($url, [
                'query' => [
                    'api_key' => $apiKey,
                    'language' => 'en-US',
                    'page' => $page
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            log_message('error', 'Error fetching similar movies: ' . $e->getMessage());
            return null;
        }
    }
}

if (!function_exists('get_tvs_similar')) {
    function get_tvs_similar($tvId, $page = 1)
    {
        $client = Services::curlrequest();
        $apiKey = get_tmdb_api_key();
        $url = "https://api.themoviedb.org/3/tv/" . $tvId . "/similar";

        try {
            $response = $client->get($url, [
                'query' => [
                    'api_key' => $apiKey,
                    'language' => 'en-US',
                    'page' => $page
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            log_message('error', 'Error fetching similar movies: ' . $e->getMessage());
            return null;
        }
    }
}

if (!function_exists('get_tvs')) {
    function get_tvs($page = 1)
    {
        $client = Services::curlrequest();
        $apiKey = get_tmdb_api_key();
        $url = "https://api.themoviedb.org/3/discover/tv";

        try {
            $response = $client->get($url, [
                'query' => [
                    'api_key' => $apiKey,
                    'language' => 'en-US',
                    'page' => $page
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            log_message('error', 'Error fetching popular TV: ' . $e->getMessage());
            return null;
        }
    }
}

if (!function_exists('search_movies')) {
    function search_movies($query, $page = 1)
    {
        $client = Services::curlrequest();
        $apiKey = get_tmdb_api_key();
        $url = "https://api.themoviedb.org/3/search/movie";

        try {
            $response = $client->get($url, [
                'query' => [
                    'api_key' => $apiKey,
                    'language' => 'en-US',
                    'query' => $query,
                    'page' => $page
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            log_message('error', 'Error searching movies: ' . $e->getMessage());
            return null;
        }
    }
}

if (!function_exists('search_tvs')) {
    function search_tvs($query, $page = 1)
    {
        $client = Services::curlrequest();
        $apiKey = get_tmdb_api_key();
        $url = "https://api.themoviedb.org/3/search/tv";

        try {
            $response = $client->get($url, [
                'query' => [
                    'api_key' => $apiKey,
                    'language' => 'en-US',
                    'query' => $query,
                    'page' => $page
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            log_message('error', 'Error searching tvs: ' . $e->getMessage());
            return null;
        }
    }
}

if (!function_exists('get_movie_details')) {
    function get_movie_details($movieId)
    {
        $client = Services::curlrequest();
        $apiKey = get_tmdb_api_key();
        $url = "https://api.themoviedb.org/3/movie/" . $movieId;

        try {
            $response = $client->get($url, [
                'query' => [
                    'api_key' => $apiKey,
                    'language' => 'en-US',
                    'append_to_response' => 'videos,images'
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            log_message('error', 'Error fetching movie details: ' . $e->getMessage());
            return null;
        }
    }
}

if (!function_exists('get_movie_trailers')) {
    function get_movie_trailers($movieId)
    {
        $client = Services::curlrequest();
        $apiKey = get_tmdb_api_key();
        $url = "https://api.themoviedb.org/3/movie/" . $movieId . "/videos";

        try {
            $response = $client->get($url, [
                'query' => [
                    'api_key' => $apiKey,
                    'language' => 'en-US'
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            log_message('error', 'Error fetching movie trailers: ' . $e->getMessage());
            return null;
        }
    }
}

if (!function_exists('get_tv_details')) {
    function get_tv_details($tvId)
    {
        $client = Services::curlrequest();
        $apiKey = get_tmdb_api_key();
        $url = "https://api.themoviedb.org/3/tv/" . $tvId;

        try {
            $response = $client->get($url, [
                'query' => [
                    'api_key' => $apiKey,
                    'language' => 'en-US',
                    'append_to_response' => 'videos,images'
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            log_message('error', 'Error fetching movie details: ' . $e->getMessage());
            return null;
        }
    }
}

if (!function_exists('get_movie_credits')) {
    function get_movie_credits($movieId)
    {
        $client = Services::curlrequest();
        $apiKey = get_tmdb_api_key();
        $url = "https://api.themoviedb.org/3/movie/" . $movieId . "/credits";

        try {
            $response = $client->get($url, [
                'query' => [
                    'api_key' => $apiKey,
                    'language' => 'en-US'
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            log_message('error', 'Error fetching movie credits: ' . $e->getMessage());
            return null;
        }
    }
}

if (!function_exists('get_tv_credits')) {
    function get_tv_credits($tvId)
    {
        $client = Services::curlrequest();
        $apiKey = get_tmdb_api_key();
        $url = "https://api.themoviedb.org/3/tv/" . $tvId . "/credits";

        try {
            $response = $client->get($url, [
                'query' => [
                    'api_key' => $apiKey,
                    'language' => 'en-US'
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            log_message('error', 'Error fetching movie credits: ' . $e->getMessage());
            return null;
        }
    }
}

