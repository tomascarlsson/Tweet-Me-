<?php 
/**
 * Bootstrapping the main files
 */
require_once 'config/config.php';
require_once 'libraries/Database.php';
require_once 'core/Controller.php';
require_once 'core/App.php';
require_once 'libraries/Session.php';

/**
 * Helper Function Files
 */
require_once('helpers/system_helper.php');
require_once('helpers/database_helper.php');

/**
 * Start sessions on entire application
 */
Session::start();