<?php snippet('stationgdm-header') ?>

<?php if( param('tag') == null ): ?>

<div class="ball y">
	<div class="ball x"></div>
</div>

<?php $stationgdm = $site->children()->find('stationgdm') ;
	  $home = $stationgdm->children()->find('home') ;
	  $focus = $home->focusselection()->toPages(); 
	  $agenda = $stationgdm->children()->find('agenda')->url();
	  $journal = $stationgdm->children()->find('journal')->url(); ?>
<div class="row border-bottom">
	<?php foreach ($focus as $page): ?>	
		<div class="col-2 white">
			<a class="focus cell linkable shadow-right" href="<?= $page->url() ?>">
				<div class="focus poster" <?php if ($page->posterimage()->isEmpty() == FALSE): ?>style="background-image: url(<?= $page->posterimage()->toFile()->url() ?>)"<?php endif ?>>
					<div class="focus poster ratio"></div>
					<?php if ($page->postervideo()->isEmpty() == FALSE): ?>
					<video class="video" preload autoplay muted loop>
			  			<source src="<?= $page->postervideo()->toFile()->url() ?>" type="<?= $page->postervideo()->toFile()->mime() ?>">
			  		</video><?php endif ?>
				</div>
				<?php if ($page->maintitle()->isEmpty() == FALSE): ?><div class="focus title border-bottom large bold cap">
					<p>
						<?= $page->maintitle() ?>
					</p>
				</div><?php endif ?>
				<?php if ($page->startdate()->isEmpty() == FALSE): ?><div class="focus date border-bottom large bold cap">
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
				<?php if ($home->focusdescription()->toBool() == FALSE ):
					  if ($page->description()->isEmpty() == FALSE): ?><div class="focus description border-bottom medium-small">
					<p>
						<?= $page->description() ?>
					</p>
				</div><?php endif; endif ?>
				<?php if ($home->focustags()->toBool() == FALSE ):
					  if ($page->maintags()->isEmpty() == FALSE || $page->mainlabels()->isEmpty() == FALSE ): ?><div class="focus tags border-bottom small cap">
					<ul><?php if ($page->mainlabels()->isEmpty() == FALSE):
							  $labels = explode(',', $page->mainlabels());
							  foreach ($labels as $label): ?>
						<li class="labels"><?= $label ?></li><?php endforeach; endif ?>
						<?php if ($page->maintags()->isEmpty() == FALSE):
							  $tags = explode(',', $page->maintags());
							  foreach ($tags as $tag): ?>
						<li class="tags"><?= $tag ?></li><?php endforeach; endif ?>
					</ul>
				</div><?php endif; endif ?>
			</a>
		</div>	
	<?php endforeach ?>
</div>

<div class="bricks">

	<div class="col-12">
		<div class="brick horizontal"></div>
	</div>

	<div class="col-12">
		<div class="brick horizontal"></div>
	</div>

	<div class="col-12">
		<div class="brick vertical"></div>
	</div>

	<div class="col-12">
		<div class="brick vertical"></div>
	</div>

	<div class="col-12">
		<div class="brick horizontal"></div>
	</div>

	<div class="col-12">
		<div class="brick horizontal"></div>
	</div>

	<div class="col-12">
		<div class="brick vertical"></div>
	</div>

	<div class="col-12">
		<div class="brick vertical"></div>
	</div>

	<div class="col-12">
		<div class="brick horizontal"></div>
	</div>

	<div class="col-12">
		<div class="brick horizontal"></div>
	</div>

	<div class="col-12">
		<div class="brick vertical"></div>
	</div>

	<div class="col-12">
		<div class="brick vertical"></div>
	</div>

</div>

<?php if ( $home->actuactived()->toBool() == FALSE ): ?>
<div id="actu" class="section">
	<div class="section agenda title large border-bottom bold cap">
		<p>
			<?= $home->actutitre() ?>
		</p>
		<a href="<?= $agenda ?>"><div class="more"></div></a>
	</div>
	
	<div class="row border-bottom">
	<?php $date = date('d.m.Y');

		  $start_month = date('31.m.Y');
		  $end_month = date('31.m.Y');

		  $week = date('W');
		  $year = date('Y');

		  function getStartAndEndDate($week, $year) {
			  $dto = new DateTime();
			  $ret['week_start'] = $dto->setISODate($year, $week)->format('d-m-Y');
			  $ret['week_end'] = $dto->modify('+6 days')->format('d-m-Y');
			  return $ret;
		  }

		  $week_dates = getStartAndEndDate($week, $year);

		  $pages = $stationgdm->children()->find('rendez-vous', 'temps-forts')->children()->listed()->sortBy('startdate')->filterBy('archived', false);

		  if($home->autoselection() == 'none'){
		  	$actus = $home->manualselection()->toPages(); } 

		  if($home->autoselection() == 'four'){
		  	$actus = $pages->filterBy('startdate', 'date >', date('d.m.Y'))->slice(0, 4); }

		  if($home->autoselection() == 'eight'){
		  	$actus = $pages->filterBy('startdate', 'date >', date('d.m.Y'))->slice(0, 8); }

		  if($home->autoselection() == 'week'){
			$actus = $pages
			  		->filterBy('startdate', 'date >=', $week_dates["week_start"])
			  		->filterBy('startdate', 'date <=', $week_dates["week_end"]); }

		  if($home->autoselection() == 'month'){
		    $actus = $pages
		    		->filterBy('startdate', 'date >=', $start_month)
			  		->filterBy('startdate', 'date <=', $end_month); }

		  foreach ($actus as $actu): 
		  ?><div class="actu col-4 white shadow-bottom-right">
			<a class="card cell linkable" href="<?= $actu->url() ?>">
				<div class="card poster" <?php if ($actu->posterimage()->isEmpty() == FALSE): ?>style="background-image: url(<?= $actu->posterimage()->toFile()->url() ?>)"<?php endif ?>>
					<div class="card poster ratio"></div>
					<?php if ($actu->postervideo()->isEmpty() == FALSE): ?>
					<video class="video" preload autoplay muted loop>
			  			<source src="<?= $actu->postervideo()->toFile()->url() ?>" type="<?= $actu->postervideo()->toFile()->mime() ?>">
			  		</video><?php endif ?>
				</div>
				<div class="card title medium bold cap">
					<p>
						<?= $actu->maintitle() ?>
					</p>
				</div>
				<?php if ($actu->startdate()->isEmpty() == FALSE): ?><div class="card date medium bold cap">
					<p><?php $startday = $actu->startdate()->toDate('d');
							 $month = $actu->startdate()->toDate('m');
							 $year = $actu->startdate()->toDate('y');
							 if( $actu->enddate()->isEmpty() == FALSE ){
							 	$endday = $actu->enddate()->toDate('d');
							 	$day = $startday . '–' . $endday;
							 }
							 if( $actu->enddate()->isEmpty() == TRUE ) {
							 	$day = $startday; } ?>
						<?= $day ?>.<?= $month ?>.<?= $year ?>
					</p>
				</div><?php endif ?>
				<?php if ($actu->maintags()->isEmpty() == FALSE || $actu->mainlabels()->isEmpty() == FALSE ): ?><div class="card tags small cap">
					<ul><?php if ($actu->mainlabels()->isEmpty() == FALSE):
							  $labels = explode(',', $actu->mainlabels());
							  foreach ($labels as $label): ?>
						<li class="labels"><?= $label ?></li><?php endforeach; endif ?>
						<?php if ($actu->maintags()->isEmpty() == FALSE):
							  $tags = explode(',', $actu->maintags());
							  foreach ($tags as $tag): ?>
						<li class="tags"><?= $tag ?></li><?php endforeach; endif ?>
					</ul>
				</div><?php endif ?>
			</a>
		  </div><?php endforeach ?>
	</div>
</div>
<?php endif ?>

<div class="row separator border-bottom"></div>

<?php if ( $home->discoveractivated()->toBool() == FALSE ): ?>
<div id="discover" class="section">
	<div class="section discover title large border-bottom bold cap">
		<p>
			<?= $home->discovertitle() ?>
		</p>
	</div>

	<div class="row">

	<?php if ( $home->discoverblock1actived()->toBool() == FALSE ): ?><div class="col-3 white">
		<a class="discover discover cell <?php  if($home->discoverblock1link()->isEmpty() == FALSE ) { echo 'linkable' ; } ; ?>" <?php if($home->discoverblock1link()->isEmpty() == FALSE ) { echo 'href="', $home->discoverblock1link(), '"' ; } ; ?> <?php if($home->discoverblock1linktarget()->toBool() == TRUE ) { echo 'target="_blank"' ; } ; ?>>
			<div class="discover poster ratio" <?php if( $home->discoverblock1image()->isEmpty() == FALSE ) { echo 'style="background-image: url(', $home->discoverblock1image()->toFile()->url(), '"' ; } ; ?>>
			
			<?php if($home->discoverblock1text()->isEmpty() == FALSE && $home->discoverblock1image()->isEmpty() == FALSE ) {
					echo '<div class="discover description medium-small hidden">
						  <p>',
						  $home->discoverblock1text()->kt()->inline(),
						  '</p>
						  </div>' ;
				} ;
				  if($home->discoverblock1text()->isEmpty() == FALSE && $home->discoverblock1image()->isEmpty() == TRUE ) {
					echo '<div class="discover description medium-small">
						  <p>',
						  $home->discoverblock1text()->kt()->inline(),
						  '</p>
						  </div>' ;
				} ;?>
			</div>
			<div class="card discover title medium bold cap">
				<p>
					<?= $home->discoverblock1title() ?>
				</p>
			</div>
		</a>
	</div><?php endif ?>

	<?php if ( $home->discoverblock2actived()->toBool() == FALSE ): ?><div class="col-3 white">
		<a class="discover cell <?php  if($home->discoverblock2link()->isEmpty() == FALSE ) { echo 'linkable' ; } ; ?>" <?php if($home->discoverblock2link()->isEmpty() == FALSE ) { echo 'href="', $home->discoverblock2link(), '"' ; } ; ?> <?php if($home->discoverblock2linktarget()->toBool() == TRUE ) { echo 'target="_blank"' ; } ; ?>>
			<div class="discover poster ratio" <?php if( $home->discoverblock2image()->isEmpty() == FALSE ) { echo 'style="background-image: url(', $home->discoverblock2image()->toFile()->url(), '"' ; } ; ?>>
			
			<?php if($home->discoverblock2text()->isEmpty() == FALSE && $home->discoverblock2image()->isEmpty() == FALSE ) {
					echo '<div class="discover description medium-small hidden">
						  <p>',
						  $home->discoverblock2text()->kt()->inline(),
						  '</p>
						  </div>' ;
				} ;
				  if($home->discoverblock2text()->isEmpty() == FALSE && $home->discoverblock2image()->isEmpty() == TRUE ) {
					echo '<div class="discover description medium-small">
						  <p>',
						  $home->discoverblock2text()->kt()->inline(),
						  '</p>
						  </div>' ;
				} ;?>
			</div>
			<div class="card discover title medium bold cap">
				<p>
					<?= $home->discoverblock2title() ?>
				</p>
			</div>
		</a>
	</div><?php endif ?>

	<?php if ( $home->discoverblock3actived()->toBool() == FALSE ): ?><div class="col-3 white">
		<a class="discover cell <?php  if($home->discoverblock3link()->isEmpty() == FALSE ) { echo 'linkable' ; } ; ?>" <?php if($home->discoverblock3link()->isEmpty() == FALSE ) { echo 'href="', $home->discoverblock3link(), '"' ; } ; ?> <?php if($home->discoverblock3linktarget()->toBool() == TRUE ) { echo 'target="_blank"' ; } ; ?>>
			<div class="discover poster ratio" <?php if( $home->discoverblock3image()->isEmpty() == FALSE ) { echo 'style="background-image: url(', $home->discoverblock3image()->toFile()->url(), '"' ; } ; ?>>
			
			<?php if($home->discoverblock3text()->isEmpty() == FALSE && $home->discoverblock3image()->isEmpty() == FALSE ) {
					echo '<div class="discover description medium-small hidden">
						  <p>',
						  $home->discoverblock3text()->kt()->inline(),
						  '</p>
						  </div>' ;
				} ;
				  if($home->discoverblock3text()->isEmpty() == FALSE && $home->discoverblock3image()->isEmpty() == TRUE ) {
					echo '<div class="discover description medium-small">
						  <p>',
						  $home->discoverblock3text()->kt()->inline(),
						  '</p>
						  </div>' ;
				} ;?>
			</div>
			<div class="card discover title medium bold cap">
				<p>
					<?= $home->discoverblock3title() ?>
				</p>
			</div>
		</a>
	</div><?php endif ?>

	<?php if ( $home->discoverblock4actived()->toBool() == FALSE ): ?><div class="col-3 white">
		<a class="discover cell <?php  if($home->discoverblock4link()->isEmpty() == FALSE ) { echo 'linkable' ; } ; ?>" <?php if($home->discoverblock4link()->isEmpty() == FALSE ) { echo 'href="', $home->discoverblock4link(), '"' ; } ; ?> <?php if($home->discoverblock4linktarget()->toBool() == TRUE ) { echo 'target="_blank"' ; } ; ?>>
			<div class="discover poster ratio" <?php if( $home->discoverblock4image()->isEmpty() == FALSE ) { echo 'style="background-image: url(', $home->discoverblock4image()->toFile()->url(), '"' ; } ; ?>>
			
			<?php if($home->discoverblock4text()->isEmpty() == FALSE && $home->discoverblock4image()->isEmpty() == FALSE ) {
					echo '<div class="discover description medium-small hidden">
						  <p>',
						  $home->discoverblock4text()->kt()->inline(),
						  '</p>
						  </div>' ;
				} ;
				  if($home->discoverblock4text()->isEmpty() == FALSE && $home->discoverblock4image()->isEmpty() == TRUE ) {
					echo '<div class="discover description medium-small">
						  <p>',
						  $home->discoverblock4text()->kt()->inline(),
						  '</p>
						  </div>' ;
				} ;?>
			</div>
			<div class="card discover title medium bold cap">
				<p>
					<?= $home->discoverblock4title() ?>
				</p>
			</div>
		</a>
	</div><?php endif ?>

	<?php if ( $home->discoverblock5actived()->toBool() == FALSE ): ?><div class="col-3 white">
		<a class="discover cell <?php  if($home->discoverblock5link()->isEmpty() == FALSE ) { echo 'linkable' ; } ; ?>" <?php if($home->discoverblock5link()->isEmpty() == FALSE ) { echo 'href="', $home->discoverblock5link(), '"' ; } ; ?> <?php if($home->discoverblock5linktarget()->toBool() == TRUE ) { echo 'target="_blank"' ; } ; ?>>
			<div class="discover poster ratio" <?php if( $home->discoverblock5image()->isEmpty() == FALSE ) { echo 'style="background-image: url(', $home->discoverblock5image()->toFile()->url(), '"' ; } ; ?>>
			
			<?php if($home->discoverblock5text()->isEmpty() == FALSE && $home->discoverblock5image()->isEmpty() == FALSE ) {
					echo '<div class="discover description medium-small hidden">
						  <p>',
						  $home->discoverblock5text()->kt()->inline(),
						  '</p>
						  </div>' ;
				} ;
				  if($home->discoverblock5text()->isEmpty() == FALSE && $home->discoverblock5image()->isEmpty() == TRUE ) {
					echo '<div class="discover description medium-small">
						  <p>',
						  $home->discoverblock5text()->kt()->inline(),
						  '</p>
						  </div>' ;
				} ;?>
			</div>
			<div class="card discover title medium bold cap">
				<p>
					<?= $home->discoverblock5title() ?>
				</p>
			</div>
		</a>
	</div><?php endif ?>

	<?php if ( $home->discoverblock6actived()->toBool() == FALSE ): ?><div class="col-3 white">
		<a class="discover cell <?php  if($home->discoverblock6link()->isEmpty() == FALSE ) { echo 'linkable' ; } ; ?>" <?php if($home->discoverblock6link()->isEmpty() == FALSE ) { echo 'href="', $home->discoverblock6link(), '"' ; } ; ?> <?php if($home->discoverblock6linktarget()->toBool() == TRUE ) { echo 'target="_blank"' ; } ; ?>>
			<div class="discover poster ratio" <?php if( $home->discoverblock6image()->isEmpty() == FALSE ) { echo 'style="background-image: url(', $home->discoverblock6image()->toFile()->url(), '"' ; } ; ?>>
			
			<?php if($home->discoverblock6text()->isEmpty() == FALSE && $home->discoverblock6image()->isEmpty() == FALSE ) {
					echo '<div class="discover description medium-small hidden">
						  <p>',
						  $home->discoverblock6text()->kt()->inline(),
						  '</p>
						  </div>' ;
				} ;
				  if($home->discoverblock6text()->isEmpty() == FALSE && $home->discoverblock6image()->isEmpty() == TRUE ) {
					echo '<div class="discover description medium-small">
						  <p>',
						  $home->discoverblock6text()->kt()->inline(),
						  '</p>
						  </div>' ;
				} ;?>
			</div>
			<div class="card discover title medium bold cap">
				<p>
					<?= $home->discoverblock6title() ?>
				</p>
			</div>
		</a>
	</div><?php endif ?>

	</div>

</div>
<?php endif ?>

<div class="row separator border-bottom"></div>

<?php if ( $home->journalactived()->toBool() == FALSE ): ?>
<div id="journal" class="section">
	<div class="section discover title large border-bottom bold cap">
		<p>
			<?= $home->journaltitle() ?>
		</p>
		<a href="<?= $journal ?>"><div class="more medium-small"></div></a>
	</div>

	<div class="row border-bottom">
		<?php $articles = $stationgdm->children()->find('journal')->children()->listed()->sortBy('date')->slice(0, 4); 
			foreach ($articles as $article): 
		?><div class="journal col-4 white">
			<a class="card cell linkable" href="<?= $article->url() ?>">
				<div class="card poster" <?php if ($article->posterimage()->isEmpty() == FALSE): ?>style="background-image: url(<?= $article->posterimage()->toFile()->url() ?>)"<?php endif ?>>
					<div class="card poster ratio"></div>
				</div>
				<div class="card title medium bold cap">
					<p>
						<?= $article->maintitle() ?>
					</p>
				</div>
				<?php if ($article->date()->isEmpty() == FALSE): ?><div class="card date medium bold cap">
					<p><?php $day = $article->date()->toDate('d');
							 $month = $article->date()->toDate('m');
							 $year = $article->date()->toDate('y'); ?>
						<?= $day ?>.<?= $month ?>.<?= $year ?>
					</p>
				</div><?php endif ?>
				<?php if ($article->mainauteur()->isEmpty() == FALSE && $home->journalauthor()->toBool() == FALSE): ?><div class="card date medium-small">
					<p>Par <?= $article->mainauteur() ?>
					</p>
				</div><?php endif ?>
				<?php if ($home->journaltags()->toBool() == FALSE && $article->mainthemes()->isEmpty() == FALSE || $article->maintags()->isEmpty() == FALSE): ?><div class="card tags small cap">
					<ul><?php if ($article->mainthemes()->isEmpty() == FALSE):
							  $themes = explode(',', $article->mainthemes());
							  foreach ($themes as $theme): ?>
						<li class="labels"><?= $theme ?></li><?php endforeach; endif ?>
						<?php if ($article->maintags()->isEmpty() == FALSE):
							  $tags = explode(',', $article->maintags());
							  foreach ($tags as $tag): ?>
						<li class="tags"><?= $tag ?></li><?php endforeach; endif ?>
					</ul>
				</div><?php endif ?>
			</a>
		  </div><?php endforeach ?>
	</div>
</div>
<?php endif ?>

<div class="row separator border-bottom"></div>

<div class="row">

	<div class="row">
		<div class="half-bricks">
			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>
		</div>
		<div class="half-bricks">
			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="half-bricks">
			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>
		</div>
		<div class="half-bricks">
			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>
		</div>
	</div>

	<div class="subscribe row border-bottom">
		<div class="message medium bold cap">
			<p>
				Pour rester informé.e de l'actualité de La Station — Gare des mines, inscrivez-vous à notre newsletter.
			</p>
			<form name="subscribe-newsletter" id="subscribe-newsletter" method="post" autocomplete="off">
				<input id="newsletter-email" type="text" name="newsletter-email" value="" class="medium bold cap" placeholder="Entrez votre e-mail" autocomplete="off" required><input id="subscribe-button" type="submit" value="">
			</form>
			<div id="subscribe-error" class="small cap">Erreur : l'adresse e-mail entrée n'est pas valide.</div>
			<div id="subscribe-confirmed" class="medimul bold cap">
				<p>Merci ! Vous êtes maintenant inscrit.e à notre newsletter.</p>
				</div>
		</div>
	</div>

	<div class="row">
		<div class="half-bricks">
			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>
		</div>
		<div class="half-bricks">
			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="half-bricks">
			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>
		</div>
		<div class="half-bricks">
			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick horizontal"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>

			<div class="col-4">
				<div class="brick vertical"></div>
			</div>
		</div>
	</div>

</div>
<?php endif ?>

<?php if( param('tag') != null ): ?>

<div class="row border-bottom">
	<div class="col-1 section white">
		<div class="page row section title border-bottom large bold cap">
			<p>
				Tag : <?= urldecode(param('tag')) ?>
			</p>
		</div>
	</div>

	<?php 

		$all_contents = $site->children()->find('stationgdm')->children()->find('rendez-vous', 'temps-forts', 'journal', 'pages')->children()->listed();

		$results = new Collection();

		$feed_contents_filtered_by_tag = $all_contents->filterBy('maintags', urldecode(param('tag')));
	    $results->add($feed_contents_filtered_by_tag);

	    $feed_contents_filtered_by_label = $all_contents->filterBy('mainlabels', urldecode(param('tag')));
	    $results->add($feed_contents_filtered_by_label);

	    $feed_contents_filtered_by_theme = $all_contents->filterBy('mainthemes', urldecode(param('tag')));
	    $results->add($feed_contents_filtered_by_theme);

	    $results->paginate(16);

		foreach ($results as $result): ?><div class="actu col-4 white shadow-bottom-right">
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
			Oops ! Pas de contenu trouvé pour ce tag.
		</p>
	</div><?php endif ?>

	<?php if ($results->pagination()->hasPages()): ?>
	<?php $pagination = $results->pagination() ?>
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

</div>
<?php endif ?>


<?php snippet('stationgdm-footer') ?>
