<?php

// can recieve message for frontend in web stomp plugin
/**
 * 1. To study about web stomp plugin
 * 2. To study about web rooting key
 * 3. To study about web binding key
 *
 * 4. To work with work queau
 */

require __DIR__ . '/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('rabbitmq.selfmade.ninja', 5672, 'praveenphotogram', '@,', 'mspraveenkumar77_photogram');
$channel = $connection->channel();

$channel->queue_declare('HomeSted-2', false, false, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";
$callback = function ($msg) {
    // print_r($msg);
    echo ' [x] Received ', $msg->body, "\n";
};

$channel->basic_consume('HomeSted-2', '', false, true, false, false, $callback);

while ($channel->is_open()) {
    $channel->wait();
}
