<!doctype html>
<?php require_once('inc/head.php') ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 <?php echo $URI ?></title>

    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <link rel="shortcut icon" href="<?php echo base('/favicon.ico') ?>">

    <link rel="stylesheet" href="<?php echo base('/bower_components/naked/css/naked.css') ?>">
    <link rel="stylesheet" href="<?php echo base('/bower_components/font-awesome/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base('/bower_components/font-mfizz/font/font-mfizz.css') ?>">
    <style>
        .container {
             padding-top:20px
        }

        @media only screen and (max-width: 480px) {
            .container {
                padding: 10px;
            }

            .listview .list-group {
                margin-bottom: 0;
            }
        }
        big {
            font-size: 300%;
        }
        .center { text-align: center; margin-top: 100px; }
    </style>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="span-12">
                <div class="center">
                    <big><i class="icon-looking fa-4x"></i></big>
                    <h1 class="subheader">404 not found!</h1>
                    <p>Whoops! Apparently this is not the page you are looking for.</p>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo base('/bower_components/zeptojs/src/zepto.js') ?>"></script>
    <script type="text/javascript">

        $(function() {
            setTimeout(function() {
                window.scrollTo(0, 1);
            }, 100);
        });
    </script>
</body>
</html>
