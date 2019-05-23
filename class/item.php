<?php

class Item
{
    private $sItemOwner;
    private $iAnzUserItems;

    public function __construct()
    {
        $this->sItemOwner = $_SESSION["sNickName"];
    }

    public function getAnzUserItems()
    {
        return $this->iAnzUserItems;
    }

    public function getItemImage($iIID)
    {
        $oDb = new Db();
        $aRows = $oDb->selectItemImage($iIID);
        return $aRows[0]['ItemImage'];
    }

    public function jsonEncodeIID($iIID)
    {
        $ar = array($iIID);
        $sJSON = json_encode($ar[0]);
        return $sJSON;
    }

    public function jsonEncodeUserItems($aItemProperties)
    {
        $ar = array($aItemProperties['ItemGoal'], $aItemProperties['ItemName'], $aItemProperties['ItemAmount'], $aItemProperties['ItemDescription'], $aItemProperties['ItemImage'], $aItemProperties['IT_ID']);
        $ar[2] = number_format($aItemProperties['ItemAmount'], 0);
        $aJSON = json_encode($ar);

        return $aJSON;
    }

    public function loadItems()
    {
        $oDb = new Db();
        $aUserItems = $oDb->selectUserItems($this->sItemOwner);
        $this->iAnzUserItems = count($aUserItems);
        return $aUserItems;
    }

    public function setItem()
    {
        if (isset($_POST['item_id']) && isset($_POST['mon_id'])) {
            $iIT_ID = $_POST['item_id'];
            $iM_ID = $_POST['mon_id'];

            $oDb = new Db();
            $oDb->updateItemPosition($iIT_ID);
            $oDb->updateMonsterItemSlot($iM_ID, $iIT_ID);

        } else {
            header('Location: ../login_error.html');
        }
    }

    public function takeOffItem()
    {
        if (isset($_POST['item_id'])) {
            $iIT_ID = $_POST['item_id'];

            $oDb = new Db();
            $oDb->updateItemStatus($iIT_ID);

        } else {
            header('Location: ../login_error.html');
        }
    }
}