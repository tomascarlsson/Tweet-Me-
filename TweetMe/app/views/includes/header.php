<?php 
//Session::display(); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

		
		<title>Tweet Me</title>

		 <!-- Custom CSS for this template -->
	 <link href="<?php echo BASE_URI; ?>/css/tweetme.css" rel="stylesheet">

	 <!-- Javascripts -->
	<script  src="<?php echo BASE_URI; ?>/js/events/Event.js"> </script> 
    <script  src="<?php echo BASE_URI; ?>/js/cookie.js"> </script>  
    <script  src="<?php echo BASE_URI; ?>/js/scripts.js"> </script>  
    <script  src="<?php echo BASE_URI; ?>/js/Main.js"> </script>  

	</head>

<body>
<div id="container">
  <div id="content">

    <header>
      <div class="row"><div id="logotype"></div></div>
      <div class="row" id="brandname">TweetMe</div>
      <div class="row"><?php
       if( Session::get('user_email') )
        include('navigation.php'); 
       ?></div>    
    </header><!-- /.row -->
      <div class="line">&nbsp;</div>
