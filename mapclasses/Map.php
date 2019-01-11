<?php

require 'PodioConnect.php';
require 'Question.php';

class Map extends Question{
            public $app_id;
            public $view_id;
            public $title;
            public $exValues = array();
            public $fieldNames = array();
            public $podio_data;
            public $ostemad;
  
   public function __construct($app_id,$view_id){
            $this->appId = $app_id;
            $this->view_id = $view_id;
            $this->podio_data = new PodioConnect($this->appId);
            $this->fieldNames = $this->podio_data->getAllFieldNames();
   
    }
    
    function getPodioViewData(){
        try{     
            $this->exValues = $this->podio_data->getAllFieldValues($this->view_id);
            }
            
        catch(PodioError $e) {
            echo $e;           
            }       
    }
    
    public function getAnswersItems(){
            $ans = array();
            $res = array();
           try{
            
            
            $this->exValues = $this->podio_data->getAllFieldValues($this->view_id);
               for($i = 3; $i < count($this->fieldNames)-1; $i++){
                       '<b>'.$this->fieldNames[$i].'</b><br/>';
                        for($j = 0; $j < count($this->exValues); $j++){                                             
                            
                            $ans[$j] = $this->exValues[$j][$i];           
                        }
            
                        
                        array_push($res,$ans);
                       
               } // end of question
                 return $res;
              
            }

            
        catch(PodioError $e) {
           return $e;           
            }        
    }
    
    public function getFieldValues(){
            return $this->fieldNames;
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
            <script>
            
            var centerInfo = <?php echo json_encode($values); ?>;
            var keyStr = <?php echo $keys; ?>; </script>
  
            <!DOCTYPE html>
            <html>
            <head>
            <script type="text/javascript" src="js/objectContrukt.js"> </script>
            <script type="text/javascript" src="js/polygon.js"> </script>
            <script src="js/jquery.min.js"></script>
            <script src="js/jquery-ui.min.js"></script>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript" src="js/uucentre.js"></script>
            <link rel="stylesheet" type="text/css" href = "css/style.css">
            <script>
             google.charts.load('current', {packages: ['corechart']});
            google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      // Define the chart to be drawn.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Choice');
            data.addColumn('number', 'Answers');
            data.addRows([
            ['svaret', <?php echo $count ?>],
            ['ikke besvaret', <?php echo 56-$count;  ?>],
        
             ]);
     
            var options = {'title':'Fordeling af besvarelser',
                     'width':400,
                     'height':400,
                     'is3D':true,
                      colors: ['#477e07', '#930a0a'],
                      sliceVisibilityThreshold:0
                     
                     };     

      // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
    }
    

            
            
            </script>
          
            </head>
            <body onload="initialize(7,'1','googleMap')">
                        <input type="text" name="uucenter" id="uucenter"  />
   
            <script>
       
                
            
            
    $(function(){
            
            $.getJSON("js/uucentre.json",function(data){
                       
            })
            
            
            //making the infobox dragable
            $("#draggable-infobox").draggable();
            
            //display number off answers when on mouseover
            $(".infoClass").hide();
            $(".infoClassRed").hide();
            $(".canvas.green").mouseover(function(){
            $(".infoClass").show();
            })
            $(".canvas.green").mouseout(function(){
            $(".infoClass").hide();
            })
            
            $(".canvas.red").mouseover(function(){
            $(".infoClassRed").show();
            })
            $(".canvas.red").mouseout(function(){
            $(".infoClassRed").hide();
            })
             })
            
            
            </script>

            <script>
            var uuaarhus_samsoe = ['aarhus.kml','samsoe.kml'];
              
            
            </script>
            
            <div class="infoBox" id = draggable-infobox 
            id = "text-field">Antal besvarelser:<?php echo $count; ?> <input type="button" value="Aarhus Samsø" onclick = "backToMap()" />
             
            <div class = "row-two">  besvaret <div class="canvas green"></div>  </div>
            <div class = "infoClassRed"><?php echo 56-$count; ?> har ikke svaret</div>
              
            <div class = "row-one">ikke besvaret<div class="canvas red">  </div> </div>
            <div class = "infoClass"><?php echo $count; ?> har svaret</div>
            
   
 

            </div>
    
            <div id="googleMap">  </div>
            <div id="chart_div"></div>
            <script>
                        
                
            </script>
         
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