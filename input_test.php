<html>
<body>
<form action="input_test.php" method="get">
<input type="text" name="search" size="40" required="required"/><button>run</button>
</form>

<?php
$myfile = @fopen("/home/ask/PycharmProjects/DistilKoBERT/input.txt", "w");
fwrite($myfile, $_GET[search]);
fclose($myfile);

exec("sudo -u www-data python3 /home/ask/PycharmProjects/DistilKoBERT/input_test.py &");

$handle = @fopen("/home/ask/PycharmProjects/DistilKoBERT/result.txt", "r");
if(!$handle) die("Not Found!");

for ($i=0 ; !feof($handle) ; $i++) { 
    $buffer[$i] = fgets($handle, 1000);
    echo $buffer[$i]."<br/>";
}

fclose($handle);
?>

<p>INPUT: <?php echo $_GET["search"]; ?></p>
</body>
</html>