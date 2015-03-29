<html>
<head>

</head>
<body>
<div class='container'>
<h3 id='title_success'>
  Регистрирахте се успешно!
	Можете да влезете от тук:
</h3>

<?php 
echo "<div id='login_errors'>";
echo validation_errors();
echo "</div>";
echo "<div id='login'>";
  
  echo form_open('home/login');
   $data = array(
    'name'        => 'username',
    'id'          => 'username',
    'placeholder'       => 'Потребителско име'    
  );
  echo form_input ($data);
  $data = array(
    'name'        => 'password',
    'id'          => 'password',
    'placeholder'       => 'Парола'    
  );

  echo form_password($data);
  echo "<br/><br/>";
    $data = array(
    'name'        => 'submit',
    'value'       => 'Вход',
    'class' => 'btn btn-success reg',
    'id' => 'login_submit'  
  );

  echo form_submit($data);
  echo "</div>";
  echo "<br/><br/></div>";
  echo "</body>";
  echo "</html>";
  
