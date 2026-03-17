<?php
$page_title = 'Sign Up';
require_once 'includes/config.php';

if (isLoggedIn()) {
    redirect('dashboard.php');
}

$error = '';
$formData = [
    'fullName' => '',
    'email' => '',
    'username' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'includes/auth.php';
    
    $formData['fullName'] = sanitize($_POST['fullName']);
    $formData['email'] = sanitize($_POST['email']);
    $formData['username'] = sanitize($_POST['username']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    
    // Validation
    $errors = [];
    
    if (empty($formData['fullName'])) {
        $errors[] = 'Full name is required';
    }
    
    if (empty($formData['email'])) {
        $errors[] = 'Email is required';
    } elseif (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email';
    }
    
    if (empty($formData['username'])) {
        $errors[] = 'Username is required';
    } elseif (strlen($formData['username']) < 3) {
        $errors[] = 'Username must be at least 3 characters';
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $formData['username'])) {
        $errors[] = 'Username can only contain letters, numbers, and underscores';
    }
    
    if (empty($password)) {
        $errors[] = 'Password is required';
    } elseif (strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters';
    }
    
    if ($password !== $confirmPassword) {
        $errors[] = 'Passwords do not match';
    }
    
    if (empty($errors)) {
        $auth = new Auth();
        $result = $auth->register($formData['fullName'], $formData['email'], $formData['username'], $password);
        
        if ($result['success']) {
            setFlashMessage('success', 'Registration successful! Please login.');
            redirect('login.php');
        } else {
            $error = $result['message'];
        }
    } else {
        $error = implode('<br>', $errors);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-box">
            <h2>Create Account</h2>
            
            <?php if ($error): ?>
                <div class="flash-message error">
                    <div class="flash-content">
                        <i class="fas fa-exclamation-circle"></i>
                        <span><?php echo $error; ?></span>
                    </div>
                </div>
            <?php endif; ?>
            
            <form class="auth-form" method="POST" action="">
                <div class="form-group">
                    <label for="fullName">Full Name</label>
                    <input type="text" id="fullName" name="fullName" value="<?php echo htmlspecialchars($formData['fullName']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($formData['email']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($formData['username']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>
            
            <div class="auth-footer">
                <p>Already have an account? <a href="login.php">Login</a></p>
                <p style="margin-top: 1rem;"><a href="index.php">← Back to Home</a></p>
            </div>
        </div>
    </div>
</body>
</html>