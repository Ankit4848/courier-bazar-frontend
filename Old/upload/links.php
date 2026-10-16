<?php
// ============ pages
$home_url = "index.php";
$about_url = "about.php";
$services_url = "services.php";
$track_url = "track.php";
$contact_url = "contact.php";
$terms_url = "terms.php";
$privacy_url = "privacy.php";
$shipping_url = "shipping-policy.php";
$refund_url = "refund-policy.php";
$login_url = "https://cb.softieons.me/login";
$register_url = "https://cb.softieons.me/register";

// ============ information
$phone_number = "+91 93112 94942";
$phone_number_alt = "+91 90151 96248";
$phone_number_alt2 = "";
$phone_url = "tel:+919311294942";
$phone_url_alt = "tel:+919015196248";
$phone_url_alt2 = "";
$email_address = "hello@courierbazar.in";
$email_url = "mailto:hello@courierbazar.in";
$office_address = "4891/92, Phoota Road, Baratooti, North Delhi, Delhi - 110006";

// ============ social media
$whatsapp_url = "https://wa.me/919311294942";
$facebook_url = "#";
$instagram_url = "#";
$linkedin_url = "#";

// Helper function to get active class
function active_class($page, $current_page)
{
    return ($page == $current_page) ? ' active' : '';
}
?>