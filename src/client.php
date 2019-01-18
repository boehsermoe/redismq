<?php

require (__DIR__ . '/vendor/autoload.php');

use RedisClient\RedisClient;


$Redis = new RedisClient([
    'server' => 'redis:6379',
    'timeout' => 0 // for waiting answer infinitely
]);
$message = (object)["foobar: " . date('Y-m-d H:i:s')];
$Redis->publish('channel.name', serialize($message));