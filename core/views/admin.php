<div class="admin-menu">
    <div class="wrap-nav">
        <ul>
            <li><a href='/admin/addObject'><button> Добавить товар</button></a></li>
            <li><a href='/admin/newsAdmin'><button>Посты</button></a></li>
            <li><a href='/admin/addPost'><button>Добавить пост</button></a></li>
            <li><a href='/admin/addDelCategory'><button>Категории</button></a></li>
            <li><a href='/admin/logout'><button>Выход</button></a></li>
        </ul>
    </div>
</div>
<section >
    <?php for($i=0;$i<count($data['products']);$i++){
       $name= explode(':', $data['products'][$i]{'img_general'}) ;
        ?>
        <div class="view_products_admin col-md-3">
            <p class="col-xs-12">ID_<?= $data['products'][$i]{'id'} ?></p>
            <div class=" ">
                <img src="<?= $name[0] ?>" alt="<?= $name[1] ?>">
            </div>
            <div class="col-xs-7">
                <input class="deleteObject" type="button" name="but" data-id="<?= $data['products'][$i]{'id'} ?>" value="Удалить">
                <a href="/admin/editObject/<?= $data['products'][$i]{'id'} ?>"><button class="editObject" >Редактировать</button></a>
            </div>
        </div>
    <?php } ?>

<div class="clearfix"></div>
</section>