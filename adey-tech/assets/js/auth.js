// Check if user is logged in
async function checkAuth() {
    try {
        const response = await fetch('/auth/me');
        if (response.ok) {
            const data = await response.json();
            return data.user;
        }
        return null;
    } catch (error) {
        console.error('Auth check error:', error);
        return null;
    }
}

// Login form handler
const loginForm = document.getElementById('loginForm');
if (loginForm) {
    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        // Clear previous errors
        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
        document.querySelectorAll('.form-group input').forEach(el => el.classList.remove('error'));
        
        const formData = {
            username: document.getElementById('username').value,
            password: document.getElementById('password').value,
            remember: document.getElementById('remember')?.checked || false
        };
        
        // Validate form
        let isValid = true;
        
        if (!formData.username) {
            showError('username', 'Username or email is required');
            isValid = false;
        }
        
        if (!formData.password) {
            showError('password', 'Password is required');
            isValid = false;
        }
        
        if (!isValid) return;
        
        // Show loading state
        const submitBtn = loginForm.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.innerHTML = '<span class="loading"></span> Logging in...';
        submitBtn.disabled = true;
        
        try {
            const response = await fetch('/auth/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            });
            
            const data = await response.json();
            
            if (response.ok) {
                showToast('Login successful! Redirecting...', 'success');
                setTimeout(() => {
                    window.location.href = '/dashboard';
                }, 1500);
            } else {
                if (data.errors) {
                    data.errors.forEach(error => {
                        const field = error.param;
                        showError(field, error.msg);
                    });
                } else {
                    showToast(data.error || 'Login failed', 'error');
                }
            }
        } catch (error) {
            console.error('Login error:', error);
            showToast('Network error. Please try again.', 'error');
        } finally {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });
}

// Signup form handler
const signupForm = document.getElementById('signupForm');
if (signupForm) {
    signupForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        // Clear previous errors
        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
        document.querySelectorAll('.form-group input').forEach(el => el.classList.remove('error'));
        
        const formData = {
            fullName: document.getElementById('fullName').value,
            email: document.getElementById('email').value,
            username: document.getElementById('username').value,
            password: document.getElementById('password').value,
            confirmPassword: document.getElementById('confirmPassword').value
        };
        
        // Validate form
        let isValid = true;
        
        if (!formData.fullName) {
            showError('fullName', 'Full name is required');
            isValid = false;
        }
        
        if (!formData.email) {
            showError('email', 'Email is required');
            isValid = false;
        } else if (!isValidEmail(formData.email)) {
            showError('email', 'Please enter a valid email');
            isValid = false;
        }
        
        if (!formData.username) {
            showError('username', 'Username is required');
            isValid = false;
        } else if (formData.username.length < 3) {
            showError('username', 'Username must be at least 3 characters');
            isValid = false;
        }
        
        if (!formData.password) {
            showError('password', 'Password is required');
            isValid = false;
        } else if (formData.password.length < 6) {
            showError('password', 'Password must be at least 6 characters');
            isValid = false;
        }
        
        if (formData.password !== formData.confirmPassword) {
            showError('confirmPassword', 'Passwords do not match');
            isValid = false;
        }
        
        if (!isValid) return;
        
        // Show loading state
        const submitBtn = signupForm.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.innerHTML = '<span class="loading"></span> Creating account...';
        submitBtn.disabled = true;
        
        try {
            const response = await fetch('/auth/signup', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            });
            
            const data = await response.json();
            
            if (response.ok) {
                showToast('Account created successfully! Redirecting to login...', 'success');
                setTimeout(() => {
                    window.location.href = '/login';
                }, 2000);
            } else {
                if (data.errors) {
                    data.errors.forEach(error => {
                        const field = error.param;
                        showError(field, error.msg);
                    });
                } else {
                    showToast(data.error || 'Signup failed', 'error');
                }
            }
        } catch (error) {
            console.error('Signup error:', error);
            showToast('Network error. Please try again.', 'error');
        } finally {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });
}

// Load dashboard data
if (window.location.pathname === '/dashboard') {
    loadDashboard();
}

async function loadDashboard() {
    try {
        const response = await fetch('/auth/me');
        if (response.ok) {
            const data = await response.json();
            displayProfile(data.user);
        } else {
            window.location.href = '/login';
        }
    } catch (error) {
        console.error('Dashboard load error:', error);
        window.location.href = '/login';
    }
}

function displayProfile(user) {
    const profileInfo = document.getElementById('profileInfo');
    if (profileInfo) {
        profileInfo.innerHTML = `
            <p><strong>Full Name:</strong> ${user.fullName}</p>
            <p><strong>Username:</strong> ${user.username}</p>
            <p><strong>Email:</strong> ${user.email}</p>
            <p><strong>Member Since:</strong> ${new Date(user.createdAt).toLocaleDateString()}</p>
            ${user.lastLogin ? `<p><strong>Last Login:</strong> ${new Date(user.lastLogin).toLocaleString()}</p>` : ''}
        `;
    }
    
    // Populate update form
    document.getElementById('fullName').value = user.fullName;
    if (user.profile) {
        document.getElementById('bio').value = user.profile.bio || '';
        document.getElementById('location').value = user.profile.location || '';
        document.getElementById('website').value = user.profile.website || '';
    }
}

// Update profile form handler
const updateProfileForm = document.getElementById('updateProfileForm');
if (updateProfileForm) {
    updateProfileForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const formData = {
            fullName: document.getElementById('fullName').value,
            bio: document.getElementById('bio').value,
            location: document.getElementById('location').value,
            website: document.getElementById('website').value
        };
        
        const submitBtn = updateProfileForm.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.innerHTML = '<span class="loading"></span> Updating...';
        submitBtn.disabled = true;
        
        try {
            const response = await fetch('/auth/profile', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            });
            
            const data = await response.json();
            
            if (response.ok) {
                showToast('Profile updated successfully!', 'success');
                displayProfile(data.user);
            } else {
                showToast(data.error || 'Update failed', 'error');
            }
        } catch (error) {
            console.error('Update error:', error);
            showToast('Network error. Please try again.', 'error');
        } finally {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });
}

// Logout handler
const logoutBtn = document.getElementById('logoutBtn');
if (logoutBtn) {
    logoutBtn.addEventListener('click', async (e) => {
        e.preventDefault();
        
        try {
            const response = await fetch('/auth/logout', {
                method: 'POST'
            });
            
            if (response.ok) {
                showToast('Logged out successfully', 'success');
                setTimeout(() => {
                    window.location.href = '/';
                }, 1500);
            }
        } catch (error) {
            console.error('Logout error:', error);
        }
    });
}

// Helper functions
function showError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const errorElement = document.getElementById(fieldId + 'Error');
    
    if (field) {
        field.classList.add('error');
    }
    
    if (errorElement) {
        errorElement.textContent = message;
    }
}

function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
    }, 3000);
}