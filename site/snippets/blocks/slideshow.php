<div class="block slideshow">

  <div class="slider-wrapper">
    <?php
    $images = $block->slideshowsimages()->sortBy('sort')->toFiles();
    $i=0;
    foreach($images as $image):
    $i++;
     ?>

    <div class="sp <?php if($i == 1): echo 'active';endif;?>">
      <img src="<?= $image->url() ?>" 
         class="">
    </div>
    <?php endforeach ?>

  </div>

  <div class="half left">
    <div class="previous">
    </div>
  </div>
  <div class="half right">
    <div class="next">
    </div>
  </div>

</div>