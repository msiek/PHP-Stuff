<?php
//connection to database
require_once "db.php";

//Declare error message, set to blank
$errormsg = "";

//This is what happens after you hit enter
if(isset($_POST['Enter']))
{
    //Associative array after cleansing
    $formfield['TalentNameVar'] = trim($_POST['TalentNameForm']);
    $formfield['TalentTitleVar'] = trim($_POST['TalentTitleForm']);

    //Validation
    if(empty($formfield['TalentNameVar']))
    {
        $errormsg.= "Please Enter a Name\n";
    }

    if(empty($formfield['TalentTitleVar']))
    {
        $errormsg.= "Please Enter a Talent\n";
    }

    if ($errormsg != "")
    {
        echo "You have an error!\n";
        echo $errormsg;
    }
    else
    {

        $sqlinsert = 'INSERT INTO TALENT (TalentName, TalentTitle) 
                        VALUES (:TalentNameBind, :TalentTitleBind)';

        //Prepares SQL Statement Execution
        $stmtinsert = $db->prepare($sqlinsert);

        //Binds associative array variable to the bound
        $stmtinsert->bindValue(':TalentNameBind', $formfield['TalentNameVar']);
        $stmtinsert->bindValue(':TalentTitleBind', $formfield['TalentTitleVar']);

        //Runs the insert statement and query
        $stmtinsert->execute();
    }
}

//Select statement to display information from DB
$sqlselect = "SELECT * from TALENT";
$result = $db->prepare($sqlselect);
$result->execute();

?>
<fieldset><legend>Add Talent</legend>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method = "post">

        <table>
            <tr>
                <th>Talent Name</th>
                <td><input type="text" name ="TalentNameForm" id="TalentNameForm"
                           value="<?php echo $formfield['TheTalentName']; ?>"></td>
            </tr>

            <tr>
                <th>Talent Title</th>
                <td><input type="text" name ="TalentTitleForm" id="TalentTitleForm"
                           value="<?php echo $formfield['TheTalentTitle']; ?>"></td>
            </tr>
        </table>

        <input type="submit" name="Enter" value="Enter">

</fieldset>

</form>

<table>
    <tr>
        <th>Talent Name</th>
        <th>Talent Title</th>
    </tr>
    <?php
    while($row = $result->fetch())
    {
        echo '<tr><td>' . $row['TalentName'].'</td><td>'
                        .$row['TalentTitle'].'</td></tr>';
    }
    ?>
</table>
