<footer class="pad-x">
    <div class="logo-text">
        <a href="#">
            <h2 class="heading">May I <span>help</span> You</h2>
        </a>
    </div>
    <div class="copyright">
        <p>&copy; 2024 MayIHelpYou - service provider || Created by Siddharth Sarode and Gopal Sadavarte</p>
    </div>
    <div class="footer-link">
        <?php if (!isset($_SESSION['userEmail'])) : ?>
        <a href="./admin/php/_adminLogin.php" class="d-flex just-center align-center ">
            <img src="img/icons/admin.png" alt="Admin" width="20" height="20">
            <span>Login</span>
        </a>
        <?php else : ?>
        <a href="#" class="button btn-green">Get Help</a>
        <?php endif; ?>
    </div>
</footer>