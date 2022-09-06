<html>
  <head>
    <link type="text/css" rel="stylesheet" href="cocktailbar.css" />
  </head>
  <body>
<?php
  $maxNumber = 5;
  $filename = "numbers.txt";
  // Get the old numbers
  $res = fopen($filename, "r") or die("Unable to open file!");
  $oldNumbersMessy = explode("\n", fread($res, filesize("numbers.txt")));
  fclose($res);
  
  // Make the code a bit more robust
  // so we don't depend on the current contents of the file
  for ($i = 0; $i < $maxNumber; $i++) {
    $oldNumbers[$i] = "";
  }

  for ($i = 0; $i < min($maxNumber, count($oldNumbersMessy)); $i++) {
    $oldNumbers[$i] = $oldNumbersMessy[$i];
  }

  $newNumbers = $oldNumbers;

  if ($_POST["number"]) {
    $newNumber = array($_POST["number"]);
    if (!is_numeric($newNumber[0])) {
      die("Send a number");
    }

    unset($oldNumbers[$maxNumber - 1]);

    $newNumbers = array_merge($newNumber, $oldNumbers);
    $newNumbersStr = "";
    foreach ($newNumbers as $num) {
      $newNumbersStr = $newNumbersStr . $num . "\n";
    }
    file_put_contents($filename, $newNumbersStr);
  }
  foreach ($newNumbers as $nr) {
    echo('<h1 style="color:#3399ff" class="numberheader">' . $nr . "</h1>");
  }
  #print_r($newNumbers);

?>

  <footer>
    <form action="<?php $_PHP_SELF ?>" method="POST">
      <input type="text" name="number" maxlength="3" id="inputnumber" autofocus />
      <input type="submit" hidden/>
    </form>
  </footer>
  </body>
  <!--<script>
    document.getElementById("inputNumber").focus();
    document.getElementById("inputNumber").select();
  </script>-->
</html>
