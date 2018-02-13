<?php
require_once("start.php");
?>

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
    </head>
    <body style="padding: 20px;">
<?

if (!isset($_POST["submit"])) {
    ?>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            Välj en bild att ladda upp:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <input type="submit" value="Ladda upp" name="submit">
        </form>
    <?php
} else {
    $target_dir = "members/";
    $target_file = $target_dir . $_POST["id"] . ".jpg";
    $uploadOk = 1;
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Filen du försökte ladda upp var inte en jpg-bild.<br>\n";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Tyvärr är bilden för stor, välj en mindre.<br>\n";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Kunde inte ladda upp bilden.<br>\n";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "Bilden är uppladdad!";
        } else {
            echo "Filen kunde inte laddas upp";
        }
    }
}
?>
    </body>
</html>
