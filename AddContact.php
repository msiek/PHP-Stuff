<?php
//connection to database
require_once "db.php";

//Declare error message, set to blank
$errormsg = "";

//This is what happens after you hit enter
if(isset($_POST['Enter']))
{
    //Associative array after cleansing
    $formfield['ContactNameVar'] = trim($_POST['ContactNameForm']);
    $formfield['ContactAddressVar'] = trim($_POST['ContactAddressForm']);
    $formfield['ContactCityVar'] = trim($_POST['ContactCityForm']);
    $formfield['ContactStateVar'] = trim($_POST['ContactStateForm']);
    $formfield['ContactPostalCodeVar'] = trim($_POST['ContactPostalCodeForm']);
    $formfield['ContactPhoneNumberVar'] = trim($_POST['ContactPhoneNumberForm']);
    $formfield['ContactEmailVar'] = trim($_POST['ContactEmailForm']);

    //Validation
    if(empty($formfield['ContactNameVar']))
    {
        $errormsg.= "Please Enter a Name\n";
    }

    if(empty($formfield['ContactAddressVar']))
    {
        $errormsg.= "Please Enter an Address\n";
    }

    if(empty($formfield['ContactCityVar']))
    {
        $errormsg.= "Please Enter a City\n";
    }

    if(empty($formfield['ContactStateVar']))
    {
        $errormsg.= "Please Enter a State\n";
    }

    if(empty($formfield['ContactPostalCodeVar']))
    {
        $errormsg.= "Please Enter a Postal Code\n";
    }

    if(empty($formfield['ContactPhoneNumberVar']))
    {
        $errormsg.= "Please Enter a Phone Number\n";
    }

    if(empty($formfield['ContactEmailVar']))
    {
        $errormsg.= "Please Enter an Email\n";
    }

    if ($errormsg != "")
    {
        echo "You have an error!\n";
        echo $errormsg;
    }
    else
    {

        $sqlinsert = 'INSERT INTO PARTNERSHIP_CONTACT (ContactName, ContactAddress, ContactCity, ContactState, ContactPostalCode, ContactPhoneNumber, ContactEmail) 
        VALUES (:ContactNameBind, :ContactAddressBind, :ContactCityBind, :ContactStateBind, :ContactPostalCodeBind, :ContactPhoneNumberBind, :ContactEmailBind)';

        //Prepares SQL Statement Execution
        $stmtinsert = $db->prepare($sqlinsert);

        //Binds associative array variable to the bound
        $stmtinsert->bindValue(':ContactNameBind', $formfield['ContactNameVar']);
        $stmtinsert->bindValue(':ContactAddressBind', $formfield['ContactAddressVar']);
        $stmtinsert->bindValue(':ContactCityBind', $formfield['ContactCityVar']);
        $stmtinsert->bindValue(':ContactStateBind', $formfield['ContactStateVar']);
        $stmtinsert->bindValue(':ContactPostalCodeBind', $formfield['ContactPostalCodeVar']);
        $stmtinsert->bindValue(':ContactPhoneNumberBind', $formfield['ContactPhoneNumberVar']);
        $stmtinsert->bindValue(':ContactEmailBind', $formfield['ContactEmailVar']);

        //Runs the insert statement and query
        $stmtinsert->execute();
    }
}

//Select statement to display information from DB
$sqlselect = "SELECT * from PARTNERSHIP_CONTACT ";
$result = $db->prepare($sqlselect);
$result->execute();

?>
<fieldset><legend>Add Talent</legend>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method = "post">

        <table>
            <tr>
                <th>Contact Name</th>
                <td><input type="text" name ="ContactNameForm" id="ContactNameForm"
                           value="<?php echo $formfield['TheContactName']; ?>"></td>
            </tr>

            <tr>
                <th>Contact Address</th>
                <td><input type="text" name ="ContactAddressForm" id="ContactAddressForm"
                           value="<?php echo $formfield['TheContactAddress']; ?>"></td>
            </tr>

            <tr>
                <th>Contact City</th>
                <td><input type="text" name ="ContactCityForm" id="ContactCityForm"
                           value="<?php echo $formfield['TheContactCity']; ?>"></td>
            </tr>

            <tr>
                <th>Contact State</th>
                <td><input type="text" name ="ContactStateForm" id="ContactStateForm"
                           value="<?php echo $formfield['TheContactState']; ?>"></td>
            </tr>

            <tr>
                <th>Contact Postal Code</th>
                <td><input type="text" name ="ContactPostalCodeForm" id="ContactPostalCodeForm"
                           value="<?php echo $formfield['TheContactPostalCode']; ?>"></td>
            </tr>

            <tr>
                <th>Contact Phone Number</th>
                <td><input type="text" name ="ContactPhoneNumberForm" id="ContactPhoneNumberForm"
                           value="<?php echo $formfield['TheContactPhoneNumber']; ?>"></td>
            </tr>

            <tr>
                <th>Contact Email</th>
                <td><input type="text" name ="ContactEmailForm" id="ContactEmailForm"
                           value="<?php echo $formfield['TheContactEmail']; ?>"></td>
            </tr>
        </table>

        <input type="submit" name="Enter" value="Enter">

</fieldset>

</form>

<table>
    <tr>
        <th>Contact Name</th>
        <th>Contact Address</th>
        <th>Contact City</th>
        <th>Contact State</th>
        <th>Contact Postal Code</th>
        <th>Contact Phone Number</th>
        <th>Contact Email</th>
    </tr>

    <?php
    while($row = $result->fetch())
    {
        echo '<tr><td>' . $row['ContactName'].'</td><td>'
                    .$row['ContactAddress'].'</td><td>'
                    .$row['ContactCity'].'</td><td>'
                    .$row['ContactState'].'</td><td>'
                    .$row['ContactPostalCode'].'</td><td>'
                    .$row['ContactPhoneNumber'].'</td><td>'
                    .$row['ContactEmail'].'</td></tr>';
    }
    ?>
</table>
