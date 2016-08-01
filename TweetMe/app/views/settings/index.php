<?php include('../app/views/includes/header.php') ?>


<h1>Settings</h1>

  <!-- Listing Content -->
 

<div class="row">
    <h2>Update settings</h2>
    <form id="sign_in" method="post" action=""  enctype="multipart/form-data" > 
      <p><label for="full_name">Name</label><br><input type="text" name="full_name" id="full_name" placeholder="Full name"></p>
      <p><label for="user_name">Username</label><br><input type="user_name" name="user_name" id="user_name" placeholder="Username"> </p>
      <p><label for="file">Picture</label><br> <input type="file" name="profilepicture" id="file"> </p>
      <p> <input type="submit" name="save_changes" value="Save changes"> </p> 
    </form>

</div>


<?php include('../app/views/includes/footer.php') ?>



