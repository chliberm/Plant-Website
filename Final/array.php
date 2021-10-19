<?php
include 'top.php';

// Read in rows as arrays into an array from table 
$sql = 'SELECT fldFirstName, fldLastName, fldOpinion, fldPermission 
        FROM tblPublicOpinions
        WHERE fldPermission = "Full" OR fldPermission = "Partial"';

$statement = $pdo->prepare($sql);
$statement->execute();

$records = $statement->fetchAll();
?>
<main class="opinions">
    <h2>The Public's Opinion</h2>
    <?php
        foreach ($records as $record) {
            if ($record['fldPermission'] == "Full") {
                $name = $record['fldFirstName'] . " " . $record['fldLastName'];
            } elseif ($record['fldPermission'] == "Partial") {
                $name = "Anonymous";
            }
            $publicStatement = $record['fldOpinion'];
            print '<article>' . PHP_EOL;
            print '<section>' . PHP_EOL;
            print '<h3>' . $name . '</h3>';
            print '<p>' . '"' . $publicStatement . '"' . '</p>';
            print '</section> '. PHP_EOL;
            print '</article>' . PHP_EOL;
        }
    ?>
</main>

<?php
include 'footer.php';
?>
</body>
</html>