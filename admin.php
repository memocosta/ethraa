<?php include 'header.php' ?>

<div role="main" class="main">

	<section class="page-header page-header-color page-header-quaternary page-header-more-padding custom-page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>لوحة الادمن</h1>
				</div>
			</div>
		</div>
	</section>

	<div class="container">
		<div class="row pt-xs pb-xl mb-md">
			<div class="col-md-8">

				<h2 class="font-weight-bold text-color-dark">- ارسل رساله</h2>
				<p>ارسل رساله لنا وسيقوم احد المختصين بالرد عليك</p>

				<div class="alert alert-success hidden mt-lg" id="contactSuccess">
					<strong>تم الارسال!</strong>
				</div>

				<div class="alert alert-danger hidden mt-lg" id="contactError">
					<strong>Error!</strong> There was an error sending your message.
					<span class="font-size-xs mt-sm display-block" id="mailErrorMessage"></span>
				</div>

				<form id="contactForm" class="custom-contact-form-style-1" action="php/contact-form.php"
					method="POST">
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<i class="icon-user icons text-color-primary"></i>
									<input type="text" value="" data-msg-required="الاسم"
										maxlength="100" class="form-control" name="name" id="name"
										placeholder="الاسم*" required>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<i class="icon-envelope icons text-color-primary"></i>
									<input type="email" value="" maxlength="100"
										class="form-control" name="email" id="email" placeholder="البريد الاليكتروني*"
										required>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<i class="icon-bubble icons text-color-primary"></i>
									<textarea maxlength="5000"
										rows="10" class="form-control" name="message" id="message"
										placeholder="الرساله*" required></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<input type="submit" value="ارسل الان"
								class="btn btn-borders btn-primary custom-btn-style-2 font-weight-semibold text-color-dark text-uppercase mt-sm"
								data-loading-text="Loading...">
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-4">

				<div class="row mb-xl">
					<div class="col-md-12">
						<div class="feature-box feature-box-style-2">
							<div class="feature-box-icon mt-xs">
								<i class="icon-location-pin icons"></i>
							</div>
							<div class="feature-box-info">
								<h2 class="font-weight-bold text-color-dark">- العنوان</h2>
								<p class="font-size-lg">
									الدور الاخير –  محل رقم ٢ – مول المغاتير<br>
									شارع حبيب مناور –قطعه ٣ - الفروانية<br>
									الكويت –  مدينه الكويت
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-xl">
					<div class="col-md-12">
						<div class="feature-box feature-box-style-2">
							<div class="feature-box-icon mt-xs">
								<i class="icon-phone icons"></i>
							</div>
							<div class="feature-box-info">
								<h2 class="font-weight-bold text-color-dark">- خدمه العملاء</h2>
								<p class="font-size-lg">
									800 123 4567 <br>
									800 123 4567
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-xl">
					<div class="col-md-12">
						<div class="feature-box feature-box-style-2">
							<div class="feature-box-icon mt-xs">
								<i class="icon-envelope icons"></i>
							</div>
							<div class="feature-box-info">
								<h2 class="font-weight-bold text-color-dark">- الايميل</h2>
								<p class="font-size-lg">
									<a href="mailto:mail@example.com"
										class="text-decoration-none">mail@example.com</a><br>
									<a href="mailto:mail2@example.com"
										class="text-decoration-none">mail2@example.com</a>
								</p>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>

</div>

<?php include 'footer.php' ?>
