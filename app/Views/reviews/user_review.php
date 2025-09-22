<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Reviews</title>
    <link rel="stylesheet" href=<?= base_url('css/styles.css') ?>>
</head>

<body>
    <?php echo view('navbar/navbar'); ?>
    <div class="container">
        <h2>Movies Reviews</h2>
        <?php if (!empty($movies)): ?>
            <div class="review-list">
                <?php foreach ($movies as $movie): ?>
                    <div class="review-item">
                        <a href="/movies/details/<?= esc($movie['tmdb_id']) ?>">
                            <img class="poster"
                                src="https://image.tmdb.org/t/p/w500<?= esc($movie['poster_url']) ?>"
                                alt="<?= esc($movie['title']) ?> Poster">
                        </a>
                        <div class="hover-content">
                            <h3>
                                <a href="/movies/details/<?= esc($movie['tmdb_id']) ?>">
                                    <?= esc($movie['title']) ?>
                                </a>
                            </h3>
                            <div class="rating">
                                Rating: <strong><?= esc($movie['rating']) ?></strong>/10
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="plist">Kamu Belum Review Movie Apapun <span>😢</span></p>
        <?php endif; ?>

        <h2>TV Shows Reviews</h2>
        <?php if (!empty($tvs)): ?>
            <div class="review-list">
                <?php foreach ($tvs as $tv): ?>
                    <div class="review-item">
                        <a href="/tvs/details/<?= esc($tv['tmdb_id']) ?>">
                            <img class="poster"
                                src="https://image.tmdb.org/t/p/w500<?= esc($tv['poster_url']) ?>"
                                alt="<?= esc($tv['original_name']) ?> Poster">
                        </a>
                        <div class="hover-content">
                            <h3>
                                <a href="/tvs/details/<?= esc($tv['tmdb_id']) ?>">
                                    <?= esc($tv['original_name']) ?>
                                </a>
                            </h3>
                            <div class="rating">
                                Rating: <strong><?= esc($tv['rating']) ?></strong>/10
                            </div>
                        </div>
                        <?php if (!empty($tv['review'])): ?>
                            <p class="review-text"><?= esc($tv['review']) ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="plist">Kamu Belum Review TV Show Apapun <span>😢</span></p>
        <?php endif; ?>
    </div>
</body>

</html>