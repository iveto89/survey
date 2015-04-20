<html>
<head>
    <title></title>  
</head>
<body>
<br/>
  
<?php 
    echo validation_errors();
    echo "<div class='container'  id='container_login' >";
    echo "<div class='col-md-4' id='div_code' >";
    echo form_open('home/code_check');
    echo "<h4>Въведете Вашия код тук: </h4><br/>";
    echo "<input type='text' name='code' id='home_code' /><br/><br/>";
    echo "<input type='submit' name='code_submit' id='code_submit' value='Провери' class='btn btn-primary'/>";
    echo form_close();
    echo "</div>";
    echo "<div class='col-md-4' id='login_form' >";
    echo form_open('home/login');
    echo "<table border='0'>";
    echo "<tr><td>";     
    echo "Потребителско име: </td><td>";
    $data=array(
        'name' => 'username',
        'id' => 'username',
        'class' => form_error('username') ? 'error' : ''
    );
    echo form_input($data);
    echo " </td></tr><tr><td>";
    echo "Парола: </td><td>";
    $data=array(
        'name' => 'password',
        'id' => 'password',
        'class' => form_error('password') ? 'error' : ''
    );
    echo form_password($data);
    echo "</td></tr>";
    echo "</table>";  
    echo '<br/>';
    echo form_submit(['name' => 'submit', 'value' => 'Вход', 'class' => 'btn btn-primary custom']);
    echo '<br/><br/>';
    echo form_close();
    echo "<a href='/survey/index.php/home/register' 
    role='button' class='btn btn-success' id='reg_form'> Регистрация </a>";
    echo "</div>";    
    echo "</div>";
    echo "</div>";
    echo "</body>";
    echo "</html>";
    