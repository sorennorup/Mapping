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
            //$this->fieldNames = $podio_data->getAllFieldNames();
              $this->fieldNames = array("centernavn"," lat2","lng3","Spørgeskema besvaret","Værdi","Værdi2");
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
                        if(isset($values[$i][3])){
                if($values[$i][3] == "Ja"){
                        
                   $count++;
        }
                        }
        
       } 
?>
<script>    var centerInfo = <?php echo json_encode($values); ?>;
            var keyStr = <?php echo $keys; ?>; </script>
  
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="js/objectContrukt.js"> </script>
<script type="text/javascript" src="js/polygon.js"> </script>
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href = "css/style.css">
</head>
<body onload="initialize(7,'1','googleMap')">
      
<script>
 $(function(){
     $("#draggable-infobox").draggable();       
            })
</script>     
          
<div class="infoBox" id = draggable-infobox 
              id = "text-field">Antal besvarelser:<?php echo $count; ?>
              
 <div class = "row-one">ikke besvaret<div class="canvas red">  </div> </div>
   
   <div class = "row-two">  besvaret <div class="canvas green"></div>  </div>

</div>

<div id="googleMap">  </div>

         
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