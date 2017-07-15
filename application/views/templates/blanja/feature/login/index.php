<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="container">
    <div class="row">
        <div class="block block-breadcrumbs">
            <ul>
                <li class="home">
                    <a href="#"><i class="fa fa-home"></i></a>
                    <span></span>
                </li>
                <li>Authentication</li>
            </ul>
        </div>
        <div class="main-page">
            <h1 class="page-title">Masuk Dkantin</h1>
            <div class="page-content">
                <div class="row">
                    <div class="col-sm-6">
                        <form action="<?php echo site_url('auth/login/dosave'); ?>" method="post">
                            <div class="box-border">
                                <?php
                                    if ($this->session->flashdata('success')) { ?>
                                        <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
                                <?php } else { ?>
                                    <?php if ($this->session->flashdata('errors')) { ?>
                                        <div class="alert alert-danger"><?= $this->session->flashdata('errors') ?></div>
                                    <?php } ?>
                                <h4>Buat akun dkantin Anda</h4>
                                <small>Ayo mulai daftar</small>
                                <p>
                                    <label>Nama (username)</label>
                                    <input type="text" name="name_client">
                                </p>
                                <p>
                                    <label>No Hp</label>
                                    <input type="text" name="hp_client">
                                </p>
                                <p>
                                    <label>Jenis Kelamin    </label><br />
                                    <input type="radio" name="gender_client" value="Pria"> Pria &nbsp;
                                    <input type="radio" name="gender_client" value="Wanita"> Female
                                </p>
                                <p>
                                    <label>Email</label>
                                    <input type="text" name="email_client" autocomplete="off">
                                </p>
                                <p>
                                    <label>Password</label>
                                    <input type="password" name="password_client" autocomplete="off">
                                </p>
                                <p>
                                    <span style="font-size:10px">
                                        Dengan mendaftar, Anda telah menyetujui	<a href="" class="color:#fff">Perjanjian Pengguna</a> dan <a href="">Kebijakan Privasi</a>
                                    </span>
                                </p>
                                <p>
                                    <div class="g-recaptcha" data-sitekey="6LdH-CgUAAAAALu_8OolgRWGEddeXO1VYVX5I9pT"></div>
                                </p>
                                <p>
                                    <button class="button"><i class="fa fa-user"></i> Masuk </button>
                                </p>
                            </div>
                        </form>
                        <?php  } ?>
                    </div>
                    <div class="col-sm-6">

                        <form action="<?php echo site_url('auth/login/doLogin'); ?>" method="post">
                            <div class="box-border">
                                <?php if ($this->session->flashdata('error_login')) { ?>
                                    <div class="alert alert-danger"><?= $this->session->flashdata('error_login') ?></div>
                                <?php } ?>
                                <h4>login</h4>
                                <p>
                                    <label>Nama(Username)</label>
                                    <input type="text" name="name_client">
                                </p>
                                <p>
                                    <label>Password</label>
                                    <input type="password" name="password_client" autocomplete="off">
                                </p>
                                <p>
                                    <a href="#">Forgot your password?</a>
                                </p>
                                <p>
                                    <button class="button"><i class="fa fa-lock"></i> Sign in</button>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
