<?php
include("GraphGenerator.php");
if(isset($_GET['submit'])) {
    if($_GET["aaa"]<$_GET["bbb"]) {




        $domainStart = intval($_GET["aaa"]);
        $domainEnd = intval($_GET["bbb"]);

        $polynomial = [intval($_GET["ccc"]), intval($_GET["ddd"]), intval($_GET["eee"]), intval($_GET["fff"])];


        $gg = new GraphGenerator();
        $gg->run($domainStart,$domainEnd,$polynomial);

        echo "<p>".$polynomial[3]."*x^3 + ".$polynomial[2]."*x^2 + ".$polynomial[1]."x + ".$polynomial[0]."</p>";
        echo "<img src='img/0.jpg'>";

    }else {
        echo "wartość początku przedziału musi być niższa niż jego koniec!!!";
    }
}



function decimalPlaces($x){
    $x = abs($x);
    $result =0;
    while($x<1){
        $x*=10;
        $result++;
    }
    return $result;


}





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
    </style>
    <meta charset="UTF-8">
    <title>Wykres</title>
</head>
<body>
<form method="get" action="index.php">
    <p>Dla a*x^3 + b*x^2 + c*x + d Podaj:</p>
    <p>Początek przedziału:</p>
    <input type="number" step="any" name="aaa" required>
    <br><p>Koniec przedziału:</p>
    <input type="number" step="any" name="bbb" required>
    <br><p>Zmienna a:</p>
    <input type="number" step="any" name="fff" required>
    <br><p>Zmienna b:</p>
    <input type="number" step="any" name="eee" required>
    <br><p>Zmienna c:</p>
    <input type="number" step="any" name="ddd" required>
    <br><p>Zmienna d:</p>
    <input type="number" step="any" name="ccc" required>
    <br>
    <input type="submit" name="submit">
</form>
</body>
</html>
