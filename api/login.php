<?php
    session_start();
    include("connect.php");
    
    // Assuming $connect is your database connection object
    
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    // Prepare the query using a prepared statement
    $query = "SELECT * FROM user_admin WHERE mail = ? AND password = ?";
    $statement = mysqli_prepare($connect, $query);
    
    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($statement, "ss", $mail, $password);
    
    // Execute the prepared statement
    mysqli_stmt_execute($statement);
    
    // Get the result
    $result = mysqli_stmt_get_result($statement);
    
    if(mysqli_num_rows($result) > 0) {
        $userdata = mysqli_fetch_array($result); 
        $groups = mysqli_query($connect,"SELECT * FROM user_admin");
        $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC); 

        $_SESSION['userdata'] = $userdata;
        $_SESSION['groupsdata'] = $groupsdata;

        echo '
        <script>
        alert("Success");
        window.location = "../routes/event.html";
        </script>
    ';
    
    }
    else {
        echo '
        <script>
            alert("Invalid Credentials or User Not found");
            window.location = "../routes/event.html";
        </script>
    ';
    }
?>
