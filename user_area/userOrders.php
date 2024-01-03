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
        // if ($numberOrders > 0) {
        while ($orderInfo = mysqli_fetch_array($fetchOrderQuery)) {
            $amount_due = $orderInfo["amount_due"];
            $totalProducts = $orderInfo["total_products"];
            $invoiceNumber = $orderInfo["invoice_number"];
            $date = $orderInfo["order_date"];
            $status = $orderInfo["order_status"];
            $order_id = $orderInfo["order_id"];

            echo "<tr>
                        <th scope='row'>$counter</th>
                        <td>$amount_due</td>
                        <td>$totalProducts</td>
                        <td>$invoiceNumber</td>
                        <td>$date</td>
                        <td>$status</td>";

            if ($status == "complete") {
                echo "<td> <a href='#' class='text-secondary'>Paid</a>
                            </td>
                         </tr>";
                $counter++;
            } else {
                echo "<td> <a href='confirmPayment.php?order_id=$order_id' class='text-secondary'>Confirm</a>
                            </td>
                         </tr>";
                $counter++;
            }
        }
        // }

        ?>
    </tbody>
</table>