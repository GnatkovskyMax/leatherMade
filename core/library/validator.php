<?php
    function valid_adress($data){
        $link = connectToDb();
      $data = mysqli_real_escape_string($link, $data);
      return $data;
    }
    function valid_required($data){
        return empty($data);
    }
    function valid_name($data){
    if(strlen($data)< 2){
        return false;
    }
    }
    function valid_numeric($data){
        return is_numeric($data);
    }
    function valid_tel($data){
        return (!preg_match('/^\+\(\d{3}\) \d{2} \d{3} \d{2} \d{2}$/', $data));
        return is_numeric($data);
    }

// /^\w+@\w{2, }\.\w{}$/
function valid_getFilteredData($dataWithRules, $data){
        var_dump($dataWithRules, $data);
    $fields = array_keys($dataWithRules);
    $errorForms = [];
    foreach ($fields as $fieldName){
        $fieldData = $data[$fieldName];
        $rules = $dataWithRules[$fieldName];
        foreach ($rules as $ruleName){
           if ($ruleName($fieldData)){
                $errorForms[$fieldName][] = $ruleName;
           }
        }
    }

    return $errorForms;
}