<?php
// database connection
include('conn.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Payment (MySQL)</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <td>TRANSACTION ID</td>
                    <td>DESCRIPTION</td>
                    <td>BRAND</td>
                    <td>PRICE</td>
                    <td>TOTAL PRICE</td>
                </tr>
            </thead>
            <tbody>
                <?php
                // check if the submit button is set
                if (isset($_POST['submit'])) {
                    $id = $_POST['id'];
                    $qty = $_POST['qty'];

                    /* query the sql where the inserted id by the user is existed on the database */
                    $sql = "SELECT * FROM `product_list` WHERE id='$id' LIMIT 1";
                    $result = $conn->query($sql);

                    // check if the id is exist on the product_list table
                    if ($result->num_rows > 0) {
                        // sql results
                        $row = $result->fetch_assoc();
                        $product_description = $row['description'];
                        $product_brand = $row['brand'];
                        $product_price = $row['price'];

                        // total price based on the quantity inserted by the user
                        $total = $product_price * $qty;

                        // sql query order list to insert data
                        $sql_order = "INSERT INTO `order_list` (product_id, product_qty, product_description, product_total) VALUES ('$id', '$qty', '$product_description', '$total')";

                        // do sql query
                        if ($conn->query($sql_order)) {
                            // when the id is exsited
                            echo '<tr>';
                            echo '<td>' . $id . '</td>';
                            echo '<td>' . $product_description . '</td>';
                            echo '<td>' . $product_brand . '</td>';
                            echo '<td>' . $product_price . '</td>';
                            echo '<td>' . $total . '</td>';
                            echo '</tr>';
                        } else {
                            // when has an error
                            echo '<tr>';
                            echo '<td colspan="5">An error occured</td>';
                            echo '</tr>';
                        }
                    } else {
                        // diplay can't found the inserted product's id
                        echo '<tr>';
                        echo '<td colspan="5">An error occured, ID inserted was wrong</td>';
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>