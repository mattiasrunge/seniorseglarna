<?php

function Helper_RunQuery($query)
{
  global $gDatabase;

  if (($result = $gDatabase->query($query)) === FALSE)
  {
    throw new Exception($gDatabase->error . ": " . $query);
  }
}

?>