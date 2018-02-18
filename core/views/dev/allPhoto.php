<div class="wrapp-edit">

    <?php
   if($data['object'][0]{'img_general'}!==''){
    $alts2=explode(':',$data['object'][0]{'img_general'});
    ?>

    <div class="col-md-12 adminPh" id="img_general"><img class='file-delG' src="<?=$alts2[0]?>" alt="<?=$alts2[1]?>">
        <div>Фото General</div>
           <form action="" method="POST">
               <input type="text" name="img-G-alt" class="img-G-alt" value="<?=$alts2[1]?>"><br>
               <button class="editAltG" data-id="<?= $data['object'][0]{'id'}?>">Изменить значение Alt-атрибута</button>
           </form>
           <button class="delPhotoG" id="<?= $data['object'][0]{'id'}?>">Удалить фото с альтом</button>
           <div class="messageG"></div>
  <?php }else{
       echo 'Нет фото! Перейдите во вкладку "Добавить/Заменить фото General"</div>';
   } ?>
    <div id="sortable">
<!--        <ul >-->
<!--            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 1</li>-->
<!--            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 2</li>-->
<!--            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 3</li>-->
<!--            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 4</li>-->
<!--            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 5</li>-->
<!--            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 6</li>-->
<!--            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 7</li>-->
<!--        </ul>-->
        <?php
        if($data['object'][0]['img']!==''){
            $imegs = explode(',', $data['object'][0]['img']);
            for ($i = 0; $i < count($imegs); $i++):
                $alts3=explode(':', $imegs[$i]);
                ?>
                <div class="col-md-3 adminPh rep_Ph ui-state-default" data-replace="<?=$i?>" id="img<?=$i?>"><img src="<?=$alts3[0]?>" alt="<?=$alts3[1]?>" class='file-delP<?=$i?>'>
                    <form action="" method="POST">
                        <input type="text" name="img-alt" class="alt<?=$i?>"  value="<?=$alts3[1]?>"><br>
                        <button class="editAlt" data="<?=$i?>" data-id="<?= $data['object'][0]{'id'}?>" >Изменить значение Alt-атрибута</button>
                    </form>
                    <input type="checkbox" class="delPhoto" id="<?=$i?>" data-id="<?= $data['object'][0]{'id'}?>">Удалить фото с альтом</input>
                    <div class="message<?=$i?>"></div>
                </div>
            <?php endfor;?>

        <?php }else{
            echo 'Нет фото! Перейдите во вкладку "Добавить фото"';
       }?>


    </div><!--
        --><div class="block_for_button_admin">
            <button class="delPhoto_Checkbox" data-id="<?= $data['object'][0]{'id'}?>">Удалить отмеченые фото.</button>
            <button class="replacePhoto" data-id="<?= $data['object'][0]{'id'}?>">Упорядочить фото.</button>
        </div>
</div>
    <div class="clearfix"></div>

</div>