<?php include('../app/views/includes/header.php') ?>

<h1>Contacts</h1>

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

	              <div class="column-small">
	              	<p><a href="<?= BASE_URI; ?>contact/follow/<?= $row->user_id ?>">Follow</a></p>
	              </div>
	          	<div class="column-small">
	          		<p><a href="<?= BASE_URI; ?>contact/unfollow/<?= $row->user_id ?>">Unfollow</a></p>
	          	</div>

	          </div><!-- /.row -->


	  <?php endforeach; ?>

    <?php else : ?>
    	<p> Inget hittades. Hmm...</p>
   <?php endif; ?> 	


<?php include('../app/views/includes/footer.php') ?>
