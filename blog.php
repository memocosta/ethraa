<?php include 'header.php' ?>

<div role="main" class="main">

	<section
		class="page-header page-header-color page-header-quaternary page-header-more-padding custom-page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>- مدوناتنا</h1>
				</div>
			</div>
		</div>
	</section>

	<div class="container">

        <div class="row mb-xl">
            <?php
                $blogs = selectTable('blog', 'ORDER BY `id` DESC ');
                for ($i=0; $i < count($blogs); $i++) {
                    $date = new DateTime($blogs[$i]['created_at']);
                    echo '<div class="col-md-6">
                            <div class="recent-posts mt-xl mb-xl">
                                <article class="post">
                                    <div class="date">
                                        <span class="day">'. $date->format('d') .'</span>
                                        <span class="month">'. $date->format('M') .'</span>
                                    </div>
                                    <h4 class="pt-md pb-none mb-none"><a class="text-color-dark" href="./single-blog?id='. $blogs[$i]['id'] .'">'. $blogs[$i]['title'] .'</a></h4>
                                    <p>'. $blogs[$i]['body_short'] .'</p>
                                    <a class="mt-md" href="./single-blog?id='. $blogs[$i]['id'] .'">اقراء المزيد <i class="fa fa-long-arrow-left"></i></a>
                                </article>
                            </div>
                        </div>';
                }
            ?>
        </div>

    </div>
    <hr class="tall">

</div>

<?php include 'footer.php' ?>
