<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Make sure this path is correct

include_once 'includes/db.inc.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $stmt = $pdo->prepare("SELECT * FROM accounts WHERE Email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // If the email doesn't exist, create a new user record
    if (!$user) {
        $type = "Client";
        $isAuthed = "0";
        $songrequested = "0";
        $stmt = $pdo->prepare("INSERT INTO accounts (Email, type, isAuthed, songrequested) VALUES (?, ?, ?, ?)");
        $stmt->execute([$email, $type, $isAuthed, $songrequested]);
    }

    // Assuming $type needs to be determined again after the insertion
    // Prepare and execute a SELECT statement to get the latest type
    $sql = 'SELECT * FROM accounts WHERE Email = :email';
    $statement = $pdo->prepare($sql);
    $statement->execute(['email' => strtolower($email)]);
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $row) {
        $type = $row['type'] === 'Admin' ? 'Admin' : 'User';
    }

    // Initialize PHPMailer and configure it to use Gmail for sending the email
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = getenv('GMAIL_USER'); // Your Gmail address
        $mail->Password   = getenv('GMAIL_PASS'); // Your Gmail password or app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        //Recipients
        $mail->setFrom('your_gmail_address@gmail.com', 'Mailer');
        $mail->addAddress($email); // Add recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Log in to My Website';
        $mail->Body    = '<!DOCTYPE html>
                          <html>
                            <head>
                              <meta charset="UTF-8">
                              <title>Log in to My Website</title>
                            </head>
                            <body>
                              <h1>Log in to My Website</h1>
                              <p>' . $email . '</p>
                              <p>Click the button below to log in:</p>
                              <a href="localhost/DJ'.$type.'?user=' . $email . '" style="background-color:#4CAF50;border:none;color:white;padding:15px 32px;text-align:center;text-decoration:none;display:inline-block;font-size:16px;margin:4px 2px;cursor:pointer;">Log in</a>
                            </body>
                          </html>';

        $mail->send();
        echo 'Email has been sent successfully to ' . $email;
    } catch (Exception $e) {
        echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DJ Nick Burret!</title>
        <style>
            html {
                height : 100%;
                width : 100%;
                padding: 0px;
                margin: 0px;
                overflow: hidden;
                background: linear-gradient(rgba(11, 39, 92, 1), rgba(16, 17, 51, 1)), linear-gradient(to right, rgba(4, 20, 47, 0), rgba(30, 65, 150, 0), rgba(30, 65, 150, 0), rgba(4, 20, 47, 0));
            }
            body{
                position: absolute;
                left: 50%;
                overflow: hidden;
                padding: 0px;
                margin: 0px;
                transform: translate(-50%, 0%);
                height: 100%;
                width: 420px;
                background-image: url("Assets/Homebg.png"), linear-gradient(rgba(10, 58, 129, 1), rgba(4, 20, 47, 1));
                background-position-x: center;
                background-repeat: no-repeat;
                background-size: 100% 100%;
                color: aliceblue;
            }
            h1 {
              position: absolute;
              width: 245px;
              height: 0px;
              left: 50%;
              transform: translate(-50%, 0%);
              top: 15px;
              font-family: 'Lexend';
              font-style: normal;
              font-weight: 600;
              font-size: 30px;
              line-height: 36px;
              text-align: center;

              color: #FFFFFF;
            }
            .icon{
              position: absolute;
              width: 270px;
              height: 330px;
              left: 50%;
              transform: translate(-50%, 0%);
              top: 125px;
            }
            ::placeholder {
              color: aliceblue;
              opacity: 1; /* Firefox */
            }

            :-ms-input-placeholder { /* Internet Explorer 10-11 */
            color: aliceblue;
            }

            ::-ms-input-placeholder { /* Microsoft Edge */
            color: aliceblue;
            }
            form {
              position: absolute;
              left: 50%;
              top: 520px;
              transform: translate(-50%, 0%);
              height: 140px;
              width: 400px;
            }
            .email {
              position: absolute;
              left: 50%;
              transform: translate(-50%, 0%);
              border-radius: 4px;
              border-width: 2px;
              border-color: rgba(16, 17, 51, 1);
              font-size: large;
              color: aliceblue;
              background: transparent;
              height:60px;
              width:380px;
              background-image: url("Assets/email.png");
              background-position-x: calc(100% - 10px);
              background-position-y: center;
              background-repeat: no-repeat;
            }
            button {
              position: absolute;
              width: 380px;
              height: 60px;
              left: 50%;
              bottom: 0px;
              color: black;
              border-color: #FFAF15;
              transform: translate(-50%, 0%);
              background: #FFAF15;
              border-radius: 60px;
            }
        </style>
</head>
<body>
  <h1>Register / Login</h1>
  <img src="Assets/Icon.png" class = "icon">
  <form method="post" action="">
    <input type="email" id="email" name="email" required placeholder="Enter email" class = "email">
    <button type="submit" name="submit">Send Email</button>
  </form>
</body>
</html>
