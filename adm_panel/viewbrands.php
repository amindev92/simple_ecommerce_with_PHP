<?php

include_once("../config/database.php");

?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">R.Num</th>
            <th scope="col">Brand Title</th>
            <th scope="col">
                <a href='index.php?editcategory' class='fa-pen-to-square'>Edit</a>
            </th>
            <th scope="col">
                <a href='index.php?removeCategory' class='fa-pen-to-square'>remove</a>
            </th>
        </tr>
    </thead>
    <tbody>

        <?php

        global $conn;
        $rowCounter = 1;
        $allBrandscommand = "SELECT * FROM brands";
        $brands_result = mysqli_query($conn, $allBrandscommand);
        while ($row = mysqli_fetch_assoc($brands_result)) {
            $brandTitle = $row["brand_title"];
            $brandId = $row["brand_id"];
            echo "<tr>
            <td>$rowCounter</td>
            <td>$brandTitle</td>
            <td> <a href='index.php?editbrand=$brandId' class='fa-pen-to-square'>Edit</a></td>
            <td> <a href='index.php?removebrand=$brandId' class='fa-pen-to-square'>remove</a>
            </th></td>
            </tr>
            ";
            $rowCounter++;
        }

        ?>

     

    </tbody>
</table>