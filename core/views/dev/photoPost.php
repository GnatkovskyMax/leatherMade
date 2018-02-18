<div >
    <?php
    if($data['object'][0]['img']!==''){
        $alts = explode(':', $data['object'][0]['img']);
        ?>
            <div id="img"><img src="<?=$alts[0]?>" alt="<?=$alts[1]?>" class='file-delPost'>
                <form action="" method="POST">
                    <input type="text" name="img-alt-post" class="altPost"  value="<?=$alts[1]?>"><br>
                    <button class="editAltPost"  data-id="<?= $data['object'][0]{'id'}?>" >Изменить значение Alt-атрибута</button>
                </form>
                <button class="delPhotoPost"  data-id="<?= $data['object'][0]{'id'}?>">Удалить фото с альтом</button>
                <div class="message<?=$i?>"></div>
            </div>
        <?php
    }else{
        echo 'Нет фото! Перейдите во вкладку "Добавить фото"';
    }?>


</div>