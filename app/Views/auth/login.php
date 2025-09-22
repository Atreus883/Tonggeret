<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href=<?= base_url('css/auth.css') ?>>
</head>

<body>
    <div class="body-container">
        <img src="<?= base_url('images/logo.png') ?>" alt="Logo" width="120">
        <?php if (session()->get('error')) : ?>
            <p style="color:red;"><?= session('error') ?></p>
        <?php endif ?>
        <div class="form-container">

            <form action="/login" method="post">
                <?= csrf_field() ?> <!-- CSRF Protection Token -->
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
            <a href="/register/">Register</a>
        </div>
    </div>
</body>

</html>