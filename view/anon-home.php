<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Trgovina</title>

<h1>Trgovina</h1>

<h2>Artikli</h2>

<p>[
<a href="<?= BASE_URL . "login" ?>">Login</a>
]</p>

<ul>

    <?php foreach ($artikli as $artikel): ?>
        <li><a href="<?= BASE_URL . "artikli/" . $artikel["idartikel"] ?>"><?= $artikel["naziv"] ?>: 
        	<?= $artikel["cena"] ?> (<?= $artikel["prodajalec_idprodajalec"] ?>)</a></li>
    <?php endforeach; ?>

</ul>
