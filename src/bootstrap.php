<?php

use OZA\Database\Events\Emitter;

require_once __DIR__ . DIRECTORY_SEPARATOR . '../vendor/autoload.php';

$emitter = Emitter::instance();

$emitter->on('db.changed', function (PDOStatement $statement) {
//    ob_start();
//    $statement->debugDumpParams();
//    $sql = ob_get_contents();
//    ob_end_clean();
//    $date = date('Y-m-d H:i:s');
//    $content = "[LOG $date] ";
//    $filename = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'db.log';
//    $file = fopen($filename, 'a+');
//    fwrite($file, $content);
//    fwrite($file, $sql);
//    fwrite($file, "\n");
//    fclose($file);
});