<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col">Number</th>
            <th scope="col">Amount Due</th>
            <th scope="col">Total Products</th>
            <th scope="col">Invoice number</th>
            <th scope="col">Date</th>
            <th scope="col">Complete/Incomplete</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php

        $counter = 1;
        $user_name = $_SESSION["user_name"];
        $selectUserQuery = "SELECT * FROM person WHERE user_name = '$user_name'";
        $fetchUserQuery = mysqli_query($conn, $selectUserQuery);
        $personInfo = mysqli_fetch_array($fetchUserQuery);
        $user_id = $personInfo['user_id'];

        $selectOrderQuery = "SELECT * FROM user_orders WHERE user_id = '$user_id'";
        $fetchOrderQuery = mysqli_query($conn, $selectOrderQuery);
        $numberOrders = mysqli_num_rows($fetchOrderQuery);
        $personInfo = mysqli_fetch_array($fetchOrderQuery);
        // if ($numberOrders > 0) {
            while ($personInfo = mysqli_fetch_array($fetchOrderQuery)) {
                $amount_due = $personInfo["amount_due"];
                $totalProducts = $personInfo["total_products"];
                $invoiceNumber = $personInfo["invoice_number"];
                $date = $personInfo["order_date"];
                $status = $personInfo["order_status"];

                echo "
                <tr>
                    <th scope='row'>$counter</th>
                    <td>$amount_due</td>
                    <td>$totalProducts</td>
                    <td>$invoiceNumber</td>
                    <td>$date</td>
                    <td>$status</td>
                    <td>        <a href='confirmPayment.php' class='text-secondary'>Confirm</a>
                    </td>
                </tr>
                ";
                $counter++;
            }
        // }

        ?>
    </tbody>
</table>