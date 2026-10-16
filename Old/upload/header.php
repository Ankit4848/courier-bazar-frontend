<?php include_once __DIR__ . '/links.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php echo isset($page_desc) ? htmlspecialchars($page_desc) : ''; ?>">
  <meta name="keywords"
    content="courier aggregator, shipping software, compare courier rates, ecommerce shipping, courier api, tracking, COD, Courier Bazar">
  <meta name="author" content="Courier Bazar">
  <meta property="og:title" content="<?php echo isset($page_title) ? htmlspecialchars($page_title) : ''; ?>">
  <meta property="og:description" content="<?php echo isset($page_desc) ? htmlspecialchars($page_desc) : ''; ?>">
  <meta property="og:type" content="website">
  <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'Courier Bazar'; ?></title>

  <link rel="icon" href="assets/images/favicon.svg" type="image/svg+xml">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

  <!-- ============================ NAVBAR ============================ -->
  <header>
    <nav class="navbar navbar-expand-lg navbar-cb fixed-top">
      <div class="container">
        <a class="navbar-brand brand" href="<?php echo $home_url; ?>" aria-label="Courier Bazar home">
          <img src="assets/images/logo.png" alt="Courier Bazar" class="brand-logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain"
          aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
          <i class="bi bi-list fs-2 text-ink"></i>
        </button>
        <div class="collapse navbar-collapse" style="flex-grow: 0;" id="navMain">
          <ul class="navbar-nav mb-2 mb-lg-0 align-items-lg-center">
            <li class="nav-item"><a class="nav-link<?php echo active_class('home', $current_page); ?>"
                href="<?php echo $home_url; ?>">Home</a></li>
            <li class="nav-item"><a class="nav-link<?php echo active_class('about', $current_page); ?>"
                href="<?php echo $about_url; ?>">About Us</a></li>
            <li class="nav-item"><a class="nav-link<?php echo active_class('services', $current_page); ?>"
                href="<?php echo $services_url; ?>">Services</a></li>
            <li class="nav-item"><a class="nav-link<?php echo active_class('track', $current_page); ?>"
                href="<?php echo $track_url; ?>">Track Order</a></li>
            <li class="nav-item"><a class="nav-link<?php echo active_class('contact', $current_page); ?>"
                href="<?php echo $contact_url; ?>">Contact Us</a></li>
            <li class="nav-item d-lg-none"><a class="nav-link<?php echo active_class('login', $current_page); ?>"
                href="<?php echo $login_url; ?>">Login</a></li>
            <li class="nav-item d-lg-none"><a class="nav-link<?php echo active_class('register', $current_page); ?>"
                href="<?php echo $register_url; ?>">Register</a></li>
          </ul>
        </div>
        <div class="d-none d-lg-block">
          <a class="btn btn-brand" href="<?php echo $login_url; ?>">Login</a>
          <a class="btn btn-brand" href="<?php echo $register_url; ?>">Register</a>
        </div>
      </div>
    </nav>
  </header>