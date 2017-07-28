<?php
    $partner = getPartner();
?>
<div class="footer-top">
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-sm-12 col-md-4">

                    <div class="block footer-block-box">
                        <div class="block-head">
                            <div class="block-title">
                                <div class="block-icon">
                                    <img src="<?php echo base_url('assets/tempdkantin/data/location-icon.png'); ?>" alt="store icon">
                                </div>
                                <div class="block-title-text text-sm">FIND A</div>
                                <div class="block-title-text text-lg">edo store</div>
                            </div>
                        </div>
                        <div class="block-inner">
                                 <div id="map" style="width:300px; height:125px"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="block footer-block-box">
                        <div class="block-head">
                            <div class="block-title">
                                <div class="block-icon">
                                    <img src="<?php echo base_url('assets/tempdkantin/data/email-icon.png'); ?>" alt="store icon">
                                </div>
                                <div class="block-title-text text-sm">SUBSCRIBE TO</div>
                                <div class="block-title-text text-lg">edo shop EMAILS</div>
                            </div>
                        </div>
                        <div class="block-inner">
                            <div class="block-info clearfix">
                                Masukan email untuk dapat informasi jelas dan terbaru.
                            </div>
                            <div class="block-input-box box-radius clearfix">
                                <form action="<?php echo site_url('/subscribed'); ?>" method="post">
                                    <input type="text" class="input-box-text" placeholder="Email address" name="subscribed">
                                    <button class="block-button">Go</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="block footer-block-box">
                        <div class="block-head">
                            <div class="block-title">
                                <div class="block-icon">
                                    <img src="<?php echo base_url('assets/tempdkantin/data/partners-icon.png'); ?>" alt="store icon">
                                </div>
                                <div class="block-title-text text-sm">our</div>
                                <div class="block-title-text text-lg">partners</div>
                            </div>
                        </div>
                        <div class="block-inner">
                            <div class="block-owl">
                                <ul class="kt-owl-carousel list-partners" data-nav="true" data-autoplay="true" data-loop="true" data-items="1">
                                    <?php
                                        foreach ($partner as $p => $vlu) {
                                    ?>
                                    <li class="partner">
                                        <a href="<?php echo site_url('/partner').'/'.sanitizeStringForUrl($vlu['name_partner']).'-'.$vlu['id_partner']; ?>">
                                            <img style="width:330px; height:85px" src="<?php echo base_url('attachments/partner/').$vlu['img_partner']; ?>" alt="<?php echo $vlu['name_partner'];  ?>"
                                            onerror="this.onerror=null;this.src='<?php echo base_url('assets/tempdkantin/data/partner1.jpg'); ?>'">
                                        </a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var imgicon = "<?php echo base_url('/assets'); ?>/icon_marker.png"

      function initMap() {
          var iconResize = {
                  url: imgicon, // url
                  scaledSize: new google.maps.Size(35, 30), // scaled size
                  origin: new google.maps.Point(0,0), // origin
                  anchor: new google.maps.Point(0, 0) // anchor
              };

        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -6.254140, lng: 106.790784},
          scrollwheel: false,
          zoom: 16
        });
        var myMarker = new google.maps.Marker({
          map: map,
          animation: google.maps.Animation.DROP,
          position: {lat: -6.254140, lng: 106.790784},
          icon: iconResize
        });
      }

    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAiKA0TqagfKT5uU3KMjP8XC3bZImSjh4&callback=initMap"
    async defer></script>
