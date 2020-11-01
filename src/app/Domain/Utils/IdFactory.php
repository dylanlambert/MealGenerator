<?php


namespace App\Domain\Utils;


interface IdFactory
{
    public function generateId(): Id;
}
