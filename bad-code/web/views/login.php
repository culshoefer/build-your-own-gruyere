<?php
/**
 * @author Christoph Ulshoefer <christophsulshoefer@gmail.com>
 * @copyright 2017
 * @license http://opensource.org/licenses/gpl-license.php MIT License
 * Diplays login depending on session (e.g. we need to display errors on trying to register)
 */
$GLOBALS['page_name'] = 'Login';
include 'includes/header.php';
?>

<div class="container">
    <div class="row">
        <div class="col s6">
            <div class="card">
                <span class="card-title">Login</span>
                <div class="card-content">
                    <form class="" method="post">
                        <div class="input-field">
                            <input type="text" placeholder="username" class="validate" name="username">
                        </div>
                        <div class="input-field">
                            <input type="password" placeholder="password" class="validate" name="password">
                        </div>
                        <input type="submit" class="btn" name="submit-login" value="Login">
                    </form>
                </div>
            </div>
        </div>

        <div class="col s6">
            <div class="card">
                <span class="card-title">Sign up</span>
                <div class="card-content">
                    <form class="" method="post">
                        <div class="input-field">
                            <input type="text" placeholder="username" class="validate" name="username">
                        </div>
                        <div class="input-field">
                            <input type="password" placeholder="password" class="validate" name="password">
                        </div>
                        <input type="submit" class="btn" name="submit-registration" value="Sign up">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>
