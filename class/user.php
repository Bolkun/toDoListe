<?php

require_once('db.php');

class User
{
    private $iID;
    private $sNickName;
    private $sGender;
    private $sPass;
    private $iSessionID;
    private $sEmail;
    private $sBirthday;
    private $sCharacterBirthday;
    private $iOnline;
    private $iIP;
    private $sLocation;
    private $iSlots;
    private $iRang;
    private $sGruppe;
    private $iCollection;
    private $sAbout;
    private $sAvatar;
    private $sClan;
    private $iInBattle;

    public function getNickName()
    {
        echo $this->sNickName;
    }

    public function getAvatar()
    {
        echo $this->sAvatar;
    }

    public function getOnline()
    {
        if ($this->iOnline === 0) echo "offline";
        else echo "online";
    }

    public function getOnlineColor()
    {
        if ($this->iOnline === 0) echo "red";
        else echo "green";
    }

    public function getLocation()
    {
        echo $this->sLocation;
    }
    public function getSlots()
    {
        $oDb = new Db();
        $countAktivMonster = $oDb->countAktivMonster($this->sNickName);
        $monsterAlive = $oDb->countAliveMonster($this->sNickName);

        for ($i = 0; $i < $countAktivMonster; $i++) {
            if ($monsterAlive > 0) {
                echo "<img class='slot' src='img/interface/slot.png'>";
                $monsterAlive--;
            } else {
                echo "<img class='slot' src='img/interface/slot2.png'>";
            }
        }
    }
    public function getGruppe(){
        echo $this->sGruppe;
    }
    public function getMonsterCollection()
    {
        $oDb = new Db();
        $countMonsterCollection = $oDb->countMonsterCollection($this->sNickName);
        echo $countMonsterCollection;
    }
    public function getTotalMonsterCollection()
    {
        $oDb = new Db();
        $countTotalMonsterCollection = $oDb->countTotalMonsterCollection();
        echo $countTotalMonsterCollection;
    }

    public function getCharacterBirthday()
    {
        echo $this->sCharacterBirthday;
    }
    public function getAbout()
    {
        echo $this->sAbout;
    }
    public function setAbout()
    {
        if(!empty($_POST['about_me'])){
            $text = $_POST['about_me'];
            echo "About me: $text";
            $this->sNickName = $_POST['nick_name'];
            $oDb = new Db();
            $oDb->updateUserAbout($this->sNickName, $text);
        }
    }

    public function loginSubmit()
    {
        if (!empty($_POST['nickname']) && !empty($_POST['pass'])) {
            $this->sNickName = $_POST['nickname'];
            $this->sPass = md5($_POST['pass']);

            $oDb = new Db();
            $aRows = $oDb->selectUserData($this->sNickName, $this->sPass);
            if (!empty($aRows)) {
                $this->iSessionID = $this->setSession($oDb, $this->sNickName);
            } else {
                header('Location: login_error.html');
            }
        }
    }

    public function setSession($oDb, $sNickName)
    {
        $iRandVal = rand(0, 1000000000);
        $_SESSION["iID"] = $iRandVal;
        $_SESSION["sNickName"] = $sNickName;
        $oDb->updateSessionID($iRandVal, $sNickName);
        return $iRandVal;
    }

    public function regSubmit()
    {
        if ((!empty($_POST['nickname'])) && (!empty($_POST['pass'])) && (!empty($_POST['pass2'])) && (!empty($_POST['gender'])) && (!empty($_POST['bday'])) && (!empty($_POST['email']))) {
            $sNickName = $_POST['nickname'];
            $sPass = md5($_POST['pass']);
            $sPass2 = md5($_POST['pass2']);
            $this->sGender = $_POST['gender'];
            $this->sBirthday = $_POST['bday'];
            $this->sEmail = $_POST['email'];

            $oDb = new Db();
            if ($oDb->nickNameExist($sNickName)) {
                header('Location: reg.php');
                /*$message = new Message();
                $message->regNickNameFailed();*/
            } else {
                $this->sNickName = $sNickName;
            }

            if ($sPass === $sPass2) {
                $this->sPass = $sPass;
            } else {
                header('Location: reg.php');
                /*$message = new Message();
                $message->regPasswordFailed();*/
            }

            if ($this->sGender === "m") {
                $this->sAvatar = "avatar.png";
            } else {
                $this->sAvatar = "avatar2.png";
            }

            $this->sLocation = "Kyoto City";

            $aRegFormData = array($this->sNickName, $this->sPass, $this->sGender, $this->sBirthday, $this->sEmail, $this->sAvatar, $this->sLocation);

            $oDb->insertRegForm($aRegFormData);
        }
    }

    public function loadMenu()
    {
        if (isset($_SESSION['sNickName'])) {
            $this->sNickName = $_SESSION['sNickName'];
        } else {
            header('Location: index.php');
        }
    }

    public function loadProfile()
    {
        if (isset($_SESSION['sNickName'])) {
            $this->sNickName = $_SESSION['sNickName'];
            $oDb = new Db();
            $aRows = $oDb->selectProfileData($this->sNickName);
            $this->sGender = $aRows[0]['Gender'];
            //$this->sPass = $aRows[0]['Pass'];
            //$this->iSessionID = $aRows[0]['SessionID'];
            //$this->sEmail = $aRows[0]['Email'];
            //$this->sBirthday = $aRows[0]['Birthday'];
            $this->sCharacterBirthday = $aRows[0]['CharacterBirthDay'];
            $this->iOnline = $aRows[0]['Online'];
            //$this->iIP = $aRows[0]['IP'];
            $this->sLocation = $aRows[0]['Location'];
            //$this->iSlots = $aRows[0]['Slots'];
            $this->iRang = $aRows[0]['Rang'];
            $this->sGruppe = $aRows[0]['Gruppe'];
            $this->iCollection = $aRows[0]['Collection'];
            $this->sAbout = $aRows[0]['About'];
            $this->sAvatar = $aRows[0]['Avatar'];
            //$this->sClan = $aRows[0]['Clan'];
            //$this->iInBattle = $aRows[0]['InBattle'];
        } else {
            header('Location: index.php');
        }
    }

    public function exitGame()
    {
        if (!empty($_POST['exit_res_nickname'])) {
            $this->sNickName = $_POST['exit_res_nickname'];
            $oDb = new Db();
            $oDb->userLogout($this->sNickName);
        }
    }

    public function jsonEncodeUser()
    {
        $a = array($_SESSION['sNickName']);
        return json_encode($a[0]);
    }

}
