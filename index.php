<?php require_once("start.php"); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Seniorseglarna</title>
        <link id="favicon" rel="shortcut icon" href="img/sseglare_logo.png" type="image/png">

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <meta name="format-detection" content="telephone=no"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="apple-touch-startup-image" href="lib/durandal/img/ios-startup-image-landscape.png" media="(orientation:landscape)" />
        <link rel="apple-touch-startup-image" href="lib/durandal/img/ios-startup-image-portrait.png" media="(orientation:portrait)" />
        <link rel="apple-touch-icon" href="lib/durandal/img/icon.png"/>

        <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="lib/bootstrap/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="css/ie10mobile.css" />
        <link rel="stylesheet" href="lib/durandal/css/durandal.css" />
        <link rel="stylesheet" href="css/style.css" />
        
        <script type="text/javascript">
            if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
                var msViewportStyle = document.createElement("style");
                var mq = "@@-ms-viewport{width:auto!important}";
                msViewportStyle.appendChild(document.createTextNode(mq));
                document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
            }
        </script>
    </head>
    <body>
        <div id="applicationHost">
            <div class="splash">
              <div class="message">
                  Laddar Seniorseglarna...
              </div>
              <i class="icon-spinner icon-2x icon-spin active"></i>
          </div>
        </div>

        <script src="lib/require/require.js" data-main="app/main"></script>
    </body>
</html>
