<form action="" method="POST" id='basketForm' class="col-xs-12">
<div class="for_basket_lineHeight">
<?php
if($data['allProductFromBasket']){
    $products=$data['allProductFromBasket'];
    for($i=0;$i<count($products);$i++){
        $alts=explode(':', $products[$i]['img_general']);
        $material=($_SESSION['lang']=='ru')? $products[$i]['material'] : $products[$i]['material_en'];
        $lang=$_SESSION['lang'];
        ?>

        <div class="oneProductBasket col-xs-12" data-id="<?=$products[$i]['id']?>">
            <img class="col-xs-6 basket-img" src="<?=$alts[0]?>" alt="<?=$alts[0]?>" data-id="<?=$products[$i]['id']?>">
<!--            <div class="col-xs-3 basket-material text-center" data-id="--><?//=$products[$i]['id']?><!--">--><?//=$material?><!--</div>-->
            <div class="col-xs-3 basket-material   text-center" data-id=""><input class="amount col-xs-12" name="amount<?=$products[$i]['id']?>" type="number" min="1" value="1"></div>
            <div class="col-xs-3 basket-price text-center <?=$lang?> data-id="<?=$products[$i]['id']?>" data-price="<?=$products[$i]['price']?>" ></div>

         <div class="deleteProduct" data-id="<?=$products[$i]['id']?>"></div>
        </div>
    <?php }
    if($lang=='ru'){
        $phone='Телефон';
        $last_name='Фамилия';
        $first_name='Имя';
        $pickup='Самовывоз';
        $posta='Почта';
        $nova='Нова почтa';
        $ukr='Укрпочта';
        $intime='Интайм';
        $address='Адрес доставки/Отделение почты';
        $type_delivery="Вид доставки";
        $checkout='Оформить заказ';
    }else{
        $phone='Phone';
        $last_name='Last name';
        $first_name='Name';
        $pickup='Pickup';
        $posta='Post';
        $nova='Nova poshta';
        $ukr='Ukrposhta';
        $intime='Intime';
        $address='Delivery address / Separation of mail';
        $type_delivery='Type of delivery';
        $checkout='Checkout';
    }

    ?>

        <div class="col-xs-12 all-sum text-center ru"></div>
        <input type="text" name="all-sum" style="display:none">
        <input type="text" placeholder="<?=$phone?>" name="phone" class=" field col-xs-12">
        <input type="text" placeholder="<?=$first_name?>" name="first-name" class="field  col-xs-12">
        <input type="text" placeholder="<?=$last_name?>" name="last-name" class="field col-xs-12">

        <?=$type_delivery?><br>
        <label class="col-xs-6"><?=$pickup?><input type="radio" name="type-delivery" value="pickup" checked class="post-check"></label>
        <label class="col-xs-6"><?=$posta?><input type="radio" name="type-delivery" value="post" class="post-check"></label>
        <hr>
        <div class="for-post">
            <label class="col-xs-6 col-md-4 text-left"><?=$ukr?><input type="radio" name="service-delivery" value="ukr-post" ></label>
            <label class="col-xs-6 col-md-2 col-md-pull-1 text-right"><?=$intime?><input type="radio" name="service-delivery" value="intime-post" ></label>
            <label class="col-xs-12 col-md-4  text-center"><?=$nova?><input type="radio" name="service-delivery" value="nova-post"></label>
            <input type="text" placeholder="<?=$address?>" name="address" class="field col-xs-12">
        </div>

        <button class="col-xs-12 checkout"><?=$checkout?></button>
</form>
<?php }else{echo "<p class='col-xs-12 text-center'>Ваша корзина пуста.</p>";}?>

</div>



