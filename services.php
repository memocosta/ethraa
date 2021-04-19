<?php 
    include 'header.php';
    $service = (isset($_GET['id'])) ? getRow($_GET['id'], 'service') : getRow(1, 'service');
?>

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
            
            <div class="col-md-9">
                <?php echo $service['body'] ?>
            </div>

            <div class="col-md-3">
                <aside class="sidebar">

                    <ul class="nav nav-list mb-xl show-bg-active">
                        <?php
							$services = selectTable('service', '');
							for ($i=0; $i < count($services); $i++) {
                                echo '<li '. (($services[$i]['id'] == $service['id']) ? 'class="active"' : '' ) .'><a href="./services?id='. $services[$i]['id'] .'">'. $services[$i]['title'] .'</a></li>';
							}
						?>
                    </ul>

                </aside>

            </div>
        </div>

    </div>
</div>

<?php include 'footer.php' ?>
