<?php 
    include 'header.php';
    $partner = (isset($_GET['id'])) ? getRow($_GET['id'], 'partner') : getRow(1, 'partner');
?>

<div role="main" class="main">
    <section class="page-header page-header-color page-header-quaternary page-header-more-padding custom-page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
                <?php $value = isset($_GET['id']) ? 'تعديل شريك' : 'أضافة شريك'; ?>
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

                <?php $value = isset($_GET['id']) ? '../api?key=updatePartner' : '../api?key=addPartner'; ?>
                <form id="contactForm" class="custom-contact-form-style-1" action="<?php echo $value; ?>" method="POST" enctype="multipart/form-data">
                    <?php if (isset($_GET['id'])) { ?>
                        <input type="hidden" value="<?php echo $partner['id']; ?>" name="row_id" required/>
                    <?php } ?>
					<div class="row">
						<div class="form-group">
							<div class="col-md-12">
								<div class="custom-input-box">
									<label for="img">الصورة </label>
									<input type="file" name="img" class="form-control" id="img" required>
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
