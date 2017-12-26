<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Library</title>

<h1>Vsi artikli</h1>

<p>[
<a href="<?= BASE_URL . "artikli" ?>">Vsi artikli</a>
]</p>

<ul>

    <?php foreach ($artikli as $artikel): ?>
        <li><a><?= $artikel["idartikel"] ?>. <?= $artikel["naziv"] ?>: 
        	<?= $artikel["cena"] ?></a></li>
    <?php endforeach; ?>

</ul>
