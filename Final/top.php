<?php
$phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF_8");
$path_parts = pathinfo($phpSelf);
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>My Plants & I</title>
        <meta name="author" content="Celia Liberman">
        <meta name="description" 
        content="A telling of my favorite plants, why I am so connected to them, and some information from the public about their favorites.">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" 
            href="css/custom.css?version=<?php print time(); ?>" 
            type="text/css">

        <link rel="stylesheet" 
            media="(max-width: 800px)"
            href="css/custom-tablet.css?version=<?php print time(); ?>" 
            type="text/css">

        <link rel="stylesheet" 
            media="(max-width: 600px)"
            href="css/custom-phone.css?version=<?php print time(); ?>" 
            type="text/css">

    </head>

    <?php
    print '<body class="grid-layout" id="' . $path_parts['filename'] . '">';
    print PHP_EOL;
    print '<!-- ################    Start of Body    ################ -->';
        include 'connect-DB.php';
        print PHP_EOL;
        include 'header.php';
        print PHP_EOL;
        include 'nav.php';
        print PHP_EOL;
    ?>