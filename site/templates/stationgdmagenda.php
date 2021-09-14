<?php snippet('stationgdm-header') ?>
<?php $stationgdm = $site->find('stationgdm');

	  $temps_forts = $stationgdm->children()->find('temps-forts');
	  $rendez_vous = $stationgdm->children()->find('rendez-vous');
	  $archives = $stationgdm->children()->find('archives');

	  $temps_forts_contents = $temps_forts->children()->listed()->sortBy('startdate')->filterBy('archived', false)->flip()->slice(0, 2);
	  $rendez_vous_contents = $rendez_vous->children()->listed()->sortBy('startdate')->filterBy('archived', false)->flip()->slice(0, 8);
	  $archives_contents = $stationgdm->children()->find('rendez-vous', 'temps-forts', 'journal', 'pages')->children()->listed()->sortBy('startdate')->filterBy('archived', true)->flip()->slice(0, 4); ?>
<div class="row">

	<div class="col-1 section white">
		<div class="page section title border-bottom large bold cap">
			<p>
				Temps forts
			</p>
			<a href="<?= $temps_forts->url() ?>"><div class="more"></div></a>
		</div>
	</div>
<?php foreach ($temps_forts_contents as $page): ?>
	<div class="col-2 white border-bottom">
		<a class="focus cell linkable shadow-right" href="<?= $page->url() ?>">
			<div class="focus poster" <?php if ($page->posterimage()->isEmpty() == FALSE): ?>style="background-image: url(<?= $page->posterimage()->toFile()->url() ?>)"<?php endif ?>>
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
			<?php if ($page->maintags()->isEmpty() == FALSE || $page->mainlabels()->isEmpty() == FALSE ): ?><div class="focus tags border-bottom small cap">
				<ul><?php if ($page->mainlabels()->isEmpty() == FALSE):
						  $labels = explode(',', $page->mainlabels());
						  foreach ($labels as $label): ?>
					<li class="labels"><?= $label ?></li><?php endforeach; endif ?>
					<?php if ($page->maintags()->isEmpty() == FALSE):
						  $tags = explode(',', $page->maintags());
						  foreach ($tags as $tag): ?>
					<li class="tags"><?= $tag ?></li><?php endforeach; endif ?>
				</ul>
			</div><?php endif ?>
		</a>
	</div><?php endforeach ?>

	<div class="col-1 white">
		<div class="section button border-bottom large bold cap">
			<a href="<?= $temps_forts->url() ?>">Voir tous les temps forts</a>
		</div>
	</div>

	<div class="col-1 section white">
		<div class="page section title border-bottom large bold cap">
			<p>
				Rendez-vous
			</p>
			<a href="<?= $rendez_vous->url() ?>"><div class="more"></div></a>
		</div>
	</div>

	<div class="row border-bottom">
		<?php foreach ($rendez_vous_contents as $rdv): ?><div class="actu col-4 white shadow-bottom-right">
			<a class="card cell linkable" href="<?= $rdv->url() ?>">
				<div class="card poster" <?php if ($rdv->posterimage()->isEmpty() == FALSE): ?>style="background-image: url(<?= $rdv->posterimage()->toFile()->url() ?>)"<?php endif ?>>
					<div class="card poster ratio"></div>
					<?php if ($rdv->postervideo()->isEmpty() == FALSE): ?>
					<video class="video" preload autoplay muted loop>
			  			<source src="<?= $rdv->postervideo()->toFile()->url() ?>" type="<?= $rdv->postervideo()->toFile()->mime() ?>">
			  		</video><?php endif ?>
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
				<?php if ($rdv->maintags()->isEmpty() == FALSE || $rdv->mainlabels()->isEmpty() == FALSE ): ?><div class="card tags small cap">
					<ul><?php if ($rdv->mainlabels()->isEmpty() == FALSE):
							  $labels = explode(',', $rdv->mainlabels());
							  foreach ($labels as $label): ?>
						<li class="labels"><?= $label ?></li><?php endforeach; endif ?>
						<?php if ($rdv->maintags()->isEmpty() == FALSE):
							  $tags = explode(',', $rdv->maintags());
							  foreach ($tags as $tag): ?>
						<li class="tags"><?= $tag ?></li><?php endforeach; endif ?>
					</ul>
				</div><?php endif ?>
			</a>
		</div><?php endforeach ?>
	</div>

	<div class="col-1 white">
		<div class="section button border-bottom large bold cap">
			<a href="<?= $rendez_vous->url() ?>">Voir tous les rendez-vous</a>
		</div>
	</div>


	<?php if($archives_contents->isEmpty() == FALSE): ?><div class="col-1 section white">
		<div class="page section title border-bottom large bold cap">
			<p>
				Archives
			</p>
			<a href="<?= $archives->url() ?>"><div class="more"></div></a>
		</div>
	</div>

	<div class="row border-bottom">
	<?php foreach($archives_contents as $archive): ?>
		<?php if($archive->archived()->toBool() == TRUE): ?><div class="actu col-4 white shadow-bottom-right">
			<a class="card cell linkable" href="<?= $archive->url() ?>">
				<div class="card poster" <?php if ($archive->posterimage()->isEmpty() == FALSE): ?>style="background-image: url(<?= $archive->posterimage()->toFile()->url() ?>)"<?php endif ?>>
					<div class="card poster ratio"></div>
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
				<?php if ($archive->maintags()->isEmpty() == FALSE || $archive->mainlabels()->isEmpty() == FALSE ): ?><div class="card tags small cap">
					<ul><?php if ($archive->mainlabels()->isEmpty() == FALSE):
							  $labels = explode(',', $archive->mainlabels());
							  foreach ($labels as $label): ?>
						<li class="labels"><?= $label ?></li><?php endforeach; endif ?>
						<?php if ($archive->maintags()->isEmpty() == FALSE):
							  $tags = explode(',', $archive->maintags());
							  foreach ($tags as $tag): ?>
						<li class="tags"><?= $tag ?></li><?php endforeach; endif ?>
					</ul>
				</div><?php endif ?>
			</a>
		</div><?php endif ?>
	<?php endforeach ?>
	</div>

	<div class="col-1 white">
		<div class="section button border-bottom large bold cap">
			<a href="<?= $archives->url() ?>">Voir toutes les archives</a>
		</div>
	</div><?php endif ?>

</div>

<?php snippet('stationgdm-footer') ?>
