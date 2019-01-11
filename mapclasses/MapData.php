<?php
require 'PodioConnect.php';

class MapData{
    private $app_id;
           
            public $exValues = array();
            public $fieldNames = array();
  
    function __construct($app_id){
            $this->appId = $app_id;        
            $this->podio_data=new PodioConnect($this->appId);
            //$this->getPodioData();
            //$this->createMap();
   
    }
    function getPodioData(){
        try{
                  
            $this->exValues = $this->podio_data->getAllFieldValues();
            $this->fieldNames = $this->podio_data->getAllFieldNames();
            }
            
        catch(PodioError $e) {
            echo $e;           
            }       
            }
    function getFieldValues(){
        return $this->podio_data->getAllFieldValues();             
    }
    function getFieldNames(){
        return $this->podio_data->getAllFieldNames();
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
    }
    
    
    
    
    
    
    
    
    
}





?>