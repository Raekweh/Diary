<!DOCTYPE html>
<html>
    <head>
        <title> Search Status Process</title>
    </head>
    <body>
        <div class = "bodyContainer">
            <?php
            require_once('./conf/sqlinfo.php');

            //Checks if the sqli_connection is a true or false
            $conn = @mysqli_connect($sql_host,
            $sql_user,
            $sql_pass,
            $sql_db);       

            if(!$conn)
            {
                echo "<p>Database connection failure <p>";
            }
            else
            {
                echo "<p>Databse connaction successful</p>";
                if(!empty($_POST["statuscode"]) && isset($_POST["status"]) && isset($_POST["date"]))
                {

                }
                else
                {
                    
                }
        }

            //Closing the database
            mysql_close($conn);
            ?>
        </div>
    </body>
</html>