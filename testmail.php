<?php
include 'includes/mail_config.php';

if (sendMail("your-test-email@gmail.com", "Test Subject", "This is a test email")) {
    echo "✅ Mail Sent!";
} else {
    echo "❌ Mail Failed!";
}
