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
                //Check if the search input is empty
                if(!empty($_GET["searchinput"]))
                {
                    echo "<p>input is not blank</p>";
                    $statusinput = $_GET["searchinput"];
                    // echo $statusinput;
                    $searchQuery = "SELECT * FROM $sql_table WHERE status = '%$statusinput%'";
                    // echo $searchQuery;
                    $result = @mysqli_query($conn, $searchQuery);
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
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo "<tr><th>car</th><td>",$row["car_id"],"</td></tr>";
                            echo "<tr><th>model</th><td>",$row["make"],"</td></tr>";
                            echo "<tr><th>make</th><td>",$row["model"],"</td></tr>";
                            echo "<tr><th>price</th><td>",$row["price"],"</td></tr>";
                        }
                        mysqli_free_result($result);
                        displayingHref();
                    }  
                    echo "</table>";
                }
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