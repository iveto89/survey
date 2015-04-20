<html>
<head>
</head>
<body>
<div class='col-md-6' >
<br/><br/>
<?php
$teacher_id = $this->uri->segment(3);

foreach($select_coordinator as $row) 
{
   echo form_open('coordinator/edit_coordinator/'.$teacher_id); 	
?>
    <table border = '0' class='table table-striped'>
    <tr><td class='col-md-2'>
    <?php
    foreach ($teacher_show as $teacher)
    {
        echo $teacher->username; 
    }
?>
   
    </td><td class='col-md-2'>
    <select name = 'edit_coordinator[]' >
    <?php   

    foreach($coordinator_show as $coordinator) 
    {
    ?>
        <option name="edit_coordinator[]" value="<?= $coordinator->coordinator_id ?>"
        <?php echo $coordinator->coordinator_id == $row->coordinator_id ? 'selected="selected"' : 
        '' ?>><?php echo $coordinator->username ; ?></option>
       
    <?php   
    } 
    echo '<option name="edit_coordinator[]" value="0"></option>'; 
    echo "</select>";
    
    echo "</td><td class='col-md-1'>";
    echo '<input type="submit" name="submit" value="Промени" class="btn btn-success" />';
    echo '</td></tr>';
?> 
</table>  
</form>
</div>

<?php 

}
?>
</body>
</html>