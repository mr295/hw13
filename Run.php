<html>
<head>
</head>
<body>

<form action="Run.php" method="get">
Search for the make:   <input type="text" name="make" placeholder = "Ford, Toyota, Acura">
<input type="submit" value="Submit"><br>
</form>

<?php

  include_once('CSVException.php');
  
  $h = new CSVExceptionHandling();
  
  $file="cars1.csv";

  $csv= file_get_contents($file);
  
  echo '<br>Below is the list of Cars available: <br><br>';
  
  $array = array_map("str_getcsv", explode("\n", $csv));
  $json = json_encode($array);

  print_r($json);
  
  echo '<br><br>Below Are your search Results:<br> <br>';

  $make = $_GET["make"];
  
  $handler = fopen("cars1.csv", "r");
  $mainarray = array();
  while (!feof($handler) ) {

    $line_of_text = fgetcsv($handler, 1024);
    
    if($line_of_text[0] == $make){
      $a = array($line_of_text[0], $line_of_text[1], $line_of_text[2]);
      array_push($mainarray, $a);
    }
  }
  $j = json_encode($mainarray);
  print_r($j);
  fclose($handler);
  
  echo '<br><br>';
  if (($h->exists('out.csv')) and ($h->canWrite('out.csv'))){
    $fo = fopen('out.csv', 'w');
    foreach($mainarray as $car){
      fputcsv($fo, $car);
    }
    echo 'Successfully wrote to file.';
    fclose($fo);
  }
?>
</body>
</html>