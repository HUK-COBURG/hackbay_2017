<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6" style="margin:10px 0;">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Dashboard</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="/">Home</a></li>
                    <li><span>Dashboard</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- page title area end -->
<div class="main-content-inner">
    <div class="row">
        <div class="col-lg-6 mt-5">
            <div class="card card-bordered">
                <div class="card-body">
                    <h5 class="header-title">Benachrichtigungen</h5>
                    <div class="list-group" id="smarte-dashboard-notifications">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mt-5">
            <div class="card card-bordered">
                <div class="card-body">
                    <h5 class="header-title">Empfehlungen</h5>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Nutzungsverhalten</h5>
                                <small>heute</small>
                            </div>
                            <p class="mb-1">Schalten Sie den Fernseher aus, wenn Sie den Raum verlassen, um Strom zu sparen!</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function refreshDashboardNotifications() {
        console.log('refresh dashboard notifications');

        $.ajax({ cache: false,
            url: '/alerts/dashboard_notifications'
        }).done(function(data) {
            console.log('request successfull');
            $('#smarte-dashboard-notifications').html(data);
        }).fail(function(data) {
            console.log('request failed');
        });
    }

    refreshDashboardNotifications();
    setInterval(refreshDashboardNotifications, 60000);
</script>