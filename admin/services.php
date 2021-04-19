<?php include 'header.php'; ?>

<div role="main" class="main">
    <section class="page-header page-header-color page-header-quaternary page-header-more-padding custom-page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>- خدماتنا</h1>
				</div>
			</div>
		</div>
	</section>

    <div class="container">

        <div class="row pt-sm mb-xl">
            
            <div class="col-md-12">
                <?php if (isset($_SESSION['wrong-submit'])) { ?>
				<div class="alert alert-danger mt-lg" id="contactSuccess">
					<strong>خطأ!</strong> - هناك خطأ فى عملية التعديل.
					<span class="font-size-xs mt-sm display-block" id="mailErrorMessage"></span>
				</div>
				<?php unset($_SESSION['wrong-submit']); } ?>

                <div class="table-responsive">
                    <table class="table table-bordered  table-striped table-hover">
                        <thead class="thead-inverse">
                            <tr>
                                <th>#</th>
                                <th>العنوان</th>
                                <th>الوصف</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="show-services">
                            <?php
                            $services = selectTable('service', '');
                            $k = 1;
                            foreach ($services as $service) {
                                echo '<tr>
                                        <td>'.$k.'</td>
                                        <td>'.$service['title'].'</td>
                                        <td>'.$service['body_short'].'</td>
                                        <td class="service-option">
                                            <a href="../api?key=deleteRow&table=service&id='.$service['id'].'">    
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>
                                            <a href="./add-service?id='.$service['id'].'">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>';
                                $k++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <a href="./add-service" class="btn btn-borders btn-primary custom-btn-style-2 font-weight-semibold text-color-dark text-uppercase mt-sm">أضافة خدمة</a>
            </div>
        </div>

    </div>
</div>

<?php include 'footer.php' ?>
