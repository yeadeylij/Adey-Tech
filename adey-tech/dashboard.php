<?php
$page_title = 'Dashboard';
require_once 'includes/config.php';

if (!isLoggedIn()) {
    setFlashMessage('error', 'Please login to access dashboard');
    redirect('login.php');
}

require_once 'includes/auth.php';
$auth = new Auth();
$user = $auth->getUser($_SESSION['user_id']);

if (!$user) {
    session_destroy();
    redirect('login.php');
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $fullName = sanitize($_POST['fullName']);
    $bio = sanitize($_POST['bio']);
    $location = sanitize($_POST['location']);
    $website = sanitize($_POST['website']);
    
    $result = $auth->updateProfile($_SESSION['user_id'], $fullName, $bio, $location, $website);
    
    if ($result['success']) {
        $success = $result['message'];
        $user = $auth->getUser($_SESSION['user_id']);
    } else {
        $error = $result['message'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="index.php" class="logo">Adey Tech</a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="logout.php" class="nav-btn logout">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="dashboard-container">
        <div class="dashboard-card">
            <div class="dashboard-header">
                <h2>Welcome, <?php echo htmlspecialchars($user['full_name']); ?>!</h2>
                <a href="index.php" class="btn btn-primary">← Back to Site</a>
            </div>
            
            <?php if ($success): ?>
                <div class="flash-message success">
                    <div class="flash-content">
                        <i class="fas fa-check-circle"></i>
                        <span><?php echo $success; ?></span>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="flash-message error">
                    <div class="flash-content">
                        <i class="fas fa-exclamation-circle"></i>
                        <span><?php echo $error; ?></span>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="profile-info">
                <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Member Since:</strong> <?php echo date('F j, Y', strtotime($user['created_at'])); ?></p>
                <?php if ($user['last_login']): ?>
                    <p><strong>Last Login:</strong> <?php echo date('F j, Y g:i a', strtotime($user['last_login'])); ?></p>
                <?php endif; ?>
            </div>
            
            <h3 style="color: var(--accent-color); margin-bottom: 2rem;">Update Profile</h3>
            
            <form class="auth-form" method="POST" action="">
                <input type="hidden" name="update_profile" value="1">
                
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" name="fullName" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea id="bio" name="bio" rows="3"><?php echo htmlspecialchars($user['bio'] ?? ''); ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($user['location'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="url" id="website" name="website" value="<?php echo htmlspecialchars($user['website'] ?? ''); ?>">
                </div>
                
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>
<!-- Enhanced Dashboard Avatar -->
<div class="dashboard-avatar" data-aos="fade-up">
    <div class="avatar-with-dtu">
        <img src="assets/images/jo.png" alt="<?php echo htmlspecialchars($user['full_name']); ?>">
    </div>
</div>

<!-- University Info -->
<div class="profile-info" style="text-align: center; margin-bottom: 2rem;">
    <div style="display: flex; align-items: center; justify-content: center; gap: 1rem; margin-bottom: 1rem;">
        <img src="assets/images/dtu.jpg" alt="DTU" style="width: 40px; height: 40px; opacity: 0.7;">
        <h3 style="color: var(--accent-color);">Debre Tabor University</h3>
        <img src="assets/images/dtu.jpg" alt="DTU" style="width: 40px; height: 40px; opacity: 0.7;">
    </div>
    <p style="color: var(--text-tertiary);">BSc in Information Technology Graduate</p>
</div>
</body>
</html>