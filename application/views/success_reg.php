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

 echo "<div class='col-md-6' id='logout_form'>";
    echo validation_errors();
    echo "</div>";
echo "<div id='success_show'>";
  
  echo form_open('home/success_show');
  $data = array(
    'name'        => 'username',
    'id'          => 'username',
    'placeholder'       => 'Потребителско име',
     'class' => form_error('username') ? 'error' : ''
  );
  echo form_input ($data);
  $data = array(
    'name'        => 'password',
    'id'          => 'password',
    'placeholder'       => 'Парола',
'class' => form_error('password') ? 'error' : ''    
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
  
