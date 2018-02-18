<!--/**-->
<!-- * Created by PhpStorm.-->
<!-- * User: Max-->
<!-- * Date: 05.04.2017-->
<!-- * Time: 0:29-->
<!-- */-->
<div class=" col-xs-12 wrapp-body">

<!--    <form action="" enctype="multipart/form-data"  method="POST" class="addP">-->
<!--       <input type="file" name="image" class="add photoP0" data-id="0" > <!--<label>-->
<!--            <input type="text" name="alt" class="alt0" data-id="0" placeholder="Введите Альт-атрибут для картинки"></label>-->
<!--        <div class="addFileP">addFile+</div></br>-->
    <input type="file" class="photoChange" multiple="multiple" accept=".txt,image/*">

        <button type="submit" class="addPhoto_Data" data-obj-id="<?=$data['object'][0]['id']?>">Добавить фото!</button>
<!--    </form>-->
</div>
