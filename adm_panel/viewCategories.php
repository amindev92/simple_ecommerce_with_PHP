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
            <td> <a class='fa-pen-to-square' type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal'>remove</a>
            </th></td>
            </tr>
            ";
            $rowCounter++;

        }

        ?>

    </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">
            <a href="index.php?removeCategory=<?php echo $categoryId; ?>">Yes</a>
        </button>
      </div>
    </div>
  </div>
</div>