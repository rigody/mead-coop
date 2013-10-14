<?php
  if (!count($text))
    echo "<p>No suggestions!</p>";
  else
  {
    foreach ($text as $t)
      echo "<p>$t</p>";
  }
?>
