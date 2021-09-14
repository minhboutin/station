	<?php $stationgdm = $site->children()->find('stationgdm') ;
		  $parametres = $stationgdm->children()->find('parametres') ; ?>
	<footer>
		<div class="row separator border-bottom"></div>
		<div id="presentation" class="col-1">
			<div id="logo-footer" class="col-3">
				<div id="circle-footer">
					<div id="circle-ratio"></div>
				</div>
			</div>
			<div class="col-3-2 col large">
				<div class="cell col-1">
					<p>
						<?= $parametres->textfooter()->kt()->inline() ?>
					</p>
				</div>
				<div class="cell col-1">
					<p>
						<?= $parametres->addressfooter()->kt()->inline() ?>
					</p>
				</div>
			</div>
		</div>
		<div id="buttons" class="small cap col-1">
			<div class="button col-3">
				<div>
					<p>
						<a href="<?= $stationgdm->find('pages')->children()->find('credits')->url() ?>"><?= $stationgdm->find('pages')->children()->find('credits')->maintitle() ?></a> / <a href="<?= $stationgdm->find('pages')->children()->find('mentions-legales')->url() ?>"><?= $stationgdm->find('pages')->children()->find('mentions-legales')->maintitle() ?></a>
					</p>
				</div>
			</div>
			<div class="button col-3">
				<div>
					<p>
						<a id="mail"><?= $parametres->mail() ?></a> / <a id="tel"><?= $parametres->phone() ?></a>
					</p>
				</div>
			</div>
			<div id="follow-us" class="button col-3">
				<div>
					Suivez-nous sur les réseaux :
				</div>
			</div>
			<div class="button col-3">
				<div>
					<a href="<?= $stationgdm->find('archives')->url() ?>">Archives</a>
				</div>
			</div>
			<div class="button col-3">
				<div>
					<a href="<?= $stationgdm->children()->find('informations')->children()->find('newsletter')->url() ?>">S'inscrire à la newsletter</a>
				</div>
			</div>
			<div class="col-3">
				<div class="social">
					<div id="facebook-button" class="col-4">
						<a class="social button" href="<?= $parametres->facebook() ?>" target="_blank">
							<div id="facebook" class="picto"></div>
						</a>
					</div>
					<div id="instagram-button" class="col-4">
						<a class="social button" href="<?= $parametres->instagram() ?>" target="_blank">
							<div id="instagram" class="picto"></div>
						</a>
					</div>
					<div id="youtube-button" class="col-4">
						<a class="social button" href="<?= $parametres->youtube() ?>" target="_blank">
							<div id="youtube" class="picto"></div>
						</a>
					</div>
					<div id="mixcloud-button" class="col-4">
						<a class="social button" href="<?= $parametres->mixcloud() ?>" target="_blank">
							<div id="mixcloud" class="picto"></div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<?= js([
		'assets/js/stationgdm.js',
	    '@auto',
	]) ?>
	</main>
</body>
</html>