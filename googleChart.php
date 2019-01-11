<?php require_once('mapclasses/Map.php'); ?>

<html>
  <head>     
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="js/chartDataObj.js"></script>
  </head>
  
    <body id = "body">
      <?php $chart = new Chart();  ?>  
      <?php  $data = json_encode($chart->setChartData());?>
        <div id = "chart_div"></div>
    </body>
        
    <script>
      var chartData = <?php echo $data ?>;
      console.log( chartData );        
    </script>   
    
</html>

<?php
class Chart {
   public $questions = array( );
    
   public function setChartData(){
     $pol_data = new Map( 12304955,40595816 );
     $arr = $pol_data->getAnswersItems();
     $j = 3;
     
     foreach( $arr as $a ){
             $pol_data->title = $pol_data->setTitle( $pol_data->fieldNames[$j] );
             $prop['title'] = $pol_data->title;
             $prop['count_array'] = $pol_data->countAnswers( $a );
             array_push( $this->questions, $prop );
             $j++;
    }
        
    return $this->questions;
    
  }
      
}

 ?>
        