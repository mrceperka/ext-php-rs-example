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

echo sprintf('Used: %s MB', memory_get_peak_usage() / 1024 / 1024) . \PHP_EOL;