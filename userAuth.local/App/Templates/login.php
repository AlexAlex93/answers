<?php
    if (isset($this->data['auth_error'])) {
        echo $this->data['auth_error'];
    } else {
?>

<form action="index.php" method="post">
    <p>
        <label for="lgn">Login</label>
        <input type="text" name="lgn" id="lgn">
    </p>
    <p>
        <label for="pswd">Password</label>
        <input type="password" name="pswd" id="pswd">
    </p>
    <p>
        <input type="checkbox" name="remember_me" id="remember_me">
        <label for="remember_me">Remember me</label>
    </p>
    <p>
        <button type="submit">
            Login
        </button>
    </p>
</form>

<?php } ?>
<?php
    if (isset($_SESSION['login_error'])) { 
        echo $_SESSION['login_error'];
        unset($_SESSION['login_error']);
    }
?>
