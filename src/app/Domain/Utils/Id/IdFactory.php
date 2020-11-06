<?php


namespace App\Domain\Utils\Id;


use App\Domain\Utils\Id\Id;

interface IdFactory
{
    public function generateId(): Id;
}
