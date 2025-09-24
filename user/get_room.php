<?php
include '../db_connect.php';
if (isset($_GET['guesthouse_id'])) {
    $guesthouse_id = intval($_GET['guesthouse_id']);
    $stmt=$conn->prepare("SELECT id, room_id FROM rooms where guesthouse_id = ? ORDER BY room_id");
    $stmt->bind_param("i",$guesthouse_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()){
            echo'<option value ="' . intval($row['id']) . '">' . htmlspecialchars($row['room_id']) . '</option>';
         } 
        } else{
           echo'<option value ="">NO rooms available</option>';  
         }
        $stmt->close();
   }

?>

