<?php

require (__DIR__.'/vendor/autoload.php');
// or require (dirname(__DIR__).'/src/autoloader.php');
use RedisClient\RedisClient;
// Example 1. subscribe
$Redis = new RedisClient([
    'server' => 'redis:6379',
    'timeout' => 1 // for waiting answer infinitely
]);
$Redis->subscribe('channel.name', function($type, $channel, $message) {
    // This function will be called on subscribe and on message
    if ($type === 'subscribe') {
        // Note, if $type === 'subscribe'
        // then $channel = <channel-name>
        // and $message = <count of subsribers>
        echo 'Subscribed to channel <', $channel, '>', PHP_EOL;
    } elseif ($type === 'message') {
        echo 'Message <', $message, '> from channel <', $channel, '>', PHP_EOL;
        if ($message === 'quit') {
            // return <false> for unsubscribe and exit
            return false;
        }
    }
    // return <true> for to wait next message
    return true;
});