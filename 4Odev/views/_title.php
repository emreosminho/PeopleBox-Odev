<?php

// fonksiyond dahil edildi.

$ozet = count(getData()["categories"]).' kategoride '.count(getGuncelFilmler()).'  film listelenmiştir';
const baslik = "Güncel Filmler";
?>

<h1 class="mb-4"><?php echo baslik?></h1>
<p class="text-muted">
<?php echo $ozet?>
</p>