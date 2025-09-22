<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= esc($tv['original_name']) ?> - TV Details</title>
    <link rel="stylesheet" href=<?= base_url('css/styles.css') ?>>
</head>

<body>
    <?= view('navbar/navbar') ?>

    <div class="movie-details">

        <?php if (!empty($tv['poster_path'])): ?>
            <div class="poster-container">
                <img src="https://image.tmdb.org/t/p/w500<?= esc($tv['poster_path']) ?>"
                    alt="<?= esc($tv['original_name']) ?> Poster">
            </div>
        <?php endif; ?>

        <?php if (!empty($tv['backdrop_path'])): ?>
            <div class="backdrop-container">
                <img src="https://image.tmdb.org/t/p/w780<?= esc($tv['backdrop_path']) ?>"
                    alt="<?= esc($tv['original_name']) ?> Backdrop">
            </div>
        <?php endif; ?>

        <h1>
            <?= esc($tv['original_name']) ?>
            <p class="release-date"><?= esc($tv['first_air_date']) ?></p>
            <?php if (!empty($credits['crew'])): ?>
                <?php
                $director = null;
                foreach ($credits['crew'] as $crewMember) {
                    if ($crewMember['job'] === 'Director') {
                        $director = $crewMember['name'];
                        break;
                    }
                }
                ?>
                <?php if ($director): ?>
                    <p class="director"><strong>Director:</strong> <?= esc($director) ?></p>
                <?php endif; ?>
            <?php endif; ?>
        </h1>

        <div class="overview">
            <p><strong>Overview:</strong> <?= esc($tv['overview']) ?></p>
        </div>

        <section class="trailer-section">
            <h2>Trailer</h2>
            <?php
            $trailers = $movie['videos']['results'] ?? [];
            $youtubeTrailer = null;

            if (!empty($trailers)) {
                foreach ($trailers as $trailer) {
                    if ($trailer['site'] === 'YouTube') {
                        $youtubeTrailer = $trailer;
                        break;
                    }
                }
            }
            ?>
            <?php if ($youtubeTrailer): ?>
                <div class="trailer">
                    <iframe
                        width="560"
                        height="315"
                        src="https://www.youtube.com/embed/<?= esc($youtubeTrailer['key']) ?>"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>
            <?php else: ?>
                <p class="no-trailer">No trailer available.</p>
            <?php endif; ?>
        </section>

        <div class="movie-actions">
            <?php if ($tvInList): ?>
                <a href="/tvs/remove-from-list/<?= esc($tv['id']) ?>">Remove from My List</a>
            <?php else: ?>
                <a href="/tvs/add-to-list/<?= esc($tv['id']) ?>">Add to My List</a>
            <?php endif; ?>
        </div>

        <?php if (!empty($credits['cast'])): ?>
            <section class="cast-section">
                <h2>Cast</h2>
                <div class="cast-list">
                    <?php foreach (array_slice($credits['cast'], 0, 10) as $castMember): ?>
                        <div class="cast-item">
                            <?php if (!empty($castMember['profile_path'])): ?>
                                <img src="https://image.tmdb.org/t/p/w185<?= esc($castMember['profile_path']) ?>"
                                    alt="<?= esc($castMember['name']) ?>">
                            <?php else: ?>
                                <img src="https://via.placeholder.com/100?text=No+Image"
                                    alt="No Image Available">
                            <?php endif; ?>
                            <p><strong><?= esc($castMember['name']) ?></strong></p>
                            <p>as <?= esc($castMember['character']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <section class="reviews-section">
            <h2>Reviews</h2>
            <div class="reviews-container">
                <div class="review-form">
                    <div class="review-form-header">
                        <h3><?= isset($userReview) ? 'Edit Your Review' : 'Write a Review' ?></h3>
                        <p>Share your thoughts about <?= esc($tv['original_name']) ?></p>
                    </div>
                    <?php if ($userReview): ?>
                        <form action="/reviews/editTvReview/<?= esc($userReview['id']) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="tmdb_id" value="<?= esc($tv['id']) ?>">
                            <label>Your Rating</label>
                            <div class="star-rating">
                                <span class="star-rating-value"></span>
                                <div class="star-rating-stars">
                                    <?php for ($i = 10; $i >= 1; $i--): ?>
                                        <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" <?= isset($userReview) && $userReview['rating'] == $i ? 'checked' : '' ?>>
                                        <label for="star<?= $i ?>">★</label>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <label for="review_text">Your Review</label>
                            <textarea name="review_text" placeholder="What did you think about the TV show?" required><?= esc($userReview['review_text']) ?></textarea>
                            <button type="submit">Update Review</button>
                            <button type="submit" class="delete-review" form="deleteForm">Delete Review</button>
                        </form>
                        <form id="deleteForm" action="/reviews/deleteTvReview/<?= esc($userReview['id']) ?>" method="post">
                            <?= csrf_field() ?>
                        </form>
                    <?php else: ?>
                        <form action="/reviews/addTvReview/<?= esc($tv['id']) ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="tmdb_id" value="<?= esc($tv['id']) ?>">
                            <div class="star-rating">
                                <span class="star-rating-value"></span>
                                <div class="star-rating-stars">
                                    <?php for ($i = 10; $i >= 1; $i--): ?>
                                        <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" required>
                                        <label for="star<?= $i ?>">★</label>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <label for="review_text">Your Review</label>
                            <textarea name="review_text" placeholder="What did you think about the TV show?" required></textarea>
                            <button type="submit">Submit Review</button>
                        </form>
                    <?php endif; ?>
                </div>

                <div class="reviews-list">
                    <?php if (!empty($reviews)): ?>
                        <?php foreach ($reviews as $review): ?>
                            <?php if (!isset($userReview) || $review['user_id'] !== $userReview['user_id']): ?>
                                <div class="review">
                                    <p class="review-author"><?= esc($review['username']) ?></p>
                                    <p class="rating"><strong>Rating:</strong> <?= esc($review['rating']) ?>/10</p>
                                    <p class="review-text"><?= esc($review['review_text']) ?></p>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="no-reviews">No reviews yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="similar-movies">
            <h2>Similar TVs</h2>
            <?php if (!empty($similar_tvs['results'])): ?>
                <div class="movie-list">
                    <?php foreach ($similar_tvs['results'] as $similar_tv): ?>
                        <?php if (!empty($similar_tv['poster_path'])): ?>
                            <div class="movie-item">
                                <a href="/tvs/details/<?= esc($similar_tv['id']) ?>">
                                    <img class="movie-poster"
                                        src="https://image.tmdb.org/t/p/original<?= esc($similar_tv['poster_path']) ?>"
                                        alt="<?= esc($similar_tv['original_name']) ?> Poster">
                                </a>
                                <h3>
                                    <a href="/tvs/details/<?= esc($similar_tv['id']) ?>">
                                        <?= esc($similar_tv['original_name']) ?>
                                    </a>
                                </h3>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="no-similar">No similar TVs found.</p>
            <?php endif; ?>
        </section>
    </div>
    <script src="<?= base_url('js/script.js') ?>"></script>
</body>

</html>