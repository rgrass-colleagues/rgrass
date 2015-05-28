<?php
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis->set('key', 'hello world');
echo $redis->get('key');
?>
