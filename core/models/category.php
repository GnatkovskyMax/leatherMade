<?php
    function findServiceByUrl($url){

        $sql = "SELECT `id` FROM service WHERE url_service = '$url'";

        return selectData($sql);
    }
function findTypeByUrl($url){

    $sql = "SELECT `id` FROM type_of_room WHERE url_type = '$url'";

    return selectData($sql);
}
function loadAction(){
    $districts = new_mysqli_fetch_all(getAllDistrict());
    $type_nav = new_mysqli_fetch_all(findAllType());
    $direction = new_mysqli_fetch_all(getAllDirect());
    $comercial_profs= new_mysqli_fetch_all(getAllProfs());
    $ser_id=(!empty($_GET['ids'])) ? $_GET['ids'] :  new_mysqli_fetch_all(findServiceByUrl(getUrlSegment(0)))[0]['id'];
    $type_id=(!empty($_GET['idt'])) ? $_GET['idt'] : new_mysqli_fetch_all(findTypeByUrl(getUrlSegment(1)))[0]['id'];
    $ser_id= +($ser_id);
    $type_id= +($type_id);
    if(!empty($_GET['prid'])&&$type_id==3){
        $profile_id=$_GET['prid'];
}else if(empty($_GET['prid'])&&$type_id==3){
        $profile_id=1;
    }else{
        $profile_id= 9;
    }
        $room=(!empty($_GET['room'])) ? $_GET['room'] : 'rooms';
        $dirid=(!empty($_GET['dirid'])) ? $_GET['dirid'] : 'directions';
        $district=(!empty($_GET['district'])) ? $_GET['district'] : 'districts';
        $commis=(!empty($_GET['commis'])) ? $_GET['commis'] : '0';
        $from_price=(!empty($_GET['from_price'])) ? $_GET['from_price'] : '0';
        $to_price=(!empty($_GET['to_price'])) ? $_GET['to_price'] : '0';
        $from_area=(!empty($_GET['from_area'])) ? $_GET['from_area'] : '0';
        $to_area=(!empty($_GET['to_area'])) ? $_GET['to_area'] : '0';
        $sort=(!empty($_GET['sort'])) ? $_GET['sort'] : '1';
        $from=(!empty($_GET['m'])) ? $_GET['m'] : 0;
        $new=(!empty($_GET['new'])) ? $_GET['new'] : '0';
        $entrance=(!empty($_GET['entrance'])) ? $_GET['entrance'] : '0';
   if($ser_id==2 || $ser_id==3){
       $btn = count(new_mysqli_fetch_all(getAllObjectIn_Ser_Type($ser_id, $type_id, $profile_id, $room, $new, $entrance, $dirid, $district, $commis, $from_price, $to_price, $from_area, $to_area)));
       $objects= new_mysqli_fetch_all(getAllObjectIn_Ser_Type_From($ser_id, $type_id, $profile_id, $room, $from, $new, $entrance, $dirid, $district, $commis, $from_price, $to_price, $from_area, $to_area, $sort ));
       renderView('catalog', ['objects' => $objects, 'type_nav' => $type_nav ,'districts' => $districts ,'new'=>$new, 'entrance'=>$entrance,'all_prof'=>$comercial_profs ,'all_direction'=>$direction ,'room'=>$room, 'btn'=> $btn,'type'=> $type_id, 'ids'=>$ser_id, 'dirid'=>$dirid, 'prid'=>$profile_id]);
   }else if(  $ser_id==1 || $ser_id==4){
       $for=($ser_id==1) ? 'for_rent' :  'for_sale';
       $from=(!empty($_GET['m'])) ? $_GET['m'] : 0;
       $objects= new_mysqli_fetch_all(getAllObjectForRentOrSale($for, $type_id, $from));
       renderView('dev/clientFormAndTopic',['objects'=>$objects]);
   }
}
