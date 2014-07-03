<?php

$URI = urldecode($_SERVER['REQUEST_URI']);
$dir = $_SERVER['DOCUMENT_ROOT'].$URI;
$config = include './config/config.php';
$units = explode(' ', 'B KB MB GB TB PB');

function base($uri) {
    return dirname($_SERVER['SCRIPT_NAME']).$uri;
}

function dirSize($directory) {
    $size = 0;
    foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file) {
        if($file -> getFileName() != '..') {
            $size+=$file->getSize();
        }
    }
    return $size;
}

function format_size($size) {
    global $units;

    $mod = 1024;

    for ($i = 0; $size > $mod; $i++) {
        $size /= $mod;
    }

    $endIndex = strpos($size, ".")+3;

    return substr( $size, 0, $endIndex).' '.$units[$i];
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
                echo '<li><a href="'.$_SERVER['REQUEST_URI'].$entry.'"><i class="fa fa-question-circle fa-2x"></i> &nbsp;'.$entry.'</a></li>';
            }
            closedir($handle);
            return;
        }

        foreach ($dirs as $entry) {
            $list = '<li>'.
                '<a href="'.$_SERVER['REQUEST_URI'].$entry.'">'.
                    '<i class="fa fa-folder fa-2x"></i> &nbsp;'.
                    '<span class="entry">'.$entry.'</span>';

            if ($config['showSize']) {
                $list .= '&nbsp; <small class="entry">('.format_size(dirSize($dir.$entry)).')</small>';
            }

            $list .= '</a>'.'</li>';

            echo $list;
        }

        foreach ($files as $entry) {
            $exploded = explode('.', $entry);

            switch (end($exploded)) {
                case 'css':
                    $icon = '<i class="icon-css fa-2x"></i> &nbsp;';
                    break;
                case 'js':
                    $icon = '<i class="icon-javascript fa-2x"></i> &nbsp;';
                    break;
                case 'png':
                case 'jpg':
                case 'jpeg':
                case 'ico':
                case 'svg':
                    $icon = '<i class="fa fa-file-image-o  fa-2x"></i> &nbsp;';
                    break;
                case 'html':
                    $icon = '<i class="icon-html fa-2x"></i> &nbsp;';
                    break;
                case 'php':
                    $icon = '<i class="icon-php fa-2x"></i> &nbsp;';
                    break;
                case 'map':
                    $icon = '<i class="fa fa-file-code-o fa-2x"></i> &nbsp;';
                    break;
                case 'pdf':
                    $icon = '<i class="fa fa-file-pdf-o fa-2x"></i> &nbsp;';
                    break;
                case 'mp3':
                case 'ogg':
                    $icon = '<i class="fa fa-file-sound-o fa-2x"></i> &nbsp;';
                    break;
                case 'mp4':
                case 'mkv':
                case 'flv':
                    $icon = '<i class="fa fa-file-video-o fa-2x"></i> &nbsp;';
                    break;
                default:
                    $icon = '<i class="fa fa-file fa-2x"></i> &nbsp;';
                    break;
            }

            $list = '<li class="plain">'.
                '<a href="'.$_SERVER['REQUEST_URI'].$entry.'">'.
                    $icon.
                    '<span class="entry">'.$entry.'</span>';

            if ($config['showSize']) {
                $list .= '&nbsp; <small class="entry">('.format_size(filesize($dir.$entry)).')</small>';
            }

            $list .= '</a>'.'</li>';

            echo $list;
        }

        closedir($handle);
    }
}
