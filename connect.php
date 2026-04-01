
<?php

$conn=mysqli_connect("localhost","root","","singadb");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
// Auto-migrate: add views column if not already present (MariaDB 10.0+)
@mysqli_query($conn, "ALTER TABLE article ADD COLUMN IF NOT EXISTS `views` INT UNSIGNED NOT NULL DEFAULT 0");
  ?>