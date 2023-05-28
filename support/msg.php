<div class="chat-messages" id="refreshSection">
    <?php
    include('database.php');
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Retrieve the user ID from the session
    $my_id = $_SESSION['user_id'];

    // Retrieve the email from the session
    $email = $_SESSION['email'];

    // Retrieve the user type from the session
    $my_type = $_SESSION['user_type'];

    $otherid= "1";

    // Retrieve the email from the session
    $othername="admin";

    // Retrieve the user type from the session
    $othertype="admin";


    // SQL query to retrieve messages from the database
    $sql = "SELECT *
        FROM (
            SELECT *
            FROM messages
            WHERE 
                (sender_id = $my_id AND sender_type = '$my_type' AND receiver_type='$othertype')
                OR (receiver_id = $my_id AND receiver_type = '$my_type' and sender_type='$othertype')
            ORDER BY date DESC
            LIMIT 5
        ) subquery
        ORDER BY date ASC;";
    $result = mysqli_query($conn, $sql);

    // Display messages in the "chat-messages" div
    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['sender_type'] == $my_type) {
                echo '<div class="message_sent">';
                echo '<p>'.$row['content'].'</p>';
                echo '</div>';
                echo '<br>';
            } else {
                echo '<div class="message">';
                echo '<p>'.$row['content'].'</p>';
                echo '</div>';
                echo '<br>';
            }
        }

    } else {
        echo '<div class="message">';
        echo '<p>No messages to display.</p>';
        echo '</div>';
    }

    mysqli_close($conn);
    ?>
</div>