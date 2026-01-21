<div class="container grid">
	<div class="row separator">
		<div class="col-lg-12 category-title">
			<h1 class="<?php echo (count($articles) > 0) ? "line" : ""; ?>"><?php echo (count($articles) > 0) ? "Résultats de la recherche:" : "Aucun Résultats"; ?></h1>
		</div>
	</div>
</div>
<?php foreach($articles as $key => $article): ?>
		<div class="container py-3">
			<div class="card">
				<div class="row ">
					<div class="col-md-7 px-3">
						<div class="card-block px-6">
							<h4 class="card-title"><?php echo $article->header_title; ?></h4>
							<p class="card-text">
								<?php echo strip_tags(html_entity_decode(substr($article->text, 0, 400))); ?>
							</p>
							<br>
							<a href="<?php echo base_url("article/".$article->id); ?>" class="mt-auto btn btn-primary">Lire plus</a>
						</div>
					</div>
					<div class="col-md-5">
						<div id="CarouselTest" class="carousel slide" data-ride="">
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img class="d-block" style="max-height: 300px;" src="<?php echo base_url("public/uploads/".$article->header_image); ?>" alt="">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php endforeach; ?>
<?php if(count($articles) > 0): ?>
	<nav class="col-lg-12 col-md-12">
		<ul class="pagination justify-content-center">
			<?php echo $this->pagination->create_links(); ?>
		</ul>
	</nav>
<?php endif; ?>