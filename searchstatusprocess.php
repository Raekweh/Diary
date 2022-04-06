<!DOCTYPE html>
<html>
    <head>
        <title> Search Status Process</title>
    </head>
    <body>
        <div class = "bodyContainer">
            <?php
            require_once('../..conf/sqlinfo.php');

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
                //Check if the search input is empty
                if(!empty($_GET["searchinput"]))
                {
                    $statusinput = $_GET["searchinput"];
                    $searchQuery = "SELECT * FROM $sql_table WHERE status = '%$statusinput%'";
                    $result = mysqli_query($searchQuery);
                    $row = mysqli_fetch_row($result);

                    //starting a table to display the sql queries
                    echo "<table>";

                    //If the result does not exist
                    if(!$result)
                    {
                        echo "<p>Not found<p>";
                        displayingHref();
                    }
                    else{
                        while($row)
                        {
                            echo "<tr><th>code: </th><td>{$row[0]}</td>";
                            echo "<th>status: </th><td>{$row[1]</td>";
                            echo "<th>date: </th><td>{$row[2]</td>";
                            echo "<th>permssion: </th><td>{$row[3]</td>";
                            echo "<th>share: </th><td>{$row[4]</td></tr>";
                            $row = mysqli_fetch_row($result);
                        }
                        displayingHref();
                    }  
                }
                echo "</table>";
                else{
                    echo "<p>Blank</p>";
                }
            }

            //Closing the database
            mysql_close($conn);

            //Displaying the links
            function displayingHref()
            {
                echo '<p><a id = "searchhref" href="http://cyz8072.cmslamp14.aut.ac.nz/assign1/searchstatusform.html">Search status</a>
                <a id = "homehref" href="http://cyz8072.cmslamp14.aut.ac.nz/assign1/index.html">Return to Home</a></p>';
            }
            ?>
        </div>
    </body>
</html>