<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6" style="margin:10px 0;">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Schadensmeldung</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="/">Home</a></li>
                    <li><span>Schadensmeldung</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- page title area end -->
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card card-bordered">
                <div class="card-body">
                    <form class="needs-validation" novalidate="" action="#">
                        <div class="form-row mb-1">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-vnr-input" class="col-form-label">Versicherungsscheinnummer</label>
                                    <input class="form-control" type="text" value="" id="example-vnr-input">
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-prename-input" class="col-form-label">Vorname</label>
                                    <input class="form-control" type="text" value="" id="example-prename-input">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-name-input" class="col-form-label">Name</label>
                                    <input class="form-control" type="text" value="" id="example-name-input">
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-street-input" class="col-form-label">Straße</label>
                                    <input class="form-control" type="text" value="" id="example-street-input">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="example-zip-input" class="col-form-label">PLZ</label>
                                    <input class="form-control" type="text" value="" id="example-zip-input">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-city-input" class="col-form-label">Stadt</label>
                                    <input class="form-control" type="text" value="" id="example-city-input">
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-email-input" class="col-form-label">E-Mail Adresse</label>
                                    <input class="form-control" type="email" value="" id="example-email-input">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-tel-input" class="col-form-label">Telefon</label>
                                    <input class="form-control" type="tel" value="" id="example-tel-input">
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-incident-from-input" class="col-form-label">Schadenszeitraum von</label>
                                    <input class="form-control" type="datetime-local" value="" id="example-incident-from-input">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-incident-to-input" class="col-form-label">Schadenszeitraum bis</label>
                                    <input class="form-control" type="datetime-local" value="" id="example-incident-to-input">
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-incident-to-input" class="col-form-label">Anhang</label>
                                    <div class="input-group">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Datei auswählen</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-1">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-description-input" class="col-form-label">Beschreibung</label>
                                    <textarea class="form-control" id="example-description-input"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-1">
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Schaden melden</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>