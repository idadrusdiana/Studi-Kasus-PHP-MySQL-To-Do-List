<?php

namespace Helper {
    class InputHelper
    {
        static function input(string $info): string
        {
            echo "$info : ";
            $result = fgets(STDIN); //supaya bisa menginputkan data lewat terminal (Standard Input)
            return trim($result);
        }
    }
}