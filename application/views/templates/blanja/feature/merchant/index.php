<header id="header">
    <!-- main header -->
    	<?php $this->load->view('templates/blanja/component/mainheader'); ?>
    <!-- ./main header -->
    <!-- main menu-->
		<?php $this->load->view('templates/blanja/component/mainmenu',  ['listCategory' => $home_categories]); ?>
    <!-- ./main menu-->
</header>

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
            <h1 class="page-title">Login Merchant</h1>
            <div class="page-content">
                <div class="row">
                    <div class="col-sm-6">
                        <form action="<?php echo site_url('auth/merchant/doLogin'); ?>" method="post">
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
