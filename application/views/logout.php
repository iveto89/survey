<html>
    <head>
    </head>
    <body>
        <div class='container'>
    		<h3 id='login_title'>
       			Излязохте успешно!
                Можете да влезете от тук:
    		</h3>
            <br/>

<?php 
    echo "<div class='col-md-6' id='logout_form'>";
    echo validation_errors();
    echo "</div>";
    echo form_open('home/login_show');
$data=array(
'name' => 'username', 
'placeholder' => 'Потребителско име', 
'id' => 'user_login',
  'class' => form_error("username") ? "error" : ""
);
    echo form_input($data);
$data=array(
'name' => 'password', 
'placeholder' => 'Парола', 
'id' => 'password_login',
 'class' => form_error("username") ? "error" : ""
);
    echo form_password($data);
    echo '<br/><br/>';
$data=array(
'name' => 'submit', 
'value' => 'Вход', 
'class' => 'btn btn-primary login_custom'
);
    echo form_submit($data);
    echo "</div>";
   
    echo "</body>";
    echo "</html>";
  

