<?php if(is_array(json_decode($value))): ?>

    <?php foreach (json_decode($value) as $key=>$item):?>

        <tr>
            <th><label for="text_chiffre_<?=$key?>">Texte chiffre <?=$key+1?></label></th>
            <td>
                <input value="<?=$item->text?>" oninput="setData(<?=$key?>,this)" class="regular-text" type="text" name="text_chiffre_<?=$key?>" id="text_chiffre_<?=$key?>">
            </td>

        </tr>
        <tr>
            <th><label for="valeur_chiffre_<?=$key?>">Valeur chiffre <?=$key+1?></label></th>
            <td>
                <input value="<?=$item->value?>" oninput="setValue(<?=$key?>,this)" class="regular-text valeur_chiffre" type="text" name="valeur_chiffre_<?=$key?>" id="valeur_chiffre_<?=$key?>">
            </td>

        </tr>
    <?php endforeach;?>

<?php else:?>


<?php for($i=0;$i< $number;$i++): ?>
<tr>
    <th><label for="text_chiffre_<?=$i?>">Texte chiffre <?=$i+1?></label></th>
    <td>
        <input oninput="setData(<?=$i?>,this)" class="regular-text" type="text" name="text_chiffre_<?=$i?>" id="text_chiffre_<?=$i?>">
    </td>

</tr>
    <tr>
        <th><label for="valeur_chiffre_<?=$i?>">Valeur chiffre <?=$i+1?></label></th>
        <td>
            <input oninput="setValue(<?=$i?>,this)" class="regular-text valeur_chiffre" type="text" name="valeur_chiffre_<?=$i?>" id="valeur_chiffre_<?=$i?>">
        </td>

    </tr>

<?php endfor;?>
<?php endif;?>
<tr id="list_<?=$number?>">
    <th>Chiffres clés</th>
    <td>
        <a href="#" id="add_chiffre" class="button button-secondary">
            Ajouter
        </a>

    </td>
    <input type="hidden" id="chiffres" name="chiffres">


</tr>

<script>
    let count = <?php echo $value === "" ? 0 : count(json_decode($value))?>;
    let button = document.getElementById('add_chiffre');
    let list = document.getElementById('list_1');
    let data = <?=$value?> !== "" ? <?=$value?> : [];

    button.addEventListener('click',function(){
        count += 1;
        let newLine = '<tr>'+
            '<th><label for="text_chiffre_'+count+'">Texte chiffre '+count+'</label></th>'+
        '<td>'+
        '<input oninput="setData('+count+',this)" class="regular-text" type="text" name="text_chiffre_'+count+'" id="text_chiffre_'+count+'">'+
            '</td>'+
        '</tr>'+
            '<tr>'+
            '<th><label for="valeur_chiffre_'+count+'">Valeur chiffre '+count+'</label></th>'+
            '<td>'+
            '<input oninput="setValue('+count+',this)" class="regular-text" type="text" name="valeur_chiffre_'+count+'" id="valeur_chiffre_'+count+'">'+
            '</td>'+
            '</tr>';
        list.insertAdjacentHTML('beforebegin',newLine);
        let newObj = {};
        data.push(newObj);
    })

    function setData(key,element){
        //key = key != 0 ? parseInt(key)-1 : key;
        if(element.value === ""){
            data.splice(key, 1);
        } else {
            data[key].text = element.value;
            document.getElementById('chiffres').value = JSON.stringify(data);
        }

    }

    function setValue(key,element){
        //key = key != 0 ? parseInt(key)-1 : key;
        data[key].value = element.value;
        document.getElementById('chiffres').value = JSON.stringify(data);
    }
</script>