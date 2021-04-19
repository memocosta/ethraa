<?php include 'header.php'; ?>

<div role="main" class="main">
    <section class="page-header page-header-color page-header-quaternary page-header-more-padding custom-page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
                <h1>- مدوناتنا</h1>
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
                                <th>التاريخ</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="show-blogs">
                            <?php
                            $blogs = selectTable('blog', 'ORDER BY `id` DESC ');
                            $k = 1;
                            foreach ($blogs as $blog) {
                                $date = new DateTime($blog['created_at']);
                                echo '<tr>
                                        <td>'.$k.'</td>
                                        <td>'.$blog['title'].'</td>
                                        <td>'.$blog['body_short'].'</td>
                                        <td class="blog-date">'.$date->format('d M Y H:i:s').'</td>
                                        <td class="blog-option">
                                            <a href="../api?key=deleteRow&table=blog&id='.$blog['id'].'">    
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </a>
                                            <a href="./add-blog?id='.$blog['id'].'">
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

                <a href="./add-blog" class="btn btn-borders btn-primary custom-btn-style-2 font-weight-semibold text-color-dark text-uppercase mt-sm">أضافة خبر</a>
            </div>
        </div>

    </div>
</div>

<?php include 'footer.php' ?>
