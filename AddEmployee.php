<?php
    //connection to database
    require_once "db.php";

    //Declare error message, set to blank
    $errormsg = "";

    //This is what happens after you hit enter
    if(isset($_POST['Enter']))
    {
        //Associative array after cleansing
        $formfield['EmployeeNameVar'] = trim($_POST['EmployeeNameForm']);

        //Validation
        if(empty($formfield['EmployeeNameVar']))
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

            $sqlinsert = 'INSERT INTO EMPLOYEE (EmployeeName) VALUES (:EmployeeNameBind)';

            //Prepares SQL Statement Execution
            $stmtinsert = $db->prepare($sqlinsert);

            //Binds associative array variable to the bound
            $stmtinsert->bindValue(':EmployeeNameBind', $formfield['EmployeeNameVar']);

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
            <th>Employee Name</th>
            <td><input type="text" name ="EmployeeNameForm" id="EmployeeNameForm"
                value="<?php echo $formfield['TheEmployeeName']; ?>"></td>
        </tr>
    </table>

    <input type="submit" name="Enter" value="Enter">

</fieldset>

</form>

<table>
    <tr>
        <th>Employee Name</th>
    </tr>
    <?php
        while($row = $result->fetch())
        {
            echo '<tr><td>' . $row['EmployeeName'].'</td></tr>';
        }
    ?>
</table>
