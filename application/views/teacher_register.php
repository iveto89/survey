<html>
<head>
  <title>
   
  </title>
   <style>

  form input {
    width: 180px;
    height: 30px;
  }

  </style>
</head>
<?php
   echo "<body>";
  echo validation_errors();
  echo "<div class='container'>";
  echo form_open('home/teacher_register');
 
  echo "<h3>Регистрация</h3><br/>";  
  echo "<table border = '0' id='register_table'>";
  echo "<tr><td>  Потребителско име:* </td><td>";
  $data=array(
    'name' => 'username',
    'class' => form_error('username') ? 'error' : ''
  );
  echo form_input($data);
  echo "</td></tr>";
  echo "<tr><td>  Парола:* </td><td>";
  $data=array(
    'name' => 'password',
    'class' => form_error('password') ? 'error' : ''
  );
  echo form_password($data);
  echo "</td></tr>";
  echo "<tr><td>  Повтори парола:* </td><td>";
  $data=array(
    'name' => 'password2',
    'class' => form_error('password2') ? 'error' : ''
  );
  echo form_password($data);
  echo "</td></tr>";
  echo "<tr><td>  Име:*  </td><td>";
  $data=array(
    'name' => 'first_name',
    'class' => form_error('first_name') ? 'error' : ''
  );
  echo form_input($data);
  echo "</td></tr>";
  echo "<tr><td>  Фамилия:*  </td><td>";
  $data=array(
    'name' => 'last_name',
    'class' => form_error('last_name') ? 'error' : ''
  );
  echo form_input($data);
  echo "</td></tr>";
  echo "<tr><td>  Населено място:*  </td><td>";
  $data=array(
    'name' => 'location',
    'class' => form_error('location') ? 'error' : ''
  );
  echo form_input($data);
  echo "</td></tr>";
  echo "<tr><td>  Имейл:*  </td><td>";
  $data=array(
    'name' => 'email',
    'class' => form_error('email') ? 'error' : ''
  );
  echo form_input($data);
  echo "</td></tr>";
  echo "<tr><td>  Училище:*  </td><td>";
  $options=array(
    'pmg' => 'ПМГ',
    'eg' => 'ЕГ',
    'class' => form_error('school[]') ? 'error' : ''
  );
  echo form_dropdown('school[]',$options);
  echo "</td></tr>";
  echo "<tr><td>  Клас:*  </td><td>";
  $options=array(
    '5а' => '5a',
    '6в' => '6в',
    'class' => form_error('class[]') ? 'error' : ''
  );
  echo form_dropdown('class[]',$options);
  echo "</td></tr>";

  echo "</table><br/>";
  $data=array(
    'name' => 'submit',
    'class' => 'btn btn-success ',
    'value' => 'Регистрация'
  );
  echo form_submit($data);
  echo "</form>";
  echo "</div>";
  echo "</body>";
  echo "</html>";


