<?php
session_start();
require_once('cfg.php');

function FormularzLogowania()
{
    $wynik = "
    <div class='logowanie'>
        <h1 class='heading'>Panel CMS:</h1>
        <div class='logowanie'>
            <form method='post' name='LoginForm' enctype='multipart/form-data' action='" . $_SERVER['REQUEST_URI'] . "'>
                <table class='logowanie'>
                    <tr>
                        <td class='log4_t'>login</td>
                        <td><input type='text' name='login_name' class='logowanie' /></td>
                    </tr>
                    <tr>
                        <td class='log4_t'>hasło</td>
                        <td><input type='password' name='login_pass' class='logowanie' /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type='submit' name='login_submit' class='logowanie' value='zaloguj' /></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    ";
    return $wynik;
}

function UsunPodstrone()
{
    global $link;
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
        $id = (int)$_POST['delete_id'];
        $query = "DELETE FROM page_list WHERE id = $id LIMIT 1";

        if (mysqli_query($link, $query)) {
            echo '<p>usunięto żądaną podstronę</p>';
        } else {
            echo '<p>Usuwanie nie powiodło się</p>';
        }

        echo '<form action="admin.php">
            <input type="submit" value="Powrót do admin panelu" />
        </form>';
    }
}

function ListaPodstron()
{
    global $link;

    $query = "SELECT id, page_title FROM page_list LIMIT 100";
    $result = mysqli_query($link, $query);

    echo '<table>
            <tr>
                <th>id</th>
                <th>Tytuł strony</th>
                <th>Czynności</th>
            </tr>';

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['page_title'] . '</td>';
        echo '<td> 
                <form method="get" action="' . $_SERVER['PHP_SELF'] . '">
                    <input type="hidden" name="edit_id" value="' . $row['id'] . '">
                    <button type="submit">Edytuj</button>
                </form>
                <form method="post">
                    <input type="hidden" name="delete_id" value="' . $row['id'] . '">
                    <button type="submit" name="delete">Usuń</button>
                </form>
              </td>
              </tr>';
    }

    echo '</table>';   
}

function EdytujPodstrone($id)
{
    global $link;
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) 
    {
        $tytul = mysqli_real_escape_string($link, $_POST['title']);
        $tresc = mysqli_real_escape_string($link, $_POST['data']);
        $status = isset($_POST['status']) ? 1 : 0;

        $query = "UPDATE page_list SET page_title = '$tytul', page_content = '$tresc', status = $status WHERE id = $id LIMIT 1";
        if (mysqli_query($link, $query)) {
            echo '<p>Pomyślnie Edytowano</p>';
        } else {
            echo '<p>Nie udało się edytować strony</p>';
        }
    } 
    else 
    {
        $query = "SELECT page_title, page_content, status FROM page_list WHERE id = $id LIMIT 1";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_assoc($result);

        echo '<form method="post">
                <label for="title">Tytuł:</label><br>
                <input type="text" id="title" name="title" value = "'.htmlspecialchars($row['page_title']).'" required><br><br>
                <label for="data">Treść:</label><br>
                <textarea id="data" name="data" required>'.htmlspecialchars($row['page_content']).'</textarea><br><br>
                <label for="status">Status:</label>
                <input type="checkbox" id="status" name="status" value = "'.htmlspecialchars($row['status']).'"><br><br>
                <input type="submit" value="Zapisz Zmiany">
              </form>';
    }

    echo    '<form action="admin.php">
                        <input type="submit" value="Powrót do admin panelu" />
                    </form>';
}

function DodajNowaPodstrone()
{
    global $link;
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) 
    {
        $title = mysqli_real_escape_string($link, $_POST['title']);
        $data = mysqli_real_escape_string($link, $_POST['data']);
        $status = isset($_POST['status']) ? 1 : 0;

        $query = "INSERT INTO page_list (page_title, page_content, status) VALUES ('$title', '$data', $status)";
        if (mysqli_query($link, $query)) {
            echo '<p>Pomyślnie dodano</p>';
        } else {
            echo '<p>Nie udało się dodać strony</p>';
        }
    } 
    else 
    {
        echo '<form method="post">
                <label for="title">Tytuł:</label><br>
                <input type="text" id="title" name="title" required><br><br>
                <label for="data">Treść:</label><br>
                <textarea id="data" name="data" required></textarea><br><br>
                <label for="status">Status:</label>
                <input type="checkbox" id="status" name="status"><br><br>
                <input type="submit" value="Dodaj Podstronę">
              </form>';
    }

    echo '<form action="admin.php">
            <input type="submit" value="Powrót do admin panelu" />
        </form>';
}

if (isset($_POST['login_submit'])) 
{
    $Login = $_POST['login_name'];
    $Password = $_POST['login_pass'];

    if ($Login == $login && $Password == $pass) 
    {
        $_SESSION['logged'] = true;
        echo "<p>Logowanie powiodło się</p>";
    } 
    else 
    {
        echo FormularzLogowania();
        echo "<p>Logowanie nie powiodło się, spróbuj ponownie</p>";
        exit;
    }
}
if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true) 
{
    echo FormularzLogowania();
    echo "<p>Logowanie do panelu administracyjnego</p>";
    exit;
}

if (isset($_GET['edit_id'])) 
{
    EdytujPodstrone((int)$_GET['edit_id']);
} 
elseif (isset($_GET['add_page'])) 
{
    DodajNowaPodstrone();
} 
else 
{
    echo "<h2>Panel Administracyjny</h2>";

    echo '<form action="index.php">
            <input type="submit" value="Powrót na strone" />
        </form>';

    UsunPodstrone();
    ListaPodstron();

    echo '<br><a href="?add_page=1">Dodaj nową podstronę</a>';

    echo '<form action="categories.php">
            <input type="submit" value="Zarządzanie kategoriami" />
        </form>';

    echo '<form action="products.php">
            <input type="submit" value="Zarządzanie produktami" />
        </form>';
}
?>