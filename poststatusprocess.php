<!DOCTYPE html>
<html>
    <head>
        <title>Post status process</title>
        <link rel = "stylesheet" href = "style.css">
</head>
<body>
    <?php
        require_once('../..conf/sqlinfo.php');

        //Checks if the sqli_connection is a true or false
        $conn = @mysqli_connect($sql_host,
        $sql_user,
        $sql_pass,
        $sql_db);

        if(!$conn)
        {
            echo "<p>Database connection failure</p>";
        }
        else{
            //Condition to check if the inputs meet the requirements
            if(checkCode($_POST["statuscode"]) && checkStatus($_POST["status"]) checkDate($_POST["date"]) && checkPermission($_POST["permission"]) && checkShare($_POST["share"]))
            {
                //Getting data from the form
                $code = $_POST["statuscode"];
                $status = $_POST["status"];
                $permission = $_POST["permission"];
                $share = $_POST["share"];
                $date = $_POST["date"];

                //Check if the database table exists
                
                //Creating the sql command to add the data into the table
                $query = "insert into $sql_tble"
                            ."(code, status, permission, share, date)"
                        . "values"
                    ."('$code','$status','$permission','$share','$date)";       
                
                echo $query;
                
                //executes the query
                $result = mysqli_query($conn,$query);
                
                //Checks if the eceuction was successful
                if(!$result)
                {
                    echo "<p> Somethign is wrong with ", $query,"</p>";
                }
                else{
                    echo "<p>Success</p>";
                }

                //Closing the databae connection
                mysqli_close($conn);
            }
            else
            {
                //Might need to change this so it detects each inputs
                echo "<p>Please check if you are missing or have incorrect information inputs </p>";
            }
        }

        //Checking if the code exist in the database
        function checkQuery($code)
        {
            $query = "SELECT * FROM  $sql_tble WHERE code = '$code'";
            $result = mysql_query($query);
            if($result)
            {
                //If the query exists
                if(mysql_num_rows($result) > 0)
                {
                    return false;
                }
                return true;
            }
            else{
                echo "THe database does not exist";
            }
        }
        //functions to check if the code is correct (I need to check if its null or empty)
        function checkCode($code)
        {
            $counter = 0;
            $codeLen = strlen($code);
            $query = ;
            if($codeLen == 5)
            {
            	echo "<p> The length of the code is 5 </p>";
                for($i = 0 ; $i < $codeLen; $i++)
                {
                    //Check if the first character is a letter (might need to change it to caps only and give a warning)
                    if($i == 0 && !(is_numeric($code[$i])))
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
                if($counter == 5 && checkQuery ($code))
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
                return false;
            }
        }

        //function to check if the status is correct (I need to chec if its null or empty)
        function checkStatus($status)
        {
            $pattern = "/[A-Za-z ]+$/";
            //Checks if the status contains only alphabet and spaces
            if(preg_match($pattern, $status))
            {
                return true;
            }
            return false;
        }                
        
        //function to check  the date
        function checkDate($date, $format = 'd/m/Y')
        {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d -> format($format) == $date;
        }

        //Not tested
        function checkShare($share)
        {
            //Checks if the radiobutton is null or not selected
            if(isset($share))
            {
                return true;
            }
            return false;
        }

        //Not tested
        function checkPermission($permission)
        {
            //Check if the checkbox is null or not selected
            if(isset($permission))
            {
                return true;
            }
            return false;
        }
    ?>
</body>
</html>