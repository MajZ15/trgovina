<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Trgovina</title>

<h1>Login</h1>

<p>[
<a href="<?= BASE_URL . "artikli" ?>">Back</a>
]</p>

<form action="<?= BASE_URL . "login" ?>" method="post">
    <p><label>Username: <input type="text" name="username" value="<?= $username ?>" autofocus /></label></p>
    <p><label>Password: <input type="text" name="password" value="<?= $password ?>" /></label></p>
    <p><button>Log in</button></p>
</form>