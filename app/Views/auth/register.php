<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href=<?= base_url('css/auth.css') ?>>
</head>

<body>
    <div class="body-container">

        <img src="<?= base_url('images/logo.png') ?>" alt="Logo" width="120">
        <div class="form-container">

            <form action="/register" method="post">
                <?= csrf_field() ?> <!-- CSRF Protection Token -->
                <input type="text" name="username" placeholder="Username" value="<?= old('username') ?>" required>
                <input type="email" name="email" placeholder="Email" value="<?= old('email') ?>" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Register</button>
            </form>
            <a href="/login/">Login</a>
        </div>
        <?php if (session()->has('errors')) : ?>
            <div style="color: red;">
                <?php foreach (session('errors') as $error) : ?>
                    <p><?= $error ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </div>
</body>

</html>