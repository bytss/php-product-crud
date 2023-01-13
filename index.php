<?php
include('./db_connect.php');

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
        <h3>Please choose your order: </h3>
        <table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>DESCRIPTION</td>
                    <td>BRAND</td>
                    <td>PRICE</td>
                </tr>
            </thead>
            <tbody>
                <?php
                // execute sql command 
                $sql = "SELECT * FROM `product_list`";
                $result = mysqli_query($conn, $sql);

                // check results 
                if (mysqli_num_rows($result) > 0) {
                    // fetch result with associative array
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . $row['description'] . '</td>';
                        echo '<td>' . $row['brand'] . '</td>';
                        echo '<td>₱ ' . $row['price'] . '.00</td>';
                        echo '</tr>';
                    }
                } else {
                    // display 0 results
                }
                ?>
            </tbody>
        </table>
    </div>
    <section class="forms">
        <form action="payment.php" method="POST">
            <label for="id">Enter ID:</label>
            <input type="text" name="id" id="id" required>
            <label for="qty">Enter Qty:</label>
            <input type="number" name="qty" id="qty" required>
            <div class="buttons">
                <input type="submit" name="submit" value="TAKE ORDER">
                <input type="reset" value="CLEAR">
            </div>
        </form>
    </section>
</body>

</html>

<?php
// close connection
mysqli_close($conn);
?>