<?php
session_start();

require_once 'cfg.php';

function AddToCart($productId, $quantity) 
{
    global $link;

    $query = "SELECT * FROM products WHERE id = $productId";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) > 0) 
    {
        $product = mysqli_fetch_assoc($result);
        if (!isset($_SESSION['cart'])) 
        {
            $_SESSION['cart'] = [];
        }
        if (isset($_SESSION['cart'][$productId])) 
        {
            $_SESSION['cart'][$productId]['quantity'] += $quantity;
        } 
        else 
        {
            $_SESSION['cart'][$productId] = [
                'id' => $product['id'],
                'image' => $product['image'],
                'title' => $product['title'],
                'net_price' => $product['net_price'],
                'vat' => $product['vat'],
                'quantity' => $quantity
            ];
        }

        echo "Dodano produkt do koszyka";
    } 
    else 
    {
        echo "Produkt nie istnieje";
    }
}

function RemoveFromCart($productId) 
{
    if (isset($_SESSION['cart'][$productId])) 
    {
        unset($_SESSION['cart'][$productId]);
        echo "Usunięto produkt z koszyka.";
    } 
    else 
    {
        echo "Produkt nie jest w koszyku.";
    }
}

function ShowCart() 
{
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) 
    {
        $total = 0;
        echo "<table border='1'>
                <tr>
                    <th>id Produktu</th>
                    <th>Produkt</th>
                    <th>Zdjecie</th>
                    <th>Ilość</th>
                    <th>Cena Netto</th>
                    <th>VAT</th>
                    <th>Cena Brutto</th>
                </tr>";

        foreach ($_SESSION['cart'] as $productId => $item) 
        {
            $netPrice = $item['net_price'];
            $vat = $item['vat'];
            $quantity = $item['quantity'];
            $finalPrice = ($netPrice + ($netPrice * $vat / 100)) * $quantity;
            $total += $finalPrice;

            echo "<tr>
                    <td>{$item['id']}</td>
                    <td>{$item['title']}</td>
                    <td><img src='../img/".$item['image']."' width='100' height='100'></td>
                    <td>{$quantity}</td>
                    <td>{$netPrice}</td>
                    <td>{$vat}%</td>
                    <td>" . number_format($finalPrice, 2) . "</td>
                  </tr>";
        }

        echo "<tr>
                <td colspan='4'><strong>Łączna wartość:</strong></td>
                <td><strong>" . number_format($total, 2) . "</strong></td>
              </tr>
            </table>";
    } 
    else 
    {
        echo "Koszyk jest pusty.";
    }
}

?>