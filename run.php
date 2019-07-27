<?php

require 'vendor/autoload.php';

use Src\Praser;

echo (Praser::getInstance($_POST))->decode();
