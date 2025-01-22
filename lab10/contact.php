<?php

function PokazKontakt()
{
    echo '<form method="post" action="contact.php?action=send">
            <label for="temat">Temat:</label><br>
            <input type="text" id="temat" name="temat" required><br><br>
            <label for="email">E-mail:</label><br>
            <input type="email" id="email" name="email" required><br><br>
            <label for="tresc">Treść:</label><br>
            <textarea id="tresc" name="tresc" required>Treść wiadomości</textarea><br><br>
            <input type="submit" value="Wyślij">
          </form>';
}

function WyslijMailKontakt($odbiorca = 'email@domena.pl')
{
    if (empty($_POST['temat']) || empty($_POST['tresc']) || empty($_POST['email'])) 
    {
        echo 'Nie wypełniłeś formularza';
        PokazKontakt();
    } 
    else 
    {
        $mail['subject']   = $_POST['temat'];
        $mail['body']      = $_POST['tresc'];
        $mail['sender']    = $_POST['email'];
        $mail['recipient'] = $odbiorca;

        $header  = "From: Formularz kontaktowy <" . $mail['sender'] . ">\n";
        $header .= "MIME-Version: 1.0\n";
        $header .= "Content-Type: text/plain; charset=UTF-8\n";
        $header .= "X-Sender: " . $mail['sender'] . "\n";
        $header .= "X-Mailer: PHP/" . phpversion() . "\n";
        $header .= "X-Priority: 3\n";
        $header .= "Return-Path: " . $mail['sender'] . "\n";

        if (mail($mail['recipient'], $mail['subject'], $mail['body'], $header)) 
        {
            echo 'Wysłano wiadomość';
        } 
        else 
        {
            echo 'Nie można było wysłać wiadomości';
        }
    }
}

function PrzypomnijHaslo()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        $email = $_POST['email'];
        $subject = 'Przypomnienie hasła';
        $message = "Hasło: admin";
        $headers = "Od: admin@domena.pl\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        if (mail($email, $subject, $message, $headers)) 
        {
            echo '<p>Hasło zostało wysłane</p>';
        } 
        else 
        {
            echo '<p>Nie można było wysłać hasła</p>';
        }
    } 
    else 
    {
        echo '<form method="post" action="contact.php?action=remind">
                <label for="email">Podaj swój e-mail:</label><br>
                <input type="email" id="email" name="email" required><br><br>
                <input type="submit" value="Przypomnij hasło">
              </form>';
    }
}


if (isset($_GET['action'])) 
{
    if($_GET['action'] == 'send')
    {
        WyslijMailKontakt();
    }
    elseif($_GET['action'] == 'remind')
    {
        PrzypomnijHaslo();
    }
    else
    {
        PokazKontakt();
    }
} 
else 
{
    PokazKontakt();
}

?>