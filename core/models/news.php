<?php
function findAllPosts($from){
    $to=2;
    $from=(+($from)-1)*$to;
    $sql = "SELECT * FROM `post` LIMIT $from, $to ";
    $result=selectData($sql);
    $sql2="SELECT * FROM `post` ";
    $result2 = selectData($sql2);
    if($result->num_rows > 0 && $result2->num_rows > 0){
        return ['from_post'=>$result, 'all_post'=>$result2->num_rows ];
    }else{
        return [];
    }
}
function getIdNews($num){
    $sql = "SELECT * FROM `post` WHERE post.id = '$num';";
    return selectData($sql);
}
function findAllPost(){

    $sql = "SELECT * FROM `post`";
    $result=selectData($sql);

    if($result->num_rows > 0){
        return $result;
    }else{
        return [];
    }
}
?>
