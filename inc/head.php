<?php

$URI = urldecode($_SERVER['REQUEST_URI']);
$dir = $_SERVER['DOCUMENT_ROOT'].$URI;

function base($uri) {
    return dirname($_SERVER['SCRIPT_NAME']).$uri;
}

function listing() {
    global $dir;
    if ($handle = opendir($dir)) {
        $dirs = array();
        $files = array();

        while (false !== ($entry = readdir($handle))) {
            if (is_dir($dir.$entry)) {
                if ($entry == '.') continue;
                $dirs[] = $entry;
            } else {
                $files[] = $entry;
            }
        }

        sort($dirs);
        sort($files);

        foreach ($dirs as $entry) {
            echo '<li class="plain"><a href="'.$_SERVER['REQUEST_URI'].$entry.'">'.$entry.'</a></li>';
        }

        foreach ($files as $entry) {
            echo '<li class="plain"><a href="'.$_SERVER['REQUEST_URI'].$entry.'">'.$entry.'</a><br/></li>';
        }

        closedir($handle);
    }
}