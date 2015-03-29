<html>
<head>

   <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script type="text/javascript">
    function showHide(self, show){
        if (show)
            $('.toggle').show();
        else
            $('.toggle').hide();
        $(":radio").prop('checked',false);
        $(self).prop('checked',true);
    }
    </script>   
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
  echo form_open('home/register');

  echo "<h3>Регистрация:</h3><br/>";  
  echo "<table border = '0' >";
  echo "<tr><td>   Потребителско име:* </td><td>";
  $data=array(
    'name' => 'username',
    'class' => form_error('username') ? 'error' : '',
    'value' => set_value('username')
  );
  echo form_input($data);
  echo "</td></tr>";
  echo "<tr><td> Парола:* </td><td>";
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
    'class' => form_error('first_name') ? 'error' : '',
    'value' => set_value('first_name')
  );
  echo form_input($data);
  echo "</td></tr>";
  echo "<tr><td>  Фамилия:*  </td><td>";
  $data=array(
    'name' => 'last_name',
    'class' => form_error('last_name') ? 'error' : '',
    'value' => set_value('last_name')
  );
  echo form_input($data);
  echo "</td></tr>";
  echo "<tr><td>  Населено място:*  </td><td>";
  $data=array(
    'name' => 'location',
    'class' => form_error('location') ? 'error' : '',
    'value' => set_value('location')
  );
  echo form_input($data);
  echo "</td></tr>";
  echo "<tr><td>  Имейл:*  </td><td>";
  $data=array(
    'name' => 'email',
    'class' => form_error('email') ? 'error' : '',
    'value' => set_value('email')
  );
  echo form_input($data);
  echo "</td></tr>";


  echo "<tr><td>  Изберете роля:*  </td><td>";

  echo form_radio('role_id[]', '1', FALSE, 'onClick="showHide(this, true)"');
  echo " Ученик ";
  echo form_radio('role_id[]', '2', FALSE, 'onClick="showHide(this, true)"');
  echo " Учител ";
   echo form_radio('role_id[]', '3', FALSE, 'onClick="showHide(this, false)"');
  echo " Родител ";
  echo "</td></tr>";


  echo "<tr class='toggle' style='display:none;'><td>  Училище:*  </td><td>";
  $options=array(
    'pmg' => 'ПМГ',
    'eg' => 'ЕГ',
    'class' => form_error('school[]') ? 'error' : ''
  );
  echo form_dropdown('school[]',$options);
  echo "</td></tr>";
  echo "<tr class='toggle' style='display:none;'><td>  Клас:*  </td><td>";
  $options=array(
    '8' => '8',
    '9' => '9',
    'class' => form_error('class[]') ? 'error' : ''
  );
  echo form_dropdown('class[]',$options);
  echo "</td></tr>";

  echo "</table><br/>";
  $data=array(
    'class' => 'btn btn-success ',
    'id' => 'reg',
    'value' => 'Регистрация'
  );
  echo form_submit($data);
  echo "</form>";
  echo "</div>";
  echo "</body>";
  echo "</html>";