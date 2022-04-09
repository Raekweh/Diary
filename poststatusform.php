<!DOCTYPE html>
<html>

<head>
    <title>Post Status Form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class = "container">
        <div class="heading">
            <h1>Status Posting System</h1>
        </div>
        <div class="bodyContainer">
            <form method="post" action="poststatusprocess.php">
                <label>Status Code:<input id="codebox" type="text" name="statuscode" maxlength="5"placeholder="S0001" autocomplete="off"></br>
                <label>Status: <input id="statusbox" type="text" name="status" placeholder="Enter Status" autocomplete="off"></br>

                <label>Share:</label>
                <label id="sharebox" >Public<input type="radio" name="share" value="Public">
                <label>Friends<input type="radio" name="share" value="Friends">
                <label>Only Me<input type="radio" name="share" value="Only Me"></br>

                <label>Date:<input type="date" name="date" id="datebox" value="<?php echo date("Y-m-d") ?>"></br>

                    <label>Permission:</label>
                    <input type="checkbox" name="permission[]" value="Allow Likes" id="permissionbox"><label>Allow Likes</label>
                    <input type="checkbox" name="permission[]" value="Allow Comments"><label>Allow Comments</label>
                    <input type="checkbox" name="permission[]" value="Allow Share"><label>Allow Share</label></br>
                    <input type="submit" name="post" value="POST" id="pbutton">
                    <input type="reset" name="reset" value="RESET" id="rbutton">
            </form>
        </div>
    </div>
    <div>
        <a id = "homehref"href="http://cyz8072.cmslamp14.aut.ac.nz/assign1/index.html">Return to Home</a>
    </div>
</body>

</html>