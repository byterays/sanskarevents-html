<?php include 'header.php'; ?>


<!-- Wrapper Start -->
<!-- Our Gallery -->
<section class="ulockd-service-three">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 text-center">
				<div class="ulockd-main-title">
					<h2>Our Photo <span class="text-thm2">Gallery</span></h2>

				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">

				<!-- Masonry Filter -->
				<!-- <ul class="list-inline masonry-filter text-center">
					<li><a href="#" class="active" data-filter="*">All</a></li>
					<li><a href="#" data-filter=".events" class="">Events</a></li>
					<li><a href="#" data-filter=".jimcorbett" class="">Jimcorbett</a></li>
					<li><a href="#" data-filter=".jaipur" class="">Jaipur</a></li>
					<li><a href="#" data-filter=".himachal" class="">Himachal</a></li>
					<li><a href="#" data-filter=".bhimtal" class="">Bhimtal</a></li>
					<li><a href="#" data-filter=".manali" class="">Manali</a></li>
				</ul> -->
				<!-- End Masonry Filter -->


				<!-- Masonry Grid -->
				<div id="photo-gallery" class="masonry-gallery grid-6 mrgn10 clearfix">

					<?php
					foreach($files as $photo):
						?>
						<!-- Masonry Item -->
						<div class="isotope-item">
							<div class="gallery-thumb">
								<img class="img-responsive img-whp" src="/gallery/<?= $photo['file_path'] ?>" alt="<?= $photo['file_name'] ?>">
								<div class="overlayer">
									<div class="lbox-caption">
										<div class="lbox-details">
											<ul class="list-inline">
												<li>
													<a class="popup-img" href="/gallery/<?= $photo['file_path'] ?>"
														title="<?= $photo['file_name'] ?>"><span
															class="flaticon-add-square-button"></span></a>
												</li>

											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="details text-center">
								<h5><?= $photo['file_name'] ?></h5>
							</div>
						</div>

					<?php endforeach; ?>
				</div>
				<!-- Masonry Gallery Grid Item -->
			</div>
		</div>
	</div>
</section>

<?php include 'footer.php'; ?>