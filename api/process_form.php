<?php
// Check if the form is submitted
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    
    $club_name = $_POST['club_name'];
    $event_action = $_POST['event_action'];
    $event_date = $_POST['event_date'];
    $event_name = $_POST['event_name']; // Assuming this is the name of the event to add/delete/update
    
    // Perform validation if needed
    
  //  include("connect.php");
    // Create connection
    $conn = mysqli_connect("localhost","root","","Clubs") or die("connection failed");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Perform actions based on event action
    if (isset($_POST['event_action'])) {
        $event_action = strtolower(trim($_POST['event_action']));
    switch ($event_action) {
        case 'add':
            // Perform insertion into the database
            $sql = "INSERT INTO events (club_name, event_name, event_date) VALUES ('$club_name', '$event_name', '$event_date')";
            if ($conn->query($sql) === TRUE) {
                echo "Event added successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            break;
        case 'delete':
            // Perform deletion from the database
            $sql = "DELETE FROM events WHERE club_name='$club_name' AND event_name='$event_name'";
            if ($conn->query($sql) === TRUE) {
                echo "Event deleted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            break;
        case 'update':
            // Perform update in the database
          //  $sql = "UPDATE events SET event_date='$event_date' WHERE club_name='$club_name' AND event_name='$event_name'";
            $sql = "UPDATE events SET event_date='date($event_date)' WHERE club_name='$club_name' AND event_name='$event_name'";

            if ($conn->query($sql) === TRUE) {
                echo "Event updated successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            break;
        default:
            echo "Invalid event action" ;
    }
    }
    // Close connection
    $conn->close();
//} else {
    // If the form is not submitted, redirect or display an error message
    //echo "Form not submitted";
//}
?>
