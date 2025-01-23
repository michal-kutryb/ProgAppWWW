<?php

$nr_indeksu = '169326';
$nrGrupy = '2';

echo('Michał Kutryb '.$nr_indeksu.' grupa '.$nrGrupy.'<br/><br/>');

echo <<< EOT
    <h3>Zastosowanie metody include() i require_once()</h3>
    <p>Metody te stosuje się aby dołączyć kod php z innego pliku do pliku w którym chcemy działanie kodu wyświetlić. <br/>
    Metoda include(), dołącza plik podany jako argument, może wyświetlić ten sam plik wielokrotnie. <br/>
    Natomiast metoda require_once() dołączając plik, sprawdza czy nie był on już dołączony i nie wyswietla duplikatów.</p>

    <h3>Warunki if, else, elseif, switch</h3>
    <p>Warunki w PHP pozwalają na podejmowanie decyzji w kodzie, wykonując określone bloki kodu w zależności od spełnienia lub niespełnienia zadanych kryteriów. <br/>
    Instrukcja if w PHP sprawdza, czy dane wyrażenie jest prawdziwe (true). Jeśli warunek jest spełniony, wykonywany jest określony blok kodu. <br/>
    Instrukcja else działa w parze z if. Wykonuje blok kodu, jeśli poprzedni warunek if nie został spełniony. <br/>
    Instrukcja elseif umożliwia sprawdzanie dodatkowych warunków, jeśli poprzednie wyrażenia if lub elseif były fałszywe (false). Można jej użyć wielokrotnie w jednej instrukcji warunkowej. <br/>
    Instrukcja switch jest alternatywą dla if...elseif...else w sytuacjach, gdy sprawdzamy wartość jednej zmiennej lub wyrażenia na wiele sposobów. <br/>
    switch porównuje wartość z każdym przypadkiem (case). Jeśli znajdzie zgodność, wykonuje blok kodu przypisany do danego case. break kończy wykonanie danego przypadku. </p>

    <h3>Pętla while() i for()</h3>
    <p>Pętle w PHP umożliwiają wielokrotne wykonanie fragmentu kodu, dopóki spełniony jest określony warunek, co pozwala efektywnie przetwarzać zbiory danych. <br/>
    Pętla while wykonuje kod, dopóki zadany warunek jest prawdziwy. <br/>
    Pętla for wykonuje kod określoną liczbę razy, z kontrolą nad warunkiem początkowym, końcowym i krokiem. <br/></p>
EOT;

echo '<h3>Typy zmiennych $_GET, $_POST, $_SESSION</h3>';
echo '<p>W PHP istnieją różne typy zmiennych superglobalnych, które służą do przekazywania danych między stronami i zarządzania stanem aplikacji. <br/>';
echo 'Tablica $_GET przechowuje dane przekazane metodą GET, czyli w adresie URL, co jest przydatne do pobierania informacji widocznych dla użytkownika. <br/>';
echo 'Tablica $_POST przechowuje dane przesyłane metodą POST, co pozwala bezpieczniej przekazywać informacje, takie jak dane z formularzy. <br/>';
echo 'Tablica $_SESSION pozwala przechowywać dane po stronie serwera przez całą sesję użytkownika, co umożliwia zachowanie informacji między różnymi podstronami. <br/>';
?>