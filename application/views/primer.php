<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
    .container { width: 404px;  }
    .meow { width: 200px; height: 200px; display: inline-block; background: aqua; border: 1px solid #000; }
    </style>
</head>
<body>
<div class="container">
<?php
for ($i = 1; $i <= 10; $i++) {
    echo '<div class="meow"></div>';
}
?>
</div>
</body>
</html>