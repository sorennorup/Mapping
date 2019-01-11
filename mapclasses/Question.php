<?php

class Question{
    
    private $title;
    
    public function setTitle($title){
        return $title;
    }
       // Set all the answers of the question
    public function setAnswers($data){
    
    }
    
    public function countAnswers($data){
        $counted = array();
        $res = array_count_values($data);
        $keys = array_keys($res);
        $values = array_values($res);
        
        for($i = 0 ; $i < count( $keys ); $i++){
            $props['answer_count'] = array('answer'=>$keys[$i],'count'=>$values[$i]);
            array_push($counted,$props);
        }
        
        return $counted;
    }
    
  }

?>