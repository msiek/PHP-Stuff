<?php
//connection to database
require_once "db.php";

//Declare error message, set to blank
$errormsg = "";

//This is what happens after you hit enter
if(isset($_POST['Enter']))
{
    //Associative array after cleansing
    $formfield['InterviewDescriptionVar'] = trim($_POST['InterviewDescriptionForm']);

    //Validation
    if(empty($formfield['InterviewDescriptionVar']))
    {
        $errormsg.= "Please Enter a Name\n";
    }

    if ($errormsg != "")
    {
        echo "You have an error!\n";
        echo $errormsg;
    }
    else
    {

        $sqlinsert = 'INSERT INTO INTERVIEW (InterviewDescription) VALUES (:InterviewDescriptionBind)';

        //Prepares SQL Statement Execution
        $stmtinsert = $db->prepare($sqlinsert);

        //Binds associative array variable to the bound
        $stmtinsert->bindValue(':InterviewDescriptionBind', $formfield['InterviewDescriptionVar']);

        //Runs the insert statement and query
        $stmtinsert->execute();
    }
}

//Select statement to display information from DB
$sqlselect = "SELECT * from EMPLOYEE";
$result = $db->prepare($sqlselect);
$result->execute();

?>
<fieldset><legend>Add Employee</legend>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method = "post">

        <table>
            <tr>
                <th>Interview Description</th>
                <td><input type="textarea" name ="InterviewDescriptionForm" id="InterviewDescriptionForm"
                           value="<?php echo $formfield['TheInterviewDescription']; ?>"></td>
            </tr>
        </table>

        <input type="submit" name="Enter" value="Enter">

</fieldset>

</form>

<table>
    <tr>
        <th>Interview Description</th>
    </tr>
    <?php
    while($row = $result->fetch())
    {
        echo '<tr><td>' . $row['InterviewDescription'].'</td></tr>';
    }
    ?>
</table>
