<?php

require 'PodioConnect.php';

class Map{
            private $app_id;
           
            public $exValues = array();
            public $fieldNames = array();
  
    function __construct($app_id){
            $this->appId = $app_id;        
            
            $this->getPodioData();
            //$this->createMap();
   
    }
    function getPodioData(){
        try{
            $podio_data=new PodioConnect($this->appId);          
            $this->exValues = $podio_data->getAllFieldValues();
            $this->fieldNames = $podio_data->getAllFieldNames();
            }
            
        catch(PodioError $e) {
            echo $e;           
            }       
            }
    
    public function createMap(){          
            $count = 0;
            $fields = $this->fieldNames;
           
            $keys = json_encode($fields);
            
            
            $values = $this->exValues;
            
              for($i = 0 ; $i < count($this->exValues); $i++){
                if($values[$i][3] == "Ja"){
                        
                   $count++;
        }
        
       }    
?>
<script>    var centerInfo = <?php echo json_encode($values); ?>;
            var keyStr = <?php echo $keys; ?>; </script> 
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="mapclasses/objectContrukt.js"> </script>
<script type="text/javascript" src="mapclasses/polygon.js"> </script>
 
<script> alert(bornholm)</script>
</head>
<body onload="initialize(7,'1','googleMap')">
      
<script>
 
</script>     
          
<div style  = "position:absolute; z-index: 3; width:200px;
              background-color: grey;margin-top:300px;
              margin-left:300px;height: 200px;padding: 10px; color: #fff;"
              id = "text-field">Antal besvarelser:<?php echo $count; ?>  </div>

<div id="googleMap" style="width:100%;height:600px; ">  </div>

         
</body>

</script>   
    <!-- the Api key loadet asyncrounus -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnCH6jSQb-BkkDGFriXjaImHSob6YaVNU&callback=initMap">
    </script>
</html>

<?php
}  
    
}
?>