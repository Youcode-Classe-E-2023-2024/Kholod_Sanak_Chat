<?php
?>
<div class="login">
    <div class="section">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                        <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
                        <input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
                        <label for="reg-log"></label>
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <!-- Sign in -->
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class=" title mb-4 pb-3">Log In</h4>
                                            <form method="post" action="index.php?page=login"
                                                  enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <input type="email" name="email" class="form-style"
                                                           placeholder="Your Email" id="email" autocomplete="off">
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="password" class="form-style"
                                                           placeholder="Your Password" id="password" autocomplete="off">
                                                </div>
                                                <button type="submit" name="signin" class="login1 login btn mt-4">
                                                    Submit
                                                </button>
                                                <p class="login1 mb-0 mt-4 text-center"><a class="link">Forgot your
                                                        password?</a></p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Sign up -->
                                <div class="card-back">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class=" title mb-4 pb-3">Sign Up</h4>
                                            <form method="post" action="index.php?page=login" enctype="multipart/form-data">
                                                <!-- input for profil picture -->
                                                <input type="file"  name="profile-picture" id="profile-picture" accept="image/*">
                                                <label for="profile-picture" class="cursor-pointer bg-grey-500 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded inline-block mt-2">Upload Picture</label>
                                                <div class="form-group mt-2">
                                                    <input type="text" name="logname" class="form-style" placeholder="Your Full Name" id="logname" autocomplete="off">
                                                    <i class="input-icon uil uil-user"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="email" name="logemail" class="form-style" placeholder="Your Email" id="logemail" autocomplete="off">
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="logpass" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <button name="signup" class=" login1 btn mt-4">submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
