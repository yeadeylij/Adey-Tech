<?php
$page_title = 'Home';
require_once 'includes/header.php';
?>

<!-- Home Section -->
<section id="home">
    <div class="section-container home-content">
        <div class="avatar-with-dtu" style="margin-bottom: 2rem;">
            <div class="avatar-container" style="width: 250px; height: 250px; margin: 0 auto;">
                <img src="assets/images/jo.png" alt="Yohannes Aregay">
                <div class="avatar-border"></div>
            </div>
        </div>
        
        <h1 data-aos="fade-up"><?php echo SITE_NAME; ?></h1>
        <h2 data-aos="fade-up" data-aos-delay="100">"Innovating Technology, Empowering Digital Skills"</h2>
        <p data-aos="fade-up" data-aos-delay="200">Adey Tech is a personal technology brand created by Yohannes Aregay, providing digital solutions, IT services, and creative technology work in Ethiopia.</p>
        <div class="cta-buttons" data-aos="fade-up" data-aos-delay="300">
            <a href="#services" class="btn btn-primary">View Services</a>
            <a href="#contact" class="btn btn-secondary">Contact Me</a>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about">
    <div class="section-container">
        <div class="section-title" data-aos="fade-up">
            <h2>About Me</h2>
        </div>
        
        <div class="about-content">
            <div class="about-grid">
                <div class="about-text" data-aos="fade-right">
                    <p>I am an Information Technology graduate from Debre Tabor University, passionate about technology, digital innovation, and helping individuals and businesses grow through modern IT solutions.</p>
                    <p>With expertise in multiple areas of technology, I provide comprehensive digital services that help clients establish strong online presence and achieve their business goals.</p>
                </div>
                
                <div class="info-cards" data-aos="fade-left">
                    <div class="info-card">
                        <i class="fas fa-user"></i>
                        <h3>Name</h3>
                        <p>Yohannes Aregay</p>
                    </div>
                    <div class="info-card">
                        <i class="fas fa-briefcase"></i>
                        <h3>Profession</h3>
                        <p>IT Specialist & Digital Creator</p>
                    </div>
                    <div class="info-card">
                        <i class="fas fa-graduation-cap"></i>
                        <h3>Education</h3>
                        <p>BSc in Information Technology</p>
                    </div>
                    <div class="info-card">
                        <i class="fas fa-map-marker-alt"></i>
                        <h3>Location</h3>
                        <p>Debre Tabor, Amhara, Ethiopia</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Skills Section -->
<section id="skills">
    <div class="section-container">
        <div class="section-title" data-aos="fade-up">
            <h2>My Skills</h2>
        </div>
        
        <div class="skills-container">
            <div class="skills-category" data-aos="fade-right">
                <h3>Professional Skills</h3>
                <?php
                $skills = [
                    ['Web Development', 90],
                    ['Graphic Design', 85],
                    ['Video Editing', 80],
                    ['Digital Marketing', 75],
                    ['Copywriting', 85],
                    ['IT Support', 95]
                ];
                foreach ($skills as $skill): ?>
                <div class="skill-item">
                    <div class="skill-info">
                        <span><?php echo $skill[0]; ?></span>
                        <span><?php echo $skill[1]; ?>%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress" data-width="<?php echo $skill[1]; ?>"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="skills-category" data-aos="fade-left">
                <h3>Technical Skills</h3>
                <?php
                $tech_skills = [
                    ['HTML/CSS', 95],
                    ['JavaScript', 85],
                    ['WordPress', 90],
                    ['Photoshop/Illustrator', 85],
                    ['Video Editing Tools', 80],
                    ['PHP/MySQL', 85]
                ];
                foreach ($tech_skills as $skill): ?>
                <div class="skill-item">
                    <div class="skill-info">
                        <span><?php echo $skill[0]; ?></span>
                        <span><?php echo $skill[1]; ?>%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress" data-width="<?php echo $skill[1]; ?>"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services">
    <div class="section-container">
        <div class="section-title" data-aos="fade-up">
            <h2>My Services</h2>
        </div>
        
        <div class="services-grid">
            <?php
            $services = [
                ['code', 'Website Development', 'Custom responsive websites built with modern technologies to establish your online presence.'],
                ['paint-brush', 'Graphic Design', 'Creative designs for brands including logos, brochures, and marketing materials.'],
                ['video', 'Video Editing', 'Professional video editing for promotional content and creative projects.'],
                ['chart-line', 'Digital Marketing', 'Strategic digital marketing to grow your online presence.'],
                ['headset', 'IT Consulting', 'Expert IT consulting and technical support for businesses.'],
                ['pen', 'Content Writing', 'Engaging SEO-optimized content for websites and blogs.']
            ];
            
            foreach ($services as $index => $service): ?>
            <div class="service-card" data-aos="fade-up" data-aos-delay="<?php echo $index * 100; ?>">
                <div class="service-icon">
                    <i class="fas fa-<?php echo $service[0]; ?>"></i>
                </div>
                <h3><?php echo $service[1]; ?></h3>
                <p><?php echo $service[2]; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section id="portfolio">
    <div class="section-container">
        <div class="section-title" data-aos="fade-up">
            <h2>My Portfolio</h2>
        </div>
        
        <div class="portfolio-grid">
            <?php
            $portfolio = [
                ['E-Commerce Website', 'Modern online store with full functionality'],
                ['Brand Identity', 'Complete brand design for local business'],
                ['Promotional Video', 'Corporate promotional video editing'],
                ['Social Media Campaign', 'Digital marketing campaign for startup']
            ];
            
            foreach ($portfolio as $index => $item): ?>
            <div class="portfolio-item" data-aos="zoom-in" data-aos-delay="<?php echo $index * 100; ?>">
                <img src="https://via.placeholder.com/400x300/112240/64ffda?text=<?php echo urlencode($item[0]); ?>" alt="<?php echo $item[0]; ?>">
                <div class="portfolio-overlay">
                    <h3><?php echo $item[0]; ?></h3>
                    <p><?php echo $item[1]; ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- About Section -->
<section id="about" class="section-bg">
    <div class="section-container">
        <div class="section-title" data-aos="fade-up">
            <h2>About Me</h2>
        </div>
        
        <div class="about-content">
            <div class="about-grid">
                <div class="about-avatar" data-aos="fade-right">
                    <div class="avatar-container">
                        <img src="assets/images/jo.png" alt="Yohannes Aregay">
                        <div class="avatar-border"></div>
                        <div class="avatar-ring"></div>
                        <div class="avatar-hover-info">Yohannes Aregay - IT Specialist</div>
                    </div>
                    
                    <!-- DTU Logo behind avatar -->
                    <div class="avatar-with-dtu"></div>
                </div>
                
                <div class="about-text" data-aos="fade-left">
                    <p>I am an Information Technology graduate from <strong style="color: var(--accent-color);">Debre Tabor University</strong>, passionate about technology, digital innovation, and helping individuals and businesses grow through modern IT solutions.</p>
                    <p>With expertise in multiple areas of technology, I provide comprehensive digital services that help clients establish strong online presence and achieve their business goals.</p>
                    
                    <div class="info-cards">
                        <div class="info-card">
                            <i class="fas fa-user"></i>
                            <h3>Name</h3>
                            <p>Yohannes Aregay</p>
                        </div>
                        <div class="info-card">
                            <i class="fas fa-briefcase"></i>
                            <h3>Profession</h3>
                            <p>IT Specialist & Digital Creator</p>
                        </div>
                        <div class="info-card">
                            <i class="fas fa-graduation-cap"></i>
                            <h3>Education</h3>
                            <p>BSc in Information Technology</p>
                        </div>
                        <div class="info-card">
                            <i class="fas fa-map-marker-alt"></i>
                            <h3>University</h3>
                            <p>Debre Tabor University</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Contact Section -->
<section id="contact">
    <div class="section-container">
        <div class="section-title" data-aos="fade-up">
            <h2>Contact Me</h2>
        </div>
        
        <div class="contact-container">
            <div class="contact-info" data-aos="fade-right">
                <h3>Get in Touch</h3>
                <div class="contact-detail">
                    <i class="fas fa-envelope"></i>
                    <span>yeadeylij@gmail.com</span>
                </div>
                <div class="contact-detail">
                    <i class="fas fa-phone"></i>
                    <span>+251 926 247 453</span>
                </div>
                <div class="contact-detail">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Debre Tabor, Ethiopia</span>
                </div>
                
                <div class="social-links">
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-github"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            
            <div class="contact-form" data-aos="fade-left">
                <form id="contactForm" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>   