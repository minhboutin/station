<?php snippet('stationgdm-header') ?>
<?php $stationgdm = $site->find('stationgdm');
	  
	  $agenda = $stationgdm->children()->find('agenda');

	  $all_contents = $stationgdm->children()->find('rendez-vous', 'temps-forts', 'journal', 'pages');
	  $tags = $stationgdm->children()->find('labels-tags')->tags()->split();
	  if( param('tag') == null ){ 
	  	$archives = $all_contents->children()->listed()->sortBy('startdate')->filterBy('archived', true)->flip()->paginate(16);
	  } else {
	  	$archives = $all_contents->children()->listed()->sortBy('startdate')->filterBy('archived', true)->filterBy('maintags', urldecode(param('tag')), ',')->flip()->paginate(16);
	  }
?>
<div class="row border-bottom">
	<div class="col-1 section white">
		<div class="page row section title border-bottom large bold cap">
			<a href="<?= $agenda->url() ?>"><div class="back"></div></a>
			<p>
				<?php if(param('tag') != null){ echo '' ; } else { echo 'Toutes les ' ; } ?>archives<?php if(param('tag') != null){ echo ' : ', urldecode(param('tag')) ; } ?>
			</p>
		</div>
		<div class="filter row border-bottom small cap">
			<ul>
				<a href="<?= $page->url() ?>"><li class="all <?php if(param($key = 'tag', $default = null)){ echo '' ; } else { echo 'active' ; } ; ?>">Tout</li></a>
				<?php foreach ($tags as $tag): ?><a href="<?= $page->url() ?>/tag:<?= $tag ?>"><li <?php if( urldecode(param('tag')) == $tag){ echo 'class="active"'; } ?>><?= $tag ?></li></a><?php endforeach ?>
			</ul>
		</div>
	</div>
	<?php foreach ($archives as $archive): ?><div class="actu col-4 white shadow-bottom-right">
		<a class="card cell linkable" href="<?= $archive->url() ?>">
			<div class="card poster" <?php if ($archive->posterimage()->isEmpty() == FALSE): ?>style="background-image: url(<?= $archive->posterimage()->toFile()->url() ?>)"<?php endif ?>>
				<div class="card poster ratio"></div>
				<?php if ($archive->postervideo()->isEmpty() == FALSE): ?>
					<video class="video" preload autoplay muted loop>
			  			<source src="<?= $archive->postervideo()->toFile()->url() ?>" type="<?= $archive->postervideo()->toFile()->mime() ?>">
			  		</video><?php endif ?>
			</div>
			<div class="card title medium bold cap">
				<p>
					<?= $archive->maintitle() ?>
				</p>
			</div>
			<?php if ($archive->startdate()->isEmpty() == FALSE): ?><div class="card date medium bold cap">
				<p><?php $startday = $archive->startdate()->toDate('d');
						 $month = $archive->startdate()->toDate('m');
						 $year = $archive->startdate()->toDate('y');
						 if( $archive->enddate()->isEmpty() == FALSE ){
						 	$endday = $archive->enddate()->toDate('d');
						 	$day = $startday . '–' . $endday;
						 }
						 if( $archive->enddate()->isEmpty() == TRUE ) {
						 	$day = $startday; } ?>
					<?= $day ?>.<?= $month ?>.<?= $year ?>
				</p>
			</div><?php endif ?>
			<?php if ($archive->mainlabels()->isEmpty() == FALSE || $archive->mainthemes()->isEmpty()): ?><div class="card tags small cap">
				<ul><?php if ($archive->mainlabels()->isEmpty() == FALSE || $archive->mainthemes()->isEmpty() ):
						  $labels = explode(',', $archive->mainlabels());
						  $themes = explode(',', $archive->mainthemes()); ?>
					<?php foreach ($labels as $label): ?><li class="labels"><?= $label ?></li><?php endforeach ?>
					<?php foreach ($themes as $theme): ?><li class="labels"><?= $theme ?></li><?php endforeach ?>
					<?php endif ?>
				</ul>
			</div><?php endif ?>
		</a>
	</div><?php endforeach ?>

	<?php if ($archives->isEmpty() == TRUE): ?><div class="empty row white medium-small">
		<p>
			Pas d'archive.
		</p>
	</div><?php endif ?>

</div>

<?php if ($archives->pagination()->hasPages()): ?>
<?php $pagination = $archives->pagination() ?>
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