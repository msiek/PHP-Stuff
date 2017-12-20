<?php
//connection to database
require_once "db.php";

//Declare error message, set to blank
$errormsg = "";

//This is what happens after you hit enter
if(isset($_POST['Enter']))
{
    //Associative array after cleansing
    $formfield['LocationNameVar'] = trim($_POST['LocationNameForm']);
    $formfield['LocationAddressVar'] = trim($_POST['LocationAddressForm']);
    $formfield['LocationCityVar'] = trim($_POST['LocationCityForm']);
    $formfield['LocationStateVar'] = trim($_POST['LocationStateForm']);
    $formfield['LocationPostalCodeVar'] = trim($_POST['LocationPostalCodeForm']);

    //Validation
    if(empty($formfield['LocationNameVar']))
    {
        $errormsg.= "Please Enter a Name\n";
    }

    if(empty($formfield['LocationAddressVar']))
    {
        $errormsg.= "Please Enter an Address\n";
    }

    if(empty($formfield['LocationCityVar']))
    {
        $errormsg.= "Please Enter a City\n";
    }

    if(empty($formfield['LocationStateVar']))
    {
        $errormsg.= "Please Enter a State\n";
    }

    if(empty($formfield['LocationPostalCodeVar']))
    {
        $errormsg.= "Please Enter a Postal Code\n";
    }

    if ($errormsg != "")
    {
        echo "You have an error!\n";
        echo $errormsg;
    }
    else
    {

        $sqlinsert = 'INSERT INTO REQUEST_LOCATION (LocationName, LocationAddress, LocationCity, LocationState, LocationPostalCode) 
        VALUES (:LocationNameBind, :LocationAddressBind, :LocationCityBind, :LocationStateBind, :LocationPostalCodeBind)';

        //Prepares SQL Statement Execution
        $stmtinsert = $db->prepare($sqlinsert);

        //Binds associative array variable to the bound
        $stmtinsert->bindValue(':LocationNameBind', $formfield['LocationNameVar']);
        $stmtinsert->bindValue(':LocationAddressBind', $formfield['LocationAddressVar']);
        $stmtinsert->bindValue(':LocationCityBind', $formfield['LocationCityVar']);
        $stmtinsert->bindValue(':LocationStateBind', $formfield['LocationStateVar']);
        $stmtinsert->bindValue(':LocationPostalCodeBind', $formfield['LocationPostalCodeVar']);

        //Runs the insert statement and query
        $stmtinsert->execute();
    }
}

//Select statement to display information from DB
$sqlselect = "SELECT * from REQUEST_LOCATION ";
$result = $db->prepare($sqlselect);
$result->execute();

?>
<fieldset><legend>Add Talent</legend>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method = "post">

        <table>
            <tr>
                <th>Location Name</th>
                <td><input type="text" name ="LocationNameForm" id="LocationNameForm"
                           value="<?php echo $formfield['TheLocationName']; ?>"></td>
            </tr>

            <tr>
                <th>Location Address</th>
                <td><input type="text" name ="LocationAddressForm" id="LocationAddressForm"
                           value="<?php echo $formfield['TheLocationAddress']; ?>"></td>
            </tr>

            <tr>
                <th>Location City</th>
                <td><input type="text" name ="LocationCityForm" id="LocationCityForm"
                           value="<?php echo $formfield['TheLocationCity']; ?>"></td>
            </tr>

            <tr>
                <th>Location State</th>
                <td><input type="text" name ="LocationStateForm" id="LocationStateForm"
                           value="<?php echo $formfield['TheLocationState']; ?>"></td>
            </tr>

            <tr>
                <th>Location Postal Code</th>
                <td><input type="text" name ="LocationPostalCodeForm" id="LocationPostalCodeForm"
                           value="<?php echo $formfield['TheLocationPostalCode']; ?>"></td>
            </tr>
        </table>

        <input type="submit" name="Enter" value="Enter">

</fieldset>

</form>

<table>
    <tr>
        <th>Location Name</th>
        <th>Location Address</th>
        <th>Location City</th>
        <th>Location State</th>
        <th>Location Postal Code</th>

    </tr>

    <?php
    while($row = $result->fetch())
    {
        echo '<tr><td>' . $row['LocationName'].'</td><td>'
            .$row['LocationAddress'].'</td><td>'
            .$row['LocationCity'].'</td><td>'
            .$row['LocationState'].'</td><td>'
            .$row['LocationPostalCode'].'</td></tr>';
    }
    ?>
</table>
