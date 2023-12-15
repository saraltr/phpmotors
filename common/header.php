<div class="topHeader">
    <img src="/phpmotors/images/site/logo.png" alt="php motors logo" id="logo">
    <?php if (isset($_SESSION['loggedin'])): ?>
    <p class="account">
        <a href="/phpmotors/accounts/">
            <?= $_SESSION['clientData']['clientFirstname'] ?>
        </a>
        <a href="/phpmotors/accounts/index.php?action=logout" title="Logout Session in PHP Motors" id="logout">Log Out</a>
        <a href="/phpmotors/search" title="Search PHP Motors">&#x1F50D;</a>
    </p>
    <?php else: ?>
        <p class="account">
            <a href="/phpmotors/accounts/index.php?action=login-page" id="loginLink">My Account</a>
            <a href="/phpmotors/search" title="Search PHP Motors">&#x1F50D;</a>
        </p>
    <?php endif; ?>
</div>