<?php snippet('stationgdm-header') ?>

<div class="row border-bottom">
	<div class="col-1 section white">
		<div class="page row section title border-bottom large bold cap">
			<p>
				Recherche : <?php if($query == ' ' || $query == '  ' ||  $query == '   ' ) { echo 'vide' ; } else { echo $query ; } ?>
			</p>
		</div>
	</div>

	<?php foreach ($results as $result): ?><div class="actu col-4 white shadow-bottom-right">
		<a class="card cell linkable" href="<?= $result->url() ?>">
			<div class="card poster" <?php if ($result->posterimage()->isEmpty() == FALSE): ?>style="background-image: url(<?= $result->posterimage()->toFile()->url() ?>)"<?php endif ?>>
				<div class="card poster ratio"></div>
				<?php if ($result->postervideo()->isEmpty() == FALSE): ?>
					<video class="video" preload autoplay muted loop>
			  			<source src="<?= $result->postervideo()->toFile()->url() ?>" type="<?= $result->postervideo()->toFile()->mime() ?>">
			  		</video><?php endif ?>
			</div>
			<div class="card title medium bold cap">
				<p>
					<?= $result->maintitle() ?>
				</p>
			</div>
			<?php if ($result->startdate()->isEmpty() == FALSE): ?><div class="card date medium bold cap">
				<p><?php $startday = $result->startdate()->toDate('d');
						 $month = $result->startdate()->toDate('m');
						 $year = $result->startdate()->toDate('y');
						 if( $result->enddate()->isEmpty() == FALSE ){
						 	$endday = $result->enddate()->toDate('d');
						 	$day = $startday . '–' . $endday;
						 }
						 if( $result->enddate()->isEmpty() == TRUE ) {
						 	$day = $startday; } ?>
					<?= $day ?>.<?= $month ?>.<?= $year ?>
				</p>
			</div><?php endif ?>
			<?php if ($result->mainlabels()->isEmpty() == FALSE || $result->maintags()->isEmpty() == FALSE ): ?><div class="card tags small cap">
				<ul><?php if ($result->mainlabels()->isEmpty() == FALSE):
						  $labels = explode(',', $result->mainlabels());
						  foreach ($labels as $label): ?>
					<li class="labels"><?= $label ?></li><?php endforeach; endif ?>
					<?php if ($result->maintags()->isEmpty() == FALSE):
						  $tags = explode(',', $result->maintags());
						  foreach ($tags as $tag): ?>
					<li class="tags"><?= $tag ?></li><?php endforeach; endif ?>
				</ul>
			</div><?php endif ?>
		</a>
	</div><?php endforeach ?>

	<?php if ($results->isEmpty() == TRUE): ?><div class="empty row white medium-small">
		<p>
			Oops ! Pas de contenu trouvé pour votre recherche.
		</p>
	</div><?php endif ?>

</div>



<?php snippet('stationgdm-footer') ?>
