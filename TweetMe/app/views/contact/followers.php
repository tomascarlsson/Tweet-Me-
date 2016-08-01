<?php include('../app/views/includes/header.php') ?>

<h1>Contacts</h1>
<h2>Followers</h2>

  	<!-- Listing Content -->
  	<?php if ($data) : ?>
	   <?php foreach($data as $row) : ?>


	          <div class="row-content">     

	              <div class="column-small">
	                <img class="profilepicture" src="<?php echo BASE_URI; ?>images/profilepictures/<?=  $row->picture ?>" alt="image" />
	              </div>

	              <div class="column-small">
	                <p><strong><?= $row->fullname; ?></strong> | <span class="username"><?= $row->username; ?></span><br></p>
	                <p></p>
	              </div>  


	          </div><!-- /.row -->


	  <?php endforeach; ?>

    <?php else : ?>
    	<p><em>No followers yet...</em></p>
   <?php endif; ?> 	


<?php include('../app/views/includes/footer.php') ?>
