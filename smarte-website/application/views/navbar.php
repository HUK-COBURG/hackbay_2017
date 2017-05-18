<script>
    function refresh(){
        $.ajax({url: "ajax/messages", success: function(result){
            var json = JSON.parse(result);
            
            $("#refresh1").html(json.length);
            $("#refresh2").html(json.length + " Benachrichtigung(en)");
            
            for (var schwellwerte in json) {
                // skip loop if the property is from prototype
                if (!json.hasOwnProperty(schwellwerte)) continue;

                var schwellwert = json[schwellwerte];
                for (var prop in schwellwert) {
                    // skip loop if the property is from prototype
                    if(!schwellwert.hasOwnProperty(prop)) continue;

                    alert(prop);
                    $("#refresh3").append("<li><a href=&quot;#&quot;>" + prop + "</a></li>");
                }
            }
            
        }});
    }
</script>

<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><?= isset($sensor) ? $sensor->get_SensorBezeichnung() : 'Überblick'; ?></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret hidden-sm hidden-xs"></b>
                                    <span id="refresh1" class="notification hidden-sm hidden-xs">1</span>
									<p id="refersh2" class="hidden-lg hidden-md">
										1 Benachrichtigung
										<b class="caret"></b>
									</p>
                              </a>
                              <ul id="refresh3" class="dropdown-menu">
                                <li><a href="#">Möglicher Wasserschaden</a></li>
                              </ul>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="">
                               <p>Konto</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <p>Abmelden</p>
                            </a>
                        </li>
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>