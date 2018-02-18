<?php
$category_nav = $data['category'];
$num_category=count($category_nav);
$count= count(explode(',',$_SESSION['cart']['id']));
$lang=$_SESSION['lang'];
$historyBrand=($_SESSION['lang']=='ru')? 'История бренда' : 'History of brand';
$catalog=($_SESSION['lang']=='ru')? 'Каталог' : 'Collection';
if($_SESSION['cart']['id']==NULL){
    $count=0;
}
?>
<body>
<div class="container">
    <div class="row">
        <header class="for-header col-xs-12">
            <div class="wrapp-for-header-info col-xs-12">
                <div class="col-xs-12  col-md-push-2 col-sm-7 col-md-8 center-xs" >
                    <h1><a href="/" class="logo">Br147.com</a></h1>
                </div>
                <div class="col-xs-12 col-sm-5 col-md-4  text-right center-xs icon-block-xs">
                    <div class=" col-xs-12">
                        <div class="basket col-xs-2 col-sm-4"><?= $count ?></div>
                        <div class=" langy col-xs-9 col-sm-8" >
                                  <div class="col-xs-12 text-left " style="padding:0">+38(063)943-78-05</div>
                                  <div class=" col-xs-12 text-left " style="padding:0">Gnatkovsky@bigmir.net</div>
                        </div>
                    </div>
                </div>
                <main class="col-xs-12 col-sm-6 col-md-6 history">
<!--                    <h2 class="header-name col-xs-12"></h2>-->
                    <section class="history-content col-xs-12 ">
<!--                        <div class="col-xs-6 col-sm-6 col-md-4 wrapp-photo-history">-->
<!--                            <img src="/assets/img/coll.jpg" alt="" class="col-xs-12">-->
<!--                        </div>-->
                        <div class="col-xs-12 wrapp-content-history">
                            <div class="col-xs-12">Не упусти свой шанс купить <span class="cool">COOL</span>ьный аксесуар</div>
                        </div>
                    </section>

                </main>
                <article class="col-xs-12 col-sm-6 ">
                    <form class="form-connect form-signin col-xs-12 col-sm-7 col-sm-push-3">
                        <h2 class="form-signin-heading">Связатся со мной</h2>
                        <label for="inputEmail" class="sr-only">Имя</label>
                        <input type="email" id="inputEmail" class="form-control connect-name" placeholder="Имя" required autofocus>
                        <label for="inputPassword" class="sr-only">Телефон</label>
                        <input type="password" id="inputPassword" class="form-control connect-phone" placeholder="(063)500-500-5" required>
                        <button class="btn btn-lg  btn-block" type="submit" style="background: gold">Отправить</button>
                    </form>

                </article>
<!--                <div class="col-xs-12 text-center wrapp-btn-collage">-->
<!--                    <button class="btn-collage bounceInDown wow ">-->
<!--                        Collection-->
<!--                    </button>-->
<!--                </div>-->
            </div>

        </header>

        <div class="forBasket col-xs-12">
            <div class="deleteBasket deleteIcon"></div>
            <div class="dataBasket col-xs-12 col-sm-5 "></div>

        </div>

<section class="catalog col-xs-12">
<!--    <h2 class="header-name col-xs-8 col-sm-12">= $catalog </h2>-->
        <div class="icon-wrapp visible-xs col-xs-4 ">
            <div class="icon-menu ">
                <div class="icon-block"></div>
                <div class="icon-block"></div>
                <div class="icon-block"></div>
        </div>
    </div>
    <div class="wrapp-menu col-xs-12">
    <ul class="menu col-xs-12" >

        <?php  for ($i = 0; $i < count($category_nav); $i++){
            $category_name=($_SESSION['lang']=='ru') ? $category_nav[$i]['name']:$category_nav[$i]['name_en'];
            $a='';
            if($category_nav[$i]['id']== $data['cat_id']){
                $a='cat_active';
            }
            ?>
            <li class="sale name-category <?=$a?>" style="width:<?=100/$num_category.'%' ?>;" data-id="<?= $category_nav[$i]['id']?>" > <?= $category_name;?>
            </li>
        <?php };?>
    </ul>
    </div>
    <div class=" col-xs-12 wrapp-products ">
             <?php renderView('dev/wrapp-products', $data)?>

    </div>

</section>
        <div class="wrapp-view-for"></div>
</div>
</div>
</body>
