<?php snippet('stationgdm-header') ?>
<?php $stationgdm = $site->find('stationgdm');
	 
	  $agenda = $stationgdm->children()->find('agenda');
	  $rendez_vous = $stationgdm->children()->find('rendez-vous');
	  $tags = $stationgdm->children()->find('labels-tags')->tags()->split();
	  if( param('tag') == null ){ 
	  	$rendez_vous_contents = $rendez_vous->children()->listed()->sortBy('startdate')->filterBy('archived', false)->flip()->paginate(16);
	  } else {
	  	$rendez_vous_contents = $rendez_vous->children()->listed()->sortBy('startdate')->filterBy('archived', false)->filterBy('maintags', urldecode(param('tag')), ',')->flip()->paginate(16);
	  }
?>
<div class="row border-bottom">
	<div class="col-1 section white">
		<div class="page row section title border-bottom large bold cap">
			<a href="<?= $agenda->url() ?>"><div class="back"></div></a>
			<p>
				<?php if(param('tag') != null){ echo '' ; } else { echo 'Tous les ' ; } ?>rendez-vous<?php if(param('tag') != null){ echo ' : ', urldecode(param('tag')) ; } ?>
			</p>
		</div>
		<div class="filter row border-bottom small cap">
			<ul>
				<a href="<?= $page->url() ?>"><li class="all <?php if(param($key = 'tag', $default = null)){ echo '' ; } else { echo 'active' ; } ; ?>">Tout</li></a>
				<?php foreach ($tags as $tag): ?><a href="<?= $page->url() ?>/tag:<?= $tag ?>"><li <?php if( urldecode(param('tag')) == $tag){ echo 'class="active"'; } ?>><?= $tag ?></li></a><?php endforeach ?>
			</ul>
		</div>
	</div>
	<?php foreach ($rendez_vous_contents as $rdv): ?><div class="actu col-4 white shadow-bottom-right">
		<a class="card cell linkable" href="<?= $rdv->url() ?>">
			<div class="card poster" <?php if ($rdv->posterimage()->isEmpty() == FALSE): ?>style="background-image: url(<?= $rdv->posterimage()->toFile()->url() ?>)"<?php endif ?>>
				<div class="card poster ratio"></div>
			</div>
			<div class="card title medium bold cap">
				<p>
					<?= $rdv->maintitle() ?>
				</p>
			</div>
			<?php if ($rdv->startdate()->isEmpty() == FALSE): ?><div class="card date medium bold cap">
				<p><?php $startday = $rdv->startdate()->toDate('d');
						 $month = $rdv->startdate()->toDate('m');
						 $year = $rdv->startdate()->toDate('y');
						 if( $rdv->enddate()->isEmpty() == FALSE ){
						 	$endday = $rdv->enddate()->toDate('d');
						 	$day = $startday . '–' . $endday;
						 }
						 if( $rdv->enddate()->isEmpty() == TRUE ) {
						 	$day = $startday; } ?>
					<?= $day ?>.<?= $month ?>.<?= $year ?>
				</p>
			</div><?php endif ?>
			<?php if ($rdv->mainlabels()->isEmpty() == FALSE ): ?><div class="card tags small cap">
				<ul><?php if ($rdv->mainlabels()->isEmpty() == FALSE):
						  $labels = explode(',', $rdv->mainlabels());
						  foreach ($labels as $label): ?>
					<li class="labels"><?= $label ?></li><?php endforeach; endif ?>
				</ul>
			</div><?php endif ?>
		</a>
	</div><?php endforeach ?>

	<?php if ($rendez_vous_contents->isEmpty() == TRUE): ?><div class="empty row white medium-small">
		<p>
			Pas de rendez-vous.
		</p>
	</div><?php endif ?>

</div>

<?php if ($rendez_vous_contents->pagination()->hasPages()): ?>
<?php $pagination = $rendez_vous_contents->pagination() ?>
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