<?php
for ($i = 0; $i < count($data['objects']); $i++):
?>
            <tr>
                <td class="table-id"><a href="/manual/object/<?= $data['objects'][$i]{'id'} ?>"><?= $data['objects'][$i]['id']?></a></td>
                <td class="info-admin"><a href="/manual/object/<?= $data['objects'][$i]{'id'} ?>"><?= $data['objects'][$i]['city']?></a></td>
                <td class="info-admin"><a href="/manual/object/<?= $data['objects'][$i]{'id'} ?>"><?= $data['objects'][$i]['street']?></a></td>
                <td class="info-admin"><a href="/manual/object/<?= $data['objects'][$i]{'id'} ?>"><?= $data['objects'][$i]['price']?> грн.</a></td>
                <td class="info-admin"><a href="/manual/object/<?= $data['objects'][$i]{'id'} ?>"><?= $data['objects'][$i]['rooms']?></td>
                <td class="info-admin"><a href="/manual/object/<?= $data['objects'][$i]{'id'} ?>"><?= $data['objects'][$i]['total_area']?></a></td>
                <td class="info-admin"><a href="/manual/object/<?= $data['objects'][$i]{'id'} ?>"><?= $data['objects'][$i]['bub_date']?></a></td>
                <td class="info-admin"><a href="/manual/object/<?= $data['objects'][$i]{'id'} ?>"><?= $data['objects'][$i]['service']?></a></td>
                <td class="info-admin"><a href="/manual/object/<?= $data['objects'][$i]{'id'} ?>"><?= $data['objects'][$i]['name']?></a></td>
                <td class="info-admin"><a href="/manual/object/<?= $data['objects'][$i]{'id'} ?>"><?= $data['objects'][$i]['surname']?></td>
                <td>
                    <input class="deleteObject" type="button" name="but" data-id="<?= $data['objects'][$i]{'id'} ?>" value="Удалить">
                    <a href="/admin/editObject/<?= $data['objects'][$i]{'id'} ?>"><button class="editObject" >Редактировать</button></a></td>

            </tr>
<?php endfor;
?>
