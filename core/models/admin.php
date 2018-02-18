<?php
function entranceAdmin($login, $password){
    $sql = "SELECT 'id' FROM `system` WHERE login = '$login' and password = '$password'";
    return selectData($sql);
}

function select_product(){
    $sql = "SELECT * FROM product WHERE 1";
    return selectData($sql);

}

function adminCountObgect($service){
    $sql = "SELECT product.id FROM product WHERE product.service = '$service'";
    return selectData($sql);
}

function deleatObject($id){
    var_dump($id);
    $sql = "DELETE  FROM `product` WHERE product.id = $id;";
    return selectData($sql);
}
function delPost($id){
    var_dump($id);
    $sql = "DELETE  FROM `post` WHERE post.id = $id;";
    return selectData($sql);
}
function single_product_for_admin($id){
$sql="SELECT  product.id, product.category_id, product.material, product.material_en,  product.description, 
 product.description_en, product.price, category.name, category.name_en
  FROM product 
 LEFT JOIN category ON (product.category_id = category.id)
 WHERE product.id=$id
 ";
    return selectData($sql);
}
function imgObj($id){
    $sql="SELECT  `id`, `img`, `img_general` FROM `product` WHERE product.id = $id";
    return selectData($sql);
}
function imgPost($id){
    $sql="SELECT  * FROM `post` WHERE post.id = $id";
    return selectData($sql);
}
function singlePost_for_admin($id){
    $sql="SELECT  * FROM `post` WHERE post.id = $id";
    return selectData($sql);
}
function addCategory($name, $name_en){
    $name=getSaveData(trim($name));
    $name_en=getSaveData(trim($name_en));
    $sql = "INSERT INTO `category`(`name`, `name_en`) VALUES ('{$name}','{$name_en}' )";
    $result = insertUpdateDelate($sql);
    return $result;
}
function redCategory($id, $name, $name_en){
    $name=getSaveData(trim($name));
    $name_en=getSaveData(trim($name_en));
    $sql = "UPDATE `category` SET `name`='{$name}',`name_en`='{$name_en}' WHERE `id`= '$id'";
    $result = insertUpdateDelate($sql);
    return $result;
}
function delCategory($id){
    $sql = "DELETE FROM category WHERE id=$id";
    $result = insertUpdateDelate($sql);
    return $result;
}
function findAllCategory(){
    $sql = "SELECT * FROM `category` WHERE 1";
    $result = selectData($sql);
    return $result;
}