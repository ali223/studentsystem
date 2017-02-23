<?php

require "vendor/autoload.php";

$routes = require "configroutes.php";
 
 $uri = '/';
 if(isset($_GET['uri'])) {
 	$uri = htmlspecialchars($_GET['uri']);
 }

$routes->direct($uri);
