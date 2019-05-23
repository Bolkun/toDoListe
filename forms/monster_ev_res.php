<?php
require '../class/monster.php';
require '../class/db.php';

session_start();

$monster = new Monster();
$monster->setEv();
