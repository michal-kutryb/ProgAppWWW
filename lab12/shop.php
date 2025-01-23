<h1>Sklep</h1>
<br><br>

<?php
session_start();

require_once 'cfg.php';
require_once 'cart.php';
global $link;


$query = "SELECT * FROM products";
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) > 0) 
{
    echo "<h3> Lista produktów </h3>";
        echo "<table border='4'>
                <tr>
                    <th>id</th>
                    <th>nazwa</th>
                    <th>opis</th>
                    <th>Cena Netto</th>
                    <th>VAT</th>
                    <th>Ilość</th>
                    <th>Kategoria</th>
                    <th>Zdjecie</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['net_price']}</td>
                    <td>{$row['vat']}</td>
                    <td>{$row['quantity']}</td>
                    <td>{$row['category']}</td>
                    <td><img src='../img/".$row['image']."' width='150' height='150'></td>
                  </tr>";
        }
        echo "</table>";
    } 
    else 
    {
        echo "Brak produktów dostępnych w sklepie";
    }

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    if (isset($_POST['add_to_cart']))
     {
        $productId = intval($_POST['product_id']);
        $quantity = intval($_POST['quantity']);
        AddToCart($productId, $quantity);
    } 
    elseif (isset($_POST['remove_from_cart'])) 
    {
        $productId = intval($_POST['product_id']);
        RemoveFromCart($productId);
    }
}
echo "<br><br>";
echo "<h3>Zawartość koszyka</h3>";
ShowCart();

echo "<h3>Dodaj produkt do koszyka</h3>
<form method='POST'>
    id produktu: <input type='number' name='product_id' required><br>
    Ilość: <input type='number' name='quantity' value='1' min='1' required><br>
    <input type='submit' name='add_to_cart' value='Dodaj do koszyka'>
</form>";

echo "<h3>Usuń produkt z koszyka</h3>
<form method='POST'>
    id produktu: <input type='number' name='product_id' required><br>
    <input type='submit' name='remove_from_cart' value='Usuń z koszyka'>
</form>";

?>
