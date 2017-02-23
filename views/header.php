<?php 
$uri = '/';
 if(isset($_GET['uri'])) {
  $uri = htmlspecialchars($_GET['uri']);
 }

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>Students Information System</title>

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="viewcourses">Students Information System</a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
           <li class="<?= ($uri == '/' || $uri == 'viewscourses') ? 'active' : '' ?>">
              <a href="viewcourses">View Courses</a>
           </li>
           <li class="<?= ($uri == 'viewstudents') ? 'active' : '' ?>">
              <a href="viewstudents">View Students</a>
           </li>
           <li class="<?= ($uri == 'addcoursesform') ? 'active' : '' ?>">
              <a href="addcoursesform">Add Courses</a>
           </li>     
           <li class="<?= ($uri == 'addstudentsform') ? 'active' : '' ?>">
              <a href="addstudentsform">Add Students</a>
           </li>
        </ul>
      </div>
    </div>
  </nav>