<?php
$number = $config = ((array)json_decode(file_get_contents("./data/config.json")))['qiwiNumber'];
return printf( json_encode(['code'=>1,'number'=>$number]) );