<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 21.02.2017
 * Time: 3:10
 */
?>
<a href='/admin/admin'><button>Главная</button></a>
<a href='/admin/logout'><button>Выход</button></a>
<form action="/admin/addObject" enctype="multipart/form-data"  method="POST" class="addObject">

    <label>Категория
        <select  name="category">
            <?php  for ($i = 0; $i < count($data['category']); $i++) {
                $id_dist = $data['category'][$i]['id'];
                echo '<option value="' . $id_dist . '" >' . $data['category'][$i]['name'] .'</option>';

            }?>
        </select>
    </label></br>
    <label>Материал<input type="text" name="material"></label></br>
    <label>Material<input type="text" name="material_en"></label></br>
    <label>Описание<textarea name="description"></textarea></label></br>
    <label>Description<textarea name="description_en"></textarea></label></br>
    <label>Цена<input type="text" name="price"></label></br>
    <label><input type="file" name="image0" class="file"><input type="radio" name="general" value="0" ><input
                type="text" name="alt0" placeholder="Введите Альт-атрибут для картинки"></label><div class="addFile">addFile+</div></br>
    <button type="submit">Добавить объект!</button><span style="color:red;">**Все поля обязательны для аполнения</span>
</form>
