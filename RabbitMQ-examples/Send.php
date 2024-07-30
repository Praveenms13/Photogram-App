<?php

require __DIR__ . '/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('rabbitmq.selfmade.ninja', 5672, 'praveenphotogram', '@,', 'mspraveenkumar77_photogram');
$channel = $connection->channel();

$channel->queue_declare('HomeSted-2', false, false, false, false);
while(1) {
    $random_no = random_int(1000, 9999);
    $message = $random_no;
    $msg = new AMQPMessage($message);
    $channel->basic_publish($msg, '', 'HomeSted-2');
    echo " [x] $message Sent\n";
    usleep(10000);
}
$channel->close();
$connection->close();
 