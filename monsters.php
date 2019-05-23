<?php
require 'class/monster.php';
require 'class/item.php';

$monster = new Monster();
$item = new Item();
?>

<div id="monster_content">
    <h4 style='margin-top: -17px;'>Monsters</h4>
    <hr style='margin-top: -5px; border-top: 1px solid black;'>
    <?php

    $monster->loadMonsters();
    $aMonsterProperties = $monster->getAktivMonstersProperties($_SESSION['sNickName']);
    $aJsvar = $monster->jsonEncodeChangeContent();

    ?>
    <table id="monsters">
        <?php for ($i = 0; $i < $monster->getAnzAktivMonster(); $i++) {
            if ($i == 0 || $i == 3) {
                echo '<tr>';
            }
            ?>
            <td>
                <div id="<?php echo 'monster_td' . $i; ?>">
                    <?php if ($aMonsterProperties[$i]['Start'] == 1) { ?>
                        <div id='<?php echo 'start' . $i; ?>' style='border-radius: 3px; font-weight: bold; background-color: rgb(92, 184, 92);'>
                            <p>#<?php echo $aMonsterProperties[$i]['ML_ID'] . ' ' . $aMonsterProperties[$i]['MName'] . ' ' . $aMonsterProperties[$i]['Lvl'] . '-lvl' ; ?></p>
                        </div>
                    <?php } else { ?>
                        <div id='<?php echo 'start' . $i; ?>'>
                            <p>#<?php echo $aMonsterProperties[$i]['ML_ID'] . ' ' . $aMonsterProperties[$i]['MName'] . ' ' . $aMonsterProperties[$i]['Lvl'] . '-lvl' ; ?></p>
                        </div>
                    <?php
                    }
                    ?>
                    <img class='image' src='img/monster/<?php echo $aMonsterProperties[$i]['MImage']; ?>'
                         onclick='<?php echo 'ChangeContent' . $i; ?>(<?php echo $aJsvar[$i]; ?>)'>
                    <?php if ($aMonsterProperties[$i]['ISlot'] == 1) { ?>
                        <img class='i_image'
                             src='img/item/<?php echo $item->getItemImage($aMonsterProperties[$i]['IID']); ?>'
                             onclick='takeOffItem(<?php echo $item->jsonEncodeIID($aMonsterProperties[$i]['IID']) ?>)'>
                    <?php } ?>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" role="progressbar"
                             aria-valuenow="<?php echo $aMonsterProperties[$i]['CHp']; ?>"
                             aria-valuemin="0" aria-valuemax="<?php echo $aMonsterProperties[$i]['Hp']; ?>"
                             style="width:<?php echo $monster->progressHp($aMonsterProperties[$i]['CHp'], $aMonsterProperties[$i]['Hp']); ?>%">
                            <?php echo $aMonsterProperties[$i]['CHp']; ?>
                        </div>
                    </div>
                    <div class="progress" style="margin-top: -18px" ;>
                        <div class="progress-bar progress-bar-info" role="progressbar"
                             aria-valuenow="<?php echo $aMonsterProperties[$i]['Exp']; ?>"
                             aria-valuemin="0" aria-valuemax="<?php echo $aMonsterProperties[$i]['ExpUp']; ?>"
                             style="width:<?php if ($aMonsterProperties[$i]['Lvl'] < 100) {
                                 echo $monster->progressExp($aMonsterProperties[$i]['Exp'], $aMonsterProperties[$i]['ExpUp']);
                             } else {
                                 echo "1000";
                             } ?>%">
                            <?php echo $aMonsterProperties[$i]['Exp']; ?>
                        </div>
                    </div>
                </div>
            </td>
            <?php
            if ($i == 2 || $i == 5) {
                echo '</tr>';
            }
        } ?>
    </table>
    <?php
    for ($i = 0; $i < $monster->getAnzAktivMonster(); $i++) {
    ?>
    <div id="<?php echo 'div' . $i; ?>" style="display:none">
        <div id="<?php echo 'tabs' . $i; ?>" <?php if($monster->getAnzAktivMonster() <= 3){ echo "style='margin:-10px -20px;'"; }?>>
            <div id="<?php echo 'menu' . $i; ?>">
                <img style='cursor: pointer;' src='img/interface/info.png' onclick='showInfo(<?php echo $i; ?>)'>
                <img style='cursor: pointer;' src='img/interface/stats.png' onclick='showStats(<?php echo $i; ?>)'>
                <img style='cursor: pointer;' src='img/interface/atacks.png' onclick='showAtacks(<?php echo $i; ?>)'>
            </div>
            <div id="<?php echo 'contents' . $i; ?>">
                <div id="<?php echo 'info' . $i; ?>" style="display:none">
                    <?php if($aMonsterProperties[$i]['Type2']>0){ ?>
                        <p class='types'>Type:
                            <img src="img/type/<?php echo $aMonsterProperties[$i]['Type1'] . '.png'; ?>">
                            <img src="img/type/<?php echo $aMonsterProperties[$i]['Type2'] . '.png'; ?>">
                        </p>
                    <?php } else { ?>
                        <p class='types'>Type:
                            <img src="img/type/<?php echo $aMonsterProperties[$i]['Type1'] . '.png'; ?>">
                        </p>
                    <?php }
                    if($aMonsterProperties[$i]['Start'] != 1){ ?>
                        <form method='POST' action='javascript:void(null);' onsubmit='ajax_make_start(<?php echo $monster->jsonEncodeStartMonster($aMonsterProperties, $monster->getAnzAktivMonster(), $aMonsterProperties[$i]['M_ID']); ?>)'>
                            <input class='btn btn-info start' type='submit' value='First Pick'>
                        </form>
                    <?php } ?>
                    <p class="gens">
                        Gens: HP<?php echo $aMonsterProperties[$i]['HpG'];?>
                              A<?php echo $aMonsterProperties[$i]['AG'];?>
                              D<?php echo $aMonsterProperties[$i]['DG'];?>
                              S<?php echo $aMonsterProperties[$i]['SG'];?>
                              SA<?php echo $aMonsterProperties[$i]['SaG'];?>
                              SD<?php echo $aMonsterProperties[$i]['SdG'];?>
                    </p>
                </div>
                <div id="<?php echo 'stats' . $i; ?>">
                    <table id='<?php echo 'stats_table' . $i; ?>'>
                        <tr>
                            <td>HP: </td>
                            <td><div><?php echo $aMonsterProperties[$i]['Hp']; ?></div></td>
                            <td><div><progress class='hp_progress' style='width: 126px;' value='<?php echo $aMonsterProperties[$i]['HpEv']; ?>' max='126'></progress></div></td>
                            <td>
                                <form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo $monster->jsonEncodeAllEv($aMonsterProperties[$i]['M_ID'], "HpEv", 1); ?>)'>
                                    <?php
                                    if($aMonsterProperties[$i]['Ev']> 0 && $aMonsterProperties[$i]['HpEv'] < 126){
                                        ?>
                                        <input class="btn btn-info pluses_stats" type='submit' value='+1'/>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </td>
                            <td>
                                <form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo $monster->jsonEncodeAllEv($aMonsterProperties[$i]['M_ID'], "HpEv", 10); ?>)'>
                                    <?php
                                    if($aMonsterProperties[$i]['Ev'] && $aMonsterProperties[$i]['HpEv'] <= 116){
                                        ?>
                                        <input class="btn btn-info pluses_stats" type='submit' value='+10'/>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </td>
                            <td>
                                <form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo $monster->jsonEncodeAllEv($aMonsterProperties[$i]['M_ID'], "HpEv", 100); ?>)'>
                                    <?php
                                    if($aMonsterProperties[$i]['Ev'] >= 100 && $aMonsterProperties[$i]['HpEv'] <= 26){
                                        ?>
                                        <input class="btn btn-info pluses_stats" type='submit' value='+100'/>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>A: </td>
                            <td><div><?php echo $aMonsterProperties[$i]['A']; ?></div></td>
                            <td><div><progress class='a_progress' style='width: 126px;' value='<?php echo $aMonsterProperties[$i]['AEv']; ?>' max='126'></progress></div></td>
                            <td>
                                <form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo $monster->jsonEncodeAllEv($aMonsterProperties[$i]['M_ID'], "AEv", 1); ?>)'>
                                    <?php
                                    if($aMonsterProperties[$i]['Ev'] > 0 && $aMonsterProperties[$i]['AEv'] < 126){
                                        ?>
                                        <input class="btn btn-info pluses_stats" type='submit' value='+1'/>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </td>
                            <td>
                                <form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo $monster->jsonEncodeAllEv($aMonsterProperties[$i]['M_ID'], "AEv", 10); ?>)'>
                                    <?php
                                    if($aMonsterProperties[$i]['Ev'] >= 10 && $aMonsterProperties[$i]['AEv'] <= 116){
                                        ?>
                                        <input class="btn btn-info pluses_stats" type='submit' value='+10'/>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </td>
                            <td>
                                <form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo $monster->jsonEncodeAllEv($aMonsterProperties[$i]['M_ID'], "AEv", 100); ?>)'>
                                    <?php
                                    if($aMonsterProperties[$i]['Ev'] >= 100 && $aMonsterProperties[$i]['AEv'] <= 26){
                                        ?>
                                        <input class="btn btn-info pluses_stats" type='submit' value='+100'/>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>D: </td>
                            <td><div><?php echo $aMonsterProperties[$i]['D']; ?></div></td>
                            <td><div><progress class='d_progress' style='width: 126px;' value='<?php echo $aMonsterProperties[$i]['DEv']; ?>' max='126'></progress></div></td>
                            <td>
                                <form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo $monster->jsonEncodeAllEv($aMonsterProperties[$i]['M_ID'], "DEv", 1); ?>)'>
                                    <?php
                                    if($aMonsterProperties[$i]['Ev'] > 0 && $aMonsterProperties[$i]['DEv'] < 126){
                                        ?>
                                        <input class="btn btn-info pluses_stats" type='submit' value='+1'/>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </td>
                            <td>
                                <form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo $monster->jsonEncodeAllEv($aMonsterProperties[$i]['M_ID'], "DEv", 10); ?>)'>
                                    <?php
                                    if($aMonsterProperties[$i]['Ev'] >= 10 && $aMonsterProperties[$i]['DEv'] <= 116){
                                        ?>
                                        <input class="btn btn-info pluses_stats" type='submit' value='+10'/>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </td>
                            <td>
                                <form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo $monster->jsonEncodeAllEv($aMonsterProperties[$i]['M_ID'], "DEv", 100); ?>)'>
                                    <?php
                                    if($aMonsterProperties[$i]['Ev'] >= 100 && $aMonsterProperties[$i]['DEv'] <= 26){
                                        ?>
                                        <input class="btn btn-info pluses_stats" type='submit' value='+100'/>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>S: </td>
                            <td><div><?php echo $aMonsterProperties[$i]['S']; ?></div></td>
                            <td><div><progress class='s_progress' style='width: 126px;' value='<?php echo $aMonsterProperties[$i]['SEv']; ?>' max='126'></progress></div></td>
                            <td>
                                <form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo $monster->jsonEncodeAllEv($aMonsterProperties[$i]['M_ID'], "SEv", 1); ?>)'>
                                    <?php
                                    if($aMonsterProperties[$i]['Ev'] > 0 && $aMonsterProperties[$i]['SEv'] < 126){
                                        ?>
                                        <input class="btn btn-info pluses_stats" type='submit' value='+1'/>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </td>
                            <td>
                                <form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo $monster->jsonEncodeAllEv($aMonsterProperties[$i]['M_ID'], "SEv", 10); ?>)'>
                                    <?php
                                    if($aMonsterProperties[$i]['Ev'] >= 10 && $aMonsterProperties[$i]['SEv'] <= 116){
                                        ?>
                                        <input class="btn btn-info pluses_stats" type='submit' value='+10'/>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </td>
                            <td>
                                <form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo $monster->jsonEncodeAllEv($aMonsterProperties[$i]['M_ID'], "SEv", 100); ?>)'>
                                    <?php
                                    if($aMonsterProperties[$i]['Ev'] >= 100 && $aMonsterProperties[$i]['SEv'] <= 26){
                                        ?>
                                        <input class="btn btn-info pluses_stats" type='submit' value='+100'/>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>SA: </td>
                            <td><div><?php echo $aMonsterProperties[$i]['Sa']; ?></div></td>
                            <td><div><progress class='sa_progress' style='width: 126px;' value='<?php echo $aMonsterProperties[$i]['SaEv']; ?>' max='126'></progress></div></td>
                            <td>
                                <form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo $monster->jsonEncodeAllEv($aMonsterProperties[$i]['M_ID'], "SaEv", 1); ?>)'>
                                    <?php
                                    if($aMonsterProperties[$i]['Ev'] > 0 && $aMonsterProperties[$i]['SaEv'] < 126){
                                        ?>
                                        <input class="btn btn-info pluses_stats" type='submit' value='+1'/>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </td>
                            <td>
                                <form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo $monster->jsonEncodeAllEv($aMonsterProperties[$i]['M_ID'], "SaEv", 10); ?>)'>
                                    <?php
                                    if($aMonsterProperties[$i]['Ev'] >= 10 && $aMonsterProperties[$i]['SaEv'] <= 116){
                                        ?>
                                        <input class="btn btn-info pluses_stats" type='submit' value='+10'/>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </td>
                            <td>
                                <form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo $monster->jsonEncodeAllEv($aMonsterProperties[$i]['M_ID'], "SaEv", 100); ?>)'>
                                    <?php
                                    if($aMonsterProperties[$i]['Ev'] >= 100 && $aMonsterProperties[$i]['SaEv'] <= 26){
                                        ?>
                                        <input class="btn btn-info pluses_stats" type='submit' value='+100'/>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>SD: </td>
                            <td><div><?php echo $aMonsterProperties[$i]['Sd']; ?></div></td>
                            <td><div><progress class='sd_progress' style='width: 126px;' value='<?php echo $aMonsterProperties[$i]['SdEv']; ?>' max='126'></progress></div></td>
                            <td>
                                <form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo $monster->jsonEncodeAllEv($aMonsterProperties[$i]['M_ID'], "SdEv", 1); ?>)'>
                                    <?php
                                    if($aMonsterProperties[$i]['Ev'] > 0 && $aMonsterProperties[$i]['SdEv'] < 126){
                                        ?>
                                        <input class="btn btn-info pluses_stats" type='submit' value='+1'/>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </td>
                            <td>
                                <form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo $monster->jsonEncodeAllEv($aMonsterProperties[$i]['M_ID'], "SdEv", 10); ?>)'>
                                    <?php
                                    if($aMonsterProperties[$i]['Ev'] >= 10 && $aMonsterProperties[$i]['SdEv'] <= 116){
                                        ?>
                                        <input class="btn btn-info pluses_stats" type='submit' value='+10'/>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </td>
                            <td>
                                <form method='POST' action='javascript:void(null);' onsubmit='ajax_send_monster_ev(<?php echo $monster->jsonEncodeAllEv($aMonsterProperties[$i]['M_ID'], "SdEv", 100); ?>)'>
                                    <?php
                                    if($aMonsterProperties[$i]['Ev'] >= 100 && $aMonsterProperties[$i]['SdEv'] <= 26){
                                        ?>
                                        <input class="btn btn-info pluses_stats" type='submit' value='+100'/>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </td>
                        </tr>
                    </table>
                    <h2 class="ev">
                        <div id='result_ev'>
                            <strong>EV: <?php echo $aMonsterProperties[$i]['Ev']; ?></strong>
                        </div>
                    </h2>
                </div>
                <div id="<?php echo 'atacks' . $i; ?>" style="display:none">
                    <?php
                    $aAtackList1 = $monster->loadAtackListProperties($aMonsterProperties[$i]['A1']);
                    $aAtackList2 = $monster->loadAtackListProperties($aMonsterProperties[$i]['A2']);
                    $aAtackList3 = $monster->loadAtackListProperties($aMonsterProperties[$i]['A3']);
                    $aAtackList4 = $monster->loadAtackListProperties($aMonsterProperties[$i]['A4']);
                    ?>
                    <table id='<?php echo 'atack_list' . $i; ?>'>
                        <tr>
                            <td><img class='atack_type' src='img/type/<?php echo $aAtackList1[0]['Type'] . '.png'; ?>'></td>
                            <td>
                                <div <?php if($aAtackList1[0]['Category'] == 1) echo "style='color: red;'";  if($aAtackList1[0]['Category'] == 2) echo"style='color: blue;'";?>>
                                    <?php echo $aMonsterProperties[$i]['A1']; ?>
                                </div>
                                <?php echo $aMonsterProperties[$i]['A1Pp'] .'/'. $aAtackList1[0]['Pp']; ?>
                            </td>
                            <td><img class='atack_type' src='img/type/<?php echo $aAtackList2[0]['Type'] . '.png'; ?>'></td>
                            <td>
                                <div <?php if($aAtackList2[0]['Category'] == 1) echo "style='color: red;'"; if($aAtackList2[0]['Category'] == 2) echo"style='color: blue;'";?>>
                                    <?php echo $aMonsterProperties[$i]['A2']; ?>
                                </div>
                                <?php echo $aMonsterProperties[$i]['A2Pp'] .'/'. $aAtackList2[0]['Pp']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><img class='atack_type' src='img/type/<?php echo $aAtackList3[0]['Type'] . '.png'; ?>'></td>
                            <td>
                                <div <?php if($aAtackList3[0]['Category'] == 1) echo "style='color: red;'"; if($aAtackList3[0]['Category'] == 2) echo"style='color: blue;'";?>>
                                    <?php echo $aMonsterProperties[$i]['A3']; ?>
                                </div>
                                <?php echo $aMonsterProperties[$i]['A3Pp'] .'/'. $aAtackList3[0]['Pp']; ?>
                            </td>
                            <td><img class='atack_type' src='img/type/<?php echo $aAtackList4[0]['Type'] . '.png'; ?>'></td>
                            <td>
                                <div <?php if($aAtackList4[0]['Category'] == 1) echo "style='color: red;'"; if($aAtackList4[0]['Category'] == 2) echo"style='color: blue;'";?>>
                                    <?php echo $aMonsterProperties[$i]['A4']; ?>
                                </div>
                                <?php echo $aMonsterProperties[$i]['A4Pp'] .'/'. $aAtackList4[0]['Pp']; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</div>
