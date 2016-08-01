<?php include('../app/views/includes/header.php') ?>


	<!-- Log in Form -->
	<div class="row">
		
		<h1>Sign in</h1>
		<form id="sign_in" method="post" action=""> 
			<p> <input type="text" name="email" id="email" placeholder="E-mail"> </p>
			<p> <input type="text" name="password" id="password" placeholder="Password"> </p>
			<p>	<input type="submit" name="sign_in" value="Sign in"> </p> 
		</form>

	<!-- Registeration Form -->
		<h2>Register a new account</h2>
		<form id="register" method="post" action=""> 
			<p> <input type="text" name="fullname" id="name" placeholder="Full name"> </p>
			<p> <input type="text" name="email" id="email" placeholder="E-mail"> </p>
			<p> <input type="text" name="password" id="password" placeholder="Password"> </p>
			<p>	<input type="submit" name="register" value="Register"> </p> 
		</form>


	</div>


<?php include('../app/views/includes/footer.php') ?>
