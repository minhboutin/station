<?php snippet('stationgdm-header') ?>
<?php $stationgdm = $site->find('stationgdm');
	 
	  $journal = $stationgdm->children()->find('journal');
	  $themes = $stationgdm->children()->find('labels-tags')->themes()->split();

	  if( param('tag') == null ){ 
	  	$articles = $journal->children()->listed()->sortBy('startdate')->filterBy('archived', false)->flip()->paginate(8);
	  } else {
	  	$articles = $journal->children()->listed()->sortBy('startdate')->filterBy('archived', false)->filterBy('mainthemes', urldecode(param('tag')), ',')->flip()->paginate(8);
	  }
?>
<div class="row">
	<div class="col-1 section white">
		<div class="page section title border-bottom large bold cap">
			<p>
				Journal<?php if(param('tag') != null){ echo ' : ', urldecode(param('tag')) ; } ?>
			</p>
		</div>
		<div class="filter row border-bottom small cap">
			<ul>
				<a href="<?= $page->url() ?>"><li class="all <?php if(param($key = 'tag', $default = null)){ echo '' ; } else { echo 'active' ; } ; ?>">Tout</li></a>
				<?php foreach ($themes as $theme): ?><a href="<?= $page->url() ?>/tag:<?php echo $theme ?>"><li <?php if( urldecode(param('tag')) == $theme){ echo 'class="active"'; } ?>><?= $theme ?></li></a>
			<?php endforeach ?>
			</ul>
		</div>
	</div>

	<div class="col-1 section white">
		<div class="list section">
			<?php foreach ($articles as $content):?><a href="<?= $content->url() ?>">
			<div class="row list-block border-bottom">
				<div class="col-3-2 row">
					<div class="space border-right">
						<div class="puce border-bottom"></div>
					</div>
					<div class="list content">
						<div class="list title border-bottom medium bold cap">
							<p><?= $content->maintitle() ?></p>
						</div>
						<?php if ($content->startdate()->isEmpty() == FALSE ): ?><div class="list date border-bottom medium bold cap">
							<p><?php $day = $content->startdate()->toDate('d');
									 $month = $content->startdate()->toDate('m');
									 $year = $content->startdate()->toDate('y'); ?>
								Publié le <?= $day ?>.<?= $month ?>.<?= $year ?><?php if($content->mainauteur()->isEmpty() == FALSE): ?> — Par <?= $content->mainauteur() ?><?php endif ?>
							</p>
						</div><?php endif ?>
						<?php if($content->description()->isEmpty() == FALSE): ?><div class="list description border-bottom medium-small">
							<p><?= $content->description() ?></p>
						</div><?php endif ?>
						<?php if ($content->mainthemes()->isEmpty() == FALSE || $content->maintags()->isEmpty() == FALSE): ?><div class="list tags border-bottom small cap">
							<ul><?php if ($content->mainthemes()->isEmpty() == FALSE):
									  $themes = explode(',', $content->mainthemes());
									  foreach ($themes as $theme): ?>
								<li class="labels"><?= $theme ?></li><?php endforeach; endif ?>
								<?php if ($content->maintags()->isEmpty() == FALSE):
									  $tags = explode(',', $content->maintags());
									  foreach ($tags as $tag): ?>
								<li class="tags"><?= $tag ?></li><?php endforeach; endif ?>
							</ul>
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

	<?php if ($articles->isEmpty() == TRUE): ?><div class="empty row white border-bottom medium-small">
		<p>
			Pas d'article.
		</p>
	</div><?php endif ?>
</div>

<?php if ($articles->pagination()->hasPages()): ?>
<?php $pagination = $articles->pagination() ?>
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