<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href=<?= base_url('css/styles.css') ?>>
</head>

<body>
    <?php echo view('navbar/navbar'); ?>
    <h2>Movies</h2>

    <?php if (!empty($movies)): ?>
        <div class="movie-list">
            <?php foreach ($movies as $movie): ?>
                <?php if (!empty($movie['poster_url'])): ?>
                    <div class="movie-item">
                        <a href="/movies/details/<?= esc($movie['tmdb_id']) ?>">
                            <img
                                class="movie-poster"
                                src="https://image.tmdb.org/t/p/original<?= esc($movie['poster_url']) ?>"
                                alt="<?= esc($movie['title']) ?> Poster">
                        </a>
                        <h3>
                            <a href="/movies/details/<?= esc($movie['tmdb_id']) ?>">
                                <?= esc($movie['title']) ?>
                            </a>
                        </h3>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="plist">No movies found.</p>
    <?php endif; ?>

    <h2>TV SHOWS</h2>
    <?php if (!empty($tvs)): ?>
        <div class="tv-list">
            <?php foreach ($tvs as $tv): ?>
                <?php if (!empty($tv['poster_url'])): ?>
                    <div class="tv-item">
                        <a href="/tvs/details/<?= esc($tv['tmdb_id']) ?>">
                            <img
                                class="tv-poster"
                                src="https://image.tmdb.org/t/p/original<?= esc($tv['poster_url']) ?>"
                                alt="<?= esc($tv['original_name']) ?> Poster">
                        </a>
                        <h3>
                            <a href="/tvs/details/<?= esc($tv['tmdb_id']) ?>">
                                <?= esc($tv['original_name']) ?>
                            </a>
                        </h3>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="plist">No tv shows found.</p>
    <?php endif; ?>
</body>

</html>