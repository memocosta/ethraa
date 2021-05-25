		<footer id="footer" class="custom-footer background-color-light m-none">
			<div class="container">
				<div class="row">
					<div class="col-md-2">
						<a href="#" class="text-decoration-none">
							<img src="img/logo1.png" width="" height="45" class="img-responsive" alt />
						</a>
					</div>
					<div class="col-md-2 col-md-offset-1">
						<h5 class="text-color-dark font-weight-bold mb-xs">خدمه العملاء</h5>
						<ul>
							<li>
								<a class="custom-text-color-1" href="tel:<?php echo $sAdmin['phone']; ?>" target="_blank" title="Call Us">
									<?php echo $sAdmin['phone']; ?>
								</a>
							</li>
							<li>
								<a class="custom-text-color-1" href="./contact" title="Contact Us">
									للاتصال بنا
								</a>
							</li>
						</ul>
					</div>
					<div class="col-md-2 col-md-offset-1">
						<h5 class="text-color-dark font-weight-bold mb-xs">العنوان</h5>
						<p class="custom-text-color-1">
							ا<?php echo $sAdmin['address']; ?>
						</p>
					</div>
					<div class="col-md-2">
						<h5 class="text-color-dark font-weight-bold mb-xs">الروابط</h5>
						<ul>
							<li>
								<a class="custom-text-color-1" href="./about">
									عن اثراء
								</a>
							</li>
							<li>
								<a class="custom-text-color-1" href="./services">
									خدماتنا
								</a>
							</li>
							
							<li>
								<a class="custom-text-color-1" href="./blog">
									مدونتنا
								</a>
							</li>
						</ul>
					</div>
					<div class="col-md-2">
						<ul class="social-icons custom-social-icons">
							<li class="social-icons-facebook">
								<a href="<?php echo $sAdmin['facebook']; ?>" target="_blank" title="Facebook">
									<i class="fa fa-facebook"></i>
								</a>
							</li>
							<li class="social-icons-twitter">
								<a href="<?php echo $sAdmin['twitter']; ?>" target="_blank" title="Twitter">
									<i class="fa fa-twitter"></i>
								</a>
							</li>
							<li class="social-icons-instagram">
								<a href="<?php echo $sAdmin['instagram']; ?>" target="_blank" title="Instagram">
									<i class="fa fa-instagram"></i>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="footer-copyright background-color-light m-none pt-md pb-md">
				<div class="container">
					<div class="row">
						<div class="col-md-12 center pt-md">
							<p class="custom-text-color-1">© حقوق الملكيه محفوظه 2020</p>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>

	<!-- Vendor -->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/jquery.easing/jquery.easing.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/common/common.min.js"></script>
	<script src="vendor/owl.carousel/owl.carousel.min.js"></script>
	<script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
	<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-8CMQ1L47L9"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'G-8CMQ1L47L9');
	</script>

	<!--Start of Tawk.to Script-->
	<script type="text/javascript">
		var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
		(function(){
			var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
			s1.async=true;
			s1.src='https://embed.tawk.to/60acd6a5bbd5354c0fdbfd08/1f6hicu5n';
			s1.charset='UTF-8';
			s1.setAttribute('crossorigin','*');
			s0.parentNode.insertBefore(s1,s0);
		})();
	</script>
	<!--End of Tawk.to Script-->

	<!-- Theme Base, Components and Settings -->
	<script src="js/theme.js"></script>

	<script src="vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
	<script src="vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

	<!-- Convert to image -->
	<script type="text/javascript" src="js/html2canvas.js"></script>

	<!-- Theme Custom -->
	<script src="js/custom.js"></script>

	<!-- Benefits Calculator -->
	<script src="js/calc.js"></script>

	<!-- Theme Initialization Files -->
	<script src="js/theme.init.js"></script>


</body>

</html>