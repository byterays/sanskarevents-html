<?php include 'header.php'; ?>

<?php 
$videos = ['Q9lDN-SeNt', 'k3RGyGTlzOs', 'udEH-nEhCdU', 'sKIiZOMV6PA'];
?>
<!-- Wrapper Start -->
<!-- Our Gallery -->
<section class="ulockd-service-three">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 text-center">
				<div class="ulockd-main-title">
					<h2>Our Events <span class="text-thm2">Video Gallery</span></h2>

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
				<div id="grid" class="masonry-gallery video-gallery grid-3 mrgn10 clearfix">

					<!-- Masonry Item -->
					 <?php foreach ($videos as $video): ?>
					<div class="isotope-item creative corporate">
						<div class="ulockd-about-video mrgn10 ulockd-mrgn1225">
							<div class="ulockd-avdo-thumb">
								<iframe class="h250" src="http://www.youtube.com/embed/<?php echo $video; ?>?autoplay=0"
									allowfullscreen=""></iframe>
							</div>
						</div>
						<!-- <div class="details text-center">
							<h5>Gallery Title Here</h5>							
						</div> -->
					</div>
					<?php endforeach; ?>

				</div>
				<!-- Masonry Gallery Grid Item -->
			</div>
		</div>
	</div>
</section>

<?php include 'footer.php'; ?>