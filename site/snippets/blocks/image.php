<?php

$alt     = $block->alt();
$caption = $block->caption();
$crop    = $block->crop()->isTrue();
$link    = $block->link();
$ratio   = $block->ratio()->or('auto');
$src     = null;

if ($block->location() == 'web') {
    $src = $block->src();
} elseif ($image = $block->image()->toFile()) {
    $alt = $alt ?? $image->alt();
    $src = $image->url();
}

?>
<?php if ($src): ?>
<figure<?= attr(['data-ratio' => $ratio, 'data-crop' => $crop], ' ') ?> class="block">
  <?php if ($link->isNotEmpty()): ?>
  <a href="<?= $link->toUrl() ?>">
    <img class="block image" src="<?= $src ?>" alt="<?= $alt ?>">
  </a>
  <?php else: ?>
  <img class="block image" src="<?= $src ?>" alt="<?= $alt ?>">
  <?php endif ?>

  <?php if ($caption->isNotEmpty()): ?>
  <figcaption class="block small cap">
    <?= $caption ?>
  </figcaption>
  <?php endif ?>
</figure>
<?php endif ?>