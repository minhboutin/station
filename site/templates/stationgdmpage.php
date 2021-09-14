<?php snippet('stationgdm-header') ?>

<div class="row">
	<div class="col-1 section white">
		<?php if ($page->maintitle()->isEmpty() == FALSE): ?><div class="page section title border-bottom large bold cap">
			<p>
				<?= $page->maintitle() ?>
			</p>
		</div><?php endif ?>
		<?php if ($page->startdate()->isEmpty() == FALSE): ?><div class="page date border-bottom medium bold cap">
					<p><?php $startday = $page->startdate()->toDate('d');
							 $month = $page->startdate()->toDate('m');
							 $year = $page->startdate()->toDate('y');
							 if( $page->enddate()->isEmpty() == FALSE ){
							 	$endday = $page->enddate()->toDate('d');
							 	$day = $startday . '–' . $endday;
							 }
							 if( $page->enddate()->isEmpty() == TRUE ) {
							 	$day = $startday; } ?>
						<?= $day ?>.<?= $month ?>.<?= $year ?>
					</p>
		</div><?php endif ?>
		<?php if ($page->maintags()->isEmpty() == FALSE || $page->mainlabels()->isEmpty() == FALSE ): ?><div class="page tags border-bottom small cap">
			<ul><?php if ($page->mainlabels()->isEmpty() == FALSE):
					  $labels = explode(',', $page->mainlabels());
					  foreach ($labels as $label): ?>
				<a class="labels" href="<?= $site->find('stationgdm')->url() ?>/tag:<?= $label ?>">
					<li class="labels">
						<?= $label ?>
					</li>
				</a><?php endforeach; endif ?>
				<?php if ($page->maintags()->isEmpty() == FALSE):
					  $tags = explode(',', $page->maintags());
					  foreach ($tags as $tag): ?>
				<a class="tags" href="<?= $site->find('stationgdm')->url() ?>/tag:<?= $tag ?>">
					<li class="tags">
						<?= $tag ?>
					</li>
				</a><?php endforeach; endif ?>
			</ul>
		</div><?php endif ?>
	</div>
</div>

<?php if ($page->children()->isEmpty() == FALSE):
	  foreach ($page->children() as $contents): ?>
<div class="row">
	<?php if ($contents->template() == 'block2x2'): ?>
		<div class="col-2 white border-bottom">
			<div class="block container"><?php if ($contents->blockimage()->isEmpty() == FALSE): ?>
				<?php if ($contents->blockimage()->toFiles()->count() == 1): ?>
				<div class="block image">
					<img src="<?= $contents->blockimage()->toFile()->url() ?>">
				</div>
				<?php endif ?>
				<?php if ($contents->blockimage()->toFiles()->count() > 1): ?>
				<div class="block slideshow">
					<div class="slider-wrapper">
						<?php
						$images = $contents->blockimage()->sortBy('sort')->toFiles();
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
				<?php endif ?>
			<?php endif ?></div>
		</div>
		<div class="col-2 white border-bottom">
		<?php foreach ($contents->contents()->toBlocks() as $block): ?>
			<div id="<?= $block->id() ?>" class="component block2x2 border-bottom">
			  <?= $block ?>
			</div>
		<?php endforeach ?>
		</div>
		<div class="row separator border-bottom"></div>
	<?php endif ?>
	<?php if ($contents->template() == 'block1x1'): ?>
		<div class="col-1 white border-bottom">
		<?php foreach ($contents->contents()->toBlocks() as $block): ?>
			<div id="<?= $block->id() ?>" class="component block1x1 border-bottom">
			  <?= $block ?>
			</div>
		<?php endforeach ?>
		</div>
		<div class="row separator border-bottom"></div>
	<?php endif ?>
	<?php if ($contents->template() == 'stationgdmblocklist'): ?>
		<div class="col-1 section white">
			<?php if ($contents->listtitle()->isEmpty() == FALSE): ?><div class="section title border-bottom large bold cap">
				<p>
					<?= $contents->listtitle() ?>
				</p>
			</div><?php endif ?>
			<div class="list section">
				<?php $listed_contents = $contents->listselection()->toPages(); 
					  foreach ($listed_contents as $content):?><a href="<?= $content->url() ?>">
				<div class="row list-block  border-bottom">
					<div class="col-3-2 row">
						<div class="list space border-right">
							<div class="puce border-bottom"></div>
						</div>
						<div class="list content">
							<div class="list title border-bottom medium bold cap">
								<p><?= $content->maintitle() ?></p>
							</div>
							<?php if ($content->startdate()->isEmpty() == FALSE ): ?><div class="list date border-bottom medium bold cap">
								<p><?php $startday = $content->startdate()->toDate('d');
										 $month = $content->startdate()->toDate('m');
										 $year = $content->startdate()->toDate('y');
										 if( $content->enddate()->isEmpty() == FALSE ){
										 	$endday = $content->enddate()->toDate('d');
										 	$day = $startday . '–' . $endday;
										 }
										 if( $content->enddate()->isEmpty() == TRUE ) {
										 	$day = $startday; } ?>
									<?= $day ?>.<?= $month ?>.<?= $year ?>
								</p>
							</div><?php endif ?>
							<?php if($content->mainauteur()->isEmpty() == FALSE): ?><div class="list description border-bottom medium-small">
								<p>Par <?= $content->mainauteur() ?></p>
							</div><?php endif ?>
							<?php if($content->description()->isEmpty() == FALSE): ?><div class="list description medium-small">
								<p><?= $content->description() ?></p>
							</div><?php endif ?>
						</div>
					</div>
					<div class="col-3 list image border-left" <?php if ($content->posterimage()->isEmpty() == FALSE): ?>style="background-image: url(<?= $content->posterimage()->toFile()->url() ?>)"<?php endif ?>>
						<div class="poster ratio"></div>
					</div>
				</div>
				</a><?php endforeach ?>
			</div>
			<div class="row separator border-bottom"></div>
		</div>
	<?php endif ?>
	<?php if ($contents->template() == 'stationgdmblockfeed'): ?>
		<div class="col-1 section">
			<?php if ($contents->feedtitle()->isEmpty() == FALSE): ?><div class="section title border-bottom large bold cap">
				<p>
					<?= $contents->feedtitle() ?>
				</p>
			</div><?php endif ?>
			<div class="feed section">
				<div class="row feed block border-bottom"><?php 
					if($contents->feedautoselection() == 'none'){
	  			  		$feed_contents = $contents->feedmanualselection()->toPages(); } ;
	  			    if($contents->feedautoselection() == 'filter'){
			  			$tag_filter = $contents->feedtagfilter()->split(',');
			  			$label_filter = $contents->feedlabelfilter()->split(',');
			  			$theme_filter = $contents->feedlabelfilter()->split(',');

			  			$all_contents = $site->children()->find('stationgdm')->children()->find('rendez-vous', 'temps-forts', 'journal', 'pages')->children()->listed();
			  			$feed_contents = new Collection();

		  			    $feed_contents_filtered_by_tag = $all_contents->filterBy('maintags', 'in', $tag_filter);
		  			    $feed_contents->add($feed_contents_filtered_by_tag);

		  			    $feed_contents_filtered_by_label = $all_contents->filterBy('mainlabels', 'in', $label_filter);
		  			    $feed_contents->add($feed_contents_filtered_by_label);

		  			    $feed_contents_filtered_by_theme = $all_contents->filterBy('mainthemes', 'in', $theme_filter);
		  			    $feed_contents->add($feed_contents_filtered_by_theme);
	  			  	};
	  			    foreach($feed_contents as $feed_content): ?><div class="feed col-4 white shadow-bottom-right">
						<a class="card cell linkable" href="<?= $feed_content->url() ?>">
							<div class="card poster" <?php if ($feed_content->posterimage()->isEmpty() == FALSE): ?>style="background-image: url(<?= $feed_content->posterimage()->toFile()->url() ?>)"<?php endif ?>>
								<div class="card poster ratio"></div>
								<?php if ($feed_content->postervideo()->isEmpty() == FALSE): ?>
								<video class="video" preload autoplay muted loop>
						  			<source src="<?= $feed_content->postervideo()->toFile()->url() ?>" type="<?= $feed_content->postervideo()->toFile()->mime() ?>">
						  		</video><?php endif ?>
							</div>
							<div class="card title medium bold cap">
								<p>
									<?= $feed_content->maintitle() ?>
								</p>
							</div>
							<?php if ($feed_content->startdate()->isEmpty() == FALSE && $contents->feeddate()->toBool() == TRUE ): ?><div class="card date medium bold cap">
								<p><?php $startday = $feed_content->startdate()->toDate('d');
										 $month = $feed_content->startdate()->toDate('m');
										 $year = $feed_content->startdate()->toDate('y');
										 if( $feed_content->enddate()->isEmpty() == FALSE ){
										 	$endday = $feed_content->enddate()->toDate('d');
										 	$day = $startday . '–' . $endday;
										 }
										 if( $feed_content->enddate()->isEmpty() == TRUE ) {
										 	$day = $startday; } ?>
									<?= $day ?>.<?= $month ?>.<?= $year ?>
								</p>
							</div><?php endif ?>
							<?php if ($contents->feedlabels()->toBool() == TRUE): ?><div class="card tags small cap">
								<ul><?php if ($feed_content->mainlabels()->isEmpty() == FALSE && $contents->feedlabels()->toBool() == TRUE):
										  $labels = explode(',', $feed_content->mainlabels());
										  foreach ($labels as $label): ?>
									<li class="labels"><?= $label ?></li><?php endforeach; endif ?>
									<?php if ($feed_content->mainthemes()->isEmpty() == FALSE && $contents->feedlabels()->toBool() == TRUE):
										  $themes = explode(',', $feed_content->mainthemes());
										  foreach ($themes as $theme): ?>
									<li class="labels"><?= $theme ?></li><?php endforeach; endif ?>
									<?php if ($feed_content->maintags()->isEmpty() == FALSE && $contents->feedtags()->toBool() == TRUE):
										  $tags = explode(',', $feed_content->maintags());
										  foreach ($tags as $tag): ?>
									<li class="tags"><?= $tag ?></li><?php endforeach; endif ?>
								</ul>
							</div><?php endif ?>
						</a>
					</div><?php endforeach ?>
				</div>
			</div>
			<div class="row separator border-bottom"></div>
		</div>
	<?php endif ?>
</div>
<?php endforeach; endif ?>

<?php snippet('stationgdm-footer') ?>
