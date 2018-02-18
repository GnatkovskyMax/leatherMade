<section class="container" id="red_bug">
    <section class="row">
        <section class="wrapp-edit-post">
            <form action="" enctype="multipart/form-data"  method="POST" id="editPostForm">
                <div class="post-t-MceVal"  style="display:none"><?= $data['objects'][0]{'title'}?></div>
                <label >Заголовок<textarea  id="basic-t-description" class="basic-t-description" name="title"></textarea></label>
                <div class="post-b-MceVal" style="display:none"><?= $data['objects'][0]{'basic_description'}?></div>
                <label >Title<textarea id="basic-b-description" class="basic-b-description" name="basic_description" ></textarea></label>
                <div class="post-c-MceVal" style="display:none"><?= $data['objects'][0]{'content'}?></div>
                <label >Контент<textarea id="content" class="content" name="content" ></textarea></label>
                <div class="post-e-MceVal" style="display:none"><?= $data['objects'][0]{'content_en'}?></div>
                <label >Content<textarea id="content_en" class="content_en" name="content_en" ></textarea></label>
                <p><textarea id="costyll" class="costyll" name="ecostyll" style="display:none;"></textarea></p>
                <button class="editPostB" data-post-id="<?= $data['objects'][0]{'id'}?>">Редактировать пост!</button>
            </form>
        </section>
        <section>
            <a class="editPost" href="/admin/editPost/<?= $data['objects'][0]{'id'} ?>" style="border:2px solid orange">Редактировать</a>
            <span class="viewPhotoPost" data-id="<?= $data['objects'][0]{'id'} ?>" style="border:2px solid orange">Все фото</span>
            <span class="add_PhotoPost" data-addPhotoPost="<?= $data['objects'][0]{'id'} ?>" style="border:2px solid orange">Заменить фото</span>
            <a href='/admin/admin'><button>Главная</button></a>
            <a href='/admin/logout'><button>Выход</button></a>
        </section>
    </section>
</section>
