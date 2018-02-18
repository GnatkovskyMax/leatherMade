
<div class="admin-menu">
    <div class="wrap-nav">
        <ul>
            <li><a href='/admin/admin'><button> Главная</button></a></li>
            <li><a href='/admin/addObject'><button> Добавить товар</button></a></li>
            <li><a href='/admin/addPost'><button>Добавить пост</button></a></li>
            <li><a href='/admin/addDelCategory'><button>Категории</button></a></li>
            <li><a href='/admin/logout'><button>Выход</button></a></li>
        </ul>
    </div>
</div>
<h1>Новости и статьи</h1>
<?php for ($i = 0; $i < count($data['objects']); $i++):
    ?>
    <div class="sectionPost<?=$data['objects'][$i]{'id'} ?>">
        <div class="disp el-background backgroundNews">
            <a class="element-shadow">
                <div class="wrapImgNews disp">
                    <?php $alts=explode(':',$data['objects'][$i]{'img'})?>
                    <img src="<?=$alts[0]?>" alt="<?=$alts[1]?>">
                </div>
                <div class="disp wrapText">
                    <span><?= $data['objects'][$i]['pubdate'] ?></span>
                    <h2><?= $data['objects'][$i]['title'] ?></h2>
                    <p><?= $data['objects'][$i]['basic_description'] ?></p>
                </div>
            </a>
        </div>
        <a href="/admin/editPost/<?=$data['objects'][$i]{'id'} ?>"><button class="redPost">Редактировать</button></a> <button class="delPost" data-del-post="<?= $data['objects'][$i]{'id'} ?>">Удалить</button>
    </div>
    <hr/>
<?php endfor; ?>