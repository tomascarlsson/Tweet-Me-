<?php include('../app/views/includes/header.php') ?>

<h1>The Tweet Wall</h1>

	<!-- Listing Content -->
  	<?php if ($data) : ?>

        <?php foreach($data as $row) : ?>

          <div class="row-content">     

              <div class="column-small">
                <img class="profilepicture" src="<?php echo BASE_URI; ?>images/profilepictures/<?=  $row->picture ?>" alt="image" />
              </div>

              <div class="column-large">
                <p><strong><?= $row->fullname; ?></strong> | <span class="username"><?= $row->username; ?></span><br></p>
                <p><?= $row->message; ?></p>
              </div>  

              <div class="column-small"> 
                <p><span class="date"><?= $row->date; ?></span></p>
              </div>

              <div class="column-small delete-tweet">
               <p clas="delete-tweet">
                <?php if ( $row->user_id == getUserId( Session::get('user_email') ) ) : ?>
                   <a href="<?php echo BASE_URI; ?>home/deletetweet/<?=  $row->id ?>">Delete tweet</a>
                <?php endif; ?>  
               </p>
               
              </div>

          </div><!-- /.row -->

         <?php endforeach; ?> 

    <?php else : ?>
    	<p>No tweets yet...</p>
   <?php endif; ?> 	



<?php include('../app/views/includes/footer.php') ?>


