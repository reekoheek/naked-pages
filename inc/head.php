<?php

$URI = urldecode($_SERVER['REQUEST_URI']);
$dir = $_SERVER['DOCUMENT_ROOT'].$URI;
$config = include './config/config.php';

function base($uri) {
    return dirname($_SERVER['SCRIPT_NAME']).$uri;
}

function inArray($string, $array = array()) {
    if (empty($array) || empty($string)) return false;
    foreach ($array as $key) {
        if (fnmatch($key, $string)) {
            return true;
        }
    }
    return false;
}

function listing() {
    global $dir;
    global $URI;
    global $config;

    $folderExcludePatterns = $config['folderExcludePatterns'];
    $fileExcludePatterns = $config['fileExcludePatterns'];

    $installDir = $config['installDir'];

    if ($handle = opendir($dir)) {
        $dirs = array();
        $files = array();
        $errors = array();

        if (! fnmatch('*'.$installDir.'*', $URI)) {
            while (false !== ($entry = readdir($handle))) {
                if (is_dir($dir.$entry)) {
                    if ($entry == '.' or inArray($entry, $folderExcludePatterns)) continue;
                    if(($URI == '/' and ($entry == '..' or fnmatch('*'.$installDir.'*', $entry)))) continue;
                    $dirs[] = $entry;
                } else {
                    if (inArray($entry, $fileExcludePatterns)) continue;
                    $files[] = $entry;
                }
            }
        } else {
            $errors[] = 'Where are you going?';
        }

        sort($dirs);
        sort($files);

        if (! empty($errors)) {
            foreach ($errors as $entry) {
                echo '<li><a href="'.$_SERVER['REQUEST_URI'].$entry.'"><i class="fa fa-question-circle"></i> &nbsp;'.$entry.'</a></li>';
            }
            closedir($handle);
            return;
        }

        foreach ($dirs as $entry) {
            echo '<li><a href="'.$_SERVER['REQUEST_URI'].$entry.'"><i class="fa fa-folder"></i> &nbsp;'.$entry.'</a></li>';
        }

        foreach ($files as $entry) {
            echo '<li class="plain"><a href="'.$_SERVER['REQUEST_URI'].$entry.'"><i class="fa fa-file"></i> &nbsp;'.$entry.'</a><br/></li>';
        }

        closedir($handle);
    }
}
