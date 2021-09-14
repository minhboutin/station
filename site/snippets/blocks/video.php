<?php if ($block->url()->isNotEmpty()): ?>
<figure class="block video">
  <?= video($block->url()) ?>
  <?php if ($block->caption()->isNotEmpty()): ?>
  <figcaption class="block small cap"><?= $block->caption() ?></figcaption>
  <?php endif ?>
</figure>
<?php endif ?>