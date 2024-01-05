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
        $rowCounter = 1 ;
        $allCategoriescommand = "SELECT * FROM categories";
        $categories_result = mysqli_query($conn, $allCategoriescommand);
        while ($row = mysqli_fetch_assoc($categories_result)) {
            $categoryTitle = $row["category_title"];
            $categoryId = $row["category_id"];
            echo "<tr>
            <td>$rowCounter</td>
            <td>$categoryTitle</td>
            <td> <a href='index.php?editcategory=$categoryId' class='fa-pen-to-square'>Edit</a></td>
            <td> <a href='index.php?removeCategory=$categoryId' class='fa-pen-to-square'>remove</a>
            </th></td>
            </tr>
            ";
            $rowCounter++;

        }

        ?>

    </tbody>
</table>