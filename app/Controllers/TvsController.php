<?php

namespace App\Controllers;

use App\Models\TvListModel;
use App\Models\TvReviewModel;


class TvsController extends BaseController
{
    protected $userTvListModel;
    protected $tvReviewModel;

    public function __construct()
    {
        $this->userTvListModel = new TvListModel();
        $this->tvReviewModel = new TvReviewModel();
        helper('tmdb');
    }


    public function details($id)
    {
        $userId = session()->get('id');
        $tv = get_tv_details($id);
        $credits = get_tv_credits($id);
        $similar_tvs = get_tvs_similar($id);
        $reviews = $this->tvReviewModel->getAllReviewsWithUsername($id);
        $isInList = false;
        $userReview = null;

        if ($userId) {
            $isInList = $this->userTvListModel->isTvInUserList($userId, $id);
            $userReview = $this->tvReviewModel->getUserReview($userId, $id);
        }

        $data = [
            'tv' => $tv,
            'credits' => $credits,
            'similar_tvs' => $similar_tvs,
            'tvInList' => $isInList,
            'reviews' => $reviews,
            'userReview' => $userReview,
        ];

        if (empty($data['tv'])) {
            return redirect()->to('/dashboard')->with('error', 'tv not found.');
        }

        return view('tvs/details', $data);
    }
}
