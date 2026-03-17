    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3><?php echo SITE_NAME; ?></h3>
                <p>Innovating Technology, Empowering Digital Skills. Your trusted partner for digital solutions and IT services in Ethiopia.</p>
                <div class="footer-social">
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-github"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=61555748346278"><i class="fab fa-facebook-f"></i></a>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="index.php#home"><i class="fas fa-chevron-right"></i> Home</a></li>
                    <li><a href="index.php#about"><i class="fas fa-chevron-right"></i> About</a></li>
                    <li><a href="index.php#services"><i class="fas fa-chevron-right"></i> Services</a></li>
                    <li><a href="index.php#portfolio"><i class="fas fa-chevron-right"></i> Portfolio</a></li>
                    <li><a href="index.php#contact"><i class="fas fa-chevron-right"></i> Contact</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Services</h3>
                <ul class="footer-links">
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Web Development</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Graphic Design</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Video Editing</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Digital Marketing</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> IT Consulting</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Contact Info</h3>
                <ul class="footer-contact">
                    <li><i class="fas fa-map-marker-alt"></i> Debre Tabor, Ethiopia</li>
                    <li><i class="fas fa-envelope"></i> yeadeylij@gmail.com</li>
                    <li><i class="fas fa-phone"></i> +251 926 247 453</li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2026 <?php echo SITE_NAME; ?>. All rights reserved. Created with <i class="fas fa-heart" style="color: #ff6b6b;"></i> by <?php echo SITE_AUTHOR; ?></p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="assets/js/main.js"></script>
    <?php if (isset($additional_scripts)) echo $additional_scripts; ?>
</body>
</html>
