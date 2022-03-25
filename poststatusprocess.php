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
            //code
            //status
            //share
            //date
            //permission
        }
            //functions to check if the code is correct (Have not tested yet)
        function checkCode($code)
        {
            int counter = 0;
            //Check if the code is 5 characters
            if(strlen($code) == 5)
            {
                for($i = 0 ; $i < strlen($code); $i++)
                {
                    //Check if the first character is 
                    if($i == 1 && !(is_numeric($code[1])))
                    {
                        $counter++;
                    }
                    else if($i != 1 && is_numeric($code[$i]))
                    {
                        $counter++;
                    }
                }
                //If the code is in the correct format 
                if($counter == 5)
                {
                    //ALso need a condition to check if the code exist
                    return true;
                }
                else{
                    return false;
                }
            }
            //If the code is not 5 characters
            else{
                return false;
            }
        }

        //function to check if the status is correct (Have not tested yet)
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
        function checkDate(DATE $date)
        {
            //Must be in the format of dd/mm/yyyy
        }
    ?>
</body>
</html>