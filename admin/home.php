<?php include 'header.php' ?>

<div role="main" class="main">

	<section
		class="page-header page-header-color page-header-quaternary page-header-more-padding custom-page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>- الاعدادات العامة</h1>
				</div>
			</div>
		</div>
	</section>

	<div class="container">
		<div class="row pt-xs pb-xl mb-md">
			<div class="col-md-12">

				<?php if (isset($_SESSION['wrong-submit'])) { ?>
				<div class="alert alert-danger mt-lg" id="contactSuccess">
					<strong>خطأ!</strong> - هناك خطأ فى عملية التعديل.
					<span class="font-size-xs mt-sm display-block" id="mailErrorMessage"></span>
				</div>
				<?php unset($_SESSION['wrong-submit']); } ?>

				<form id="contactForm" class="custom-contact-form-style-1" action="../api?key=updateCPanel" method="POST">
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="phone">الهاتف </label>
									<input type="text" value="<?php echo $sAdmin['phone']; ?>" name="val[phone]" data-msg-required="الهاتف" maxlength="100" class="form-control" id="phone" placeholder="الهاتف*" required>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="email">البريد الاليكتروني </label>
									<input type="email" value="<?php echo $sAdmin['email']; ?>" name="val[email]" maxlength="100" class="form-control" id="email" placeholder="البريد الاليكتروني*" required>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="pass">كلمة المرور </label>
									<input type="password" value="<?php echo $sAdmin['pass']; ?>" name="val[pass]" maxlength="100" class="form-control" id="pass" placeholder="كلمة المرور*" required>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="address">العنوان </label>
									<textarea  rows="3" class="form-control" name="val[address]" id="address" placeholder="العنوان*" required><?php echo $sAdmin['address']; ?></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="map">الموقع الجغرافى </label>
									<textarea  rows="3" class="form-control" name="val[map]" id="map" placeholder="الموقع الجغرافى*" required><?php echo $sAdmin['map']; ?></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="facebook">الفيس بوك </label>
									<input type="text" value="<?php echo $sAdmin['facebook']; ?>" name="val[facebook]" data-msg-required="الفيس بوك" maxlength="100" class="form-control" id="facebook" placeholder="الفيس بوك*" required>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="twitter">تويتر </label>
									<input type="text" value="<?php echo $sAdmin['twitter']; ?>" name="val[twitter]" data-msg-required="تويتر" maxlength="100" class="form-control" id="twitter" placeholder="تويتر*" required>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="instagram">أنستجرام </label>
									<input type="text" value="<?php echo $sAdmin['instagram']; ?>" name="val[instagram]" data-msg-required="أنستجرام" maxlength="100" class="form-control" id="instagram" placeholder="أنستجرام*" required>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="vision">رؤيتنا </label>
									<textarea  rows="3" class="form-control" name="val[vision]" id="vision" placeholder="رؤيتنا*" required><?php echo $sAdmin['vision']; ?></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="mission">مهمتنا </label>
									<textarea  rows="3" class="form-control" name="val[mission]" id="mission" placeholder="مهمتنا*" required><?php echo $sAdmin['mission']; ?></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="about_short">من نحن </label>
									<textarea  rows="3" class="form-control" name="val[about_short]" id="about_short" placeholder="من نحن*" required><?php echo $sAdmin['about_short']; ?></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="about">عن أثراء </label>
									<textarea  rows="3" class="form-control" name="val[about]" id="about" placeholder="عن أثراء*" required><?php echo $sAdmin['about']; ?></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="judicial_accountability_short"> المحاسبه القضائية عنوان </label>
									<input type="text" value="<?php echo $sAdmin['judicial_accountability_title']; ?>" name="val[judicial_accountability_title]" data-msg-required="المحاسبه القضائية" maxlength="100" class="form-control" id="judicial_accountability_title" placeholder="المحاسبه القضائية*" required>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="judicial_accountability_short">المحاسبه القضائية مختصرة </label>
									<textarea  rows="3" class="form-control" name="val[judicial_accountability_short]" id="judicial_accountability_short" placeholder="المحاسبه القضائية مختصرة*" required><?php echo $sAdmin['judicial_accountability_short']; ?></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="judicial_accountability">المحاسبه القضائية </label>
									<textarea  rows="3" class="form-control" name="val[judicial_accountability]" id="judicial_accountability" placeholder="المحاسبه القضائية*" required><?php echo $sAdmin['judicial_accountability']; ?></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="consulting_short"> الاستشارات عنوان </label>
									<input type="text" value="<?php echo $sAdmin['consulting_title']; ?>" name="val[consulting_title]" data-msg-required="الاستشارات" maxlength="100" class="form-control" id="consulting_title" placeholder="الاستشارات*" required>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="consulting_short"> الاستشارات مختصرة </label>
									<textarea  rows="3" class="form-control" name="val[consulting_short]" id="consulting_short" placeholder="الاستشارات مختصرة*" required><?php echo $sAdmin['consulting_short']; ?></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="consulting">الاستشارات </label>
									<textarea  rows="3" class="form-control" name="val[consulting]" id="consulting" placeholder="الاستشارات*" required><?php echo $sAdmin['consulting']; ?></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="economic_studies_title"> الدراسات الجدوى الإقتصادية عنوان </label>
									<input type="text" value="<?php echo $sAdmin['economic_studies_title']; ?>" name="val[economic_studies_title]" data-msg-required="الدراسات الجدوى الإقتصادية" maxlength="100" class="form-control" id="economic_studies_title" placeholder="الدراسات الجدوى الإقتصادية*" required>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="economic_studies_short"> الدراسات الجدوى الإقتصادية مختصرة </label>
									<textarea  rows="3" class="form-control" name="val[economic_studies_short]" id="economic_studies_short" placeholder="الدراسات الجدوى الإقتصادية مختصرة*" required><?php echo $sAdmin['economic_studies_short']; ?></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="economic_studies">الدراسات الجدوى الإقتصادية </label>
									<textarea  rows="3" class="form-control" name="val[economic_studies]" id="economic_studies" placeholder="الدراسات الجدوى الإقتصادية*" required><?php echo $sAdmin['economic_studies']; ?></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<input type="submit" name="submit" value="ارسل الان" class="btn btn-borders btn-primary custom-btn-style-2 font-weight-semibold text-color-dark text-uppercase mt-sm" data-loading-text="Loading...">
						</div>
					</div>
				</form>
			</div>
		</div>

	</div>

</div>

<?php include 'footer.php' ?>
