<?php
$aItemProperties = $item->loadItems();
?>
<div id="item_content">
    <h4 style='margin-top: -35px;'>Backpack</h4>
    <hr style='margin-top: -5px;border-top: 1px solid black;'>
    <div id="selected">
        <p id="name_value"></p>
        <img id="img" src="img/item/item.png" style="display:none; width: 85px; height: 85px; padding-top: 15px;">
        <p id="amount"></p>
        <p id="desc"></p>
        <p id="i_id"></p>
        <div id="forma" style="display:none">
            <form method='POST' id='item_form' action='javascript:void(null);' onsubmit='ajax_send_item()'>
                <label for='monster_choice'></label>
                <select class="form_control" id='monster_choice'>
                    <?php
                    for ($i = 0; $i < $monster->getAnzAktivMonster(); $i++) {
                        if ($i == 0) {    //selected
                            ?>
                            <option class='select_item' selected value='<?php echo $aMonsterProperties[$i]['M_ID']; ?>'><?php echo $aMonsterProperties[$i]['MName']; ?></option>
                        <?php } else { ?>
                            <option class='select_item' value='<?php echo $aMonsterProperties[$i]['M_ID']; ?>'><?php echo $aMonsterProperties[$i]['MName']; ?></option>
                        <?php }
                    }
                    ?>
                </select>
                <input class="btn btn-info item_use" type='submit' value='Use'>
            </form>
        </div>
    </div>
    <?php if ($item->getAnzUserItems() != 0) { ?>
        <table border='1'>
            <tr>
                <?php
                for ($i = 0; $i < $item->getAnzUserItems(); $i++) { ?>
                    <td style='padding-top: 5px;padding-left: 8px'>
                        <img style='width: 85px; height: 85px; cursor: pointer;' src='img/item/<?php echo $aItemProperties[$i]['ItemImage']; ?>' onclick='changeItemContent(<?php echo $item->jsonEncodeUserItems($aItemProperties[$i]); ?>)'>
                        <p style='margin-top: -1px;color:rgb(51 51 51);'><?php echo $aItemProperties[$i]['ItemAmount']; ?></p>
                    </td>
                <?php
                    if ((($i + 1) % 5) == 0) {
                        echo "</tr>";
                    }
                }
                ?>
        </table>
    <?php } else { echo "Your backpack is empty!"; } ?>
</div>

