<?php include '1startingcode.php';?>

    <h1>Welcome to the Edit Task Page, <?= $full_name ?>!</h1>

    

    <?php
    // Close the connection
    mysqli_close($conn);
    ?>
    <?php
        echo $_SESSION['taskid'];
    ?>
            </section>
        </div>
    </body>
</html>


