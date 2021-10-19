<?php
include 'top.php';
?> 
<main>   
    <h2>SQL statements</h2>
    <article>
        <h3>Creating Table</h3>
        <code>
        CREATE TABLE tblPublicOpinions (
            pmkSubmissionId INT AUTO_INCREMENT PRIMARY KEY,
            fldFirstName varchar(20),
            fldLastName varchar(20),
            fldEmail varchar(50),
            fldOpinion text,
            fldPermission varChar(30)
        );
        </code>

        <h3>Inserting into Table</h3>
        <code>
        INSERT INTO tblPublicOpinions (fldFirstName, fldLastName, fldEmail, fldOpinion, fldPermission) VALUES

        ('Elizabeth', 'Carson', 'ecarson123@gmail.com', 'I almost care about my plants more than I do about my kids! My favorite is the snake plant.', 'Full'),

        ('Taylor', 'Sullivan', 'taysul95@gmail.com', 'My dearest plant is my Bonsai Tree. It so small and delicate and adds so much to my living space.', 'Full'),

        ('Patty', 'Keen', 'keen_patty@gmail.com', 'I love plants but cannot keep them alive for the life of me! Would love some help or tips!', 'Partial'),

        ('Gary', 'Garland', 'ggthegod@gmail.com', 'We share a lot of favorites! I also love the pathos plant and how the vines spread everywhere!', 'Full'),

        ('Jack', 'Dickson', 'grumpypants@gmail.com', 'Boring website. No one cares.', 'No');
        </code>

        <h3>Selecting Submissions from Table</h3>
        <code>
        SELECT fldFirstName, fldLastName, fldOpinion, fldPermission 
        FROM tblPublicOpinions
        WHERE fldPermission = "Full" OR fldPermission = "Partial"
        </code>
    </article>
</main>
<?php
include 'footer.php';
?>
</body>
</html>
        