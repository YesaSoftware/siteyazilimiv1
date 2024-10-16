<?php
if (preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) {
    die("No direct script access allowed");
    exit();
}
$helperdir = __DIR__ . "/helper";
if ($dh = opendir($helperdir)) {

    while ($file = readdir($dh)) {

        if (is_file($helperdir . "/" . $file)) {

            require $helperdir . "/" . $file;
        }
    }
}
