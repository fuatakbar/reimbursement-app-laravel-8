<?php

$targetFolder = __DIR__.'/../laravel/storage/app/public';
$linkFolder = __DIR__.'/storage';
symlink($targetFolder,$linkFolder);

echo 'Sukses Boy!';