<?php 
    include 'header.php';
    $blog = getRow($_GET['id'], 'blog');
?>

<div role="main" class="main">

	<section
		class="page-header page-header-color page-header-quaternary page-header-more-padding custom-page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
                    <?php
                    $date = new DateTime($blog['created_at']);
                    echo '<h1>- '. $blog['title'] .'</h1>
                        <div class="date">
                            <span class="day">'. $date->format('d') .'</span>
                            <span class="month">'. $date->format('M') .'</span>
                        </div>';
                    ?>
				</div>
			</div>
		</div>
	</section>

	<div class="container">
		<div class="row pt-xs pb-xl mb-md">
            <div class="col-md-12">
                <?php echo $blog['body'] ?>
            </div>
            
        </div>
        
    </div>
    <hr class="tall">

</div>

<?php include 'footer.php' ?>
