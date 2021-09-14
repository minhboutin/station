<?php snippet('stationgdm-header') ?>
<?php $stationgdm = $site->find('stationgdm');
	 
	  $agenda = $stationgdm->children()->find('agenda');
	  $temps_forts = $stationgdm->children()->find('temps-forts');
	  $tags = $stationgdm->children()->find('labels-tags')->tags()->split();

	  if( param('tag') == null ){ 
	  	$temps_forts_contents = $temps_forts->children()->listed()->sortBy('startdate')->filterBy('archived', false)->flip()->paginate(6);
	  } else {
	  	$temps_forts_contents = $temps_forts->children()->listed()->sortBy('startdate')->filterBy('archived', false)->filterBy('maintags', urldecode(param('tag')), ',')->flip()->paginate(6);
	  }
?>
<div class="row shadow-inset-bottom <?php if ($temps_forts_contents->isEmpty() == TRUE) { echo 'border-bottom ' ; } ?>">
	<div class="col-1 section white">
		<div class="page row section title border-bottom large bold cap">
			<a href="<?= $agenda->url() ?>"><div class="back"></div></a>
			<p>
				<?php if(param('tag') != null){ echo '' ; } else { echo 'Tous les ' ; } ?>temps forts<?php if(param('tag') != null){ echo ' : ', urldecode(param('tag')) ; } ?>
			</p>
		</div>
		<div class="filter row border-bottom small cap">
			<ul>
				<a href="<?= $page->url() ?>"><li class="all <?php if(param($key = 'tag', $default = null)){ echo '' ; } else { echo 'active' ; } ; ?>">Tout</li></a>
				<?php foreach ($tags as $tag): ?><a href="<?= $page->url() ?>/tag:<?= $tag ?>"><li <?php if( urldecode(param('tag')) == $tag){ echo 'class="active"'; } ?>><?= $tag ?></li></a><?php endforeach ?>
			</ul>
		</div>
	</div>
<?php foreach ($temps_forts_contents as $page): ?>
	<div class="col-2 white border-bottom">
		<a class="focus cell linkable shadow-right" href="<?= $page->url() ?>">
			<div class="focus poster shadow-right" <?php if ($page->posterimage()->isEmpty() == FALSE): ?>style="background-image: url(<?= $page->posterimage()->toFile()->url() ?>)"<?php endif ?>>
				<div class="focus poster ratio"></div>
				<?php if ($page->postervideo()->isEmpty() == FALSE): ?>
					<video class="video" preload autoplay muted loop>
			  			<source src="<?= $page->postervideo()->toFile()->url() ?>" type="<?= $page->postervideo()->toFile()->mime() ?>">
			  		</video><?php endif ?>
			</div>
			<?php if ($page->maintitle()->isEmpty() == FALSE): ?><div class="focus title border-bottom medium bold cap">
				<p>
					<?= $page->maintitle() ?>
				</p>
			</div><?php endif ?>
			<?php if ($page->startdate()->isEmpty() == FALSE): ?><div class="focus date border-bottom medium bold cap">
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
			<?php if ($page->mainlabels()->isEmpty() == FALSE ): ?><div class="focus tags border-bottom small cap">
				<ul><?php if ($page->mainlabels()->isEmpty() == FALSE):
						  $labels = explode(',', $page->mainlabels());
						  foreach ($labels as $label): ?>
					<li class="labels"><?= $label ?></li><?php endforeach; endif ?>
				</ul>
			</div><?php endif ?>
		</a>
	</div><?php endforeach ?>

	<?php if ($temps_forts_contents->isEmpty() == TRUE): ?><div class="empty row white medium-small">
		<p>
			Pas de temps fort.
		</p>
	</div><?php endif ?>

</div>

<?php if ($temps_forts_contents->pagination()->hasPages()): ?>
<?php $pagination = $temps_forts_contents->pagination() ?>
<div id="pagination" class="row">
	<div class="col-1 white">
		<div class="row separator border-bottom"></div>
		<div class="pagination row border-bottom medium-small">
			<ul>
				<?php if ($pagination->hasPrevPage()): ?>
				<a href="<?= $pagination->prevPageURL() ?>"><li class="previous"></li></a>
				<?php endif ?>

				<?php foreach ($pagination->range(5) as $key => $r): ?>
				<li>
					<a <?= $pagination->page() === $r ? 'aria-current="page" class="active" ' : ' class=""' ?> href="<?= $pagination->pageURL($r) ?>"><?= $r ?></a>
				</li>
				<?php $range = $pagination->range(5) ?>
				<?php if ($key === end($range) && $r < $pagination->lastPage()): ?>
					<li>
					...
					</li>
				<?php endif ?>
				<?php endforeach ?>

				<?php if ($pagination->hasNextPage()): ?>
				<a href="<?= $pagination->nextPageURL() ?>"><li class="next"></li></a>
				<?php endif ?>
			</ul>
		</div>
	</div>
</div>
<?php endif ?>

<?php snippet('stationgdm-footer'); ?>