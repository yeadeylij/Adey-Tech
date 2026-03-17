// Initialize AOS
AOS.init({
    duration: 1000,
    once: true,
    offset: 100
});

// Mobile Navigation
const hamburger = document.querySelector('.hamburger');
const navLinks = document.querySelector('.nav-links');
const navLinksItems = document.querySelectorAll('.nav-links a');

if (hamburger) {
    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('active');
        navLinks.classList.toggle('active');
    });
}

// Close mobile menu when clicking a link
navLinksItems.forEach(item => {
    item.addEventListener('click', () => {
        hamburger.classList.remove('active');
        navLinks.classList.remove('active');
    });
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Active navigation link on scroll
const sections = document.querySelectorAll('section');
const navItems = document.querySelectorAll('.nav-links a:not(.nav-btn)');

window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop - 100;
        const sectionHeight = section.clientHeight;
        if (pageYOffset >= sectionTop && pageYOffset < sectionTop + sectionHeight) {
            current = section.getAttribute('id');
        }
    });

    navItems.forEach(item => {
        item.classList.remove('active');
        if (item.getAttribute('href') === `#${current}`) {
            item.classList.add('active');
        }
    });
});

// Animate progress bars on scroll
const progressBars = document.querySelectorAll('.progress');

function animateProgressBars() {
    progressBars.forEach(bar => {
        const barPosition = bar.getBoundingClientRect().top;
        const screenPosition = window.innerHeight - 50;
        
        if (barPosition < screenPosition && bar.style.width === '0px') {
            const width = bar.getAttribute('data-width');
            bar.style.width = width + '%';
        }
    });
}

window.addEventListener('scroll', animateProgressBars);
window.addEventListener('load', animateProgressBars);

// Flash message auto close
const flashMessage = document.querySelector('.flash-message');
if (flashMessage) {
    setTimeout(() => {
        flashMessage.style.animation = 'slideOutRight 0.3s ease';
        setTimeout(() => {
            flashMessage.remove();
        }, 300);
    }, 5000);
}

// Flash message close button
const flashClose = document.querySelector('.flash-close');
if (flashClose) {
    flashClose.addEventListener('click', () => {
        const flashMessage = document.querySelector('.flash-message');
        flashMessage.style.animation = 'slideOutRight 0.3s ease';
        setTimeout(() => {
            flashMessage.remove();
        }, 300);
    });
}

// Contact form submission
const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const formData = new FormData(contactForm);
        const submitBtn = contactForm.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        // Show loading state
        submitBtn.innerHTML = '<span class="loading-spinner"></span> Sending...';
        submitBtn.disabled = true;
        
        try {
            const response = await fetch('contact_process.php', {
                method: 'POST',
                body: formData
            });
            
            const result = await response.json();
            
            if (result.success) {
                showNotification('Message sent successfully!', 'success');
                contactForm.reset();
            } else {
                showNotification(result.message || 'Failed to send message', 'error');
            }
        } catch (error) {
            showNotification('Network error. Please try again.', 'error');
        } finally {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });
}

// Notification function
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `flash-message ${type}`;
    notification.innerHTML = `
        <div class="flash-content">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
            <span>${message}</span>
            <button class="flash-close"><i class="fas fa-times"></i></button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 5000);
    
    // Add close button functionality
    notification.querySelector('.flash-close').addEventListener('click', () => {
        notification.style.animation = 'slideOutRight 0.3s ease';
        setTimeout(() => {
            notification.remove();
        }, 300);
    });
}

// Scroll to top button
const scrollBtn = document.createElement('button');
scrollBtn.className = 'scroll-top';
scrollBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
document.body.appendChild(scrollBtn);

scrollBtn.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

window.addEventListener('scroll', () => {
    if (window.pageYOffset > 300) {
        scrollBtn.classList.add('show');
    } else {
        scrollBtn.classList.remove('show');
    }
});

// Add scroll to top button styles
const style = document.createElement('style');
style.textContent = `
    .scroll-top {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 45px;
        height: 45px;
        background: var(--accent-color);
        color: var(--primary-color);
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        opacity: 0;
        visibility: hidden;
        transition: var(--transition);
        z-index: 999;
        box-shadow: var(--shadow-md);
    }
    
    .scroll-top.show {
        opacity: 1;
        visibility: visible;
    }
    
    .scroll-top:hover {
        background: var(--text-primary);
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
    }
    
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
`;

document.head.appendChild(style);
// Add this to your main.js
document.addEventListener('DOMContentLoaded', () => {
    // 1. Progress Bar Animation
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const progressBar = entry.target;
                progressBar.style.width = progressBar.dataset.width + '%';
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.progress').forEach(el => observer.observe(el));

    // 2. Smooth Scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});