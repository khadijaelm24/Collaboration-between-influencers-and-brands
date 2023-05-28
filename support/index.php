<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatter avec le support</title>
    <link rel="stylesheet" href="chat.css">
</head>
<body>
<header style="position: fixed; top: 0; width: 100%;">
    <nav>
        <ul>
            <div id="divheader1">
                <li class="listee"><a href="../dashboard_<?php         session_start();
                    echo $_SESSION['user_id']; ?>" class="headrr">M&I</a></li>
            </div>
            <div id="divheader2">
                <li class="liste"><a href="../index.html" class="headr" onclick="location.href='../logout.php'">LOG OUT</a></li>
            </div>
        </ul>
    </nav>
</header>
<style>
    /* CSS to style the fixed button */
    #fixedbutton {
        position: fixed;
        top: 150px;
        left: 50px;
        width: 100px;
    }
</style>
<a href="../dashboard_marque" ><img src="backbutton.png" id="fixedbutton" onclick="desession()"></a>

<br><br><br><br><br><br><br>

<div class="chat-container">
    <div class="chat-header">
        <?php

        if(!empty($_SESSION['otherid']) and !empty($_SESSION['othername']) and !empty($_SESSION['othertype'])){
            $otherid= "1";

            // Retrieve the email from the session
            $othername="admin";

            // Retrieve the user type from the session
            $othertype="admin";
        }

        if(empty($othertype) and empty($otherid) and empty($othername)){
            $othertype='admin';
            $otherid = $_POST['id'];
            $othername = "admin";

            // Retrieve the email from the session
            $_SESSION['othername']=$othername;

            // Retrieve the user type from the session
            $_SESSION['othertype']=$othertype;

        }
        echo "<h2>Envoyer des messages à $othername</h2>";
        ?>
    </div>

    <div id="refreshSection">
            <?php include('msg.php'); ?>
        </div>

        <div class="chat-input">
            <form method="post" action="send_message.php">

                <input id="inputmsg" type="text" name="message" placeholder="Type your message here" required>
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var inputField = document.getElementById("inputmsg");
            inputField.focus(); // Set focus on the input field when the page loads
        });

    </script>
    <script>
        // Function to refresh the content of the div
        function refreshContent() {
            var refreshSection = document.getElementById('refreshSection');
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    refreshSection.innerHTML = xhr.responseText;
                }
            };

            xhr.open('GET', 'msg.php', true);
            xhr.send();
        }

        // Call the refreshContent function every second (1000 milliseconds)
        setInterval(refreshContent, 20);
    </script>
</div>
    <script>
        // Function to refresh the content of the div
        function refreshContent() {
            var refreshSection = document.getElementById('refreshSection');
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    refreshSection.innerHTML = xhr.responseText;
                }
            };

            xhr.open('GET', 'msg.php', true);
            xhr.send();
        }

        // Call the refreshContent function every second (1000 milliseconds)
        setInterval(refreshContent, 20);
    </script>
</body>
</html>
