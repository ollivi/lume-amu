<?php if(count($latest) === 3): ?>
	<div class="container">
		<div class="row separator">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<?php foreach($latest as $key => $article): ?>
						<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $key; ?>" class="<?php echo ($key == 0) ? 'active' : '' ?>"></li>
					<?php endforeach; ?>
				</ol>
				<div class="carousel-inner">
					<?php foreach($latest as $key => $article): ?>
						<div class="carousel-item <?php echo ($key == 0) ? 'active' : '' ?>">
							<img class="d-block w-100" src="<?= base_url('public/uploads/'.$article->header_image);?>" alt="">
							<div class="carousel-caption d-none d-md-block">
								<div class="title"><a href="<?php echo base_url("article/".$article->id); ?>"><?php echo $article->header_title; ?></a></div>
								<p><a href="<?php echo base_url("article/".$article->id); ?>"><?php echo $article->header_subtitle; ?></a></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php foreach($categories as $key => $category): ?>
	<?php if(!empty($articles["category_".$category->id])): ?>
		<div class="container grid">
			<div class="row separator">
				<div class="col-lg-12 category-title">
					<a href="#cat_<?php echo $category->id; ?>" style="color: black !important;" data-toggle="collapse" aria-expanded="<?php echo ($key == 0) ? 'true' : 'false' ?>" aria-controls="cat_<?php echo $category->id; ?>"><h1 class="line"><?php echo $category->category; ?></h1><a>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<div id="cat_<?php echo $category->id; ?>" class="panel-collapse <?php echo ($key != 0) ? 'collapse in' : '' ?>" aria-expanded="<?php echo ($key == 0) ? 'true' : 'false' ?>" aria-labelledby="cat_<?php echo $category->id; ?>">
		<div class="container">
			<?php foreach($articles["category_".$category->id] as $key => $article): ?>
				<div class="blog-card spring-fever" style="background-image:url(<?php echo base_url('public/uploads/'.$article->header_image);?>) !important;">
					<div class="title-content">
						<h3><a href="<?php echo base_url("article/".$article->id); ?>"><?php echo $article->header_title; ?></a></h3>
						<div class="intro"><a href="<?php echo base_url("article/".$article->id); ?>"><?php echo $article->header_subtitle; ?></a> </div>
					</div>
					<div class="card-info">
						<?php echo strip_tags(html_entity_decode(substr($article->text, 0, 400))); ?>
						<a href="<?php echo base_url("article/".$article->id); ?>">Lire plus<span class="licon icon-arr icon-black"></span></a>
					</div>
					<div class="utility-info">
						<ul class="utility-list">
							<li><span class="licon icon-dat"></span>Le <?php echo date("d/m/Y", strtotime($article->created_at)); ?></li>
						</ul>
					</div>
					<div class="gradient-overlay"></div>
					<div class="color-overlay"></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endforeach; ?>