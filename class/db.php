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
        } catch(PDOException $e) {
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
        } catch(PDOException $e) {
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

}