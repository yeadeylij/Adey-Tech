<?php
require_once 'config.php';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?> - <?php echo $page_title ?? 'Home'; ?></title>
    
    <!-- Meta Tags -->
    <meta name="description" content="Adey Tech - Personal technology brand by Yohannes Aregay, providing digital solutions, IT services, and creative technology work in Ethiopia.">
    <meta name="keywords" content="Adey Tech, Yohannes Aregay, IT Specialist, Digital Creator, Web Development, Ethiopia">
    <meta name="author" content="<?php echo SITE_AUTHOR; ?>">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">
                <span class="logo-text">Adey Tech</span>
            </a>
            
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
            <ul class="nav-links">
                <li><a href="index.php#home" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">Home</a></li>
                <li><a href="index.php#about">About</a></li>
                <li><a href="index.php#skills">Skills</a></li>
                <li><a href="index.php#services">Services</a></li>
                <li><a href="index.php#portfolio">Portfolio</a></li>
                <li><a href="index.php#contact">Contact</a></li>
                <?php if (isLoggedIn()): ?>
                    <li><a href="dashboard.php" class="nav-btn">Dashboard</a></li>
                    <li><a href="logout.php" class="nav-btn logout">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="nav-btn">Login</a></li>
                    <li><a href="signup.php" class="nav-btn signup">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <!-- Navigation -->
<nav class="navbar">
    <div class="nav-container">
        <a href="index.php" class="logo">
            <div class="logo-avatar">
                <img src="assets/images/jo.png" alt="Yohannes Aregay" class="logo-img">
                <span class="logo-text">Adey Tech</span>
            </div>
        </a>
        
        <!-- Rest of the navbar remains the same -->
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        
        <ul class="nav-links">
            <li><a href="index.php#home" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">Home</a></li>
            <li><a href="index.php#about">About</a></li>
            <li><a href="index.php#skills">Skills</a></li>
            <li><a href="index.php#services">Services</a></li>
            <li><a href="index.php#portfolio">Portfolio</a></li>
            <li><a href="index.php#contact">Contact</a></li>
            <?php if (isLoggedIn()): ?>
                <li><a href="dashboard.php" class="nav-btn">Dashboard</a></li>
                <li><a href="logout.php" class="nav-btn logout">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php" class="nav-btn">Login</a></li>
                <li><a href="signup.php" class="nav-btn signup">Sign Up</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<!-- DTU Background Pattern -->
<div class="dtu-pattern">
    <div class="dtu-pattern-item"></div>
    <div class="dtu-pattern-item"></div>
    <div class="dtu-pattern-item"></div>
    <div class="dtu-pattern-item"></div>
</div>

<!-- DTU Watermark -->
<div class="dtu-watermark">
    <img src="assets/images/dtu.jpg" alt="DTU">
</div>

<!-- Main Background Logo -->
<div class="background-logo">
    <img src="assets/images/dtu.jpg" alt="Debre Tabor University">
</div>
</body>
    <!-- Flash Messages -->
    <?php if ($flash = getFlashMessage()): ?>
        <div class="flash-message <?php echo $flash['type']; ?>">
            <div class="flash-content">
                <i class="fas <?php echo $flash['type'] == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'; ?>"></i>
                <span><?php echo $flash['message']; ?></span>
                <button class="flash-close"><i class="fas fa-times"></i></button>
            </div>
        </div>
    <?php endif; ?>