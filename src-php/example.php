<?php

var_dump(example_ext_pass_callback(function(...$args){
    var_dump($args);
}));

var_dump(example_ext_threads());

var_dump(example_ext_set_kv("key1", "value2"));
var_dump(example_ext_get_kv_all());

for($i = 0; $i < 100; $i++) {
    example_ext_set_kv("key$i", $i);
}

var_dump(example_ext_get_kv_all());

$callbackSharedData = [];
$callbacks = [];
$callbacks[] = function() use (&$callbackSharedData) {
    echo "sleeping callback 1s" . \PHP_EOL;
    $callbackSharedData['1s'] = '1s value';
    sleep(1);
};
$callbacks[] = function() use (&$callbackSharedData) {
    echo "sleeping callback 2s" . \PHP_EOL;
    $callbackSharedData['2s'] = '2s value';
    sleep(2);
};
$callbacks[] = function() use (&$callbackSharedData) {
    $callbackSharedData['some'] = 'some value';
};
example_ext_pass_array_of_callbacks($callbacks);
var_dump($callbackSharedData);

echo sprintf('Used: %s MB', memory_get_peak_usage() / 1024 / 1024) . \PHP_EOL;