<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="http://www.redexperu.com/assets/js/bootstrap-progressbar/less/bootstrap-progressbar-3.2.0-3.x.x.less">
  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/css.css');?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/styles/layout.css');?>" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <style>
    li {
      list-style: none;
    }
    #dropdown li {
      width: 220px;
    }
    #dropdown {
      float: right;
    }
    #dropdown-toggle {
      text-align: center;
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
  </style>
</head>
<body>
  <div id="container">

    <div id="header">
      <h1></h1>
      <?php if ($this->session->userdata('is_logged_in') && $this->session->userdata('is_logged_in') == TRUE) { 
      echo "<h4 id='header_title'>"; echo anchor('home/logout', 'Излез'); } ?></h4>
      <?php if ($this->session->userdata('is_logged_in') && $this->session->userdata('is_logged_in') == TRUE) { ?>
      <h4 id='header_title'>
        Здравей, <?php  echo $this->session->userdata['username'] ; echo '!';} ?>  
      </h4>  

      <?php if($this->session->userdata('is_logged_in') && $this->session->userdata('is_logged_in') == TRUE) {
        echo "<div id='nav'>";

          foreach ($menu as $m) : ?>     
        
            <a class="dropdown-toggle" href="<?php echo site_url($m->link); ?>"><?php echo ($m->name); ?></a>
            
          <?php endforeach ;  ?>

          <ul class="nav navbar-nav" id='results'>
         <li class="dropdown" ><a class="dropdown-toggle" id="dropdown-toggle" data-toggle="dropdown" href="#">
        Диаграми <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/survey/index.php/chart/activity_chart/1">Анкета 1</a></li>
            <li><a href="/survey/index.php/chart/activity_chart/2">Анкета 2</a></li>
            <li><a href="/survey/index.php/chart/activity_chart/3">Анкета 3</a></li>
          </ul>
        </li>

        </ul>

        <ul class="nav navbar-nav" id='results'>
          <li class="dropdown" ><a class="dropdown-toggle" id="dropdown-toggle" data-toggle="dropdown" href="#">
          Резултати <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/survey/index.php/index/results_show/1">Анкета 1</a></li>
              <li><a href="/survey/index.php/index/results_show/2">Анкета 2</a></li>
              <li><a href="/survey/index.php/index/results_show/3">Анкета 3</a></li>
            </ul>
        </li>

        </ul>
          <?php  if($this->session->userdata('role_id')==4 || $this->session->userdata('role_id')==5
          || $this->session->userdata('role_id')==2) { ?>
            <ul class="nav navbar-nav" id='dropdown'>
         <li class="dropdown" ><a class="dropdown-toggle" id="dropdown-toggle" data-toggle="dropdown" href="#">
         Управление на екип <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <?php  if($this->session->userdata('role_id')==4 || $this->session->userdata('role_id')==5) { ?>
            <li><a href="/survey/index.php/admin/coordinators_show">Управление на координатори</a></li>
            <?php }
             
            if($this->session->userdata('role_id')==4 || $this->session->userdata('role_id')==2) { ?>
            <li><a href="/survey/index.php/admin/teachers_show">Управление на учители</a></li>
            <?php }
              if($this->session->userdata('role_id')==4 || $this->session->userdata('role_id')==2) { ?>
            <li><a href="/survey/index.php/admin/students_show">Управление на ученици</a></li>
            
            <?php } } ?>
          </ul>
        </li>

        </ul>
      <?php } ?>
</div>
</div>
</div>
   
  
</body>
</html>



  

  