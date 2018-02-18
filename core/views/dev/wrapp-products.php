<div class=" col-xs-12 center ">
<?php
$lang=$_SESSION['lang'];
for ($i = 0; $i < count($data['product']); $i++):
    $material=($_SESSION['lang']=='ru')? $data['product'][$i]['material'] : $data['product'][$i]['material_en'];
    ?>

    <div class="single-product col-xs-12 col-sm-6 col-md-4" data-id="<?= $data['product'][$i]['id'] ?>">
        <div class="relative">
        <?php $alts=explode(':',$data['product'][$i]{'img_general'})?>
        <div class="wrapp-im "><!---->
            <img src="<?=$alts[0]?>" alt="<?=$alts[1]?>" data-id="<?= $data['product'][$i]['id'] ?>">
        </div>


        <div class="single-product-cover col-xs-12">
            <div class="single-product-cover-center " data-id="<?= $data['product'][$i]['id'] ?>">
                <p class="col-xs-12" data-id="<?= $data['product'][$i]['id'] ?>"><?=$material?></p>
                <p class="col-xs-12 <?=$lang?> price-product" data-id="<?= $data['product'][$i]['id'] ?>"><?= $data['product'][$i]['price'] ?> </p>
                <button class="btn <?php
                if (stristr($_SESSION['cart']['id'], $data['product'][$i]['id'])) {
                    echo 'deleteProduc ';
                } else {
                    echo 'addToBasket ';
                }
                ?> text-right" data-id="<?= $data['product'][$i]['id'] ?>">
                </button>
            </div>

        </div>
    </div>
    </div>
<?php endfor;

?>
</div>

