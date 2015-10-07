<?php

namespace Kunstmaan\Fitness;

use CL\Slack\Payload\ChatPostMessagePayload;
use CL\Slack\Transport\ApiClient;

class Fitness
{
    private static $victims   = array('kevin', 'jens', 'bart', 'ruud', 'sam');
    private static $exercises = array('push-ups', 'rondjes van het eiland', 'sit-ups');

    public static function run($apiKey)
    {
        $victim   = self::$victims[array_rand(self::$victims, 1)];
        $exercise = self::$exercises[array_rand(self::$exercises, 1)];
        $number   = rand(1, 20);
        $sentence = sprintf("Fitness : %d %s voor <@%s>", $number, $exercise, $victim);

        $client = new ApiClient($apiKey);
        $payload = new ChatPostMessagePayload();
        $payload->setChannel('#smarties');
        $payload->setIconEmoji('ghost');
        $payload->setText($sentence);
        $client->send($payload);
    }
}

require_once "vendor/autoload.php";
require_once "apikey.php";

$fitness = new Fitness();
$fitness->run(API_KEY);
