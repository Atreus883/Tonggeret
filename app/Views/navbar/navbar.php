<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <nav class="navbar">
        <ul class="navbar-left">
            <div class="logo-tonggeret">
                <li><a href="/dashboard"><img src="<?= base_url('images/logo.png') ?>" alt="Logo" width="120"></a></li>
            </div>
            <li><a href="/list">List</a></li>
            <li><a href="/reviews">My Review</a></li>
        </ul>
        <ul class="navbar-right">
            <li class="search-container">
                <form action="/dashboard" method="get" class="search-form">
                    <?= csrf_field() ?>
                    <?php $query = isset($query) ? $query : ''; ?>
                    <input type="text" name="query" placeholder="Search for a movie" value="<?= esc($query) ?>">
                    <button id="search-btn" type="submit">Search</button>
                </form>
            </li>
            <li class="user-dropdown">
                <?php $username = session()->get('username'); ?>
                <span class="username">Hi, <?= esc($username) ?></span>
            </li>
            <a href="/logout" class="logout-btn">Logout</a>
        </ul>
    </nav>
</body>

</html>