<?php

class Monster
{
    private $iM_ID;
    private $sMName;
    private $sMOwner;
    private $sMDate;
    private $sMImage;
    private $iISlot;        /*0-пустой 1-надет*/
    private $iIID;          /*item ID*/
    private $iLvl;          /*Уровень*/
    private $iHp;           /*Cтат xп*/
    private $iA;            /*Стат атаки*/
    private $iD;            /*Стат защиты*/
    private $iS;            /*Стат скорости*/
    private $iSa;           /*Стат сп. атаки*/
    private $iSd;           /*Стат сп. защиты*/
    private $iHpEv;	        /*EV xп*/
    private $iAEv;		    /*EV атаки*/
    private $iDEv;  	    /*EV защиты*/
    private $iSEv; 	        /*EV скорости*/
    private $iSaEv; 	    /*EV сп. атаки*/
    private $iSdEv; 	    /*EV сп. защиты*/
    private $iHpG;	        /*Ген xп*/
    private $iAG;	        /*Ген атаки*/
    private $iDG; 	        /*Ген защиты*/
    private $iSG; 	        /*Ген скорости*/
    private $iSaG;          /*Ген сп. атаки*/
    private $iSdG;          /*Ген сп. защиты*/
    private $iEv;		    /*Очки ЕВ*/
    private $iCHp;
    private $iCA;
    private $iCD;
    private $iCS;
    private $iCSa;
    private $iCSd;
    private $iExp; 	        /*Опыт*/
    private $iExpUp;	    /*Опыт до следущего уровня*/
    private $iHar;          /*Характер*/
    private $sA1;		    /*Атака название и.т.д.*/
    private $sA2;
    private $sA3;
    private $sA4;
    private $iA1Pp;	        /*current A PP*/
    private $iA2Pp;
    private $iA3Pp;
    private $iA4Pp;
    private $iStart;	    /*0-не стартовий 1 -стартовый*/
    private $iAktiv;        /*0 not in team 1 in team*/
    private $iHpCount;
    private $iACount;
    private $iDCount;
    private $iSCount;
    private $iSaCount;
    private $iSdCount;

    public function __construct()
    {
        $this->sMOwner = $_SESSION["sNickName"];
    }

    public function getMOwner()
    {
        echo $this->sMOwner;
    }

    public function loadMonsters()
    {
        $aAktivMonstersProperties = $this->getAktivMonstersProperties($this->sMOwner);
        $iCountAktivMonster = $this->getAnzAktivMonster();

        if($iCountAktivMonster == 0){
            echo "No active Monsters!";
        } else {
            $this->calcStats($iCountAktivMonster, $aAktivMonstersProperties);
        }

        $this->setStartMonster($iCountAktivMonster, $aAktivMonstersProperties);

        // if changed start need  $start[0] = 1;
        $aAktivMonstersProperties = $this->getAktivMonstersProperties($this->sMOwner);

        //print_r($aAktivMonstersProperties);
    }

    public function getAktivMonstersProperties($sMOwner)
    {
        $oDb = new Db();
        $aAktivMonstersProperties = $oDb->selectAktivMonsters($sMOwner);
        return $aAktivMonstersProperties;
    }

    public function getAnzAktivMonster()
    {
        $oDb = new Db();
        $iCountAktivMonster = $oDb->countAktivMonster($this->sMOwner);
        return $iCountAktivMonster;
    }

    public function loadAtackListProperties($sAtackName)
    {
        $oDb = new Db();
        $aAtackListProperties = $oDb->selectAtackListProperties($sAtackName);
        return $aAtackListProperties;
    }

    public function setStartMonster($iCountAktivMonster, $aAktivMonstersProperties)
    {
        if ($iCountAktivMonster >= 1) {
            //if no start! Set first monster start
            $bStartExist = false;
            for ($i = 0; $i < $iCountAktivMonster; $i++) {
                if ($aAktivMonstersProperties[$i]['Start'] == 1) {
                    $bStartExist = true;
                    break;
                }
            }
            if ($bStartExist == false) {
                $oDb = new Db();
                $oDb->updateStartMonster($aAktivMonstersProperties[0]['M_ID']);
            }
        }
    }

    public function calcStats($iCountAktivMonster, $aAktivMonstersProperties)
    {
        for ($a = 0; $a < $iCountAktivMonster; $a++) {
            //(((BaseStat * 2 + GenHP + (EV_HP/2) ) * Level/100 ) + 10 + Level)
            $aStatHp[$a] = (int)(($aAktivMonstersProperties[$a]['Hpe'] * 2 + $aAktivMonstersProperties[$a]['HpG'] + ($aAktivMonstersProperties[$a]['HpEv'] / 2)) * $aAktivMonstersProperties[$a]['Lvl'] / 100 + 10 + $aAktivMonstersProperties[$a]['Lvl']);
            //(((BaseStat * 2 + Gen + (EV/2) ) * Level/100 ) + 5)
            $aStatA[$a] = (int)(((($aAktivMonstersProperties[$a]['Atk'] * 2 + $aAktivMonstersProperties[$a]['AG'] + ($aAktivMonstersProperties[$a]['AEv'] / 2)) * $aAktivMonstersProperties[$a]['Lvl'] / 100) + 5) * $aAktivMonstersProperties[$a]['Hatk']);
            $aStatD[$a] = (int)(((($aAktivMonstersProperties[$a]['Def'] * 2 + $aAktivMonstersProperties[$a]['DG'] + ($aAktivMonstersProperties[$a]['DEv'] / 2)) * $aAktivMonstersProperties[$a]['Lvl'] / 100) + 5) * $aAktivMonstersProperties[$a]['Hdef']);
            $aStatS[$a] = (int)(((($aAktivMonstersProperties[$a]['Spd'] * 2 + $aAktivMonstersProperties[$a]['SG'] + ($aAktivMonstersProperties[$a]['SEv'] / 2)) * $aAktivMonstersProperties[$a]['Lvl'] / 100) + 5) * $aAktivMonstersProperties[$a]['Hspeed']);
            $aStatSa[$a] = (int)(((($aAktivMonstersProperties[$a]['Sp_A'] * 2 + $aAktivMonstersProperties[$a]['SaG'] + ($aAktivMonstersProperties[$a]['SaEv'] / 2)) * $aAktivMonstersProperties[$a]['Lvl'] / 100) + 5) * $aAktivMonstersProperties[$a]['Hsatk']);
            $aStatSd[$a] = (int)(((($aAktivMonstersProperties[$a]['Sp_D'] * 2 + $aAktivMonstersProperties[$a]['SdG'] + ($aAktivMonstersProperties[$a]['SdEv'] / 2)) * $aAktivMonstersProperties[$a]['Lvl'] / 100) + 5) * $aAktivMonstersProperties[$a]['Hsdef']);
            $aEv[$a] = 3 * ($aAktivMonstersProperties[$a]['Lvl'] - 1) + 99;    //297+99=396 на 100lvl
            $aEv[$a] = $aEv[$a] - $aAktivMonstersProperties[$a]['HpEv'] - $aAktivMonstersProperties[$a]['AEv'] - $aAktivMonstersProperties[$a]['DEv'] - $aAktivMonstersProperties[$a]['SEv'] - $aAktivMonstersProperties[$a]['SaEv'] - $aAktivMonstersProperties[$a]['SdEv'];

            $oDb = new Db();
            $oDb->updateMonsterStats($aStatHp[$a], $aStatA[$a], $aStatD[$a], $aStatS[$a], $aStatSa[$a], $aStatSd[$a], $aEv[$a], $aAktivMonstersProperties[$a]['M_ID']);
        }
    }

    public function jsonEncodeChangeContent()
    {
        $aAktivMonstersProperties = $this->getAktivMonstersProperties($this->sMOwner);
        $iCountAktivMonster = $this->getAnzAktivMonster();
        $aJSON = [];

        for($i=0; $i<$iCountAktivMonster; $i++){
            $ar[$i] = array($aAktivMonstersProperties[$i]['M_ID'], $aAktivMonstersProperties[$i]['MOwner'], $aAktivMonstersProperties[$i]['MImage'], $aAktivMonstersProperties[$i]['Lvl'], $aAktivMonstersProperties[$i]['Hp'], $aAktivMonstersProperties[$i]['A'],
                $aAktivMonstersProperties[$i]['D'], $aAktivMonstersProperties[$i]['S'], $aAktivMonstersProperties[$i]['Sa'], $aAktivMonstersProperties[$i]['Sd'], $aAktivMonstersProperties[$i]['HpEv'], $aAktivMonstersProperties[$i]['AEv'], $aAktivMonstersProperties[$i]['DEv'],
                $aAktivMonstersProperties[$i]['SEv'], $aAktivMonstersProperties[$i]['SaEv'], $aAktivMonstersProperties[$i]['SdEv'], $aAktivMonstersProperties[$i]['Ev'], $aAktivMonstersProperties[$i]['HpG'], $aAktivMonstersProperties[$i]['AG'], $aAktivMonstersProperties[$i]['DG'],
                $aAktivMonstersProperties[$i]['SG'], $aAktivMonstersProperties[$i]['SaG'], $aAktivMonstersProperties[$i]['SdG'], $aAktivMonstersProperties[$i]['Exp'], $aAktivMonstersProperties[$i]['ExpUp'], $aAktivMonstersProperties[$i]['A1'], $aAktivMonstersProperties[$i]['A2'],
                $aAktivMonstersProperties[$i]['A3'], $aAktivMonstersProperties[$i]['A4'], $aAktivMonstersProperties[$i]['Start'], $aAktivMonstersProperties[$i]['ML_ID'], $aAktivMonstersProperties[$i]['Type1'], $aAktivMonstersProperties[$i]['Type2'], $aAktivMonstersProperties[$i]['ExpGroup'],
                $aAktivMonstersProperties[$i]['Hatk'], $aAktivMonstersProperties[$i]['Hdef'], $aAktivMonstersProperties[$i]['Hspeed'], $aAktivMonstersProperties[$i]['Hsatk'], $aAktivMonstersProperties[$i]['Hsdef'], $iCountAktivMonster);
            $aJSON[$i] = json_encode($ar[$i]);
        }

        return $aJSON;
    }

    public function jsonEncodeStartMonster($aMonsterProperties, $iCountAktivMonster, $iNewStartM_ID)
    {
        for($i=0; $i<$iCountAktivMonster; $i++){
            if($aMonsterProperties[$i]['Start'] == 1){
                $iOldStartM_ID = $aMonsterProperties[$i]['M_ID'];	//old start to be changed for new start
                break;
            } else {
                $iOldStartM_ID = "0";
            }
        }
        $aStart = array($iNewStartM_ID, $iOldStartM_ID);
        $aJSON = json_encode($aStart);
        return $aJSON;
    }

    public function jsonEncodeAllEv($iM_ID, $sStatNameEv, $iAmount)
    {
        $aStat = array($iM_ID, $sStatNameEv, $iAmount);
        $aJSON = json_encode($aStat);
        return $aJSON;
    }

    public function setStart()
    {
        if (isset($_POST['m_id']) && isset($_POST['start'])) {
            $iNewStartM_ID = $_POST['m_id'];
            $iOldStartM_ID = $_POST['start'];

            $oDb = new Db();
            $oDb->updateStartMonster($iNewStartM_ID, $iOldStartM_ID);
        } else {
            header('Location: ../login_error.html');
        }
    }

    public function setEv()
    {
        if (isset($_POST['m_id']) && isset($_POST['stat']) && isset($_POST['amount'])) {
            $iM_ID = $_POST['m_id'];
            $sStatName = $_POST['stat'];
            $iAmount = $_POST['amount'];

            $oDb = new Db();
            $oDb->updateEvMonster($iM_ID, $sStatName, $iAmount);
        } else {
            header('Location: ../login_error.html');
        }
    }

    public function progressHp($iCHp, $iStatHp)
    {
        return ($iCHp * 100) / $iStatHp;
    }

    public function progressExp($iExp, $iExpUp)
    {
        return ($iExp * 100) / $iExpUp;
    }

}
