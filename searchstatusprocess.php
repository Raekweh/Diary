<!DOCTYPE html>
<html>
    <head>
        <title> Search Status Process</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class = "container">
            <div class = "heading">
                <h1 id = "title">Status Posting System</h1>
            </div>
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
                    //Check if the search input is empty
                    if(!empty($_GET["searchinput"]))
                    {
                        $statusinput = $_GET["searchinput"];
                        $searchQuery = "SELECT * FROM $sql_tble WHERE STATUS LIKE '%$statusinput%'";
                        $searchresult = @mysqli_query($conn, $searchQuery);

                        $statusColumQuery = "SELECT COUNT(status) AS statuslength FROM $sql_tble WHERE STATUS LIKE '%$statusinput%'";
                        $columnResult = @mysqli_query($conn, $statusColumQuery);
                        $length = mysqli_fetch_assoc($columnResult);
                        $statusColumn = $length['statuslength'];

                        //starting a table to display the sql queries
                        echo "<table>";
                        //If the result does not exist
                        if(!$searchresult)
                        {
                            echo "<p>Something when wrong with " , $query , "</p>";
                        }
                        else
                        {
                            //no results from the given query
                            if($statusColumn == 0)
                            {
                                echo "<p>No Results</p>";
                            }
                            else
                            {
                                while($row = mysqli_fetch_assoc($searchresult))
                                {
                                    echo "<tr><th>Code: </th> <td>",$row["code"],"</td></tr>";
                                    echo "<tr><th>Status: </th><td>",$row["status"],"</td></tr>";
                                    echo "<tr><th>Date: </th><td>", date('d/m/Y', strtotime($row['date'])),"</td></tr>";
                                    echo "<tr><th>Permission: </th><td>",$row["permission"],"</td></tr>";
                                    echo "<tr><th>Share: </th><td>",$row["share"],"</td></tr>";
                                }
                            }
                        }  
                        echo "</table>";
                        mysqli_free_result($searchresult);
                        echo "<br>";
                        displayingHref();
                    }
                    else
                    {
                        echo "<p>Blank</p>";
                        displayingHref();
                    }
                }

                //Closing the database
                mysql_close($conn);

                //Displaying the links back to search status and home page
                function displayingHref()
                {
                    echo '<p><a id = "searchhref" href="http://cyz8072.cmslamp14.aut.ac.nz/assign1/searchstatusform.html">Search status</a>
                    <a id = "homehref" href="http://cyz8072.cmslamp14.aut.ac.nz/assign1/index.html">Return to Home</a></p>';
                }
                ?>
            </div>
        </div>
    </body>
</html>