    
 <?php include 'header.php' ?>

<div role="main" class="main">

	<section
		class="page-header page-header-color page-header-quaternary page-header-more-padding custom-page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>تسجيل الدخول</h1>
				</div>
			</div>
		</div>
	</section>

	<div class="container">
		<div class="row pt-xs pb-xl mb-md">
			<div class="col-md-12"> 
                <div class="login">
                    <form action="../api?key=login-admin" class="loginClient" method="post">

                        <? if (isset($_SESSION['wrong-submit'])) { ?>
                        <div class="alert alert-danger">
                            <strong>خطأ!</strong> - هناك خطأ فى عملية التسجيل.
                        </div>
                        <? unset($_SESSION['wrong-submit']); } ?>

                        <div class="form-group">
                            <div class="col-md-12">
								<div class="custom-input-box">
									<label for="email">البريد الاليكتروني </label>
									<input type="email" name="val[email]" maxlength="100" class="form-control" id="email" placeholder="البريد الاليكتروني*" required>
								</div>
							</div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
								<div class="custom-input-box">
									<label for="pass">كلمة المرور </label>
									<input type="password" name="val[pass]" maxlength="100" class="form-control" id="pass" placeholder="كلمة المرور*" required>
								</div>
							</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" name="submit" value="أدخال" class="btn btn-borders btn-primary custom-btn-style-2 font-weight-semibold text-color-dark text-uppercase mt-sm" data-loading-text="Loading...">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>