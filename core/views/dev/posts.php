<?php
for ($i = 0; $i < count($data['objects']); $i++):
?>
    <div class="sectionPost">
        <div class="disp el-background backgroundNews">
            <a  href="/manual/post/<?= $data['objects'][$i]{'id'} ?>">
                <div class="wrapImgNews disp">
                    <?php $alts=explode(':',$data['objects'][$i]{'img'})?>
                    <img src="<?=$alts[0]?>" alt="<?=$alts[1]?>">
                </div>
                <div class="disp wrapText">
                    <span class="data"><?= $data['objects'][$i]['pubdate'] ?></span>
                    <h2><?= $data['objects'][$i]['title'] ?></h2>
                    <p><?= $data['objects'][$i]['basic_description'] ?></p>
                </div>
            </a>
        </div>
    </div>
<?php endfor; ?>