<?php

$myemail  = "blazer@nau.edu";

/* inputs */
$yourname = check_input($_POST['yourname'], "Enter your name");
$subject  = check_input($_POST['subject'], "Write a subject");
$email    = check_input($_POST['email']);
$website  = check_input($_POST['website']);
$type   = check_input($_POST['type']);
$how_find = check_input($_POST['how']);
$comments = check_input($_POST['comments'], "Write your comments");
$t = time();
$timestamp = date("m/d/Y    H:i:s",$t);

/* email field validation */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
    show_error("E-mail address not valid");
}


/* email */
$message = "Hello!

Your contact form has been submitted by:

Name: $yourname
E-mail: $email
URL: $website

Type? $type
How did he/she find it? $how_find

Comments:
$comments

$timestamp";

$returnmessage = "Hello $yourname!

Your submission has been recieved.

Here is what you said:
$comments

Thank you for your feedback.

$timestamp";

/* send the email*/
mail($myemail, $subject, $message);
mail($email, $subject, $returnmessage);

/* Show success page */
header('Location: index.php');
exit();

/* Functions*/
function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        show_error($problem);
    }
    return $data;
}

function show_error($myError)
{
?>
    <html>
    <body>

    <b>Please correct the following error:</b><br />
    <?php echo $myError; ?>

    </body>
    </html>
<?php
exit();
}
?>
