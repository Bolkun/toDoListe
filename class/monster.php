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

}
