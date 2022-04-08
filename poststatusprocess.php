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
                if(checkCode($_POST["statuscode"]))
                {
                    echo "Congrats";
                }
                else
                {
                    echo "<p>Check input <p>";
                }

            }

                    //functions to check if the code is correct
            function checkCode($code)
            {
                //check if the code is null or empty
                if(empty($code) || !isset($code))
                {
                    echo "<p>Codebox is empty</p>";
                    return false;
                }
                else
                {
                    $counter = 0;
                    $codeLen = strlen($code);
                    if($codeLen == 5)
                    {
                        for($i = 0 ; $i < $codeLen; $i++)
                        {
                            echo $i;
                            //Check if the first character is a letter (might need to change it to caps only and give a warning)
                            if($i == 0 && !(is_numeric($code[$i])) && $code[$i] == 'S')
                            {
                                $counter++;
                            }
                            //Check if the remaining characters are numbers only
                            else if($i != 0 && is_numeric($code[$i]))
                            {
                                $counter++;
                            }
                        }
                        //Checking if the code formmatt is correct (Need something to check if the code exist e.g. use database)
                        if($counter == 5)
                        {
                            return true;
                        }
                        else
                        {
                            return false;
                        }
                    }
                    else
                    {
                        echo "<p>Please enter a code  of length 5";
                        return false;
                    }
                }
            }

            function checkStatus($status)
            {
                if(empty($code) || !isset($code))
                {
                    echo "<p>Codebox is empty</p>";
                    return false;
                }
                else
                {                
                    $pattern = "/[a-zA-Z0-9\s,\.!\?]*$/";
                    //Checks if the status contains only alphabet and spaces
                    if(preg_match($pattern, $status))
                    {
                        return true;
                    }
                    return false;
                }
            } 
            //Closing the database
            mysql_close($conn);
            ?>
        </div>
    </body>
</html>