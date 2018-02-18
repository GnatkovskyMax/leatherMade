<?php
$news=($_SESSION['lang']=='ru')? 'Новости' : 'News';
?>

<h2 class="header-name col-xs-8 col-sm-12"><?=$news?></h2>
<?php
$posts=$data['posts'];
for ($i = 0; $i < count($posts); $i++):
    $title=($_SESSION['lang']=='ru')?$posts[$i]['title']:$posts[$i]['basic_description'];
    $content=($_SESSION['lang']=='ru')?$posts[$i]['content']:$posts[$i]['content_en'];

    ?>
    <div class="all-news col-xs-12">
        <div class="col-xs-4 col-sm-3 wrapp-photo-news">
            <?php $alts=explode(':',$posts[$i]{'img'})?>
            <img src="<?=$alts[0]?>" alt="<?=$alts[1]?>" class="col-xs-12">
        </div><!--

        --><div class="col-xs-8 col-sm-9 wrapp-content-news">
            <span class="col-xs-12"><?= $posts[$i]['pubdate'] ?></span>
            <h2 class="col-xs-12"><?= $title?></h2>
            <div class="col-xs-12"><?= $content ?></div>
        </div>
        <hr class="col-xs-12">
    </div>
<?php endfor;?>
<div class="col-xs-12 col-md-12 col-lg-12 text-center">

    <?php
    $btn_post =$data['all_post'];
    if ($btn_post % 2 == 0) {
        $btn_post = $btn_post / 2;
    } else {
        $btn_post = ($btn_post / 2) + 1;
    }
    for ($i = 1; $i <= $btn_post; $i++):
        ?>
        <button class="post <?php if ((0 == +($_SESSION['page_post']) && $i == 1) OR ($i == +($_SESSION['page_post']))) {echo'lActive';}?>"><?= $i ?></button>

    <?php endfor;
    ?>
</div>