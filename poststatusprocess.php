<!DOCTYPE html>
<html>

<head>
    <title> Search Status Process</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="bodyContainer">
        <?php
        require_once('./conf/sqlinfo.php');

        //Checks if the sqli_connection is a true or false
        $conn = @mysqli_connect(
            $sql_host,
            $sql_user,
            $sql_pass,
            $sql_db
        );

        if (!$conn) 
        {
            echo "<p>Database connection failure <p>";
        } 
        else
         {
            if (checkCode($_POST["statuscode"]) && checkStatus($_POST["status"]) && validDate($_POST["date"])) 
            {
                echo "Congrats";

                //Storing values
                $code = $_POST["statuscode"];
                $status = $_POST["status"];
                $date = $_POST["date"];
                $share = $_POST["share"];
                $permisisonInput = $_POST["permission"];
                $permission = "";
                //Storing permission variables into a single string
                foreach ($permisisonInput as $value) 
                {
                    $permission .= $value . " ";
                }

                $checkCodeQuery = "SELECT * FROM $sql_tble WHERE code = '$code'";

                //Checking if the code exist in the database 
                if(checkDatabase($checkCodeQuery, $conn))
                {
                    //Sqli queries
                    $tableExistence = "SELECT 1 FROM $sql_tble";
                    $creatingTable = "CREATE TABLE $sql_tble(
                        code VARCHAR(5) NOT NULL,
                            status VARCHAR(255) NOT NULL,
                            date DATE NOT NULL,
                            permission VARCHAR(255),
                            share VARCHAR(255),
                            PRIMARY KEY (code)
                            )";

                    $dropTable = "DROP TABLE $sql_tble";
                    $insertQuery = "INSERT INTO forumDB (code, status, date, permission, share)
                    VALUES ('$code' , '$status' , '$date' , '$permission', '$share')";

                    $tableResult = @mysqli_query($conn, $tableExistence);

                    //Checking if the table exist in the database;
                    if ($tableResult !== FALSE) 
                    {
                        insertingQuery($conn, $insertQuery);
                    } 
                    else 
                    {
                        //Drops the table for insurance
                        $dropTableResult = @mysqli_query($conn, $dropTable);
                        $creatingTableResult = @mysqli_query($conn, $creatingTable);
                        insertingQuery($conn, $insertQuery);
                    }
                }
            } 
        }

        //Checks if the code exist in the database
        function checkDatabase($checkCodeQuery, $conn)
        {
            echo $checkCodeQuery;
            $checkCodeResult = @mysqli_query($conn, $checkCodeQuery);
            if(mysqli_num_rows($checkCodeResult) > 0)
            {
                echo "<p>The code already exist in the database</p>";
                return false;
            }
            else{
                return true;
            }
        }

        //Inserting Query into the database
        function insertingQuery($conn, $insertQuery)
        {
            $insertingResult = @mysqli_query($conn, $insertQuery);
            if ($insertingResult !== FALSE) 
            {
                echo "<p>Successful</p>";
            } 
            else 
            {
                echo "<p>Error inserting into table</p>";
            }
        }

        //functions to check if the code is correct
        function checkCode($code)
        {
            //Query to check if the code exist in the database
            //check if the code is null or empty
            if (empty($code) || !isset($code)) 
            {
                echo "<p>Codebox is empty</p>";
                return false;
            }
             else 
             {
                $counter = 0;
                $codeLen = strlen($code);
                if ($codeLen == 5) 
                {
                    for ($i = 0; $i < $codeLen; $i++) 
                    {
                        //Check if the first character is a letter (might need to change it to caps only and give a warning)
                        if ($i == 0 && !(is_numeric($code[$i])) && $code[$i] == 'S') 
                        {
                            $counter++;
                        }
                        //Check if the remaining characters are numbers only
                        else if ($i != 0 && is_numeric($code[$i])) 
                        {
                            $counter++;
                        }
                    }
                    //Checking if the code formmatt is correct (Need something to check if the code exist e.g. use database)
                    if ($counter == 5) 
                    {
                        return true;
                    } 
                    else 
                    {
                        echo "<p>Please check if you have entered the code in the correct format</p>";
                        return false;
                    }
                } 
                else 
                {
                    echo "<p>Please enter a code of length 5";
                    return false;
                }
            }
        }

        function checkStatus($status)
        {
            if (empty($status) || !isset($status)) 
            {
                echo "<p>Status box is empty</p>";
                return false;
            } 
            else 
            {
                $pattern = "/[a-zA-Z0-9\s,\.!\?]*$/";
                //Checks if the status contains only alphabet and spaces
                if (preg_match($pattern, $status)) 
                {
                    return true;
                }
                else
                {
                    echo "<p>Please check if you have any other special characters</p>";
                    return false;
                }
            }
        }

        function validDate($date)
        {
            if (empty($date) || !isset($date)) 
            {
                echo "<p>Date box is empty</p>";
                return false;
            }
            return true;
        }

        //Closing the database
        mysql_close($conn);
        ?>
    </div>
</body>

</html>