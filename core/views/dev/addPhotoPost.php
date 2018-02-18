<div class="wrapp-edit-post">
    <form action="" id="my_form_Post" enctype="multipart/form-data" method="POST">
        <label><input type="file" name="imagePost" data-post-id="<?=$data['object'][0]['id']?>" class="filePost">
            <input type="text" name="altPost" class="altPost" placeholder="Введите Альт-атрибут для картинки"></label></br>
        <button type="submit" class="upPhPo" data-post-id="<?=$data['object'][0]['id']?>">Обновить фото</button>
    </form>
</div>