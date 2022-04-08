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
                if(checkCode($_POST["statuscode"]) && checkStatus($_POST["status"]) && validDate($_POST["date"]))
                {
                    echo "Congrats";
                    $code = $_POST["statuscode"];
                    $status = $_POST["status"];
                    $date = date("d/m/Y", strtotime($_POST["date"]));
                    $share = $_POST["share"];
                    $permisisonInput = $_POST["permission"];
                    $permission = "";
                    //Storing permission variables into a single string
                    foreach($permisisonInput as $value)
                    {
                        $permission .= $value . " ";
                    }
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
                if(empty($status) || !isset($status))
                {
                    echo "<p>Status box is empty</p>";
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

            function validDate($date)
            {
                if(empty($date) || !isset($date))
                {
                    echo "<p>Date box is empty</p>";
                    return false;
                }
                return true;
            }

            function permissionValue($like, $comment, $share)
            {
                echo "<p>YOu are gay</p>";
                echo $like;
                echo $comment;
                echo $share;
                $permissionStr = " ";
                $permissionStr = $permissionStr . $like . $comment . $share;
                echo $permissionstr; 
                return $permissionStr;
            }
            //Closing the database
            mysql_close($conn);
            ?>
        </div>
    </body>
</html>