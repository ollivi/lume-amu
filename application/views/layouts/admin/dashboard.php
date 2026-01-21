	<div class="row row-offcanvas row-offcanvas-left ml-7">
		<div class="col main pt-5 mt-3">
			<h1 class="display-4 d-none d-sm-block">
			Rapidement
			</h1>
			<p class="lead d-none d-sm-block">Vos dernières alertes:</p>

			<div class="row mb-3">
				<div class="col-xl-3 col-sm-6 py-2">
					<div class="card bg-success text-white h-100">
						<div class="card-body bg-success">
							<div class="rotate">
								<i class="fa fa-user fa-4x"></i>
							</div>
							<h6 class="text-uppercase">Utilisateurs nécessitants activation</h6>
							<h1 class="display-4"><?php echo $users; ?></h1>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 py-2">
					<div class="card text-white bg-danger h-100">
						<div class="card-body bg-danger">
							<div class="rotate">
								<i class="fa fa-list fa-4x"></i>
							</div>
							<h6 class="text-uppercase">Articles nécessitants publication</h6>
							<h1 class="display-4"><?php echo $articles; ?></h1>
						</div>
					</div>
				</div>
<!-- 				<div class="col-xl-3 col-sm-6 py-2">
					<div class="card text-white bg-info h-100">
						<div class="card-body bg-info">
							<div class="rotate">
								<i class="fa fa-twitter fa-4x"></i>
							</div>
							<h6 class="text-uppercase">?</h6>
							<h1 class="display-4">125</h1>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 py-2">
					<div class="card text-white bg-warning h-100">
						<div class="card-body">
							<div class="rotate">
								<i class="fa fa-share fa-4x"></i>
							</div>
							<h6 class="text-uppercase">?</h6>
							<h1 class="display-4">36</h1>
						</div>
					</div>
				</div> -->
			</div>