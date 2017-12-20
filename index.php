<?php
session_start();
include ('header.php');
?>
<main>
<div id="main">
    <div class="container">
        <div class="row">
            <?php if (empty($_SESSION['login']) and empty($_SESSION['password'])) { ?>
            <div class="col"></div>
        <div class="enter-mode col-xs-12 col-sm-12 col-md-6 col-6" role="tablist">
            <div class="card">
                <div class="card-header" role="tab" id="enterH">
                    <h5 class="mb-0">
                        <a data-toggle="collapse" href="#enterB" aria-expanded="true" aria-controls="enterB">
                            Log In
                        </a>
                    </h5>
                </div>

                <div id="enterB" class="collapse show" role="tabpanel" aria-labelledby="enter" data-parent="#accordion">
                    <div class="card-body">
                        <form id="logForm" action="assets/php/test_reg.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="loginField">login</label>
                                <input type="text" class="form-control" name="loginField" id="loginField" <?php if (isset($_COOKIE['loginField'])) { ?> value=" <?php echo $_COOKIE['loginField']; ?>" <?php } ?>/>
                            </div>
                            <div class="form-group">
                                <label for="passwordField">password</label>
                                <input type="password" class="form-control" name="passwordField" id="passwordField" <?php if (isset($_COOKIE['passwordField'])) { ?> value=" <?php echo $_COOKIE['passwordField']; ?>" <?php } ?>/>
                            </div>
                            <div class="form-group">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" id="save" name="save" value='1'>
                                    Remember me
                                </label>
                            </div>
                            <input id="submitE" type="button" class="btn" value="submit">
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" role="tab" id="registerH">
                    <h5 class="mb-0">
                        <a data-toggle="collapse" href="#registerB" aria-expanded="false" aria-controls="registerB">
                            Register
                        </a>
                    </h5>
                </div>

                <div id="registerB" class="collapse" role="tabpanel" aria-labelledby="registerH" data-parent="#accordion">
                    <div class="card-body">
                        <form id="regForm" action="assets/php/register.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="loginFieldR">Your login</label>
                                <input type="text" class="form-control" id="loginFieldR" aria-describedby="loginHelp" name="loginFieldR">
                                <small class="form-text text-muted">3-15 chars</small>
                            </div>
                            <div class="form-group">
                                <label for="passwordFieldR1">Your password</label>
                                <input type="password" class="form-control" id="passwordFieldR1" name="passwordFieldR1" size="15" maxlength="15"/>
                                <small class="form-text text-muted">3-15 chars</small>
                            </div>
                            <div class="form-group">
                                <label for="passwordFieldR2">Confirm</label>
                                <input type="password" class="form-control" id="passwordFieldR2" name="passwordFieldR2" size="15" maxlength="15"/>
                                <small class="form-text text-muted">3-15 chars</small>
                            </div>
                            <div class="form-group">
                                <label class="custom-file">
                                    <input type="file" id="file" name="file" class="form-control-file">
                                    <span class="form-control-file"></span>
                                </label>
                            </div>
                            <input id="submitR" type="submit" class="btn" value="submit">
<!--                            <input id="submitR" type="button" class="btn" value="submit">-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
            <div class="col"></div>
            <?php } ?>
    </div>
    </div>
</div>
    <div class="alert-popup">
        <p class="message">!</p>
    </div>
</main>
<?php
include ('footer.php');
?>
