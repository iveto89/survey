<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="http://www.redexperu.com/assets/js/bootstrap-progressbar/less/bootstrap-progressbar-3.2.0-3.x.x.less">
  
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/css.css');?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/styles/layout.css');?>" />

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
            <a href="<?php echo site_url($m->link); ?>"><?php echo ($m->name); ?></a>
        <?php endforeach ; }?>
    </div>
  </div>
  </div>
  </body>
  </html>



  

  