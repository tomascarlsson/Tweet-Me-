<?php include('../app/views/includes/header.php') ?>

<h1>Add a Tweet</h1>

<form action="" method="post">
  <textarea name="message" id="message" cols="60" rows="3" maxlength="140" placeholder="Compose new tweet... (max 140 characters)"></textarea><br>
  <input type="submit" name="submit_tweet" value="Tweet">
</form>
<br><br>

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

          </div><!-- /.row -->

         <?php endforeach; ?> 

    <?php else : ?>
      <p> Inget hittades. Hmm...</p>
   <?php endif; ?>  



<?php include('../app/views/includes/footer.php') ?>


