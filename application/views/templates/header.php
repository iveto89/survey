<!DOCTYPE html>
<html>
<head>
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.min.css');?>" />

  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="http://www.redexperu.com/assets/js/bootstrap-progressbar/less/bootstrap-progressbar-3.2.0-3.x.x.less">
   <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/css.css');?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/styles/layout.css');?>" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <?php // header('Content-type: text/html; charset=utf-8'); ?>
  <style>
    li {
      list-style: none;
      display: inline-block;
    }
   /* #dropdown li {
      width: 220px;
    }*/
    #dropdown {
      float: right;  
    }
  
    #dropdown-toggle {
      text-align: center;
      margin-left:4px !important;
    }
    .caret {
      text-align: center;
    }
    
    #nav {
      height: 50px;
    }
    #results {
      float: right;
    }
    #nav  .active a{
      background: #2980b9 ;
      color:white !important;
    }
    #nav a {
      /*width: 190px !important;*/
    }
    #results a {
      width: 190px !important;
    }
     #user_manage a {
      width: 220px !important;
    }
    
    
 
  </style>
  <script>
  $(function () {
    setNavigation();
});

function setNavigation() {
    var path = window.location.pathname;
    path = path.replace(/\/$/, "");
    path = decodeURIComponent(path);

    $("#nav a").each(function () {
        var href = $(this).attr('href');
        if (path.substring(0, href.length) === href) {
            $(this).closest('li').addClass('active');
        }
    });
}

  </script>
</head>
<body>
  <div class="container">

    <div id="header">
      <h1></h1>
       <div class = "row">
       <div class = "col-md-7">
         <span id='logos' ><a  href='#'> <img src="http://21stcenturyskills.info/wp-content/themes/zvcp/images/logo-bg.png" /></a>
        </span></div>
        <div class = "social col-md-4">
   <span id="social_links">Последвайте ни и тук:</span><br/>
    <span id="social_links"><a href="http://www.facebook.com/teachforbulgaria" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a></span>
   <span id="social_links">
    <a href="http://twitter.com/zaednovchas" target="_blank"><i class="fa fa-twitter fa-2x"></i></a>
  </span>
  <span id="social_links"><a href="http://www.youtube.com/user/teachforbulgaria" target="_blank"><i class="fa fa-youtube  fa-2x"></i></a></span>
   <span id="social_links"><a href="http://www.linkedin.com/company/1273201?trk=tyah&amp;trkInfo=tas%3Azaedno%20%2Cidx%3A1-2-2" target="_blank"><i class="fa fa-linkedin  fa-2x"></i></a></span>
   <br/><br/></div></div>

      <?php
       if ($this->session->userdata('is_logged_in') && $this->session->userdata('is_logged_in') == TRUE) { 

       echo "<h4 id='header_title'>"; echo anchor('authentication/logout', 'Излез'); } ?></h4>
      <?php if ($this->session->userdata('is_logged_in') && $this->session->userdata('is_logged_in') == TRUE) { ?>
      <h4 id='header_title'>
        Здравей, <?php  echo $this->session->userdata['username'] ; echo '!';} ?>  
      </h4> 

      <?php if($this->session->userdata('is_logged_in') && $this->session->userdata('is_logged_in') == TRUE) {
        echo "<div id='nav'>  <ul class='nav navbar-nav' >";

          foreach ($menu as $m) : ?>     
        
           <li><a id='dropdown-toggle' class="dropdown-toggle" href="<?php echo site_url($m->link); ?>"><?php echo ($m->name); ?></a></li>
            
          <?php endforeach ;  ?></ul>
          
          <?php /*<ul class="nav navbar-nav" id='results'>
         <li class="dropdown" ><a class="dropdown-toggle" id="dropdown-toggle" data-toggle="dropdown" href="#">
        Диаграми <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?= base_url() ?>index.php/chart/activity_chart/1">Анкета 1</a></li>
            <li><a href="<?= base_url() ?>index.php/chart/activity_chart/2">Анкета 2</a></li>
            <li><a href="<?= base_url() ?>index.php/chart/activity_chart/3">Анкета 3</a></li>
          </ul>
        </li>

        </ul>*/ ?>
         <?php  if($this->session->userdata('role_id') == 4 ) { ?>
        <ul class="nav navbar-nav" id='dropdown'>
          <li class="dropdown" ><a class="dropdown-toggle" id="dropdown-toggle" data-toggle="dropdown" href="#">
          Админ Резултати <span class="caret"></span></a>
            <ul class="dropdown-menu" id='results'>
              <li><a href="<?= base_url() ?>index.php/results/admin_coord_show">Резултати на класове</a></li>
           

            </ul>
        </li>
        </ul>
        <?php } ?>


         <?php if($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 4) { ?>
        <ul class="nav navbar-nav" id='dropdown'>
          <li class="dropdown" ><a class="dropdown-toggle" id="dropdown-toggle" data-toggle="dropdown" href="#">
          Ученик Резултати <span class="caret"></span></a>
            <ul class="dropdown-menu" id='results'>
            <li><a href="<?= base_url() ?>index.php/results/student_surveys">Резултати</a></li>
             
            </ul>
        </li>
        </ul>
        <?php } if(($this->session->userdata('role_id') == 2 && $this->session->userdata('is_approved') == 1
        )|| $this->session->userdata('role_id') == 4) { ?>
        <ul class="nav navbar-nav" id='dropdown'>
          <li class="dropdown" ><a class="dropdown-toggle" id="dropdown-toggle" data-toggle="dropdown" href="#">
         Учител Резултати <span class="caret"></span></a>
            <ul class="dropdown-menu" id='results'>
              <li><a href="<?= base_url() ?>index.php/results/teacher_classes_show">Резултати на ученици</a></li>
              <li><a href="<?= base_url() ?>index.php/results/teacher_results_show">Резултати на класове</a></li>
             
            </ul>
        </li>
        </ul>
        <?php } 
        /*if($this->session->userdata('role_id') == 5 || $this->session->userdata('role_id') == 4) { ?>
        <ul class="nav navbar-nav" id='dropdown'>
          <li class="dropdown" ><a class="dropdown-toggle" id="dropdown-toggle" data-toggle="dropdown" href="#">
         Координатор <span class="caret"></span></a>
            <ul class="dropdown-menu" id='results'>
              <li><a href="<?= base_url() ?>index.php/results/coordinator_teachers_show">Резултати на класове</a></li>
              <li><a href="<?= base_url() ?>index.php/results/teacher_results_show">Резултати на ученици</a></li>
             
            </ul>
        </li>
        </ul> <?php }*/ ?>

         <?php  /*if($this->session->userdata('role_id') == 5 || $this->session->userdata('role_id') == 4) { ?>
        <ul class="nav navbar-nav" id='dropdown'>
          <li class="dropdown" ><a class="dropdown-toggle" id="dropdown-toggle" data-toggle="dropdown" href="#">
          Резултати <span class="caret"></span></a>
            <ul class="dropdown-menu" id='results'>
              <li><a href="<?= base_url() ?>index.php/results/survey_select/average_results_view">Всички участвали</a></li>
              <li><a href="<?= base_url() ?>index.php/results/survey_select/coord_schools_show">Училища</a></li>

            </ul>
        </li>
        </ul>
        <?php }*/ ?>

          <?php  if($this->session->userdata('role_id')==4 || $this->session->userdata('role_id')==5
          || $this->session->userdata('role_id')==2) { ?>
      
            <ul class="nav navbar-nav" id='dropdown'  >

         <li class="dropdown" ><a class="dropdown-toggle" id="dropdown-toggle" data-toggle="dropdown" href="#">
         Управление на потребители <span class="caret"></span></a>
          <ul class="dropdown-menu" id='user_manage'>
          <?php  if($this->session->userdata('role_id')==4 || $this->session->userdata('role_id')==5) { ?>
                <li><a href="<?= base_url() ?>index.php/admin/coordinators_show">Управление на координатори</a></li>
            <?php }
             
            if($this->session->userdata('role_id')==4 || $this->session->userdata('role_id')==2) { ?>
                <li><a href="<?= base_url() ?>index.php/admin/teachers_show">Управление на учители</a></li>
            <?php }
              if($this->session->userdata('role_id')==4 || $this->session->userdata('role_id')==2) { ?>
                <li><a href="<?= base_url() ?>index.php/admin/students_show">Управление на ученици</a></li>
            
            <?php } 
              if($this->session->userdata('role_id')==4 || $this->session->userdata('role_id')==2) { ?>
                <li><a href="<?= base_url() ?>index.php/admin/quaestors_show">Управление на квестори</a></li>
            
            <?php } 

            } ?>
          </ul>
        </li>

        </ul>
      
      <?php } ?>
</div>
</div>
</div>
   
  




  

