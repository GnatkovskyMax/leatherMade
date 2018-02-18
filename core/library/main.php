<?php
    function show404page(){
        header("HTTP/1.1 404 Not found");
        echo '404 page';
    }

    function getUrlSegment($num){
        $url = strtolower($_GET['url']);
        //$id = $_GET['id'];
        //var_dump($url);
        $urlSegments = explode('/', $url);
//        echo '<pre>';
//       //var_dump($id);
//        echo '<pre>';

        //var_dump($urlSegments[$num]);
        //var_dump($urlSegments[$num]);
        if(empty($urlSegments[$num])){
            return null;
        }
        return $urlSegments[$num];

    }

    function renderView($view_name, array $data=[]){
        //var_dump($data);
        include 'core/views/'.$view_name.'.php';
    }

//    function getIdSegment($num){
//        $idEl = explode('?', $url);
//       //var_dump($idEl);
//    }

//    function NameId($num){
//        $view_name = $num;
//        $url = strtolower($_GET['url']);
//        $idEl = explode('?', $url);
//        var_dump($idEl);
//        //renderView($view_name, )
//    }

function is_auth(){
        if(isset($_SESSION['user']['id']) and !empty($_SESSION['user']['id'])){
            return true;
        }
        return false;
}