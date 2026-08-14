<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check karein ki data modal se aaya hai ya contact section se
    $is_modal = isset($_POST['name']) && !isset($_POST['first_name']);

    if ($is_modal) {
        // --- MODAL FORM DATA ---
        $name    = htmlspecialchars(trim($_POST['name'] ?? ''));
        $email   = htmlspecialchars(trim($_POST['email'] ?? ''));
        $phone   = htmlspecialchars(trim($_POST['phone'] ?? ''));
        $message = htmlspecialchars(trim($_POST['message'] ?? ''));

        $to = "mail@doricmultimedia.com";
        $subject = "New Modal Inquiry: " . (!empty($name) ? $name : "Website Visitor");

        $body  = "You have received a new inquiry from the Modal Form:\n\n";
        $body .= "----------------------------------------\n";
        $body .= "Full Name     : " . (!empty($name) ? $name : "N/A") . "\n";
        $body .= "Email Address : " . (!empty($email) ? $email : "N/A") . "\n";
        $body .= "Phone Number  : " . (!empty($phone) ? $phone : "N/A") . "\n";
        $body .= "Message       :\n" . (!empty($message) ? $message : "No message provided") . "\n";
        $body .= "----------------------------------------\n";
        
        $clientName = !empty($name) ? $name : "User";

    } else {
        // --- CONTACT SECTION FORM DATA ---
        $first_name = htmlspecialchars(trim($_POST['first_name'] ?? ''));
        $last_name  = htmlspecialchars(trim($_POST['last_name'] ?? ''));
        $email      = htmlspecialchars(trim($_POST['email'] ?? ''));
        $phone      = htmlspecialchars(trim($_POST['phone'] ?? ''));
        $company    = htmlspecialchars(trim($_POST['company'] ?? ''));
        $service    = htmlspecialchars(trim($_POST['service'] ?? ''));
        $message    = htmlspecialchars(trim($_POST['message'] ?? ''));

        $fullName = trim($first_name . ' ' . $last_name);

        $to = "mail@doricmultimedia.com";
        $subject = "New Contact Form Inquiry: " . ($service ?: "Website Visitor");

        $body  = "You have received a new inquiry from the Contact Section Form:\n\n";
        $body .= "----------------------------------------\n";
        $body .= "First Name      : " . ($first_name ?: "N/A") . "\n";
        $body .= "Last Name       : " . ($last_name ?: "N/A") . "\n";
        $body .= "Email Address   : " . ($email ?: "N/A") . "\n";
        $body .= "Phone Number    : " . ($phone ?: "N/A") . "\n";
        $body .= "Company Name    : " . (!empty($company) ? $company : "Not Provided") . "\n";
        $body .= "Selected Service: " . (!empty($service) ? $service : "Not Specified") . "\n";
        $body .= "Additional Msg  : " . (!empty($message) ? $message : "No message provided") . "\n";
        $body .= "----------------------------------------\n";
        
        $clientName = !empty($fullName) ? $fullName : "User";
    }

    $headers = "From: inquiry@doricmultimedia.com\r\n" .
               "Reply-To: " . (!empty($email) ? $email : "inquiry@doricmultimedia.com") . "\r\n" .
               "Content-Type: text/plain; charset=UTF-8";

    $status = mail($to, $subject, $body, $headers);
} else {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request Status - Doric Multimedia</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #0f1015; color: #fff; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); padding: 40px; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.5); text-align: center; max-width: 400px; }
        .icon { font-size: 60px; margin-bottom: 20px; }
        h1 { margin-bottom: 10px; font-size: 24px; }
        p { color: rgba(255, 255, 255, 0.7); line-height: 1.6; }
    </style>
    <script>
        setTimeout(function(){ window.location.href = "index.php"; }, 4000);
    </script>
</head>
<body>
    <div class="card">
        <?php if ($status) { ?>
            <div class="icon" style="color: #00b894;">✓</div>
            <h1>Message Sent!</h1>
            <p>Thank you <strong><?php echo $clientName; ?></strong>. We will get back to you shortly.</p>
        <?php } else { ?>
            <div class="icon" style="color: #ff4757;">✕</div>
            <h1>Sending Failed</h1>
            <p>Please try again later or call us directly.</p>
        <?php } ?>
        <p style="font-size: 12px; margin-top: 20px; color: rgba(255,255,255,0.4);">Redirecting in 4 seconds...</p>
    </div>
</body>
</html>