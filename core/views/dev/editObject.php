<section class="container" id="red_bug">
    <section class="row">
        <section class="wrapp-edit text_int_top">
            <form action=""   enctype="multipart/form-data" method="POST" class="">
                <label>Категория
                    <select  name="category" class="category">

                        <?php
                        echo '<option value="' . $data['product'][0]['category_id'] . '" class="active_edit" >' . $data['product'][0]['name'] .'</option>';
                        for ($i = 0; $i < count($data['category']); $i++) {
                            $id_dist = $data['category'][$i]['id'];
                            if(+($id_dist)== +($data['product'][0]['category_id'])){
                                continue;
                            }else{
                                echo '<option value="' . $id_dist . '" >' . $data['category'][$i]['name'] .'</option>';
                            }


                        }?>
                    </select>
                </label></br>
                <label>Материал<input class="material" type="text" name="material" value="<?= $data['product'][0]{'material'}?>"></label></br>
                <label>Material<input class="material_en" type="text" name="material_en" value="<?= $data['product'][0]{'material_en'}?>"></label></br>
                <div class="firstMceVal" style="display:none"><?= $data['product'][0]{'description'}?></div>
                <label >Описание.**Чтобы появился текст для редактирования, кликните в поле ввода.<textarea class="description" name="description"></textarea></label>
                <div class="secondMceVal" style="display:none"><?= $data['product'][0]{'description_en'}?></div>
                <label >Description.**Чтобы появился текст для редактирования, кликните в поле ввода.<textarea id="descriptione" class="description_en" name="description_en" ></textarea></label>
                <label>Цена<input class="price" type="text" name="price" value="<?= $data['product'][0]{'price'}?>"></label></br>
                <input class="id" type="text" name="id"  value="<?= $data['product'][0]{'id'} ?>" readonly>
                <button class="editThisObject" style="border:2px solid green">Редактировать объект</button>
                <p><textarea id="costyll" class="costyll" name="ecostyll" style="display:none;"></textarea></p>
            </form>
        </section>
        <section>
            <a class="editObject" href="/admin/editObject/<?= $data['product'][0]{'id'} ?>" style="background:lightblue;border:2px solid orange">Обновить</a>
            <span class="viewPhoto" data-id="<?= $data['product'][0]{'id'} ?>" style="background:lightblue;border:2px solid orange">Все фото</span>
            <span class="upPhotoG" data-updatePhotoG="<?= $data['product'][0]{'id'} ?>" style="background:lightblue;border:2px solid orange">Добавить/Заменить фото General</span>
            <span class="add_Photo" data-addPhotoP="<?= $data['product'][0]{'id'} ?>" style="background:lightblue;:2px solid orange">Добавить фото</span>
            <a href='/admin/admin'><button>Главная</button></a>
            <a href='/admin/logout'><button>Выход</button></a>
        </section>
    </section>
</section>

