<!doctype html>
<html lang="en">

<head>
    <title>Guestbook</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="Contact.css">
</head>

<body>
    <div class="container">
        <nav sty>
            <label class="logo" href="#">Guestbook</label>
            <ul>
                <li><a href="../index.php" class="active">Home</a></li>
                <li><a href="About.php">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="$">Login</a></li>
                <li><a href="$">Logout</a></li>

            </ul>
        </nav>
        <div class="form_content">
            <div class="formbg">
                <form onsubmit="sendEmail(); reset(); return false;">
                    <h3>GET IN TOUCH</h3>
                    <input type="text" id="name" placeholder="Your Name" required>
                    <input type="email" id="email" placeholder="abc@gmail.com" required>
                    <input type="number" id="phone" placeholder="Your Phone" >
                    <textarea id="message" placeholder="How can I help you ?" rows="10"></textarea>
                    <button type="submit">Send</button>

                </form>
            </div>
        </div>
    </div>

    </div>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <script>
        function sendEmail() {
            Email.send({
                Host: "smtp.elasticemail.com",
                Username: "trungtintin1989@gmail.com",
                Password: "3080A6855FD57508B252D21F41D167A1803D",
                To:  'trungtintin1989@gmail.com',
                From: document.getElementById('email').value, 
                Subject: "This is the subject",
                Body: "Name :" + document.getElementById("name").value +
                "<br> Email :" + document.getElementById("email").value +
                "<br> Phone :" + document.getElementById("phone").value +
                "<br> Message :" + document.getElementById("message").value
                
            }).then(
                message => alert(message)
            );
        }
    </script>
</body>

</html>