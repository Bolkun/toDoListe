<?php

class Message
{
    private $sMessage;

    public function selectUserDataFailed($e)
    {
        echo "Error: " . $e;
    }

    public function dBConnectionSuccess()
    {
        echo "Connection Success!\n";
    }

    public function dBConnectionFailed($e)
    {
        echo 'Connection Failed!' . $e;
    }

    public function loginFailed()
    {
        echo "Your (1)Name or (2)Password is wrong or (3)User user not exist";
    }

    public function regPasswordFailed()
    {
        echo "Passwords not equal! Please try again.";
    }

    public function regNickNameFailed()
    {
        echo "Nickname is already in use! Pick up another one.";
    }
}