<div class="wrapp-add-category">
<ul>
    <?php for ($i = 0; $i < count($data['category']); $i++){ ?>
        <li>
            <?= $data['category'][$i]['id']?>
            <input type="text" class="name<?= $data['category'][$i]['id']?>"        value="<?= $data['category'][$i]['name']?>">
            <input type="text" class="name_en<?= $data['category'][$i]['id']?>"  value="<?= $data['category'][$i]['name_en']?>">
            <button data-id="<?= $data['category'][$i]['id']?>" class="del_category">Удалить</button>
            <button data-id="<?= $data['category'][$i]['id']?>"  class="red_category">Редактировать</button>
        </li>
    <?php }?>
</ul>
        <form>
            <input type="text" class="name_new"    name="name">
            <input type="text" class="name_en_new" name="name_en">
            <button  class="add_category">Добавить</button>
        </form>
</div>
