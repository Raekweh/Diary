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
            if()
            //code
            //status
            //share
            //date
            //permission
        }
        //functions to check if the code is correct (I need to check if its null or empty)
        function checkCode($code)
        {
            $counter = 0;
            $codeLen = strlen($code);
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
        function checkDate($date, $format = 'dd-mm-yyyy')
        {

            //Must be in the format of dd/mm/yyyy
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