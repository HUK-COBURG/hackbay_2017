<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SMART-E: Smart Home Auswertung</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">-->
    <?php echo assets_css(array('bootstrap.min.css', 'font-awesome.min.css', 'themify-icons.css', 'metisMenu.css', 'owl.carousel.min.css', 'slicknav.min.css')); ?>
    <!-- others css -->
    <?php echo assets_css(array('typography.css', 'default-css.css', 'styles.css', 'responsive.css')); ?>
    <!-- modernizr css -->
    <?php echo assets_js('vendor/modernizr-2.8.3.min.js'); ?>
</head>

<body>
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="#"><?php echo assets_img('icon/logo1.png', array('alt' => 'logo')); ?></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <?php foreach ($menu as $item): ?>
                                <?php echo $item->getHtml(); ?>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                            <li class="dropdown" id="smarte-notifications">
                                <i class="ti-bell dropdown-toggle" data-toggle="dropdown"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <div id="smarte-content"></div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright 2018. All right reserved. Template by <a href="https://colorlib.com/wp/">Colorlib</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- jquery latest version -->
    <?php echo assets_js('vendor/jquery-2.2.4.min.js'); ?>
    <!-- bootstrap 4 js -->
    <?php echo assets_js(array('popper.min.js', 'bootstrap.min.js', 'owl.carousel.min.js', 'metisMenu.min.js', 'jquery.slimscroll.min.js', 'jquery.slicknav.min.js')); ?>
    <!-- start zingchart js -->
    <?php echo assets_js('vendor/zingchart.min.js'); ?>
    <script>
        zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- others plugins -->
    <?php echo assets_js(array('plugins.js', 'scripts.js')); ?>
    <script>
        function loadContent(href) {
            console.log('load content for ' + href)
            
            $.ajax({ cache: false,
                url: href
            }).done(function(data) {
                console.log('request successfull');
                $('#smarte-content').html(data);
            }).fail(function(data) {
                console.log('request failed');
            });
        }
        
        function loadChart(id, interval, div) {
            console.log('load chart hour for ' + id);

            $.ajax({ cache: false,
                url: '/measurement/chart/' + id + '/' + interval
            }).done(function(data) {
                console.log('request successfull');
                console.log('set chart ' + id);

                zingchart.render({ 
                    id : div, 
                    data : data, 
                    height: 400, 
                    width: '100%'
                });
            }).fail(function(data) {
                console.log('request failed');
            });
        }
        
        function refreshNotifications() {
            console.log('refresh notifications');

            $.ajax({ cache: false,
                url: '/alerts/notifications'
            }).done(function(data) {
                console.log('request successfull');
                $('#smarte-notifications').html(data);
            }).fail(function(data) {
                console.log('request failed');
            });
        }

        $(document).on("click", '.ajax-get-content', function(event) {
            loadContent($(this).attr('data-href'));
        });
        
        $( document ).ready(function() {
            loadContent($('.smarte-menu').first().attr('data-href'));
            refreshNotifications();
            setInterval(refreshNotifications, 60000);
        });
    </script>
</body>

</html>