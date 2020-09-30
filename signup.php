<?php

$file = fopen("ac.csv","a");

$x = array (
  array($_POST["account"], $_POST["password"]),
);


foreach ($x as $line) {
   fputcsv($file, $line);
}
echo "Sign up successfully!";
fclose($file);
?>