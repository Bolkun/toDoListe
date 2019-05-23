<?php

require_once('message.php');

class Db
{
    private $sHost = 'localhost';
    private $sUser = 'root';
    private $sPass = '';
    private $sName = 'cmo';

    /*
    protected $sHost = 'localhost';
    protected $sUser = 'serhiybolkun_cmo';
    protected $sPass = '325500';
    protected $sName = 'serhiybolkun_cmo';
    */

    public function selectUserData($sNickName, $sPass)
    {
        $pdo = $this->connection();
        try {
            $stmt = $pdo->query("SELECT * FROM user WHERE NickName='$sNickName' AND Pass='$sPass'");
            $aRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $oMessage = new Message();
            $oMessage->selectUserDataFailed($e->getMessage());
        }
        $pdo = null;
        return $aRows;
    }

    public function connection()
    {
        try {
            $pdo = new PDO("mysql:host=$this->sHost;dbname=$this->sName", $this->sUser, $this->sPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch (PDOException $e) {
            $oMessage = new Message();
            $oMessage->dBConnectionFailed($e->getMessage());
        }
        return $pdo;
    }

    public function updateSessionID($iRandVal, $sNickName)
    {
        $pdo = $this->connection();
        try {
            $sql = "UPDATE user SET SessionID=?, Online=? WHERE NickName=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$iRandVal, 1, $sNickName]);
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
        $pdo = null;
    }

    public function nickNameExist($sNickName)
    {
        $pdo = $this->connection();
        try {
            $stmt = $pdo->query("SELECT NickName FROM user WHERE NickName='$sNickName'");
            $aRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $oMessage = new Message();
            $oMessage->selectUserDataFailed($e->getMessage());
        }
        $pdo = null;
        if (!empty($aRows)) return true;
        return false;
    }

    public function insertRegForm($aRegFormData)
    {
        $pdo = $this->connection();
        try {
            $sql = "INSERT INTO user (NickName, Pass, Gender, Birthday, Email, CharacterBirthDay, Avatar) VALUES (?, ?, ?, ?, ?, ?, ?, Now())";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$aRegFormData[0], $aRegFormData[1], $aRegFormData[2], $aRegFormData[3], $aRegFormData[4], $aRegFormData[5], $aRegFormData[6]]);
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
        // give monsters and money
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();
            $pdo->exec("INSERT INTO monster (MName, MOwner, MImage, Lvl, Aktiv) VALUES ('Shalki', '$aRegFormData[0]', '7.png', 100, 1)");
            $pdo->exec("INSERT INTO monster (MName, MOwner, MImage, Lvl, Aktiv) VALUES ('Goron', '$aRegFormData[0]', '8.png', 100, 1)");
            $pdo->exec("INSERT INTO monster (MName, MOwner, MImage, Lvl, Aktiv) VALUES ('Elzikutor', '$aRegFormData[0]', '9.png', 100, 1)");
            $pdo->exec("INSERT INTO monster (MName, MOwner, MImage, Lvl, Aktiv) VALUES ('Leafoil', '$aRegFormData[0]', '10.png', 100, 1)");
            $pdo->exec("INSERT INTO monster (MName, MOwner, MImage, Lvl, Aktiv) VALUES ('Kokotyk', '$aRegFormData[0]', '5.png', 100, 1)");
            $pdo->exec("INSERT INTO monster (MName, MOwner, MImage, Lvl, Aktiv) VALUES ('Flejmaro', '$aRegFormData[0]', '6.png', 100, 1)");
            $pdo->exec("INSERT INTO item (IT_ID, IL_ID, ItemOwner, ItemPosition, ItemAmount) VALUES('', 1, '$aRegFormData[0]', 0, 1000)");
            $pdo->commit();
        } catch (PDOException $e) {
            $pdo->rollback();
            echo "Error: " . $e->getMessage();
        }
        $pdo = null;
    }

    public function selectProfileData($sNickName)
    {
        $pdo = $this->connection();
        try {
            $stmt = $pdo->query("SELECT * FROM user WHERE NickName='$sNickName'");
            $aRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $oMessage = new Message();
            $oMessage->selectUserDataFailed($e->getMessage());
        }
        $pdo = null;
        return $aRows;
    }

    public function countAktivMonster($sNickName)
    {
        $pdo = $this->connection();

        $stmt = $pdo->prepare("SELECT * FROM monster WHERE MOwner = ? AND Aktiv = ?");
        $stmt->execute(array($sNickName, 1));
        $countAktivMonster = $stmt->rowCount();

        $pdo = null;
        return $countAktivMonster;
    }

    public function countAliveMonster($sNickName)
    {
        $pdo = $this->connection();

        $stmt = $pdo->prepare("SELECT * FROM monster WHERE MOwner = ? AND CHP > ? AND Aktiv = ?");
        $stmt->execute(array($sNickName, 0, 1));
        $countAliveMonster = $stmt->rowCount();

        $pdo = null;
        return $countAliveMonster;
    }

    public function countMonsterCollection($sNickName)
    {
        $pdo = $this->connection();

        $stmt = $pdo->prepare("SELECT DISTINCT MName FROM monster WHERE MOwner = ?");
        $stmt->execute(array($sNickName));
        $countMonsterCollection = $stmt->rowCount();

        $pdo = null;
        return $countMonsterCollection;
    }

    public function countTotalMonsterCollection()
    {
        $pdo = $this->connection();

        $stmt = $pdo->prepare("SELECT * FROM monster_list");
        $stmt->execute();
        $countTotalMonsterCollection = $stmt->rowCount();

        $pdo = null;
        return $countTotalMonsterCollection;
    }

    public function updateUserAbout($sNickName, $text)
    {
        $pdo = $this->connection();
        try {
            $sql = "UPDATE user SET About = ? WHERE NickName = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$text, $sNickName]);
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
        $pdo = null;
    }

    public function userLogout($sNickName)
    {
        $pdo = $this->connection();
        try {
            $sql = "UPDATE user SET Online=? WHERE NickName=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([0, $sNickName]);
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
        $pdo = null;
    }

    public function selectAktivMonsters($sNickName)
    {
        $pdo = $this->connection();
        try {
            $stmt = $pdo->query("SELECT m.M_ID, m.MName, m.MOwner, m.MImage, m.ISlot, m.IID, m.Lvl, m.Hp, m.A, m.D, m.S, m.Sa, m.Sd, m.HpEv, m.AEv, m.DEv, m.SEv, m.SaEv, m.SdEv, 
                                           m.HpG, m.AG, m.DG, m.SG, m.SaG, m.SdG, m.Ev, m.CHp, m.Exp, m.ExpUp, m.A1, m.A2, m.A3, m.A4, m.A1Pp, m.A2Pp, m.A3Pp,m.A4Pp, m.Start, m.Aktiv, 
                                           ml.ML_ID, ml.Type1, ml.Type2, ml.ExpGroup, ml.Hpe, ml.Atk, ml.Def, ml.Spd, ml.Sp_A, ml.Sp_D, 
                                           h.Hatk, h.Hdef, h.Hspeed, h.Hsatk, h.Hsdef	
						                   FROM monster m INNER JOIN monster_list ml ON ml.Name = m.MName INNER JOIN har h ON m.Har = h.Har_ID
						                   WHERE MOwner='$sNickName' AND Aktiv='1' ORDER BY M_ID "); //1 2 20 300
            $aRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "<br>" . $e->getMessage();
        }
        $pdo = null;
        return $aRows;
    }

    public function selectAtackListProperties($sAtackName)
    {
        $pdo = $this->connection();
        try {
            $stmt = $pdo->query("SELECT Pp, `Type`, Category FROM atack_list WHERE `Name`='$sAtackName'");
            $aRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "<br>" . $e->getMessage();
        }
        $pdo = null;
        return $aRows;
    }

    public function updateMonsterStats($iStatHp, $iStatA, $iStatD, $iStatS, $iStatSa, $iStatSd, $iEv, $iM_ID)
    {
        $pdo = $this->connection();
        try {
            $sql = "UPDATE monster SET Hp = ?, A = ?, D = ?, S = ?, Sa = ?, Sd = ?, Ev = ? WHERE M_ID = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$iStatHp, $iStatA, $iStatD, $iStatS, $iStatSa, $iStatSd, $iEv, $iM_ID]);
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
        $pdo = null;
    }

    public function updateStartMonster($iNewStartM_ID, $iOldStartM_ID = "0")
    {
        $pdo = $this->connection();
        if ($iOldStartM_ID == "0") {
            try {
                $sql = "UPDATE monster SET Start = ? WHERE M_ID = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([1, $iNewStartM_ID]);
            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
        } else {
            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->beginTransaction();
                $pdo->exec("UPDATE monster SET Start = 1 WHERE M_ID = '$iNewStartM_ID'");
                $pdo->exec("UPDATE monster SET Start = 0 WHERE M_ID = '$iOldStartM_ID'");
                $pdo->commit();
            } catch (PDOException $e) {
                $pdo->rollback();
                echo "Error: " . $e->getMessage();
            }
        }
        $pdo = null;
    }

    public function updateEvMonster($iM_ID, $sStatName, $iAmount)
    {
        $pdo = $this->connection();
        try {
            $sql = "UPDATE monster SET $sStatName=$sStatName+$iAmount, Ev=Ev-$iAmount WHERE M_ID = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$iM_ID]);
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
        $pdo = null;
    }

    public function selectItemImage($iIID)
    {
        $pdo = $this->connection();
        try {
            $stmt = $pdo->query("SELECT ItemImage FROM item_list WHERE IL_ID='$iIID'");
            $aRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $pdo = null;
        return $aRows;
    }

    public function selectUserItems($sItemOwner)
    {
        $pdo = $this->connection();
        try {
            $stmt = $pdo->query("SELECT i.IT_ID, i.ItemAmount, il.ItemName, il.ItemImage, il.ItemGoal, il.ItemValue, il.ItemDescription 
						  FROM item i INNER JOIN item_list il ON il.IL_ID=i.IL_ID
						  WHERE ItemOwner='$sItemOwner' AND ItemPosition='0'");
            $aRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $pdo = null;
        return $aRows;
    }

    public function updateItemPosition($iIT_ID)
    {
        $pdo = $this->connection();
        try {
            $sql = "UPDATE item SET ItemPosition='1' WHERE IT_ID = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$iIT_ID]);
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
        $pdo = null;
    }

    public function updateMonsterItemSlot($iM_ID, $iIT_ID)
    {
        $pdo = $this->connection();
        try {
            $stmt = $pdo->query("SELECT ISlot, IID FROM monster WHERE M_ID='$iM_ID'");
            $aRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        if ($aRows[0]['ISlot'] == 0) {    //nothing on(not NULL!!!)
            try {
                $sql = "UPDATE monster SET ISlot='1', IID = ? WHERE M_ID = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$iIT_ID, $iM_ID]);
            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
        } else {
            $iIIDMonsterWearing = $aRows[0]['IID'];
            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->beginTransaction();
                $pdo->exec("UPDATE item SET ItemPosition='0' WHERE IT_ID = '$iIIDMonsterWearing'");
                $pdo->exec("UPDATE monster SET IID='$iIT_ID' WHERE M_ID='$iM_ID'");
                $pdo->commit();
            } catch (PDOException $e) {
                $pdo->rollback();
                echo "Error: " . $e->getMessage();
            }
        }
        $pdo = null;
    }

    public function updateItemStatus($iIT_ID)
    {
        $pdo = $this->connection();
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->beginTransaction();
            $pdo->exec("UPDATE item SET ItemPosition='0' WHERE IT_ID = '$iIT_ID'");
            $pdo->exec("UPDATE monster SET ISlot='0', IID='0' WHERE IID='$iIT_ID'");
            $pdo->commit();
        } catch (PDOException $e) {
            $pdo->rollback();
            echo "Error: " . $e->getMessage();
        }
        $pdo = null;
    }
}