<?php

// phpinfo();

declare(strict_types=1);

use TerribleTools\DirtyDomains\Command;
use TerribleTools\DirtyDomains\CommandFactory;

require __DIR__ . '/../vendor/autoload.php';

// i wonder if this is any better than using $_SERVER['PATH_INFO'] and $_SERVER['QUERY_STRING']
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$commandLine = trim($uri_path, '/');
$command = CommandFactory::createCommand($commandLine);

$results = $command->execute();

http_response_code($results->statusCode);
header('Content-Type: text/javascript; charset=utf-8');
echo json_encode(array( 'result' => $results->payload ));
