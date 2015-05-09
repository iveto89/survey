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
  <?php // header('Content-type: text/html; charset=utf-8'); ?>
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
    .active{
background:#7FFFD4;
color:#000;
}
#nav .active a {
    background-color:green;
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
       <?php if ($this->session->userdata('is_logged_in') == FALSE) { ?>
       <div>
       <br/> "Настоящото задание е изготвено в рамките на проект BG05/146 „Функционална грамотност за 21ви век: инструменти за оценка и методи на преподаване“, дог. № 48 / 07.02.2014 г"
       </div>
       <?php } 
       if ($this->session->userdata('is_logged_in') && $this->session->userdata('is_logged_in') == TRUE) { ?>
        <span id='logos' ><a  href='http://zaednovchas.bg/'> <img id='zaednovchas_logo'  height='40px' width='150px' src='<?php echo base_url('css/logo-bg.png');?>'></a>
    <a  href='http://eeagrants.org/'> <img id='eeagrants_logo' height='37'  width='150px' src='<?php echo base_url('css/logo-350.png');?>'></a></span>
     
      <?php echo "<h4 id='header_title'>"; echo anchor('home/logout', 'Излез'); } ?></h4>
      <?php if ($this->session->userdata('is_logged_in') && $this->session->userdata('is_logged_in') == TRUE) { ?>
      <h4 id='header_title'>
        Здравей, <?php  echo $this->session->userdata['username'] ; echo '!';} ?>  
      </h4> 

      <?php if($this->session->userdata('is_logged_in') && $this->session->userdata('is_logged_in') == TRUE) {
        echo "<div id='nav'>";

          foreach ($menu as $m) : ?>     
        
            <a class="dropdown-toggle" href="<?php echo site_url($m->link); ?>"><?php echo ($m->name); ?></a>
            
          <?php endforeach ;  ?>
          <?php 
          /*<ul class="nav navbar-nav" id='results'>
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

        </ul>*/
            if($this->session->userdata('role_id')==4 || $this->session->userdata('role_id')==5
          || $this->session->userdata('role_id')==2) { ?>
            <ul class="nav navbar-nav" id='dropdown'>
         <li class="dropdown" ><a class="dropdown-toggle" id="dropdown-toggle" data-toggle="dropdown" href="#">
         Управление на потребители <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <?php  if($this->session->userdata('role_id')==4 || $this->session->userdata('role_id')==5) { ?>
                <li><a href="/survey/index.php/admin/coordinators_show">Управление на координатори</a></li>
            <?php }
             
            if($this->session->userdata('role_id')==4 || $this->session->userdata('role_id')==2) { ?>
                <li><a href="/survey/index.php/admin/teachers_show">Управление на учители</a></li>
            <?php }
              if($this->session->userdata('role_id')==4 || $this->session->userdata('role_id')==2) { ?>
                <li><a href="/survey/index.php/admin/students_show">Управление на ученици</a></li>
            
            <?php } 
              if($this->session->userdata('role_id')==4 ) { ?>
                <li><a href="/survey/index.php/admin/quaestors_show">Управление на квестори</a></li>
            
            <?php } 

            } ?>
          </ul>
        </li>

        </ul>
      <?php } ?>
</div>
</div>
</div>
   
  
</body>
</html>



  

  