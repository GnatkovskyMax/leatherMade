<?php
$lang=$_SESSION['lang'];
$material=($_SESSION['lang']=='ru')? $data['product'][0]['material'] : $data['product'][0]['material_en'];
$description=($_SESSION['lang']=='ru')? $data['product'][0]['description'] : $data['product'][0]['description_en'];
?>
<section class="wrapp-view col-xs-12">
    <div class="deleteIcon"></div>
         <div class="wrapp-slider col-xs-12 col-sm-8 col-md-8">
<!--             <h2 class="header-for-slider text-center col-xs-12">--><?//=$material?><!--</h2>-->
            <div class="catalog-im col-xs-12" style="display:block;">
 <?php
$imegs = explode(',', $data['product'][0]['img']);

for ($i = 0; $i < count($imegs); $i++):
    $alts=explode(':', $imegs[$i]);
    ?>
                <div class="slide"><img src="<?=$alts[0]?>" alt="<?=$alts[1]?>"></div>
            <?php endfor; ?>
        </div>


         </div>
        <div class="wrapp-info col-xs-12 col-sm-4 col-md-4">
            <div class="col-xs-12">
<!--                <div class="flip wow col-xs-6 text-center">-->
<!--                    <div class="price-info --><?//=$lang?><!--">--><?//= $data['product'][0]['price'] ?><!--</div>-->
<!--                </div>-->
                <p class="col-xs-12 <?=$lang?> price-product" data-id="<?= $data['product'][0]['id'] ?>"><?= $data['product'][0]['price'] ?> </p>
                <button class="btn <?php
                if (stristr($_SESSION['cart']['id'], $data['product'][0]['id'])) {
                    echo 'deleteProduc ';
                } else {
                    echo 'addToBasket ';
                }
                ?> text-right" data-id="<?= $data['product'][0]['id'] ?>">
                </button>
<!--                <div class="wow flip col-xs-6 text-center"><div class="add-info del-info  -->
<!--                --><?php //if (stristr($_SESSION['cart']['id'], $data['product'][0]['id'])) {
//            echo 'deleteProduc';
//        } else {
//            echo 'addToBasket';
//        }
//        ?><!-- --><?//= $lang?><!--" data-id="--><?//= $data['product'][0]['id'] ?><!--"></div></div>-->

            </div>
<!--                <p class="category-info">kolie</p>-->
<!--                <p class="material-info">gold</p>-->
<!--                <p class="price-info en">123 uan</p>-->
                <p class="description-info col-xs-12"><?=$description?></p>
        </div>
</section>