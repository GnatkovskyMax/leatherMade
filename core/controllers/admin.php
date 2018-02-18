<?php
function action_addPost (){
    if (is_auth()) {
        require '/home/maxim92/leathspace.com/www/vendor/autoload.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $formData = [
                'title' => getSaveData(trim($_POST['title'])),
                'basic_description' => getSaveData(trim($_POST['basic_description'])),
                'content' => getSaveData(trim($_POST['content'])),
                'content_en' => getSaveData(trim($_POST['content_en']))
            ];
            $sql1 = "INSERT INTO `post`( `title`,`basic_description`, `content`, `content_en`) VALUES ('{$formData['title']}',
'{$formData['basic_description']}','{$formData['content']}','{$formData['content_en']}')";
            $res = insertUpdateDelate($sql1);
            $sql = "SELECT max(id) FROM `post`";
            $res2 = selectData($sql);
            $last = mysqli_fetch_assoc($res2)['max(id)'];
            if ($res == true && $_FILES["image"]["name"] != '') {
                $d = opendir("posts");///home/albre88/hauzer.in.ua
                mkdir('posts/' . $last, 0755, true);
                $opendir = opendir('posts/' . $last);
                $imgPost = "/posts/$last/". time().$_FILES["image"]["name"] . ":" . $_POST["alt"];
                $name_files = "posts/$last/" . time() . $_FILES["image"]["name"];
                move_uploaded_file($_FILES["image"]["tmp_name"], $name_files);
                $imagine = new Imagine\Gd\Imagine();
                $size = new Imagine\Image\Box(580, 360);
                $image = $imagine->open($name_files)->thumbnail($size);
                $image->save($name_files);//paste($watermark, $bottomRight)->
                closedir($opendir);
                closedir($d);
                $sql2=" UPDATE `post` SET `img`=\"$imgPost\" WHERE `id`= $last";
                $res2=insertUpdateDelate($sql2);
            }
            if($res2){
                echo'Пост добавлен успешно!';
                echo "<a href='/admin/admin'><button>Главная</button></a>";
            }
        }else{
            renderView('dev/addPost');
        }
    }else{
        echo "<a href='/admin/login'><button>Вход</button></a>";
    }
}
function action_editPost(){
    if (is_auth()) {

        $ElId = getUrlSegment(2);
        $result = new_mysqli_fetch_all(getIdNews($ElId));
        renderView('dev/editPost', ['objects' => $result]);
    }else{
        echo "<a href='/admin/login'><button>Вход</button></a>";
    }
}

function action_newsAdmin (){
    if (is_auth()) {

        $result = new_mysqli_fetch_all(findAllPost());
        // var_dump($result);
        renderView('dev/newsAdmin', ['objects' => $result]);
    }else{
        echo "<a href='/admin/login'><button>Вход</button></a>";
    }
}
function action_login(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $login = valid_adress(htmlspecialchars(trim($_POST['login'])));
        $password = md5(valid_adress(htmlspecialchars(trim($_POST['password']))));
        $resEntranceAdmin = entranceAdmin($login, $password);
        if($resEntranceAdmin -> num_rows === 0){
            echo "Incorect login or password";
        }else{
            $_SESSION['user'] = mysqli_fetch_assoc($resEntranceAdmin);
           echo "<a href='/admin/admin'><button>Главная</button></a>";
            echo "<a href='/admin/logout'><button>Выход</button></a>";
            
        }
    }else{
      renderView('login');
    }
  
}
function action_admin(){
    if(is_auth()){
        $adminObjects = new_mysqli_fetch_all(select_product());

            renderView('admin', ['products' => $adminObjects]);


    }else{
        echo "<a href='/admin/login'><button>Вход</button></a>";
    }
}
function action_addDelCategory(){
    if(is_auth()) {
        $allCategory = new_mysqli_fetch_all(findAllCategory());
        renderView('dev/addDelCategory', ['category' => $allCategory]);
    }else{
        echo "<a href='/admin/login'><button>Вход</button></a>";
    }
}
function action_logout(){
    session_unset();
    session_destroy();
    echo "<a href='/admin/login'><button>Вход</button></a>";
}
function action_editObject(){
    //вытянуть с базы все дание об обьекте во вьюшку а дальше работать через аякс
    //var_dump(getUrlSegment(2));
    if(is_auth()){
        $category=new_mysqli_fetch_all(findAllCategory());
        $id_object = getUrlSegment(2);
        $product = new_mysqli_fetch_all(single_product_for_admin($id_object));
        renderView('dev/editObject', ['category' => $category, 'product' => $product]);
    }else{
        echo "<a href='/admin/login'><button>Вход</button></a>";
    }


}
function action_addObject(){

if(is_auth()) {
    require '/home/maxim92/leathspace.com/www/vendor/autoload.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $formData = [
            // 'author-id'=> $_SESSION['user']['id'],
            'price' => +(getSaveData(trim($_POST['price']))),
            'material' => getSaveData(trim($_POST['material'])),
            'material_en' => getSaveData(trim($_POST['material_en'])),
            'description' => getSaveData(trim($_POST['description'])),
            'description_en' => getSaveData(trim($_POST['description_en'])),
        ];
        $category = +($_POST['category']);
        $sql1 = "INSERT INTO `product`( `category_id`, `price`, `material`, 
`material_en`, `description`, `description_en`) VALUES ($category, {$formData['price']},'{$formData['material']}',  '{$formData['material_en']}',
                   '{$formData['description']}', '{$formData['description_en']}')";
        $res = insertUpdateDelate($sql1);
        //
        $sql = "SELECT max(id) FROM `product`";
        $res2 = selectData($sql);
        $last = mysqli_fetch_assoc($res2)['max(id)'];
        if ($last && $res) {
            $d = opendir("catalog");
            mkdir('catalog/' . $last, 0755, true);
            closedir($d);
            echo '<a href="/admin/editObject/' . $last . '">Редактировать добавленный объект</a>';
        }


        if ($res == true && $_FILES["image0"]["name"] != '') {
            $img = '';
            $g = '';
            $d = opendir("catalog");
            $opendir = opendir('catalog/' . $last);
            for ($i = 0; !empty($_FILES["image$i"]); $i++) {
                if ($_POST['general'] != NULL) {
                    if (+$_POST['general'] == $i) {
                        $g = 'general';
                        $img_general = "/catalog/$last/" . $g . time() . $_FILES["image$i"]["name"] . ":" . $_POST["alt$i"];
                    } else {
                        $g = '';
                        $img = $img . "/catalog/$last/" . $g . time() . $_FILES["image$i"]["name"] . ":" . $_POST["alt$i"] . ',';
                    }
                } else {
                    $g = '';
                    $img = $img . "/catalog/$last/" . $g . time() . $_FILES["image$i"]["name"] . ":" . $_POST["alt$i"] . ',';
                }

                $name_files = "catalog/$last/" . $g . time() . $_FILES["image$i"]["name"];
                move_uploaded_file($_FILES["image$i"]["tmp_name"], $name_files);
                $imagine = new Imagine\Gd\Imagine();

                if ($g == '') {
                    $size = new Imagine\Image\Box(1024, 768);
////        $imagine->open("catalog/$last/".$g.time().$_FILES["image$i"]["name"])->thumbnail($size, 'inset')->save
////        ("catalog/$last/".$g.time().$_FILES["image$i"]["name"]);
                    $image = $imagine->open($name_files)->thumbnail($size);
                    //$watermark = $imagine->open("/home/albre88/hauzer.in.ua/assets/img/hauzer_2017_watermark.png");
                    // $wSize     = $watermark->getSize();
                    //$bottomRight = new Imagine\Image\Point(50,50);//$size->getWidth() - $wSize->getWidth(), $size->getHeight() - $wSize->getHeight()
                    $image->save($name_files);//paste($watermark, $bottomRight)->
                } else {
                    $size = new Imagine\Image\Box(200, 150);
////        $imagine->open("catalog/$last/".$g.time().$_FILES["image$i"]["name"])->thumbnail($size, 'inset')->save
////        ("catalog/$last/".$g.time().$_FILES["image$i"]["name"]);
                    $image = $imagine->open($name_files)->thumbnail($size);
                    //$watermark = $imagine->open("/home/albre88/hauzer.in.ua/assets/img/hauzer_2017_watermark.png");
                    //$wSize     = $watermark->getSize();
                    //$bottomRight = new Imagine\Image\Point(50,50);//$size->getWidth() - $wSize->getWidth(), $size->getHeight() - $wSize->getHeight()
                    $image->save($name_files);//paste($watermark, $bottomRight)->

                }

            }
            closedir($opendir);
            closedir($d);
            $img = substr($img, 0, -1);
            $sql2 = " UPDATE `product` SET `img`=\"$img\",`img_general`= \"$img_general\" WHERE `id`= $last";
            $res2 = insertUpdateDelate($sql2);
            if ($res2) {
                echo "<p style='color:green;font-size:18px;'>Обьект добавлен успешно!</p><br>
              <span style='color:red;font-size:18px;'>Перезагрузка страницы приведет к повторному добавлению объекта.</span></br>
              <a href='/admin/admin'><button>Объекты</button></a><br>
              <a href='/admin/addObject'><button> Добавить объект</button></a><br>
              <a href='/admin/logout'><button>Выход</button></a>";
            }
        } else {
            echo "<br><span style='color:red;font-size:18px;text-decoration: underline'>Заполните все поля</span>";
            echo "<br><span style='color:red'>Чтобы исправить ошибки рекомендуется<a href='/admin/addObject'><button>Заполнить заново</button></a></span></br>
";
            echo "<a href='/admin/logout'><button>Выход</button></a>";
        }
    }
    else {
        $category=new_mysqli_fetch_all(findallCategory());
        renderView('dev/addObject', ['category'=>$category]);
    }
}

else{
    echo "<a href='/admin/login'><button>Вход</button></a>";
}


   
}

