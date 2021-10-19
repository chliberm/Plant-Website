<nav>
    <a class="<?php
    if ($path_parts['filename'] == "index") {
        print 'activePage';
    }
    ?>" href="index.php">Home</a>

    <a class="<?php
    if ($path_parts['filename'] == "favorites") {
        print 'activePage';
    }
    ?>" href="favorites.php">My Favorites</a>

    <a class="<?php
    if ($path_parts['filename'] == "array") {
        print 'activePage';
    }
    ?>" href="array.php">Public's Opinion</a>

    <a class="<?php
    if ($path_parts['filename'] == "form") {
        print 'activePage';
    }
    ?>" href="form.php">Survey</a>
</nav>