<div class="block button small bold cap">
  <ul>
  	<?php if( $block->link1()->isEmpty() == FALSE ): ?>
  	<a href="<?= $block->link1()->url() ?>" target="_blank"><li><?= $block->linktext1() ?></li></a>
  	<?php endif ?>
  	<?php if( $block->link2()->isEmpty() == FALSE ): ?>
  	<a href="<?= $block->link2()->url() ?>" target="_blank"><li><?= $block->linktext2() ?></li></a>
  	<?php endif ?>
  	<?php if( $block->link3()->isEmpty() == FALSE ): ?>
  	<a href="<?= $block->link3()->url() ?>" target="_blank"><li><?= $block->linktext3() ?></li></a>
  	<?php endif ?>
  	<?php if( $block->link4()->isEmpty() == FALSE ): ?>
  	<a href="<?= $block->link4()->url() ?>" target="_blank"><li><?= $block->linktext4() ?></li></a>
  	<?php endif ?>
  	<?php if( $block->link5()->isEmpty() == FALSE ): ?>
  	<a href="<?= $block->link5()->url() ?>" target="_blank"><li><?= $block->linktext5() ?></li></a>
  	<?php endif ?>
  	<?php if( $block->link6()->isEmpty() == FALSE ): ?>
  	<a href="<?= $block->link6()->url() ?>" target="_blank"><li><?= $block->linktext6() ?></li></a>
  	<?php endif ?>
  </ul>
</div>