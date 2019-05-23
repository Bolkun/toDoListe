<?php
require '../class/item.php';
require '../class/db.php';

session_start();

$item = new Item();
$item->takeOffItem();
