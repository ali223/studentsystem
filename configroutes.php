<?php
use StudentsApp\Route;

$route = new Route();

$route->add('/'						, 		'CoursesController@index');
$route->add('viewstudents'       	,    	'StudentsController@index');
$route->add('viewstudentdetails'    ,    	'StudentsController@show');
$route->add('addstudentsform'      	, 		'StudentsController@create');
$route->add('savestudent'      	    ,  		'StudentsController@store');
$route->add('viewcourses'       	,    	'CoursesController@index');
$route->add('addcoursesform'        , 		'CoursesController@create');
$route->add('savecourse'       	    ,  		'CoursesController@store');
$route->add('viewcoursestudents'    ,    	'CoursesController@show');
$route->add('error'            		,  		'PagesController@showError');
$route->add('errortechnical'        ,  		'PagesController@showErrorTechnical');

return $route;