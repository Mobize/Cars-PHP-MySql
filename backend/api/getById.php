<?php
require 'connect.php';

// Get the posted data.
$postdata = file_get_contents("php://input");
if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);
	
  // Validate.
  if(trim($request->unique_id) == '')
  {
    return;
  }
    
  // Sanitize.
  $uid   = mysqli_real_escape_string($con, trim($request->unique_id));

  // Get by id.
  $sql = "SELECT * FROM `cars` WHERE `unique_id` ='{$uid}' LIMIT 1";

  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_assoc($result);
  
  $json = json_encode($row);
  echo $json;
}
exit;