<?php

session_start();
require_once 'cfg.php';

if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true) 
{
    echo "<p>Brak uprawnień do tej strony</p>";
    exit;
}

function DodajKategorie($nazwa, $matka = 0) 
{
    global $link;

    $query = "INSERT INTO categories (matka, nazwa) VALUES ('$matka', '$nazwa')";

    if (mysqli_query($link, $query)) 
    {
        echo "Pomyślnie dodano kategorie<br>";
    } 
    else 
    {
        echo "Wystąpił błąd: " . mysqli_error($link) . "<br>";
    }
}

function UsunKategorie($id) 
{
    global $link;

    $query = "DELETE FROM categories WHERE id = $id OR matka = $id";

    if (mysqli_query($link, $query)) 
    {
        echo "Pomyślnie usunieto kategorie wraz z jej podkategoriami <br>";
    } 
    else 
    {
        echo "Wystąpił błąd: " . mysqli_error($link) . "<br>";
    }
}

function EdytujKategorie($id, $nazwa, $matka = 0) 
{
    global $link;

    $query = "UPDATE categories SET nazwa = '$nazwa', matka = $matka WHERE id = $id";

    if (mysqli_query($link, $query)) 
    {
        echo "Pomyślnie zaaktualizowano kategorie<br>";
    } 
    else 
    {
        echo "Wystąpił błąd: " . mysqli_error($link) . "<br>";
    }
}

function PokazKategorie($matka = 0) 
{
    global $link;

    $query = "SELECT id, nazwa FROM categories WHERE matka = $matka";
    $result = mysqli_query($link, $query);

    while ($row = mysqli_fetch_assoc($result)) 
    {
        echo $row['id'] . " | " . htmlspecialchars($row['nazwa']) . " | <a href='?usun=" . $row['id'] . "'>Usuń</a> | <a href='?edytuj=" . $row['id'] . "'>Edytuj</a><br>";

        $subquery = "SELECT id, nazwa FROM categories WHERE matka = " . $row['id'];
        $subresult = mysqli_query($link, $subquery);

        if (mysqli_num_rows($subresult) > 0) 
        {
            echo "<ul>";

            while ($subrow = mysqli_fetch_assoc($subresult)) 
            {
                echo "<li>".$subrow['id'] . " | " . htmlspecialchars($subrow['nazwa']) . " | <a href='?usun=" . $subrow['id'] . "'>Usuń</a> | <a href='?edytuj=" . $subrow['id'] . "'>Edytuj</a></li>";
            }

            echo "</ul>";
        }
    }
}

if (isset($_POST['dodaj'])) 
{
    DodajKategorie($_POST['nazwa'], $_POST['matka']);
} 
elseif (isset($_GET['usun'])) 
{
    UsunKategorie($_GET['usun']);
} 
elseif (isset($_POST['edytuj'])) 
{
    EdytujKategorie($_POST['id'], $_POST['nazwa'], $_POST['matka']);
}

echo "<h3>Dodawanie Kategorii:</h3>";
echo "<form method='POST'>";
echo "Nazwa: <input type='text' name='nazwa' required><br>";
echo "Matka: <input type='number' name='matka' value='0'><br>";
echo "<input type='submit' name='dodaj' value='Dodaj kategorię'>";
echo "</form>";

if (isset($_GET['edytuj'])) 
{
    $id = (int)$_GET['edytuj'];
    $query = "SELECT nazwa, matka FROM categories WHERE id = $id";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);

    echo "<h3>Edycja kategorii:</h3>";
    echo "<form method='POST'>";
    echo "<input type='hidden' name='id' value='" . $id . "'>";
    echo "Nazwa: <input type='text' name='nazwa' value='" . htmlspecialchars($row['nazwa']) . "' required><br>";
    echo "Matka: <input type='number' name='matka' value='" . $row['matka'] . "'><br>";
    echo "<input type='submit' name='edytuj' value='Edytuj kategorię'>";
    echo "</form>";
    echo '<form action="categories.php">
        <input type="submit" value="Anuluj" />
    </form>';

}

echo "<h3>Lista Kategorii:</h3>";
PokazKategorie();

echo '<form action="admin.php">
        <input type="submit" value="Powrót do panelu administracyjnego" />
    </form>';

?>