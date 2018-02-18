<?php
    session_start();
    require_once 'assets/PHPMailer-master/PHPMailerAutoload.php';
    require_once 'core/library/main.php';
    require_once 'core/library/validator.php';
    require_once 'core/library/db.php';
    require_once 'core/models/category.php';
    require_once 'core/models/object.php';
    require_once 'core/models/admin.php';
require_once 'core/models/news.php';
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
    require_once 'core/controllers/ajax.php';
    $actionAjax = 'action_' . getUrlSegment(1);
    //var_dump($actionAjax);
    $actionAjax();
}else {
 require_once 'core/views/dev/header.php';


    /*$url = $_GET['url'];

    $urlSegments = explode('/', $url);
    $cntrName = (empty($urlSegments[0])) ? 'main' : $urlSegments[0];
    $actionName = (empty($urlSegments[1])) ? 'action_index' : 'action_'.$urlSegments[1];

    if (file_exists('core/controllers/'.$cntrName.'.php')){
        require_once 'core/controllers/'.$cntrName.'.php';

        if (function_exists($actionName)){
            $actionName();
        }else{
            echo '111';
        }
    }*/
    $cntrName = (is_null(getUrlSegment(0))) ? 'main' : getUrlSegment(0);
    $actionName = (is_null(getUrlSegment(1))) ? 'action_index' : 'action_' . getUrlSegment(1);
    if (file_exists('core/controllers/' . $cntrName . '.php')) {
        require_once 'core/controllers/' . $cntrName . '.php';
        if (function_exists($actionName)) {
            $actionName();
        } else {
            //show404page();
        }
    }
     else {
       // show404page();
    }
    require_once 'core/views/dev/footer.php';
    connectToDb();

}


