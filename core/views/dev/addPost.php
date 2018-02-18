<a href='/admin/admin'><button>Главная</button></a>
<a href='/admin/logout'><button>Выход</button></a>
<form action="/admin/addPost" enctype="multipart/form-data"  method="POST" class="">
    <label>Заголовок<textarea name="title"></textarea></label></br>
    <label>Title<textarea name="basic_description"></textarea></label></br>
    <label>Контент<textarea name="content"></textarea></label></br>
    <label>Content<textarea name="content_en"></textarea></label></br>
    <label><input type="file" name="image" class="file"><input
    type="text" name="alt" placeholder="Введите Альт-атрибут для картинки"></label></br>
    <button type="submit">Добавить пост!</button>
</form>