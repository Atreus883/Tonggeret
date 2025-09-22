<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href=<?= base_url('css/styles.css') ?>>
</head>

<body>
    <?php include('navbar/navbar.php'); ?>
    <?php if (!empty($topRatedMovies) && empty($query)): ?>
        <h2>Top Rated Movies</h2>
        <div class="movie-list">
            <?php foreach ($topRatedMovies as $movie): ?>
                <div class="movie-item">
                    <a href="/movies/details/<?= esc($movie['tmdb_id']) ?>">
                        <img
                            class="movie-poster"
                            src="https://image.tmdb.org/t/p/w500<?= esc($movie['poster_url']) ?>"
                            alt="<?= esc($movie['title']) ?> Poster">
                    </a>
                    <h3>
                        <a href="/movies/details/<?= esc($movie['tmdb_id']) ?>">
                            <?= esc($movie['title']) ?>
                        </a>
                    </h3>
                    <p>Rating: <?= number_format(esc($movie['average_rating']), 1) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <h2>Movies</h2>
    <?php if (!empty($movies['results'])): ?>
        <div class="movie-list <?= !empty($query) ? 'no-scroll' : '' ?>">
            <?php foreach ($movies['results'] as $movie): ?>
                <?php if (!empty($movie['poster_path'])): ?>
                    <div class="movie-item">
                        <a href="/movies/details/<?= esc($movie['id']) ?>">
                            <img
                                class="movie-poster"
                                src="https://image.tmdb.org/t/p/original<?= esc($movie['poster_path']) ?>"
                                alt="<?= esc($movie['title']) ?> Poster">
                        </a>
                        <h3>
                            <a href="/movies/details/<?= esc($movie['id']) ?>">
                                <?= esc($movie['title']) ?>
                            </a>
                        </h3>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No movies found.</p>
    <?php endif; ?>

    <?php if (!empty($topRatedTvs) && empty($query)): ?>
        <h2>Top Rated TVs</h2>
        <div class="tv-list">
            <?php foreach ($topRatedTvs as $tv): ?>
                <div class="tv-item">
                    <a href="/tvs/details/<?= esc($tv['tmdb_id']) ?>">
                        <img
                            class="tv-poster"
                            src="https://image.tmdb.org/t/p/w500<?= esc($tv['poster_url']) ?>"
                            alt="<?= esc($tv['original_name']) ?> Poster">
                    </a>
                    <h3>
                        <a href="/tvs/details/<?= esc($tv['tmdb_id']) ?>">
                            <?= esc($tv['original_name']) ?>
                        </a>
                    </h3>
                    <p>Rating: <?= number_format(esc($tv['average_rating']), 1) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <h2>TV SHOWS</h2>
    <?php if (!empty($tvs['results'])): ?>
        <div class="tv-list <?= !empty($query) ? 'no-scroll' : '' ?>">
            <?php foreach ($tvs['results'] as $tv): ?>
                <?php if (!empty($tv['poster_path'])): ?>
                    <div class="tv-item">
                        <a href="/tvs/details/<?= esc($tv['id']) ?>">
                            <img
                                class="tv-poster"
                                src="https://image.tmdb.org/t/p/original<?= esc($tv['poster_path']) ?>"
                                alt="<?= esc($tv['original_name']) ?> Poster">
                        </a>
                        <h3>
                            <a href="/tvs/details/<?= esc($tv['id']) ?>">
                                <?= esc($tv['original_name']) ?>
                            </a>
                        </h3>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No tvs found.</p>
    <?php endif; ?>
</body>

</html>