<!DOCTYPE html>

<!--
  Theme Name: Resto
  Theme URL: https://probootstrap.com/resto-free-restaurant-responsive-bootstrap-website-template
  Author: ProBootstrap.com
  Author URL: https://probootstrap.com
  License: Released for free under the Creative Commons Attribution 3.0 license (probootstrap.com/license)
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ProBootstrap:Resto &mdash; Free Bootstrap Theme, Free Restaurant Responsive Bootstrap Website Template</title>
    <meta name="description" content="Free Bootstrap Theme by ProBootstrap.com">
    <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Pinyon+Script" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('/assets/landing/css/styles-merged.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/landing/css/style.min.css'); ?>">

    <!--[if lt IE 9]>
      <script src="js/vendor/html5shiv.min.js"></script>
      <script src="js/vendor/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <!-- Fixed navbar -->

    <nav class="navbar navbar-default navbar-fixed-top probootstrap-navbar">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo site_url('/home'); ?>" title="ProBootstrap:FineOak">FineOak</a>
        </div>

        <div id="navbar-collapse" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li >
                <a class="btn" href="<?php echo site_url('/auth/login'); ?>">Register</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <section class="flexslider" data-section="welcome">
      <ul class="slides">
        <li style="background-image: url(<?php echo base_url('/assets/landing/img/hero_bg_1.jpg') ?>)" class="overlay" data-stellar-background-ratio="0.5">
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <div class="probootstrap-slider-text text-center probootstrap-animate probootstrap-heading">
                  <h1 class="primary-heading">Welcome</h1>
                  <br />
                  <h3 class="secondary-heading">Dkantin</h3>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </section>
    <script src="<?php echo base_url('/assets/landing/js/scripts.min.js'); ?>"></script>
    <script src="<?php echo base_url('/assets/landing/js/custom.js'); ?>"></script>

  </body>
</html>