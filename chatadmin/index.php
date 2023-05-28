<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="chatter.css"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHAT</title>
</head>
<body>
<header style="position: fixed; top: 0; width: 100%;">
    <nav>
        <ul>
            <div id="divheader1">
                <li class="listee"><a href="../dashboard_admin" class="headrr">M&I</a></li>
            </div>
            <div id="divheader2">
                <li class="liste"><a href="../dashboard_admin" class="headr">RETOUR</a></li>
                <li class="liste"><a href="../index.html" class="headr" onclick="location.href='../logout.php'">LOG OUT</a></li>
            </div>
        </ul>
    </nav>
</header>
<section>
<br><br><br><br><br><br><br><br><br><br>
<div class="chat-container">
    <div class="chat-header">
        <?php
        session_start();
        include('database.php');
        $otherid = $_POST['otherid'];
        $_SESSION['otherid'] = $otherid;
        $othertype = $_POST['othertype'];
        $_SESSION['othertype'] = $othertype;

        $sql = "
    SELECT *
    FROM $othertype
    WHERE
        (id = '$otherid')
";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $receiver_type = $_SESSION['othertype'];
            if ($receiver_type == "influenceur") {
                $othername = $row['fname'] . ' ' . $row['lname'];
            } else {
                $othername = $row['name'];
            }
        } else {
            // Handle the case when no row is found or an error occurs
            $othername = "Unknown";
        }

        echo "<h2>Envoyer des messages à $othername</h2>";
        ?>

    </div>
    <div class="chat-messages">
        <?php
        include('database.php');

        // Retrieve the user ID from the session
        $my_id = $_SESSION['user_id'];

        // Retrieve the email from the session
        $email = $_SESSION['email'];

        // Retrieve the user type from the session
        $my_type = $_SESSION['user_type'];



        // SQL query to retrieve messages from the database
        $sql = "SELECT *
        FROM (
            SELECT *
            FROM messages
            WHERE 
                (sender_id = $my_id AND sender_type = '$my_type' AND receiver_id=$otherid)
                OR (receiver_id = $my_id AND receiver_type = '$my_type' and sender_id=$otherid)
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
    <div class="chat-input">
        <form method="post" action="send_message.php" target="_blank">
            <input type="hidden" name="id" value="<?php echo $otherid; ?>">
            <input type="hidden" name="name" value="<?php echo $othername; ?>">
            <input type="text" name="message" placeholder="Type your message here" required>
            <button type="submit" onclick="setTimeout(function(){ window.location.reload(); }, 100);">Send</button>
        </form>
    </div>
</div>
    </section>
</body>
</html>
