		<div class="motopress-wrapper footer">

		    <div class="container">

		        <div class="row">

		            <div class="span12" data-motopress-wrapper-file="wrapper/wrapper-footer.php" data-motopress-wrapper-type="footer">

		                <?php get_template_part('wrapper/wrapper-footer'); ?>

		            </div>

		        </div>

		    </div>

		</div>

		<footer class="motopress-wrapper copyright-wrapper">

			<div class="container">

				<div class="row">

					<div class="span12" data-motopress-wrapper-file="wrapper/wrapper-copyright.php" data-motopress-wrapper-type="footer">

						<?php get_template_part('wrapper/wrapper-copyright'); ?>

						

						<div id="back-top-wrapper" class="visible-desktop">

						    <p id="back-top">

						        <a href="#top"><span><i class="icon-angle-up"></i></span></a>

						    </p>

						</div>

	            </div>

				</div>

			</div>

		</footer>

		<!--End #motopress-main-->

	</div>

	<?php wp_footer(); ?> <!-- this is used by many Wordpress features and for plugins to work properly -->

	<?php if(of_get_option('ga_code')) { ?>

		<script type="text/javascript">

			<?php echo stripslashes(of_get_option('ga_code')); ?>

		</script>

	  <!-- Show Google Analytics -->	

	<?php } ?>
</body>

</html>