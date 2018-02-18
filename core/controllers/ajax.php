<?php
function action_sendMail(){
    $headers="Content-type: text/html; Charset=utf-8";
    $message=$_POST['serialize'];
mail("gnatkovsky@bigmir.net", "Заказ",$message ,$headers,
    "LeathSpace.com\r\n"
    ."X-Mailer: PHP/" . phpversion());
    $lang = $_SESSION['lang'];
    if ($lang == 'ru') {
        echo "<p class='col-xs-12 text-center'>Ваш заказ отправлен успешно, с вами свяжутся ближайшее время.</p>
                <div class='col-xs-12 text-center'><div class='col-xs-8 col-md-3  btn btn-success clear-b'>Очистить корзину</div></div>  
";
    } else {
        echo "<p class='col-xs-12 text-center'>Your order has been sent successfully, you will be contacted shortly.</p>
            <div class='col-xs-12 text-center'><div class='col-xs-3  btn btn-success clear-b'>Delete all</div></div> 
";
    }



//}
//    if (1) {
//        $mail = new PHPMailer;
//        $mail->isSMTP();
//        $mail->Host = 'gnatkovsky@bigmir.net';
//        $mail->CharSet = 'UTF-8';
//        $mail->SMTPAuth = false;
//        $mail->Username = 'hauzer2017';
//        $mail->Password = 'qwerty';
//        $mail->SMTPSecure = false;
//        $mail->Port = 25;
//        $mail->From = 'gnatkovsky@bigmir.net';
//        $mail->FromName = 'Новая заявка';
//        $mail->addAddress('gnatkovsky@bigmir.net', 'Артём');
//        $mail->Subject = 'Новое письмо';
//        $mail->Body = "Имя: 'Заказ'
//    Email: 'ddd'
//    Телефон: 'sddddd'";
//        if ($mail->send()) {
//            echo 'Письмо отправлено!';
//            $answer = 1;
//        } else {
//            echo $mail->ErrorInfo;
//            $answer = 0;
//        }
//        die($answer);
//    }

}
function action_basket(){
    if($_SESSION['cart']['id']){
        $allProductFromBasket= new_mysqli_fetch_all(findAllProductFromBasket($_SESSION['cart']['id']));
    }else{
        $allProductFromBasket=NULL;
    }

    renderView('dev/basket', ['allProductFromBasket'=>$allProductFromBasket]);
}
function action_clearBasket(){
    $_SESSION['cart']['id']='';
}
function action_deleteProductFromBasket(){//удаляем id товара из массива
    $id=+($_POST['id']);
    $arr=explode(',',$_SESSION['cart']['id']);
    for($i=0; $i<=count($arr); $i++){
      if(+($arr[$i])==$id){
          unset($arr[$i]);
      }
    }
   $arr= implode( ',',$arr) ;
    $_SESSION['cart']['id']= $arr;
    if($_SESSION['cart']['id']==NULL){
        renderView('dev/basket',[]);
    }
}
function action_addToBasket(){//добавляем id товара в массив
    $id=+($_POST['id']);
    $session=$_SESSION['cart']['id'];
    if($session==NULL&&!stristr($session, "$id")){
        $session=$id;
    }
    else if($session!==NULL&&!stristr($session, "$id")){
        $session=$session.','.$id;
    }
    var_dump($_SESSION['cart']['id']=$session);
}
function action_singleProduct(){
    $id=+($_POST['id']);
    $single_product=new_mysqli_fetch_all(getObjectById($id));
    renderView('dev/single-product', ['product' => $single_product]);

}

function action_langLoad(){
    $_SESSION['lang']=(!empty($_POST['lang']))? $_POST['lang'] : $_SESSION['lang'];
    $category_id=(!empty($_SESSION['cat_id']))? +($_SESSION['cat_id']) : 1;
    $page= (!empty($_SESSION['page']))? +($_SESSION['page']) : 1;
    $page_post= (!empty($_SESSION['page_post']))? +($_SESSION['page_post']) : 1; //new
    $posts = new_mysqli_fetch_all(findAllPosts($page_post)['from_post']);//первые два поста//new
    $all_post = findAllPosts($page_post)['all_post'];//все посты для кнопок//new
    $category_nav = new_mysqli_fetch_all(findAllCategory());//все категории
    $product= new_mysqli_fetch_all(getAllObjectIn_Cat_From($category_id, $page)['from']);
    $buttons= getAllObjectIn_Cat_From($category_id, $page)['all'];
    renderView('index', ['category'=>$category_nav,
        'posts' => $posts,
        'all_post'=>$all_post,
        'product'=> $product,
        'btn'=>$buttons,
        'cat_id'=>$category_id]);
}
function action_addCategory (){
    $name=$_POST['name'];
    $name_en=$_POST['name_en'];
    $res=addCategory($name, $name_en );
    if($res){
        $allCategory=new_mysqli_fetch_all(findAllCategory());
        renderView('dev/addDelCategory', ['category' => $allCategory]);
    }else{
        echo'net';
    }

}
function action_nextPage(){
    if(!empty($_POST['cat_id'])){
        $_SESSION['cat_id']=+($_POST['cat_id']);
    }
    $category_id=(!empty($_SESSION['cat_id'])&&$_SESSION['cat_id']!=0)? +($_SESSION['cat_id']) : 1;
    if(!empty($_POST['page'])){
        $_SESSION['page']= +($_POST['page']);
    }

    $page= (!empty($_SESSION['page']))? +($_SESSION['page']) : 1;
    $product= new_mysqli_fetch_all(getAllObjectIn_Cat_From($category_id, $page)['from']);
    $buttons= getAllObjectIn_Cat_From($category_id, $page)['all'];
    renderView('dev/wrapp-products', ['page'=>$page,
        'product'=> $product,
        'btn'=>$buttons]);
}
function action_nextPageNews(){
    if(!empty($_POST['page_post'])){
        $_SESSION['page_post']=+($_POST['page_post']);
    }
    $page_post= (!empty($_SESSION['page_post']))? +($_SESSION['page_post']) : 1; //new
    $posts = new_mysqli_fetch_all(findAllPosts($page_post)['from_post']);//первые два поста//new
    $all_post = findAllPosts($page_post)['all_post'];//все посты для кнопок//new
    renderView('dev/wrapp-news', [
        'page_post'=>$page_post,
        'posts' => $posts,
        'all_post'=>$all_post,]);
}
function action_redCategory (){

    $id=+($_POST['id']);
    $name=$_POST['name'];
    $name_en=$_POST['name_en'];
    $res=redCategory($id, $name, $name_en );
    if($res){
        $allCategory=new_mysqli_fetch_all(findAllCategory());
        renderView('dev/addDelCategory', ['category' => $allCategory]);
    }else{
        echo'net';
    }

}
function action_delCategory (){
    $id=+($_POST['id']);
    $res= delCategory($id);
    if($res){
        $allCategory=new_mysqli_fetch_all(findAllCategory());
        renderView('dev/addDelCategory', ['category' => $allCategory]);
    }else{
        echo'net';
    }

}
function action_delete (){
    if (!empty($_POST['id'])) {
        deleatObject($_POST['id']);
        $id=$_POST['id'];
        if ($objs = glob("catalog/$id/*")) {
            foreach($objs as $obj) {
                unlink($obj);
            }
        }
        rmdir("catalog/$id");
    }
}
function action_editObject (){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $formData = [
            'description' => getSaveData(trim($_POST['description'])),
            'description_en' => getSaveData(trim($_POST['description_en'])),
            'price' => getSaveData(trim($_POST['price'])),
            'material' => getSaveData(trim($_POST['material'])),
            'material_en' => getSaveData(trim($_POST['material_en'])),
            'category' => +(getSaveData(trim($_POST['category']))),
        ];
         $id=$_POST['id'];
        $sql1="UPDATE `product` SET   
        `description`='{$formData['description']}',`description_en`='{$formData['description_en']}',
          `price`='{$formData['price']}',`material`='{$formData['material']}',
       `material_en`='{$formData['material_en']}',
         `category_id`={$formData['category']} WHERE id= $id";


        $res1= insertUpdateDelate($sql1);
        if($res1){
echo '<div class="wrapp-edit">Объект редактирован успешно!</div>';
        }
    }

}
function action_viewPhoto(){
    $id_object = $_POST['id'];
    $singleObject = new_mysqli_fetch_all(imgObj($id_object));
    if($singleObject){
        renderView('dev/allPhoto', ['object' => $singleObject]);
    }else{
        echo 'hello';
    }

}

function action_upPhotoT(){
    $id_object = $_POST['id'];
    $singleObject = new_mysqli_fetch_all(imgObj($id_object));
    if($singleObject){
        renderView('dev/upPhotoT', ['object' => $singleObject]);
        var_dump($id_object);
    }else{

        echo 'not';
    }
}
function action_upPhotoG(){
    $id_object = $_POST['id'];
    $singleObject = new_mysqli_fetch_all(imgObj($id_object));
    if($singleObject){
        renderView('dev/upPhotoG', ['object' => $singleObject]);
    }else{

        echo 'not';
    }
}
function action_addPhotoP(){
    $id_object = $_POST['id'];
    $singleObject = new_mysqli_fetch_all(imgObj($id_object));
    if($singleObject){
        renderView('dev/addPhotoP', ['object' => $singleObject]);

    }else{

        echo 'not';
    }
}
function action_upT(){
    require '/home/maxim92/leathspace.com/www/vendor/autoload.php';
    $altT= $_POST['altT'];
    $id = $_POST['id'];
    $img_top = "/catalog/$id/top".time().$_FILES["max"]["name"].":".$altT;
    $name_files_top = "catalog/$id/top".time().$_FILES["max"]["name"];
    $singleObject = new_mysqli_fetch_all(imgObj($id));
    $old = explode(':', $singleObject[0]['img-top']);
   $o = substr($old[0], 1);
   if(file_exists($o)){
       unlink($o);
   }

    move_uploaded_file($_FILES['max']['tmp_name'], "$name_files_top");
    $imagine = new Imagine\Gd\Imagine();
    $size  = new Imagine\Image\Box(1024, 768);
    //$watermark = $imagine->open("assets/img/hauzer_2017_watermark.png");
    $image     = $imagine->open($name_files_top)->thumbnail($size);
    //$wSize     = $watermark->getSize();
    //$bottomRight = new Imagine\Image\Point(50,50);//$size->getWidth() - $wSize->getWidth(), $size->getHeight() - $wSize->getHeight()
    $image->save
    ($name_files_top);//paste($watermark, $bottomRight)->
    $sql=" UPDATE `product` SET `img-top`=\"$img_top\" WHERE `id`= $id";
    $res=insertUpdateDelate($sql);
    if($res){
        echo'<div class="wrapp-edit">Фаил Top успешно загружен!</div>';
    }else{
    }




}
function action_upG(){
    require '/home/maxim92/leathspace.com/www/vendor/autoload.php';
    $altG= $_POST['altG'];
    $id = $_POST['id'];
//    $e= strpos($_FILES["max"]['name'], '.');
//    $type= substr($_FILES["max"]['name'], $e+1 );
//    $type_two=explode('/', $_FILES["max"]['type'])[1];
    $img_general= "/catalog/$id/general".time().$_FILES["max"]['name'].":".$_POST["altG"];
    $name_files_general = "catalog/$id/general".time().$_FILES["max"]['name'];
    $singleObject = new_mysqli_fetch_all(imgObj($id));
    $old = explode(':', $singleObject[0]['img_general']);
    $o = substr($old[0], 1);
    if(file_exists($o)){
        unlink($o);
    }
    move_uploaded_file($_FILES['max']['tmp_name'], "$name_files_general");
    $imagine = new Imagine\Gd\Imagine();
    $size  = new Imagine\Image\Box(250, 170);
    $image     = $imagine->open($name_files_general)->thumbnail($size);
        //$watermark = $imagine->open("/home/albre88/hauzer.in.ua/assets/img/hauzer_2017_watermark.png");
       // $wSize     = $watermark->getSize();
        //$bottomRight = new Imagine\Image\Point(50,50);//$size->getWidth() - $wSize->getWidth(), $size->getHeight() - $wSize->getHeight()
        $image->save
        ($name_files_general);//paste($watermark, $bottomRight)->
    $sql=" UPDATE `product` SET `img_general`=\"$img_general\" WHERE `id`= $id";
    $res=insertUpdateDelate($sql);
    if($res){
        echo '<div class="wrapp-edit"><?= $o ?>Фаил General успешно загружен!</div>';

    }else{
    }


}
function action_addP(){

    require '/home/maxim92/leathspace.com/www/vendor/autoload.php';
    $img="";
    $id=$_POST['id'];
    $singleImg = new_mysqli_fetch_all(imgObj($id));
    $img0=$singleImg[0]['img'];
for($i=0;!empty($_FILES[$i]);$i++){


       if($i==0&&$img0!=''){
           $img= ",/catalog/$id/".time().$_FILES[$i]["name"].': ,';
       }else{
           $img= $img."/catalog/$id/".time().$_FILES[$i]["name"].': ,';
       }


    $name_filesP = "catalog/$id/".time().$_FILES[$i]["name"];
    move_uploaded_file($_FILES[$i]["tmp_name"], $name_filesP);
    $imagine = new Imagine\Gd\Imagine();
    $size  = new Imagine\Image\Box(820, 460);
//        $imagine->open("catalog/$last/".$g.time().$_FILES["image$i"]["name"])->thumbnail($size, 'inset')->save
//        ("catalog/$last/".$g.time().$_FILES["image$i"]["name"]);
    $image = $imagine->open($name_filesP)->thumbnail($size);

        //$watermark = $imagine->open("/home/albre88/hauzer.in.ua/assets/img/hauzer_2017_watermark.png");
        //$wSize     = $watermark->getSize();
        //$bottomRight = new Imagine\Image\Point(50,50);//$size->getWidth() - $wSize->getWidth(), $size->getHeight() - $wSize->getHeight()
        $image->save($name_filesP);//paste($watermark, $bottomRight)->
}
    $img= substr($img, 0,-1);
    $img= $img0.$img;
    $sql=" UPDATE `product` SET `img`=\"$img\" WHERE `id`= $id";
    $res=insertUpdateDelate($sql);
    if($res){
        //echo $img;
        echo'<div class="wrapp-edit">Фото успешно загружены!</div>';
    }else{
    }
}
function action_delPhotoP(){


   if (!empty($_POST['id'])){
        $id = $_POST['id'];//id el
        $delSum=count($_POST['numbers']);

        $imgStr = new_mysqli_fetch_all(imgObj($id));
        $images= explode(',', $imgStr[0]{'img'});
        for($i=0;$delSum>$i;$i++){
            $numP=+($_POST['numbers'][$i][0]);//nomer foto
            unset($images[$numP]);
        }

        sort($images);
        $images = implode(',', $images);
        var_dump($images);
        $sql=" UPDATE `product` SET `img`=\"$images\" WHERE `id`= $id";
        $res=insertUpdateDelate($sql);
        if($res){
            for($i=0;$delSum>$i;$i++){
                $fileDel= substr($_POST['numbers'][$i][1], 1);
                unlink($fileDel);
            }

            // echo "<div id='img$numP'>Фото удалено!</div>";
        }else{
        }
        }
}
function action_replacePhoto(){
//var_dump($_POST[0]);
 $id = $_POST['id'];

      $imgStr = new_mysqli_fetch_all(imgObj($id));
    $images= explode(',', $imgStr[0]{'img'});
    $imgReplace=[];
    for($i=0; count($images)>$i; $i++){
       if(!empty($_POST[$i])||$_POST[$i]==0){
            $imgReplace[$i]= $images[$_POST[$i]];
            echo $i.'______'.$_POST[$i];
    }

    }

//  sort($images);
   // var_dump($imgReplace);
    $im = implode(',', $imgReplace);
    //var_dump($images);
    //var_dump($im);
    $sql=" UPDATE `product` SET `img`=\"$im\" WHERE `id`= $id";
    $res=insertUpdateDelate($sql);
    if($res){


       echo "<div>ok!</div>";
    }else{
    }
}
function action_editAltP(){
    $id = $_POST['id'];
    $numP=+($_POST['numP']);
    $file=$_POST['file'];
    $imgStr = new_mysqli_fetch_all(imgObj($id));
    $images= explode(',', $imgStr[0]{'img'});

    foreach ($images as $imagesNew){
        $image=explode(':', $imagesNew);
        $im[]=$image;
    }
    $im[$numP][1]=$file;
    $v=0;
    foreach ($im as $phalt){
        $ima=implode(':', $phalt);
        $arr[$v]=$ima;
        $v++;
    }
    $arrFast= implode(',',$arr);
    var_dump($arrFast);
    $sql=" UPDATE `product` SET `img`=\"$arrFast\" WHERE `id`= $id";
    $res=insertUpdateDelate($sql);
    if($res){
        echo "hello";
    }else{
    }
}
function action_editAltT(){
    $id = $_POST['id'];
    $file=$_POST['file'];
    $imgStr = new_mysqli_fetch_all(imgObj($id));
    $im_top= explode(':', $imgStr[0]{'img-top'});
    $im_top[1]= $file;
    $im_top= implode(':',$im_top);
    //var_dump($file);
    $sql=" UPDATE `product` SET `img-top`=\"$im_top\" WHERE `id`= $id";
    $res=insertUpdateDelate($sql);
    if($res){
        echo'ok';
    }else{
    }
}
function action_editAltG(){
    $id = $_POST['id'];
    $file=$_POST['file'];
    $imgStr = new_mysqli_fetch_all(imgObj($id));
    $im_top= explode(':', $imgStr[0]{'img_general'});
    $im_top[1]= $file;
    $im_top= implode(':',$im_top);
    //var_dump($file);
    $sql=" UPDATE `product` SET `img_general`=\"$im_top\" WHERE `id`= $id";
    $res=insertUpdateDelate($sql);
    if($res){
        echo'ok';
    }else{
    }
}
function action_delPhotoT(){
    if (!empty($_POST['idT'])){
        $idT=+($_POST['idT']);
        $file= substr($_POST['file'], 1);
        $d = opendir("catalog/$idT");
        unlink("$file");
        closedir($d);
        $str='';
        $sql=" UPDATE `product` SET `img-top`=\"$str\" WHERE `id`= $idT";
        $res=insertUpdateDelate($sql);
        if($res){
            echo '<div id="img-top">Фото Top удалено</div>';
        }else{
            echo '<div class="messageT">Фото Top не удалено</div>';
        }

    }
}
function action_delPhotoG(){
    if (!empty($_POST['idG'])){
        $idG=+($_POST['idG']);
        $file= substr($_POST['file'], 1);
        $d = opendir("catalog/$idG");
        unlink("$file");
        closedir($d);
        $str='';
        $sql=" UPDATE `product` SET `img_general`=\"$str\" WHERE `id`= $idG";
        $res=insertUpdateDelate($sql);
        if($res){
            echo '<div id="img_general">Фото General удалено</div>';
        }else{
            echo '<div class="messageG">Фото General не удалено</div>';
        }

    }
}
function action_catalog(){
    loadAction();
}
function action_editPost(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $formData = [
            'title' => getSaveData(trim($_POST['title'])),
            'basic_description' => getSaveData(trim($_POST['basic_description'])),
            'content' => getSaveData(trim($_POST['content'])),
            'content_en' => getSaveData(trim($_POST['content_en']))
        ];
        $id = $_POST['id'];
        $sql1 = "UPDATE `post` SET   `title`='{$formData['title']}', `basic_description`='{$formData['basic_description']}',
        `content`='{$formData['content']}', `content_en`='{$formData['content_en']}'
          WHERE id= $id";
        $res1 = insertUpdateDelate($sql1);
        if ($res1) {
            echo '<div class="wrapp-edit-post">Пост редактирован успешно!</div>';
        }
    }
}
function action_delPost(){
    echo 'hello';
    $id = $_POST['id'];
    $res = delPost($id);
    if($res){
    if ($objs = glob("posts/$id/*")) {
        foreach($objs as $obj) {
            unlink($obj);
        }
    }
    rmdir("posts/$id");
        echo('Пост удален.');
    }

}
function action_viewPhotoPost(){
    $id_post = $_POST['id'];
    $singlePost = new_mysqli_fetch_all(singlePost_for_admin($id_post));
    if($singlePost){
        renderView('dev/photoPost', ['object' => $singlePost]);
    }else{
        echo 'hello';
    }

}
function action_editAltPost(){
    $id = $_POST['id'];
    $file=$_POST['file'];
    $imgStr = new_mysqli_fetch_all(imgPost($id));
    $im= explode(':', $imgStr[0]{'img'});
    $im[1]= $file;
    $im= implode(':',$im);
    //var_dump($file);
    $sql=" UPDATE `post` SET `img`=\"$im\" WHERE `id`= $id";
    $res=insertUpdateDelate($sql);
    if($res){
        echo'ok';
    }else{
    }
}
function action_delPhotoPost(){
    if (!empty($_POST['id'])){
        $id=+($_POST['id']);
        $file= substr($_POST['file'], 1);
        $d = opendir("posts/$id");
        unlink("$file");
        closedir($d);
        $str='';
        $sql=" UPDATE `post` SET `img`=\"$str\" WHERE `id`= $id";
        $res=insertUpdateDelate($sql);
        if($res){
            echo '<div id="img">Фото удалено</div>';
        }
    }
}
function action_upPhotoPost(){
    $id = $_POST['id'];
    $singlePost = new_mysqli_fetch_all(imgPost($id));
    if($singlePost){
        renderView('dev/addPhotoPost', ['object' => $singlePost]);

    }else{

        echo 'not';
    }
}
function action_upPhPo(){
    require '/home/maxim92/leathspace.com/www/vendor/autoload.php';
    $alt= $_POST['alt'];
    $id = $_POST['id'];
    $img= "/posts/$id/".time().$_FILES["max"]["name"].":".$_POST["alt"];
    $name_files_general = "posts/$id/".time().$_FILES["max"]["name"];
    $singleObject = new_mysqli_fetch_all(imgPost($id));
    $old = explode(':', $singleObject[0]['img']);
    $o = substr($old[0], 1);
    if(file_exists($o)){
        unlink($o);
    }

    move_uploaded_file($_FILES['max']['tmp_name'], "$name_files_general");
    $imagine = new Imagine\Gd\Imagine();
    $size  = new Imagine\Image\Box(200, 150);
    $image     = $imagine->open($name_files_general)->thumbnail($size);
    //$watermark = $imagine->open("/home/albre88/hauzer.in.ua/assets/img/hauzer_2017_watermark.png");
    // $wSize     = $watermark->getSize();
    //$bottomRight = new Imagine\Image\Point(50,50);//$size->getWidth() - $wSize->getWidth(), $size->getHeight() - $wSize->getHeight()
    $image->save
    ($name_files_general);//paste($watermark, $bottomRight)->
    $sql=" UPDATE `post` SET `img`=\"$img\" WHERE `id`= $id";
    $res=insertUpdateDelate($sql);
    if($res){
        echo'<div class="wrapp-edit-post">Фаил  успешно загружен!</div>';
    }else{
    }



}