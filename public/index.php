<?php

declare(strict_types=1);

use TerribleTools\DirtyDomains\Command;
use TerribleTools\DirtyDomains\CommandResult;

require __DIR__ . '/../vendor/autoload.php';

// i wonder if this is any better than using $_SERVER['PATH_INFO'] and $_SERVER['QUERY_STRING']
list( 'path' => $uri_path, 'query' => $query_string ) = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$commandLine = trim($uri_path, '/');
$command = CommandFactory::createCommand($commandLine);

$results = $command->execute();

http_response_code($results->statusCode);
echo json_encode(array( 'result' => $results->payload ));
