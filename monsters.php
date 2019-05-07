<?php
require 'class/monster.php';

$monster = new Monster();
?>
<div id="monster_content">
    <h4 style='margin-top: -17px;'>Monsters</h4>
    <hr style='margin-top: -5px; border-top: 1px solid black;'>
    <?php

    $aNickName = $_COOKIE['CMO_NICK_NAME'];

    //db_connect
    include 'db_connect/db.php';

    $query = "SELECT m.M_ID, m.M_Name, m.M_Owner, m.M_Image, m.I_Slot, m.I_ID, m.Lvl, m.Hp_Ev, m.A_Ev, m.D_Ev, m.S_Ev, m.Sa_Ev, m.Sd_Ev, m.Hp_G, m.A_G, m.D_G, m.S_G, m.Sa_G, m.Sd_G, m.Ev, m.C_Hp, m.Exp, m.Exp_Up, m.A1, m.A2, m.A3, m.A4, m.A1_Pp, m.A2_Pp, m.A3_Pp, m.A4_Pp, m.Start, m.Aktiv,
						ml.M_ID_L, ml.Type1, ml.Type2, ml.Exp_Group, ml.Hp, ml.Atk, ml.Def, ml.Spd, ml.Sp_A, ml.Sp_D, h.Hatk, h.Hdef, h.Hspeed, h.Hsatk, h.Hsdef	
						FROM monsters m INNER JOIN monster_list ml ON ml.Name = m.M_Name INNER JOIN har h ON m.Har = h.Har_ID
						WHERE M_Owner='$aNickName' AND Aktiv='1' ORDER BY M_ID ";    //1 2 20 300
    $result = mysql_query($query) or die("Query failed : " . mysql_error());
    while ($aRow = mysql_fetch_array($result)) {
        $m_id[] = $aRow["M_ID"];
        $m_name[] = $aRow["M_Name"];
        $m_owner[] = $aRow["M_Owner"];
        $m_image[] = $aRow["M_Image"];
        $i_slot[] = $aRow["I_Slot"];
        $i_id[] = $aRow["I_ID"];
        $m_lvl[] = $aRow["Lvl"];
        $hp_ev[] = $aRow["Hp_Ev"];
        $a_ev[] = $aRow["A_Ev"];
        $d_ev[] = $aRow["D_Ev"];
        $s_ev[] = $aRow["S_Ev"];
        $sa_ev[] = $aRow["Sa_Ev"];
        $sd_ev[] = $aRow["Sd_Ev"];
        $hp_g[] = $aRow["Hp_G"];
        $a_g[] = $aRow["A_G"];
        $d_g[] = $aRow["D_G"];
        $s_g[] = $aRow["S_G"];
        $sa_g[] = $aRow["Sa_G"];
        $sd_g[] = $aRow["Sd_G"];
        $ev[] = $aRow["Ev"];
        $c_hp[] = $aRow["C_Hp"];
        $exp[] = $aRow["Exp"];
        $exp_up[] = $aRow["Exp_Up"];
        //$har[] = $aRow["Har"];   //надо выщитать
        $a1[] = $aRow["A1"];
        $a2[] = $aRow["A2"];
        $a3[] = $aRow["A3"];
        $a4[] = $aRow["A4"];
        $a1_pp[] = $aRow["A1_Pp"];
        $a2_pp[] = $aRow["A2_Pp"];
        $a3_pp[] = $aRow["A3_Pp"];
        $a4_pp[] = $aRow["A4_Pp"];
        $start[] = $aRow["Start"];
        $aktiv[] = $aRow["Aktiv"];
        $ml_id[] = $aRow["M_ID_L"];
        $type1[] = $aRow["Type1"];
        $type2[] = $aRow["Type2"];
        $exp_group[] = $aRow["Exp_Group"];
        $hp_base[] = $aRow["Hp"];
        $a_base[] = $aRow["Atk"];
        $d_base[] = $aRow["Def"];
        $s_base[] = $aRow["Spd"];
        $sa_base[] = $aRow["Sp_A"];
        $sd_base[] = $aRow["Sp_D"];
        $h_a[] = $aRow["Hatk"];
        $h_d[] = $aRow["Hdef"];
        $h_s[] = $aRow["Hspeed"];
        $h_sa[] = $aRow["Hsatk"];
        $h_sd[] = $aRow["Hsdef"];
    }
    if (mysql_num_rows($result) == 0) { //no aktiv monsters(NULL)
        $anz_aktiv_monsters = 0;
        echo "No active Monsters!";
    } else {
        $anz_aktiv_monsters = count($aktiv);

        //calculate stats and update mysql
        for ($a = 0; $a < $anz_aktiv_monsters; $a++) {
            //(((BaseStat * 2 + GenHP + (EV_HP/2) ) * Level/100 ) + 10 + Level)
            $stat_hp[$a] = (int)(($hp_base[$a] * 2 + $hp_g[$a] + ($hp_ev[$a] / 2)) * $m_lvl[$a] / 100 + 10 + $m_lvl[$a]);
            //(((BaseStat * 2 + Gen + (EV/2) ) * Level/100 ) + 5)
            $stat_a[$a] = (int)(((($a_base[$a] * 2 + $a_g[$a] + ($a_ev[$a] / 2)) * $m_lvl[$a] / 100) + 5) * $h_a[$a]);
            $stat_d[$a] = (int)(((($d_base[$a] * 2 + $d_g[$a] + ($d_ev[$a] / 2)) * $m_lvl[$a] / 100) + 5) * $h_d[$a]);
            $stat_s[$a] = (int)(((($s_base[$a] * 2 + $s_g[$a] + ($s_ev[$a] / 2)) * $m_lvl[$a] / 100) + 5) * $h_s[$a]);
            $stat_sa[$a] = (int)(((($sa_base[$a] * 2 + $sa_g[$a] + ($sa_ev[$a] / 2)) * $m_lvl[$a] / 100) + 5) * $h_sa[$a]);
            $stat_sd[$a] = (int)(((($sd_base[$a] * 2 + $sd_g[$a] + ($sd_ev[$a] / 2)) * $m_lvl[$a] / 100) + 5) * $h_sd[$a]);
            $ev[$a] = 3 * ($m_lvl[$a] - 1) + 99;    //297+99=396 на 100lvl
            $ev[$a] = $ev[$a] - $hp_ev[$a] - $a_ev[$a] - $d_ev[$a] - $s_ev[$a] - $sa_ev[$a] - $sd_ev[$a];
            //Проверка на одинаковые стати !!!
            $sql_stats[$a] = mysql_query("UPDATE monsters SET Hp='$stat_hp[$a]', A='$stat_a[$a]', D='$stat_d[$a]', S='$stat_s[$a]', Sa='$stat_sa[$a]', Sd='$stat_sd[$a]' WHERE M_ID = '$m_id[$a]'");
            $sql_ev[$a] = mysql_query("UPDATE monsters SET Ev='$ev[$a]' WHERE M_ID = '$m_id[$a]'");
        }
    }

    mysql_free_result($result);

    if ($anz_aktiv_monsters >= 1) {
        //if no start set first monster start
        $startIsPresent = false;
        for ($b = 0; $b < $anz_aktiv_monsters; $b++) {
            if ($start[$b] == 1) {
                $startIsPresent = true;
                break;
            }
        }
        if ($startIsPresent == false) {
            mysql_query("UPDATE monsters SET Start='1' WHERE M_ID = '$m_id[0]'");
            $start[0] = 1;
        }
        //end
        $ar[0] = array($m_id[0], $m_name[0], $m_owner[0], $m_image[0], $m_lvl[0], $stat_hp[0], $stat_a[0], $stat_d[0], $stat_s[0], $stat_sa[0], $stat_sd[0], $hp_ev[0], $a_ev[0], $d_ev[0], $s_ev[0], $sa_ev[0], $sd_ev[0], $ev[0], $hp_g[0], $a_g[0], $d_g[0], $s_g[0], $sa_g[0], $sd_g[0], $exp[0], $exp_up[0], $a1[0], $a2[0], $a3[0], $a4[0], $start[0], $ml_id[0], $type1[0], $type2[0], $exp_group[0], $h_a[0], $h_d[0], $h_s[0], $h_sa[0], $h_sd[0], $anz_aktiv_monsters);
        $jsvar0 = json_encode($ar[0]);
    }
    if ($anz_aktiv_monsters >= 2) {
        $ar[1] = array($m_id[1], $m_name[1], $m_owner[1], $m_image[1], $m_lvl[1], $stat_hp[1], $stat_a[1], $stat_d[1], $stat_s[1], $stat_sa[1], $stat_sd[1], $hp_ev[1], $a_ev[1], $d_ev[1], $s_ev[1], $sa_ev[1], $sd_ev[1], $ev[1], $hp_g[1], $a_g[1], $d_g[1], $s_g[1], $sa_g[1], $sd_g[1], $exp[1], $exp_up[1], $a1[1], $a2[1], $a3[1], $a4[1], $start[1], $ml_id[1], $type1[1], $type2[1], $exp_group[1], $h_a[1], $h_d[1], $h_s[1], $h_sa[1], $h_sd[1], $anz_aktiv_monsters);
        $jsvar1 = json_encode($ar[1]);
    }
    if ($anz_aktiv_monsters >= 3) {
        $ar[2] = array($m_id[2], $m_name[2], $m_owner[2], $m_image[2], $m_lvl[2], $stat_hp[2], $stat_a[2], $stat_d[2], $stat_s[2], $stat_sa[2], $stat_sd[2], $hp_ev[2], $a_ev[2], $d_ev[2], $s_ev[2], $sa_ev[2], $sd_ev[2], $ev[2], $hp_g[2], $a_g[2], $d_g[2], $s_g[2], $sa_g[2], $sd_g[2], $exp[2], $exp_up[2], $a1[2], $a2[2], $a3[2], $a4[2], $start[2], $ml_id[2], $type1[2], $type2[2], $exp_group[2], $h_a[2], $h_d[2], $h_s[2], $h_sa[2], $h_sd[2], $anz_aktiv_monsters);
        $jsvar2 = json_encode($ar[2]);
    }
    if ($anz_aktiv_monsters >= 4) {
        $ar[3] = array($m_id[3], $m_name[3], $m_owner[3], $m_image[3], $m_lvl[3], $stat_hp[3], $stat_a[3], $stat_d[3], $stat_s[3], $stat_sa[3], $stat_sd[3], $hp_ev[3], $a_ev[3], $d_ev[3], $s_ev[3], $sa_ev[3], $sd_ev[3], $ev[3], $hp_g[3], $a_g[3], $d_g[3], $s_g[3], $sa_g[3], $sd_g[3], $exp[3], $exp_up[3], $a1[3], $a2[3], $a3[3], $a4[3], $start[3], $ml_id[3], $type1[3], $type2[3], $exp_group[3], $h_a[3], $h_d[3], $h_s[3], $h_sa[3], $h_sd[3], $anz_aktiv_monsters);
        $jsvar3 = json_encode($ar[3]);
    }
    if ($anz_aktiv_monsters >= 5) {
        $ar[4] = array($m_id[4], $m_name[4], $m_owner[4], $m_image[4], $m_lvl[4], $stat_hp[4], $stat_a[4], $stat_d[4], $stat_s[4], $stat_sa[4], $stat_sd[4], $hp_ev[4], $a_ev[4], $d_ev[4], $s_ev[4], $sa_ev[4], $sd_ev[4], $ev[4], $hp_g[4], $a_g[4], $d_g[4], $s_g[4], $sa_g[4], $sd_g[4], $exp[4], $exp_up[4], $a1[4], $a2[4], $a3[4], $a4[4], $start[4], $ml_id[4], $type1[4], $type2[4], $exp_group[4], $h_a[4], $h_d[4], $h_s[4], $h_sa[4], $h_sd[4], $anz_aktiv_monsters);
        $jsvar4 = json_encode($ar[4]);
    }
    if ($anz_aktiv_monsters == 6) {
        $ar[5] = array($m_id[5], $m_name[5], $m_owner[5], $m_image[5], $m_lvl[5], $stat_hp[5], $stat_a[5], $stat_d[5], $stat_s[5], $stat_sa[5], $stat_sd[5], $hp_ev[5], $a_ev[5], $d_ev[5], $s_ev[5], $sa_ev[5], $sd_ev[5], $ev[5], $hp_g[5], $a_g[5], $d_g[5], $s_g[5], $sa_g[5], $sd_g[5], $exp[5], $exp_up[5], $a1[5], $a2[5], $a3[5], $a4[5], $start[5], $ml_id[5], $type1[5], $type2[5], $exp_group[5], $h_a[5], $h_d[5], $h_s[5], $h_sa[5], $h_sd[5], $anz_aktiv_monsters);
        $jsvar5 = json_encode($ar[5]);
    }
    ?>
    <table id="monsters">
        <tr>
            <!-- Monster 0 -->
            <?php
            if ($anz_aktiv_monsters >= 1) {
                ?>
                <td>
                    <div id="monster_td0">
                        <?php
                        if ($start[0] == 1) {
                            echo "<div id='start0' style='border-radius: 3px; font-weight: bold; background-color: rgb(92, 184, 92);'><p>#$ml_id[0] $m_name[0] $m_lvl[0]-lvl</p></div>";
                        } else {
                            echo "<div id='start0'><p>#$ml_id[0] $m_name[0] $m_lvl[0]-lvl</p></div>";
                        }
                        ?>
                        <img class='image' src='img_monsters/<?php echo "$m_image[0]"; ?>'
                             onclick='ChangeContent0(<?php echo "$jsvar0"; ?>)'>
                        <?php
                        if ($i_slot[0] == 1) {
                            $query = "SELECT ItemImage FROM items_list WHERE IL_ID='$i_id[0]'";
                            $result = mysql_query($query) or die("Query failed : " . mysql_error());
                            while ($aRow = mysql_fetch_array($result)) {
                                $i_image0[] = $aRow["ItemImage"];
                            }
                            mysql_free_result($result);

                            $i_array0 = array($i_id[0]);
                            $js_item0 = json_encode($i_array0[0]);
                            ?>
                            <img class='i_image' src='img_items/<?php echo "$i_image0[0]"; ?>'
                                 onclick='takeOffItem(<?php echo "$js_item0"; ?>)'>
                            <?php
                        }
                        ?>
                        <?php
                        $progress_hp0 = ($c_hp[0] * 100) / $stat_hp[0];
                        $progress_exp0 = ($exp[0] * 100) / $exp_up[0];
                        ?>

                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar"
                                 aria-valuenow="<?php echo "$c_hp[0]"; ?>"
                                 aria-valuemin="0" aria-valuemax="<?php echo "$stat_hp[0]"; ?>"
                                 style="width:<?php echo "$progress_hp0"; ?>%">
                                <?php echo "$c_hp[0]"; ?>
                            </div>
                        </div>
                        <div class="progress" style="margin-top: -18px" ;>
                            <div class="progress-bar progress-bar-info" role="progressbar"
                                 aria-valuenow="<?php echo "$exp[0]"; ?>"
                                 aria-valuemin="0" aria-valuemax="<?php echo "$exp_up[0]"; ?>"
                                 style="width:<?php if ($m_lvl[0] < 100) {
                                     echo "$progress_exp0";
                                 } else {
                                     echo "1000";
                                 } ?>%">
                                <?php echo "$exp[0]"; ?>
                            </div>
                        </div>
                    </div>
                </td>
                <?php
            }
            ?>
            <!-- Monster 1 -->
            <?php
            if ($anz_aktiv_monsters >= 2) {
                ?>
                <td>
                    <div id="monster_td1">
                        <?php
                        if ($start[1] == 1) {
                            echo "<div id='start1' style='border-radius: 3px; font-weight: bold; background-color: rgb(92, 184, 92);'><p>#$ml_id[1] $m_name[1] $m_lvl[1]-lvl</p></div>";
                        } else {
                            echo "<div id='start1'><p>#$ml_id[1] $m_name[1] $m_lvl[1]-lvl</p></div>";
                        }
                        ?>
                        <img class='image' src='img_monsters/<?php echo "$m_image[1]"; ?>'
                             onclick='ChangeContent1(<?php echo "$jsvar1"; ?>)'>
                        <?php
                        if ($i_slot[1] == 1) {
                            $query = "SELECT ItemImage FROM items_list WHERE IL_ID='$i_id[1]'";
                            $result = mysql_query($query) or die("Query failed : " . mysql_error());
                            while ($aRow = mysql_fetch_array($result)) {
                                $i_image1[] = $aRow["ItemImage"];
                            }
                            mysql_free_result($result);

                            $i_array1 = array($i_id[1]);
                            $js_item1 = json_encode($i_array1[0]);
                            ?>
                            <img class='i_image' src='img_items/<?php echo "$i_image1[0]"; ?>'
                                 onclick='takeOffItem(<?php echo "$js_item1"; ?>)'>
                            <?php
                        }
                        ?>
                        <?php
                        $progress_hp1 = ($c_hp[1] * 100) / $stat_hp[1];
                        $progress_exp1 = ($exp[1] * 100) / $exp_up[1];
                        ?>

                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar"
                                 aria-valuenow="<?php echo "$c_hp[1]"; ?>"
                                 aria-valuemin="0" aria-valuemax="<?php echo "$stat_hp[1]"; ?>"
                                 style="width:<?php echo "$progress_hp1"; ?>%">
                                <?php echo "$c_hp[1]"; ?>
                            </div>
                        </div>
                        <div class="progress" style="margin-top: -18px" ;>
                            <div class="progress-bar progress-bar-info" role="progressbar"
                                 aria-valuenow="<?php echo "$exp[1]"; ?>"
                                 aria-valuemin="0" aria-valuemax="<?php echo "$exp_up[1]"; ?>"
                                 style="width:<?php if ($m_lvl[1] < 100) {
                                     echo "$progress_exp1";
                                 } else {
                                     echo "1000";
                                 } ?>%">
                                <?php echo "$exp[1]"; ?>
                            </div>
                        </div>
                    </div>
                </td>
                <?php
            }
            ?>
            <!-- Monster 2 -->
            <?php
            if ($anz_aktiv_monsters >= 3) {
                ?>
                <td>
                    <div id="monster_td2">
                        <?php
                        if ($start[2] == 1) {
                            echo "<div id='start2' style='border-radius: 3px; font-weight: bold; background-color: rgb(92, 184, 92);'><p>#$ml_id[2] $m_name[2] $m_lvl[2]-lvl</p></div>";
                        } else {
                            echo "<div id='start2'><p>#$ml_id[2] $m_name[2] $m_lvl[2]-lvl</p></div>";
                        }
                        ?>
                        <img class='image' src='img_monsters/<?php echo "$m_image[2]"; ?>'
                             onclick='ChangeContent2(<?php echo "$jsvar2"; ?>)'>
                        <?php
                        if ($i_slot[2] == 1) {
                            $query = "SELECT ItemImage FROM items_list WHERE IL_ID='$i_id[2]'";
                            $result = mysql_query($query) or die("Query failed : " . mysql_error());
                            while ($aRow = mysql_fetch_array($result)) {
                                $i_image2[] = $aRow["ItemImage"];
                            }
                            mysql_free_result($result);

                            $i_array2 = array($i_id[2]);
                            $js_item2 = json_encode($i_array2[0]);
                            ?>
                            <img class='i_image' src='img_items/<?php echo "$i_image2[0]"; ?>'
                                 onclick='takeOffItem(<?php echo "$js_item2"; ?>)'>
                            <?php
                        }
                        ?>
                        <?php
                        $progress_hp2 = ($c_hp[2] * 100) / $stat_hp[2];
                        $progress_exp2 = ($exp[2] * 100) / $exp_up[2];
                        ?>

                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar"
                                 aria-valuenow="<?php echo "$c_hp[2]"; ?>"
                                 aria-valuemin="0" aria-valuemax="<?php echo "$stat_hp[2]"; ?>"
                                 style="width:<?php echo "$progress_hp2"; ?>%">
                                <?php echo "$c_hp[2]"; ?>
                            </div>
                        </div>
                        <div class="progress" style="margin-top: -18px" ;>
                            <div class="progress-bar progress-bar-info" role="progressbar"
                                 aria-valuenow="<?php echo "$exp[2]"; ?>"
                                 aria-valuemin="0" aria-valuemax="<?php echo "$exp_up[2]"; ?>"
                                 style="width:<?php if ($m_lvl[2] < 100) {
                                     echo "$progress_exp2";
                                 } else {
                                     echo "1000";
                                 } ?>%">
                                <?php echo "$exp[2]"; ?>
                            </div>
                        </div>
                    </div>
                </td>
                <?php
            }
            ?>
        </tr>
        <tr>
            <!-- Monster 3 -->
            <?php
            if ($anz_aktiv_monsters >= 4) {
                ?>
                <td>
                    <div id="monster_td3">
                        <?php
                        if ($start[3] == 1) {
                            echo "<div id='start3' style='border-radius: 3px; font-weight: bold; background-color: rgb(92, 184, 92);'><p>#$ml_id[3] $m_name[3] $m_lvl[3]-lvl</p></div>";
                        } else {
                            echo "<div id='start3'><p>#$ml_id[3] $m_name[3] $m_lvl[3]-lvl</p></div>";
                        }
                        ?>
                        <img class='image' src='img_monsters/<?php echo "$m_image[3]"; ?>'
                             onclick='ChangeContent3(<?php echo "$jsvar3"; ?>)'>
                        <?php
                        if ($i_slot[3] == 1) {
                            $query = "SELECT ItemImage FROM items_list WHERE IL_ID='$i_id[3]'";
                            $result = mysql_query($query) or die("Query failed : " . mysql_error());
                            while ($aRow = mysql_fetch_array($result)) {
                                $i_image3[] = $aRow["ItemImage"];
                            }
                            mysql_free_result($result);

                            $i_array3 = array($i_id[3]);
                            $js_item3 = json_encode($i_array3[0]);
                            ?>
                            <img class='i_image' src='img_items/<?php echo "$i_image3[0]"; ?>'
                                 onclick='takeOffItem(<?php echo "$js_item3"; ?>)'>
                            <?php
                        }
                        ?>
                        <?php
                        $progress_hp3 = ($c_hp[3] * 100) / $stat_hp[3];
                        $progress_exp3 = ($exp[3] * 100) / $exp_up[3];
                        ?>

                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar"
                                 aria-valuenow="<?php echo "$c_hp[3]"; ?>"
                                 aria-valuemin="0" aria-valuemax="<?php echo "$stat_hp[3]"; ?>"
                                 style="width:<?php echo "$progress_hp3"; ?>%">
                                <?php echo "$c_hp[3]"; ?>
                            </div>
                        </div>
                        <div class="progress" style="margin-top: -18px" ;>
                            <div class="progress-bar progress-bar-info" role="progressbar"
                                 aria-valuenow="<?php echo "$exp[3]"; ?>"
                                 aria-valuemin="0" aria-valuemax="<?php echo "$exp_up[3]"; ?>"
                                 style="width:<?php if ($m_lvl[3] < 100) {
                                     echo "$progress_exp3";
                                 } else {
                                     echo "1000";
                                 } ?>%">
                                <?php echo "$exp[3]"; ?>
                            </div>
                        </div>
                    </div>
                </td>
                <?php
            }
            ?>
            <!-- Monster 4 -->
            <?php
            if ($anz_aktiv_monsters >= 5) {
                ?>
                <td>
                    <div id="monster_td4">
                        <?php
                        if ($start[4] == 1) {
                            echo "<div id='start4' style='border-radius: 3px; font-weight: bold; background-color: rgb(92, 184, 92);'><p>#$ml_id[4] $m_name[4] $m_lvl[4]-lvl</p></div>";
                        } else {
                            echo "<div id='start4'><p>#$ml_id[4] $m_name[4] $m_lvl[4]-lvl</p></div>";
                        }
                        ?>
                        <img class='image' src='img_monsters/<?php echo "$m_image[4]"; ?>'
                             onclick='ChangeContent4(<?php echo "$jsvar4"; ?>)'>
                        <?php
                        if ($i_slot[4] == 1) {
                            $query = "SELECT ItemImage FROM items_list WHERE IL_ID='$i_id[4]'";
                            $result = mysql_query($query) or die("Query failed : " . mysql_error());
                            while ($aRow = mysql_fetch_array($result)) {
                                $i_image4[] = $aRow["ItemImage"];
                            }
                            mysql_free_result($result);

                            $i_array4 = array($i_id[4]);
                            $js_item4 = json_encode($i_array4[0]);
                            ?>
                            <img class='i_image' src='img_items/<?php echo "$i_image4[0]"; ?>'
                                 onclick='takeOffItem(<?php echo "$js_item4"; ?>)'>
                            <?php
                        }
                        ?>
                        <?php
                        $progress_hp4 = ($c_hp[4] * 100) / $stat_hp[4];
                        $progress_exp4 = ($exp[4] * 100) / $exp_up[4];
                        ?>

                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar"
                                 aria-valuenow="<?php echo "$c_hp[4]"; ?>"
                                 aria-valuemin="0" aria-valuemax="<?php echo "$stat_hp[4]"; ?>"
                                 style="width:<?php echo "$progress_hp4"; ?>%">
                                <?php echo "$c_hp[4]"; ?>
                            </div>
                        </div>
                        <div class="progress" style="margin-top: -18px" ;>
                            <div class="progress-bar progress-bar-info" role="progressbar"
                                 aria-valuenow="<?php echo "$exp[4]"; ?>"
                                 aria-valuemin="0" aria-valuemax="<?php echo "$exp_up[4]"; ?>"
                                 style="width:<?php if ($m_lvl[4] < 100) {
                                     echo "$progress_exp4";
                                 } else {
                                     echo "1000";
                                 } ?>%">
                                <?php echo "$exp[4]"; ?>
                            </div>
                        </div>
                    </div>
                </td>
                <?php
            }
            ?>
            <!-- Monster 5 -->
            <?php
            if ($anz_aktiv_monsters == 6) {
                ?>
                <td>
                    <div id="monster_td5">
                        <?php
                        if ($start[5] == 1) {
                            echo "<div id='start5' style='border-radius: 3px; font-weight: bold; background-color: rgb(92, 184, 92);'><p>#$ml_id[5] $m_name[5] $m_lvl[5]-lvl</p></div>";
                        } else {
                            echo "<div id='start5'><p>#$ml_id[5] $m_name[5] $m_lvl[5]-lvl</p></div>";
                        }
                        ?>
                        <img class='image' src='img_monsters/<?php echo "$m_image[5]"; ?>'
                             onclick='ChangeContent5(<?php echo "$jsvar5"; ?>)'>
                        <?php
                        if ($i_slot[5] == 1) {
                            $query = "SELECT ItemImage FROM items_list WHERE IL_ID='$i_id[5]'";
                            $result = mysql_query($query) or die("Query failed : " . mysql_error());
                            while ($aRow = mysql_fetch_array($result)) {
                                $i_image5[] = $aRow["ItemImage"];
                            }
                            mysql_free_result($result);

                            $i_array5 = array($i_id[5]);
                            $js_item5 = json_encode($i_array5[0]);
                            ?>
                            <img class='i_image' src='img_items/<?php echo "$i_image5[0]"; ?>'
                                 onclick='takeOffItem(<?php echo "$js_item5"; ?>)'>
                            <?php
                        }
                        ?>
                        <?php
                        $progress_hp5 = ($c_hp[5] * 100) / $stat_hp[5];
                        $progress_exp5 = ($exp[5] * 100) / $exp_up[5];
                        ?>

                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar"
                                 aria-valuenow="<?php echo "$c_hp[5]"; ?>"
                                 aria-valuemin="0" aria-valuemax="<?php echo "$stat_hp[5]"; ?>"
                                 style="width:<?php echo "$progress_hp5"; ?>%">
                                <?php echo "$c_hp[5]"; ?>
                            </div>
                        </div>
                        <div class="progress" style="margin-top: -18px" ;>
                            <div class="progress-bar progress-bar-info" role="progressbar"
                                 aria-valuenow="<?php echo "$exp[5]"; ?>"
                                 aria-valuemin="0" aria-valuemax="<?php echo "$exp_up[5]"; ?>"
                                 style="width:<?php if ($m_lvl[5] < 100) {
                                     echo "$progress_exp5";
                                 } else {
                                     echo "1000";
                                 } ?>%">
                                <?php echo "$exp[5]"; ?>
                            </div>
                        </div>
                    </div>
                </td>
                <?php
            }
            ?>
        </tr>
    </table>
    <?php
    include 'monster0.php';
    include 'monster1.php';
    include 'monster2.php';
    include 'monster3.php';
    include 'monster4.php';
    include 'monster5.php';
    ?>
</div>
<script>
    function showInfo(id) {
        var i = 'info'.concat(id);
        var s = 'stats'.concat(id);
        var a = 'atacks'.concat(id);
        document.getElementById(i).style.display = "block";
        document.getElementById(s).style.display = "none";
        document.getElementById(a).style.display = "none";
    }

    function showStats(id) {
        var i = 'info'.concat(id);
        var s = 'stats'.concat(id);
        var a = 'atacks'.concat(id);
        document.getElementById(i).style.display = "none";
        document.getElementById(s).style.display = "block";
        document.getElementById(a).style.display = "none";
    }

    function showAtacks(id) {
        var i = 'info'.concat(id);
        var s = 'stats'.concat(id);
        var a = 'atacks'.concat(id);
        document.getElementById(i).style.display = "none";
        document.getElementById(s).style.display = "none";
        document.getElementById(a).style.display = "block";
    }

    function takeOffItem(values) {
        var id = values[0];	//item_id
        $.ajax({
            type: 'POST',
            url: 'forms/item_off.php',
            data: 'item_id=' + id,
            success: function (msg) {
                alert("Item removed successfuly!");
            }
        });
        $('#monster_content').load(document.URL + ' #monster_content');
        $('#item_content').load(document.URL + ' #item_content');
    }

    function ajax_send_monster_ev(values) {/*m_id, Hp_Ev, amount(1,10,100)*/
        $.ajax({
            type: 'POST',
            url: 'forms/monster_ev_res.php',
            data: 'm_id=' + values[0] + '&stat=' + values[1] + '&amount=' + values[2],
            success: function (msg) {

            }
        });
        //m0
        $('#monster_td0').load(document.URL + ' #monster_td0');	//progress bar reload
        $('#tabs0').load(document.URL + ' #tabs0');					//content stats reload
        //m1
        $('#monster_td1').load(document.URL + ' #monster_td1');	//progress bar reload
        $('#tabs1').load(document.URL + ' #tabs1');					//content stats reload
        //m2
        $('#monster_td2').load(document.URL + ' #monster_td2');	//progress bar reload
        $('#tabs2').load(document.URL + ' #tabs2');					//content stats reload
        //m3
        $('#monster_td3').load(document.URL + ' #monster_td3');	//progress bar reload
        $('#tabs3').load(document.URL + ' #tabs3');					//content stats reload
        //m4
        $('#monster_td4').load(document.URL + ' #monster_td4');	//progress bar reload
        $('#tabs4').load(document.URL + ' #tabs4');					//content stats reload
        //m5
        $('#monster_td5').load(document.URL + ' #monster_td5');	//progress bar reload
        $('#tabs5').load(document.URL + ' #tabs5');					//content stats reload

        $('#doctorATable').load(document.URL + ' #doctorATable');
    }

    function ajax_make_start(values) {
        $.ajax({
            type: 'POST',
            url: 'forms/monster_start_res.php',
            data: 'm_id=' + values[0] + '&start=' + values[1],
            success: function (msg) {
                //alert("Your first pick is "+values[0]+"! Old start is "+values[1]);
                alert("Starter Changed!");
            }
        });
        $('#monster_content').load(document.URL + ' #monster_content');
        $('#forest_main').load(document.URL + ' #forest_main');
    }

    function ajax_send_monster_atack() { /*m_id, slot(A1,A2,A3,A4), id(table), radio_name*/
        /*var tableRedraw = values[2];
        var radio_name = values[3];*/

        /*var atack_name = document.getElementsByName(radio_name);
        var atack_value;
        for(var i = 0; i < atack_name.length; i++){
            if(atack_name[i].checked){
                atack_value = atack_name[i].value;
            }
        }*/
        $.ajax({
            type: 'POST',
            url: 'forms/monster_atacks_res.php',
            data: /*'m_id='+values[0]+'&slot='+values[1]*/$('#changeMonster0Atack1').serialize(),
            success: function (response, textStatus, jqXHR) {
                alert("Atack changed successfuly!");
                //location.reload(true);	//refreshes the whole page in browser from server
                //$( "menu.php" ).load(window.location.href + " menu.php" );
            }
        });
        //$('#tabs').load(document.URL +  ' #tabs');
        //$('#monster0_atacks').load(document.URL +  ' #monster0_atacks');
        //$('#'+tableRedraw).load(document.URL +  ' #'+tableRedraw);
        //$('#atacks0').load(document.URL +  ' #atacks0');
        //$('#doctorA').load(document.URL +  ' #doctorA');
        //$('#'+tableRedraw).load(document.URL +  ' #'+tableRedraw);
        $('#pop_m1_a1').load(document.URL + ' #pop_m1_a1');
        $('#atack_list0').load(document.URL + ' #atack_list0');
        //$('#monster_content').load(document.URL +  ' #monster_content');
    }
</script>
