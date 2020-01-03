<?php

function url_for($url)
{
    if ($url[0] != '/') {
        $url = '/' . $url;
    }
    return URL_ROOT . $url;
}

function redirect_to($location)
{
    header('Location: '. $location);
    exit;
}

function is_post_request()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function is_get_request()
{
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}

/* set a session var for errors[] or success msg
** $value = errors[] or success msg
*/
function setMsg($name, $value, $class = 'success')
{
    if (is_array($value)) {
        $_SESSION[$name] = $value;
    } else {
        $_SESSION[$name] = "<div class=\"alert alert-{$class} text-center\">" . $value . "</div>";
    }
}

// get session msg
function getMsg($name)
{
    if (isset($_SESSION[$name])) {
        $session = $_SESSION[$name];
        unset($_SESSION[$name]);
        return $session;
    }
}

// Check user is logged in
function isUserLoggedIn()
{
    if (isset($_SESSION['user']) || isset($_COOKIE['user'])) {
        return true;
    } else {
        return false;
    }
}

function userLogOut()
{
    unset($_SESSION['user']);
    if (isUserLoggedIn()) {
        setcookie('user', '', time()+86400*30, '/');
    }
    return true;
}

// Send email
function send_email($options = [])
{
    $mail = new PHPMailer(true); 	//(true) enables exceptions
     //Tell PHPMailer to use SMTP - requires a local mail server
    //Faster and safer than using mail()
    $mail->SMTPDebug = 2;								  // Enable verbose debug output
    $mail->isSMTP();									  // Set mailer to use SMTP
    $mail->Host = 'smtp.sendgrid.net';//'smtp.mailtrap.io';					  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = '';                 // SMTP username
    $mail->Password = '';                        // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = ;   								  // TCP port to connect to
    if (isset($options['to']) && $options['to'] != '' && isset($options['from']) && $options['from'] != '' && isset($options['subject']) && $options['subject'] != '' && isset($options['msg']) && $options['msg'] != '') {
        //Set who the message is to be sent from
        $mail->setFrom('');
        //Set an alternative reply-to address
        // $mail->addReplyTo('replyto@example.com', 'First Last');
        //Set who the message is to be sent to
        $mail->addAddress($options['to']);
        $mail->isHTML(true);                                  // Set email format to HTML
        //Set the subject line
        $mail->Subject = $options['subject'];
        $mail->Body    = $options['msg'];
        //send the message, check for errors
        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
            exit;
        } else {
            return true;
            // echo "Message sent!";
        }
    }
}
