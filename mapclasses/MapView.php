<?php
require 'MapData.php';
$map = new MapData(17080416);
$map->getFieldValues();
?>
<html>
            <head></head>
            <body>
<script>
var data = <?php echo json_encode($map->getFieldValues()); ?>;  alert(data)</script>
</body>
</html>