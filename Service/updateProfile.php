<?php

function updateProfileAdmin($db, $id, $surname, $firstname, $middlename, $email,  $contact, $citizenship, $address, $munipal_bara){
   try{
     $stmt = "UPDATE accounts SET Surname = ?, Firstname =?, Middlename = ?, Email = ?, Contact = ?, Citizenship = ?, place = ?, Munipal_bara = ? WHERE id = ?";

    $stmt = $db->prepare($stmt);
   $stmt->bind_param('ssssssssi',$surname, $firstname, $middlename, $email, $contact, $citizenship, $address, $munipal_bara, $id);

 if ($stmt->execute()) {
  // The query was successful
  echo "<script>window.location.href='adminProfile.php';</script>";
  exit();
 } 
   }catch(Exception $e){
    echo "". $e->getMessage();
}

}
?>