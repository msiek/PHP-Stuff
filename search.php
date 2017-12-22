<?php
    require_once 'db.php';

    $formfield['myEmployeeName'] = $_POST['employeename'];
    $formfield['myBusinessName'] = $_POST['businessname'];
    $formfield['myClientPhone'] = $_POST['clientphone'];
    $formfield['myPromo'] = $_POST['promo'];
    $formfield['myInvest'] = $_POST['invest'];

    $sqlselectemp = 'SELECT * FROM EMPLOYEE';
    $resultemp = $db->prepare($sqlselectemp);
    $resultemp->execute();

    if(isset($_POST['mySubmit']))
    {
        if ($formfield['myEmployeeName'] == '') {
            $sqlselect = "SELECT CLIENT.*, EMPLOYEE.EmployeeName FROM 
                          CLIENT, EMPLOYEE where BusinessName like CONCAT('%', :thebusiness '%')
                          AND ClientPhone like CONCAT('%', :theclient, '%')
                          AND PromotionalConsideration like CONCAT('%', :thepromo, '%')
                          AND InvestmentAmount like CONCAT('%', :theinvest, '%')
                          AND CLIENT.EmployeeID = EMPLOYEE.EmployeeID";
        } else {
            $sqlselect = "SELECT CLIENT.*, EMPLOYEE.EmployeeName FROM 
                          CLIENT, EMPLOYEE where BusinessName like CONCAT('%', :thebusiness '%')
                          AND ClientPhone like CONCAT('%', :theclient, '%')
                          AND PromotionalConsideration like CONCAT('%', :thepromo, '%')
                          AND InvestmentAmount like CONCAT('%', :theinvest, '%')
                          AND CLIENT.EmployeeID = :theemployee
                          AND CLIENT.EmployeeID = EMPLOYEE.EmployeeID";
        }

        $result = $db->prepare($sqlselect);

        $result->bindValue(':thebusiness', $formfield['myBusinessName']);
        $result->bindValue(':theclient', $formfield['myClientPhone']);
        $result->bindValue(':thepromo', $formfield['myPromo']);
        $result->bindValue(':theinvest', $formfield['myInvest']);

        if ($formfield['myEmployeeName'] != '')
        {
            $result->bindValue(':theemployee', $formfield['myEmployeeName']);
        }
        $result->execute();
    }
        else
        {
            $sqlselect = "SELECT CLIENT.*, EMPLOYEE.EmployeeName
                            FROM CLIENT, EMPLOYEE
                            WHERE CLIENT.EmployeeID = EMPLOYEE.EmployeeID";
            $result = $db->prepare($sqlselect);
            $result->execute();
    }
?>
<html>
<body>

    <fieldset><legend>SEARCH</legend>
    <form action = "search.php" method = "post">
        <table>
            <tr>
                <th>Business Name</th>
                <td><input type = "text" name = "businessname" id = "businessname"
                    value = "<?php echo $formfield['myBusinessName']; ?>"</td>
            </tr>

            <tr>
                <th>Client Phone</th>
                <td><input type = "text" name = "clientphone" id = "clientphone"
                           value = "<?php echo $formfield['myClientPhone']; ?>"</td>
            </tr>

            <tr>
                <th>Promotional Consideration</th>
                <td><input type = "text" name = "promo" id = "promo"
                           value = "<?php echo $formfield['myPromo']; ?>"</td>
            </tr>

            <tr>
                <th>Investment Amount</th>
                <td><input type = "text" name = "invest" id = "invest"
                           value = "<?php echo $formfield['myInvest']; ?>"</td>
            </tr>

            <tr>
                <th><label for="employeename">Employee Name:</label></th>
                <td><select name="employeeename" id="employeename">
                        <option value = "">Please Select an Employee</option>
                        <?php while ($rowp = $resultemp->fetch() )
                        {
                            echo '<option value="'. $rowp['EmployeeID'] . '">' . $rowp['EmployeeName'] . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
        </table>
        <input type = "submit" name = "mySubmit" value = "Enter">
    </form></fieldset>

    <table>
        <tr>
            <th>Employee Name</th>
            <th>Business Name</th>
            <th>Client Phone</th>
            <th>Promotional Consideration</th>
            <th>Investment Amount</th>
        </tr>
        <?php
            while ($row = $result->fetch())
            {
                echo'<tr><td>'.$row['EmployeeName'].'</td><td>'
                              .$row['BusinessName'].'</td><td>'
                              .$row['ClientPhone'].'</td><td>'
                              .$row['PromotionalConsideration'].'</td><td>'
                              .$row['InvestmentAmount'].'</td></tr>';
            }
        ?>
    </table>
</body>
</html>
