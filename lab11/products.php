<?php
session_start();

require_once 'cfg.php';

function DodajProdukt($title, $description, $creation_date, $expiration_date, $net_price, $vat, $quantity, $available, $category, $size, $image)
{
    global $link;

    if (empty($title) || empty($description) || empty($creation_date) || empty($expiration_date) || empty($net_price) || empty($vat) || empty($quantity) || empty($category) || empty($size)) 
    {
        echo "Formularz nie został wypełniony";
        return;
    }

    $title = mysqli_real_escape_string($link, $title);
    $description = mysqli_real_escape_string($link, $description);

    $query = "INSERT INTO products (title, description, creation_date, expiration_date, net_price, vat, quantity, available, category, size, image) 
              VALUES ('$title', '$description', '$creation_date', '$expiration_date', $net_price, $vat, $quantity, $available, $category, $size, '$image')";

    if (mysqli_query($link, $query)) 
    {
        echo "Dodano produkt";
    } 
    else 
    {
        echo "Wystąpił błąd: " . mysqli_error($link);
    }
}

function UsunProdukt($id)
{
    global $link;

    $query = "DELETE FROM products WHERE id = $id";

    if (mysqli_query($link, $query)) 
    {
        echo "Usunięto produkt";
    } 
    else 
    {
        echo "Wystąpił błąd: " . mysqli_error($link);
    }
}

function EdytujProdukt($id, $title, $description, $modification_date, $net_price, $vat, $quantity, $available, $category, $size, $image)
{
    global $link;

    if (empty($title) || empty($description) || empty($net_price) || empty($vat) || empty($quantity) || empty($category) || empty($size)) 
    {
        echo "Formularz nie został wypełniony";
        return;
    }

    $title = mysqli_real_escape_string($link, $title);
    $description = mysqli_real_escape_string($link, $description);
    $imagePart = $image ? ", image = '$image'" : "";

    $query = "UPDATE products SET title = '$title', description = '$description', creation_date = '$modification_date', 
              net_price = $net_price, vat = $vat, quantity = $quantity, available = $available, category = $category, size = $size $imagePart
              WHERE id = $id";

    if (mysqli_query($link, $query)) 
    {
        echo "Zaaktualizowano produkt";
    } 
    else 
    {
        echo "Wystąpił błąd: " . mysqli_error($link);
    }
}

function PokazProdukty()
{
    global $link;

    $query = "SELECT * FROM products";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) > 0) 
    {
        echo "<table border='4'>
                <tr>
                    <th>id</th>
                    <th>nazwa</th>
                    <th>opis</th>
                    <th>Data Utworzenia</th>
                    <th>Data Wygaśnięcia</th>
                    <th>Cena Netto</th>
                    <th>VAT</th>
                    <th>Ilość</th>
                    <th>Dostępność</th>
                    <th>Kategoria</th>
                    <th>Rozmiar</th>
                    <th>Obraz</th>
                    <th></th>
                </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['creation_date']}</td>
                    <td>{$row['expiration_date']}</td>
                    <td>{$row['net_price']}</td>
                    <td>{$row['vat']}</td>
                    <td>{$row['quantity']}</td>
                    <td>" . ($row['available'] ? 'Tak' : 'Nie') . "</td>
                    <td>{$row['category']}</td>
                    <td>{$row['size']}</td>
                    <td><img src='../img/".$row['image']."' width='50' height='50'></td>
                    <td>
                        <a href='?delete={$row['id']}'>Usuń</a>
                        <a href='?edit={$row['id']}'>Edytuj</a>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } 
    else 
    {
        echo "Nie ma produktów";
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    if (isset($_POST['add'])) 
    {
        $available = isset($_POST['available']) ? 1 : 0;
        DodajProdukt($_POST['title'], $_POST['description'], $_POST['creation_date'], $_POST['expiration_date'], $_POST['net_price'], $_POST['vat'], $_POST['quantity'], $available, $_POST['category'], $_POST['size'], $_POST['image']);
    } 
    elseif (isset($_POST['update'])) 
    {
        EdytujProdukt($_POST['id'], $_POST['title'], $_POST['description'], $_POST['modification_date'], $_POST['net_price'], $_POST['vat'], $_POST['quantity'], $_POST['available'], $_POST['category'], $_POST['size'], $_POST['image']);
    }
}

if (isset($_GET['delete'])) 
{
    UsunProdukt($_GET['delete']);
}

echo "<h2>Dodaj Produkt</h2>
<form method='POST' enctype='multipart/form-data'>
    Tytuł: <input type='text' name='title'><br>
    Opis: <textarea name='description'></textarea><br>
    Data Utworzenia: <input type='date' name='creation_date'><br>
    Data Wygaśnięcia: <input type='date' name='expiration_date'><br>
    Cena Netto: <input type='number' step='0.01' name='net_price'><br>
    VAT: <input type='number' step='0.01' name='vat'><br>
    Ilość: <input type='number' name='quantity'><br>
    Dostępność: <input type='checkbox' name='available' value='1'><br>
    Kategoria: <input type='number' name='category'><br>
    Rozmiar: <input type='number' step='0.01' name='size'><br>
    Obraz: <input type='text' name='image'><br>
    <input type='submit' name='add' value='Dodaj Produkt'>
</form>";

PokazProdukty();

if (isset($_GET['edit'])) 
{
    $id = intval($_GET['edit']);
    $query = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($link, $query);
    $product = mysqli_fetch_assoc($result);
    if ($product) 
    {
        echo "<h2>Edytuj Produkt</h2>
        <form method='POST' enctype='multipart/form-data'>
            <input type='hidden' name='id' value='{$product['id']}'>
            Tytuł: <input type='text' name='title' value='{$product['title']}'><br>
            Opis: <textarea name='description'>{$product['description']}</textarea><br>
            Data Modyfikacji: <input type='date' name='modification_date' value='" . date('Y-m-d') . "'><br>
            Cena Netto: <input type='number' step='0.01' name='net_price' value='{$product['net_price']}'><br>
            VAT: <input type='number' step='0.01' name='vat' value='{$product['vat']}'><br>
            Ilość: <input type='number' name='quantity' value='{$product['quantity']}'><br>
            Dostępność: <input type='checkbox' name='available' value='1' " . ($product['available'] ? 'checked' : '') . "><br>
            Kategoria: <input type='number' name='category' value='{$product['category']}'><br>
            Rozmiar: <input type='number' step='0.01' name='size' value='{$product['size']}'><br>
            Obraz: <input type='text' name='image' value='{$product['image']}'><br>
            <input type='submit' name='update' value='Zaktualizuj Produkt'>
        </form>";

        echo '<form action="products.php">
                <input type="submit" value="Anuluj" />
            </form>';
    } 
    else 
    {
        echo "niema produktu o podanym id: $id";
    }
}

echo '<form action="admin.php">
        <input type="submit" value="Powrót do panelu administracyjnego" />
    </form>';

?>