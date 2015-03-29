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
    echo validation_errors();
    echo form_open('home/login_show');
    echo form_input(['name' => 'username', 'placeholder' => 'Потребителско име', 'id' => 'user_login',
          'class' => 'echo (form_error("username") ? "error" : "") ']);
    echo form_password(['name' => 'password', 'placeholder' => 'Парола', 'id' => 'password_login',
         'class' => 'echo (form_error("username") ? "error" : "") ']);
    echo '<br/><br/>';
    echo form_submit(['name' => 'submit', 'value' => 'Вход', 'class' => 'btn btn-primary login_custom']);
    echo "</div>";
   
    echo "</body>";
    echo "</html>";
  

