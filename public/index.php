<?php
require_once __DIR__ . '/../vendor/autoload.php';

use app\config\Config;
use app\libraries\Core;

session_start();

$app = new Core(new Config());
