<html>
<head>
    <title>
        
    </title>  
</head>
<body>
<br/>
  
<?php 

    echo validation_errors();
    echo "<div class='container'>";
    echo "<div class='col-md-4' id='login_form'>";
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
    