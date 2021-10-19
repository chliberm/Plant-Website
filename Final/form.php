<?php
include 'top.php';

$dataIsGood = false;
$firstName = "";
$lastName = "";
$email = "";
$opinion = "";
$permission = "Full" ;

// function to check text and numbers
function verifyAlphaNum($testString) {
    return (preg_match ("/^([[:alnum:]]|-|\.| |\'|&|;|#)+$/", $testString));
}

// Sanatize function from the text
function getData($field) {
    if (!isset($_POST[$field])) {
        $data = "";
    } else {
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data);
    }
    return $data;
}
?>
<main class=".formPos">
    <article>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $dataIsGood = true;

            $firstName = getData("txtFirstName");
            $lastName = getData("txtLastName");
            $email = getData("txtEmail");
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $opinion = getData("txtOpinion");
            $permission = getData("radPermission");
            

            // Server side validation
            if ($firstName == "") {
                print '<p class="mistake">Please enter your first name.</p>';
                $dataIsGood = false;
            } elseif (!verifyAlphaNum($firstName)) {
                print '<p class="mistake">Your first name appears to have an illegal character.</p>';
                $dataIsGood = false;
            }

            if ($lastName == "") {
                print '<p class="mistake">Please enter your last name.</p>';
                $dataIsGood = false;
            } elseif (!verifyAlphaNum($lastName)) {
                print '<p class="mistake">Your last name appears to have an illegal character.</p>';
                $dataIsGood = false;
            }

            if ($email == "") {
                print '<p class="mistake">Please enter your email address.</p>';
                $dataIsGood = false;
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                print '<p class="mistake">Your email address appears to be incorrect.</p>';
                $dataIsGood = false;
            }

            if($opinion == "") {
                print '<p class="mistake">Please write about your favorite plants</p>';
                $dataIsGood = false;
            } elseif (!verifyAlphaNum($opinion)) {
                    print '<p class="mistake">Your comment about your favorites appears to have at least one illegal character.</p>';
                    $dataIsGood = false;
            }

            if ($permission != "Full" AND $permission != "Partial" AND $permission != "No") {
                print '<p class="mistake">Please choose a valid response for permission to share your response.</p>';
                $dataIsGood = false;
            }

            if ($dataIsGood) {
                try {
                    $sql = 'INSERT INTO tblPublicOpinions
                    (fldFirstName, fldLastName, fldEmail, fldOpinion, fldPermission) 
                    VALUES (?,?,?,?,?)';
                    $statement = $pdo->prepare($sql);
                    $params = array($firstName, $lastName, $email, $opinion, $permission);

                    if ($statement->execute($params)) {
                        print '<p>Your survey answers were successfully submitted.</p>';

                        // Send email 
                        $to = $email;
                        $from = 'Celia Liberman <chliberm@uvm.edu>';
                        $subject = 'Your Favorite Plants Submission';

                        $mailMessage = '<p style="font: oblique large Times, Helvetica;"> Thank you for sharing! ';
                        $mailMessage .= 'Looking forward to reading your submission.</p>';
                        $mailMessage .= '<p>A copy of your submission:</p>';
                        $mailMessage .= '<p>First name: ' . $firstName . '</p>';
                        $mailMessage .= '<p>Last name: ' . $lastName . '</p>';
                        $mailMessage .= '<p>Your favorites: ' . $opinion . '</p>';
                        $mailMessage .= '<p>Permission to share: ' . $permission . '</p>';
                        $mailMessage .= '<p>Sincerely,</p>';
                        $mailMessage .= '<p style="font: oblique medium cursive; padding-left: 2.5em; color: rgb(8, 59, 28);">Celia Liberman</p>';
                        
                        $headers = "MINE-Version: 1.0\r\n";
                        $headers .= "Content-type: text/html; charset=utf-8\r\n";
                        $headers .= "From: " . $from . "\r\n";
                        $mailSent = mail($to, $subject, $mailMessage, $headers);
                        
                        if ($mailSent) {
                            print "<p>A copy of your submission was sent to your email.</p>";
                            print $mailMessage;
                        }

                    } else {
                        print '<p>Your survey answers were NOT successfully submitted.</p>';
                    }
                    
                } catch (PDOExecption $e) {
                    print '<p>Couldn\'t insert the record.</p>';
                } // end try
            } // ends data is good
        } // ends form was submitted

        if($dataIsGood) {
            print '<h2>Thank you for sharing! Looking forward to reading your submission.</h2>';
        }
        ?>
    </article>

    <form action="#" method="POST">
        <!--Contact info-->
        <fieldset class="contact">
            <legend>Contact Information</legend>
            <p>
                <label for="txtFirstName">First Name:</label>
                <input type="text" 
                       name="txtFirstName" 
                       id="txtFirstName"
                       maxlength="45"
                       onfocus="this.select()"
                       tabindex="100"
                       value="<?php print $firstName; ?>"
                       required>
            </p>

            <p>
                <label for="txtLastName">Last Name:</label>
                <input type="text" 
                       name="txtLastName" 
                       id="txtLastName"
                       maxlength="45"
                       onfocus="this.select()"
                       tabindex="100"
                       value="<?php print $lastName; ?>"
                       required>
            </p>

            <p>
                <label for="txtEmail">Email:</label>
                <input type="email"
                       name="txtEmail" 
                       id="txtEmail"
                       maxlength="50"
                       onfocus="this.select()"
                       tabindex="120"
                       value="<?php print $email; ?>"
                       required>
            </p>
        </fieldset>
        
        <!--Share their favrites-->
        <fieldset class="opinion">
            <legend>Your Favorites!</legend>
            <p>
                <label for="txtOpinion">Tell me all about your favorite plants!</label>
                <textarea id="txtOpinion" 
                          name="txtOpinion"
                          onfocus="this.select()"
                          required><?php print $opinion; ?></textarea>
            </p>
        </fieldset>

        <!-- Permission to share their submission-->
        <fieldset class="permission">
            <legend>Can I share your submission on my site?</legend>
            <p>
                <input type="radio" name="radPermission" id="radFullPermission" value="Full"
                       <?php if ($permission == "Full") print 'checked'; ?> required>
                <label for="radFullPermission">Yes, with my full name</label>
            </p>

            <p>
                <input type="radio" name="radPermission" id="radRestictPermission" value="Partial"
                       <?php if ($permission == "Partial") print 'checked'; ?> required>
                <label for="radRestrictPermission">Yes, but anonymously</label>
            </p>

            <p>
                <input type="radio" name="radPermission" id="radNoPermission" value="No"
                       <?php if ($permission == "No") print 'checked'; ?> required>
                <label for="radNoPermission">No thank you</label>
            </p>
        </fieldset>

        
        <!--Submit button-->
        <fieldset>
            <input type="submit" id="btnSubmit" name="btnSubmit" value="Register">
        </fieldset>
    </form>
</main>

<?php
include 'footer.php';
?>

</body>
</html>