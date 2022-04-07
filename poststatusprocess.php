<!DOCTYPE html>
<html>
    <head>
        <title>Post status process</title>
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
            //Check if the code and the status are non-empty entry
            if(!empty($_POST["statuscode"]) && isset($_POST["status"]) && isset($_POST["date"]))
            {
                //Condition to check if the inputs meet the requirements
                if(checkCode($_POST["statuscode"]) && checkStatus($_POST["status"]) && checkDate($_POST["date"]))
                {
                    //Getting data from the form
                    $code = $_POST["statuscode"];
                    $status = $_POST["status"];
                    $permission = $_POST["permission"];
                    $share = $_POST["share"];
                    $date = $_POST["date"];

                    $tableQuery = "SELECT * FROM $sql_tble";

                    //Creating the sql command to add the data into the table
                    $insertQuery = "INSERT INTO $sql_tble"
                    ."(code, status, permission, share, date)"
                    . "VALUES"
                    ."('$code','$status','$permission','$share','$date')";      

                    //sql query to create a table
                    $createTableQuery = "CREATE TABLE $sql_tble(
                        code VARCHAR(5) NOT NULL,
                        status VARCHAR(50) NOT NULL,
                        date DATE NOT NULL,
                        permission VARCHAR(255),
                        share VARCHAR(255),
                        PRIMARY KEY(code)
                        )";
                    
                    //Checks if the database table exists
                    if(EXIST($tableQuery))
                    {                
                        insertQueries($conn, $insertQuery);
                    }
                    else
                    {
                        createingTable($conn, $createTableQuery, $insertQuery);
                    }
                }
                else
                {
                    //Might need to change this so it detects each inputs
                    echo "<p>Please check if you are missing or have incorrect information inputs </p>";
                }
            }
            else{
                echo "<p>Please check if either your code or status is empty </p>";
            }
        }

        //Creates a table in the database
        function creatingTable($conn, $createTableQuery, $insertQuery)
        {
            //execute the creation of table query
            $result =  mysqli($conn, $createTableQuery);

            //Check if the execution was sucessful
            if(!$result)
            {
                echo "<p> Something is wrong with ", $createTableQuery, "</p>";
            }
            else{
                insertQueries($conn, $insertQuery);
            }
        }

        //Inserts the query to the database //!!!!Need to check if this works
        function insertQueries($conn, $insertQuery)
        {
            echo $query;
                
            //executes the insertion query
            $result = mysqli_query($conn,$insertQuery);
            
            //Checks if the eceuction was successful
            if(!$result)
            {
                echo "<p> Something is wrong with ", $insertQuery,"</p>";
            }
            else
            {
                echo "<p>Success</p>";
            }
            //Closing the databae connection
            mysqli_close($conn);
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
                echo "The database does not exist";
            }
        }
        //functions to check if the code is correct
        function checkCode($code)
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
                if($counter == 5 && checkQuery ($code))
                {
                    return true;
                }
                else
                {
                    echo "<p>The code is not in the correct formmat";
                    return false;
                }
            }
            else
            {
                return false;
            }
        }

        //Check if the status is correct
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
        
        //Check the date formmat
        function checkDate($date, $format = 'd/m/Y')
        {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d -> format($format) == $date;
        }
    ?>
</body>
</html>