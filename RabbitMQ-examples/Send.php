<?php

require __DIR__ . '/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('rabbitmq.selfmade.ninja', 5672, '', '', '');
$channel = $connection->channel();

$channel->queue_declare('HomeSted-2', false, false, false, false);
$message = "Hii man how are you 😆 ";
$msg = new AMQPMessage($message);
$channel->basic_publish($msg, '', 'HomeSted-2');

echo " [x] $message Sent\n";

$channel->close();
$connection->close();
