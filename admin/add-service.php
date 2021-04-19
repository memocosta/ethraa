<?php 
    include 'header.php';
    $service = (isset($_GET['id'])) ? getRow($_GET['id'], 'service') : getRow(1, 'service');
?>

<div role="main" class="main">
    <section class="page-header page-header-color page-header-quaternary page-header-more-padding custom-page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
                <?php $value = isset($_GET['id']) ? 'تعديل خدمة' : 'أضافة خدمة'; ?>
		            <h1>- <?php echo $value; ?></h1>
				</div>
			</div>
		</div>
	</section>

    <div class="container">

        <div class="row pt-sm mb-xl">
            
            <div class="col-md-12">
                <?php if (isset($_SESSION['wrong-submit'])) { ?>
				<div class="alert alert-danger mt-lg" id="contactSuccess">
					<strong>خطأ!</strong> - هناك خطأ   .
					<span class="font-size-xs mt-sm display-block" id="mailErrorMessage"></span>
				</div>
				<?php unset($_SESSION['wrong-submit']); } ?>

                <?php $value = isset($_GET['id']) ? '../api?key=updateRow' : '../api?key=addRow'; ?>
                <form id="contactForm" class="custom-contact-form-style-1" action="<?php echo $value; ?>" method="POST">
                    <?php if (isset($_GET['id'])) { ?>
                        <input type="hidden" value="<?php echo $service['id']; ?>" name="row_id" required/>
                    <?php } ?>
                    <input type="hidden" value="services" name="link" required/>
                    <input type="hidden" value="service" name="table" required/>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="title">الاسم </label>
                                    <?php $value = isset($_GET['id']) ? 'value="'.$service['title'].'"' : ''; ?>
									<input type="text" <?php echo $value; ?> name="val[title]" data-msg-required="الاسم" maxlength="100" class="form-control" id="title" placeholder="الاسم*" required>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="body_short">الوصف </label>
                                    <?php $value = isset($_GET['id']) ? $service['body_short'] : ''; ?>
									<textarea  rows="3" class="form-control" name="val[body_short]" id="body_short" placeholder="الوصف*" required><?php echo $value; ?></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="body">المحتوى </label>
                                    <?php $value = isset($_GET['id']) ? $service['body'] : ''; ?>
									<textarea  rows="3" class="form-control" name="val[body]" id="body" placeholder="المحتوى*" required><?php echo $value; ?></textarea>
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
