<style>
    .levelI a{
        background-image: url('https://cdn4.iconfinder.com/data/icons/momenticons-gloss-basic/momenticons-gloss-basic/16/bullet-green.png');
        background-repeat: no-repeat;
        background-position: 2px center;
    }
    
    .levelW a{
        background-image: url('https://cdn4.iconfinder.com/data/icons/momenticons-gloss-basic/momenticons-gloss-basic/16/bullet-yellow.png');
        background-repeat: no-repeat;
        background-position: 2px center;
    }
    
    .levelE a{
        background-image: url('https://cdn4.iconfinder.com/data/icons/momenticons-gloss-basic/momenticons-gloss-basic/16/bullet-red.png');
        background-repeat: no-repeat;
        background-position: 2px center;
    }
</style>

<script>
    
    
    function refreshVar(elem){
        $.ajax({url: "<?= site_url('ajax/messages') ?>", success: function(result){
            var json = JSON.parse(result);
            
            var anzahl = json.messages.length
            
            $(elem).empty();
            
            for(var k = 0; k < anzahl; k++){
                var name = json.messages[k].name;
                var level = json.messages[k].level;
                var text = json.messages[k].text;
                
                $(elem).append('<li class="level' + level + '"><a style="padding-left:20px;" href="<?= site_url('sensor/show/'); ?>' + name + '">&nbsp;' + text + '</a></li>');
            }
            
        }});
    }
    
    function refresh(){
        $.ajax({url: "<?= site_url('ajax/messages') ?>", success: function(result){
            var json = JSON.parse(result);
            
            var anzahl = json.messages.length

            $("#refresh1").empty();
            $("#refresh2").empty();
            
            $("#refresh1").html(anzahl);
            $("#refresh2").html(anzahl + " Benachrichtigung(en)");
            
            $("#refresh3").empty();
            
            for(var k = 0; k < anzahl; k++){
                var name = json.messages[k].name;
                var level = json.messages[k].level;
                var text = json.messages[k].text;
      
                $("#refresh3").append('<li class="level' + level + '"><a href="<?= site_url('sensor/show/'); ?>' + name + '">&nbsp;' + text + '</a></li>');
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
                                    <span id="refresh1" class="notification hidden-sm hidden-xs">0</span>
									<p id="refersh2" class="hidden-lg hidden-md">
										<b class="caret"></b>
									</p>
                              </a>
                              <ul id="refresh3" class="dropdown-menu">
                                <li><a href="#"></a></li>
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