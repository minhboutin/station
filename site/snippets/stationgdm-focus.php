<div class="col-2">
	<a class="cell" href="<?= $page->url() ?>">
		<div class="poster" style="background-image: url(<?= $page->posterimage()->toFile()->url() ?>)">
			<div class="poster ratio"></div>
		</div>
		<div class="focus title border large cap">
			<p>
				<?= $page->maintitle() ?>
			</p>
		</div>
		<div class="focus title border large cap">
			<p>
				<?= $page->maindate() ?>
			</p>
		</div>
	</a>
</div>