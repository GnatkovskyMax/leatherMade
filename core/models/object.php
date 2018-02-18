<?php
    function findPostById($id){
        $sql = "SELECT * FROM `post` WHERE id = $id";
        return selectData($sql);
    }
function getObjectById($id){
    $sql = "SELECT * FROM `product` WHERE id = $id";
    return selectData($sql);
}
     function getAllObjectIn_Cat_From($category_id, $from){
        $to=8;
        $from=(+($from)-1)*$to;
        $sql = "SELECT * FROM `product` WHERE category_id = $category_id";
        //var_dump($sql);
         $result = selectData($sql);
         $sql2="SELECT * FROM `product` WHERE category_id = $category_id";
         $result2 = selectData($sql2);
        if($result->num_rows > 0 && $result2->num_rows > 0){
            return ['from'=>$result, 'all'=>$result2->num_rows ];
        }else{
            return [];
        }
}

function getAllObjectIn_Cat($category_id){
    $sql = "SELECT * FROM `product` WHERE category_id = $category_id  ;";
    $result = selectData($sql);
    if($result->num_rows > 0){
        return $result;
    }else{
        return [];
    }
}
function findAllProductFromBasket($allId){
    $id ='';
    if(stristr($allId, ',')&& $allId!=''){
        $allId= explode(',', $allId);

        for($i=0;$i<count($allId);$i++){
            $allId[$i]=+($allId[$i]);
            if(count($allId)>1){
                if($i==0){
                    $id="id = $allId[$i]";
                }else{
                    $id= "$id || id = $allId[$i]";
                }
            }else{
                $id="id = $allId[$i]";
            }
        }
    }else{
        if(is_int(+($allId))&&+($allId)!==0&&$allId!=''){
            $allId= +($allId);
            $id="id = $allId";
        }else{

        }
    }

        $sql = "SELECT * FROM `product` WHERE $id ;";
        $result = selectData($sql);
        if($result->num_rows > 0){
            return $result;
        }else{
            return [];
        }


}