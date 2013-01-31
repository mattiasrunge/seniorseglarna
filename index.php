<!DOCTYPE html>
<html lang="sv">
  <head>
    <meta charset="utf-8">
    <title>Seniorseglarna</title>
    <link id="favicon" rel="shortcut icon" href="img/logo.png" type="image/png">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="robots" content="noarchive, nosnippet, notranslate">

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body style="background-color: #CCEEFF;">

    <div style="width: 1000px; margin: 50px auto 50px auto;">
      <div style="position: relative;">

        <div style="padding: 20px; position: relative; z-index: 2;">

          <img class="pull-left" src="img/logo.png" style="width: 100px; height: 100px; margin-right: 30px;"/>

          <img class="thumbnail pull-right" src="img/fortissimo_small.jpg" style="height: 115px;">

          <div class="page-header" style="border-bottom-width: 0px; margin-bottom: 10px;">
            <h1>
              Seniorseglarna<br/>
              <small><i>En förening för seglingsintresserade</i></small>
            </h1>
          </div>

          <div class="tabbable"> <!-- Only required for left/right tabs -->
            <ul class="nav nav-tabs">
              <li data-bind="css: { active: newsModel.show }"><a href="#news">Nyheter</a></li>
              <li data-bind="css: { active: aboutModel.show }"><a href="#about">Om oss</a></li>
              <li><a href="#tab3" data-toggle="tab">Forum</a></li>
              <li><a href="#tab3" data-toggle="tab">Gästbok</a></li>
              <li><a href="#tab4" data-toggle="tab">Galleri</a></li>
              <li><a href="#tab5" data-toggle="tab">Artiklar</a></li>

              <li class="pull-right"><a href="#tab6" data-toggle="tab">Logga in</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane" data-bind="css: { active: newsModel.show }">
                <? include("./views/news/view.html"); ?>
              </div>
              <div class="tab-pane" data-bind="css: { active: aboutModel.show }">
                <? include("./views/about/view.html"); ?>
              </div>

               <div class="tab-pane" id="tab5">

                <div class="row-fluid">
                  <div class="span3">
                    <ul class="nav nav-pills nav-stacked">
                      <li><a href="#">2013</a></li>
                      <li class="active"><a href="#">2012</a></li>
                      <li><a href="#">2011</a></li>
                      <li><a href="#">2010</a></li>
                      <li><a href="#">2009</a></li>
                      <li><a href="#">2008</a></li>
                      <li><a href="#">2007</a></li>
                      <li><a href="#">2006</a></li>
                      <li><a href="#">2005</a></li>
                      <li><a href="#">2004</a></li>
                      <li><a href="#">2003</a></li>

                    </ul>
                  </div>

                  <div class="span9">

<div class="media well" style="background-color: white;">
  <a class="pull-left" href="#">
    <img class="media-object thumbnail" style="width: 125px; height: 125px;" src="img/artikel1.jpg">
  </a>
  <div class="media-body">
    <h4 class="media-heading">Eskadersegling 2011</h4>
    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
  </div>
</div>

<div class="media well" style="background-color: white;">
  <a class="pull-left" href="#">
    <img class="media-object thumbnail" style="width: 125px; height: 125px;" src="img/artikel2.jpg">
  </a>
  <div class="media-body">
    <h4 class="media-heading">En tur på havet</h4>
    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
  </div>
</div>

                  </div>
                </div>
              </div>

              <div class="tab-pane" id="tab2">

                <div class="row-fluid">
                  <div class="span3">


                  <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#">Om oss</a></li>
                    <li><a href="#">Stadgar</a></li>
                    <li class="nav-header">Mötesanteckningar</li>
                    <li><a href="#">2013-01-01</a></li>
                  </ul>


                  </div>

                  <div class="span9" style="padding-bottom: 20px;">
                    <h3>Stadgar</h3>
<div style="max-height: 400px; overflow: auto;">
<h4>§1 Föreningens syfte</h4>
<p>
Föreningen har till syfte att samla seglingsintresserade seniorer  med eller utan båt. Genom samverkan och ömsesidig hjälp skall föreningen medverka till ett rikare och mer aktivt båtliv.
Föreningen skall också verka för aktivitetsutbyte mellan olika kustområden.
</p>


<h4>§2     Verksamhet     </h4>
<p>
Räkenskapsår skall omfatta tiden 1 oktober - 30 september.
Årsmöte skall hållas senast 15 november.

Kallelse till mötet skall ske senast 12 dagar före mötet. Kallelsen samt protokollutskick skall ske på de kanaler som krävs för att alla skall nås.
</p>


<h4>§3     Avgifter  </h4>
<p>
Avgifter för räkenskapsåret fastställs på årsmötet och erläggs före 1 februari påföljande år.
</p>


<h4>§4     Föredragningslistor till möten </h4>
<p>

  <h5>       Vid mötet skall förekomma:</h5>

                         <ol>
<li>       Val av ordförande att leda mötet</li>

<li>     Godkännande av röstlängden</li>

<li>     Fråga om mötets stadgeenliga
          utlysande</li>

<li>      Val av två personer att justera                         mötesprotokollet</li>


</ol>

<h5>  Vid årsmöte skall dessutom förekomma:</h5>

<ol start="5">

<li>     Föredragning av styrelsens
         och revisorernas berättelse</li>

<li>       Fastställande av balansräkningen</li>

<li>       Fråga om ansvarsfrihet för                             styrelsen                                              </li>

<li>        Val av styrelseledamöter, revisorer                och ledamöter till valberedningen                                                 </li>

<li>       Fastställande av föreningens inkomst-           och utgiftsstat för löpande                              räkenskapsåret 1 oktober -
          30 september    </li>

<li>      Fastställande av avgifter</li>
</ol>
</p>


<h4>§5     Styrelse, revisorer och valberedning</h4>
<p>

Styrelsen skall bestå av

   Dels ordförande och vice ordförande
   utsedda för två år   ,

   dels två övriga ordinarie ledamöter,
   utsedda för två år

    samt en suppleant, utsedd för ett år.

    Revisor och suppleant utses för ett år.

    Valberedning skall bestå av två
    ledamöter, som utses för ett år.

    Styrelsen skall konstituera sig inom 14
    dagar efter årsmötet, vid nyval av
    styrelse eller styrelseledamot.
</p>


<h4>§6     Omröstning på möte, ändring av stadgar, mm</h4>
<p>
         Omröstning sker öppet om ej annat
          begäres.
          Medlem kan genom fullmakter på
          möte rösta för högst fem
          röstberättigade medlemmar.

         Fullmakterna granskas av två av
         styrelsen utsedda medlemmar.

         Beslut fattas med enkel majoritet, dock
         att för ändring av föreningens stadgar
         erfordras 2/3 majoritet.

          Beslut om föreningens upplösning kan           endast ske med 3/4 majoritet.

          Vid upplösning av föreningen tillfaller
          kvarvarande medel Sjöräddningen.
</p>
                  </div>
                </div>

</div>
              </div>

              <div class="tab-pane" id="tab3">

              <div class="row-fluid">
                  <div class="span3">
                    <ul class="nav nav-pills nav-stacked">
                      <li class="active"><a href="#">Allt om båtar</a></li>
                      <li><a href="#">Glada minnen</a></li>
                      <li><a href="#">Allt om hamnar</a></li>
                    </ul>
                  </div>

                  <div class="span9">



                <table class="table table-striped">
                  <thead>
                    <th>Ämne</th>
                    <th>Författare</th>
                    <th>Senaste&nbsp;uppdaterad</th>
                    <th>Antal&nbsp;inlägg</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Fin båt!</td>
                      <td>Bengt Runge</td>
                      <td>Idag</td>
                      <td>5</td>
                    </tr>
                    <tr>
                      <td>Vädret är inte bra</td>
                      <td>Jan Perlander</td>
                      <td>Igår</td>
                      <td>1</td>
                    </tr>
                    <tr>
                      <td>En väldigt bra hamn</td>
                      <td>Bengt Runge</td>
                      <td>Måndag den 13:e mars</td>
                      <td>3</td>
                    </tr>
                    <tr>
                      <td>Segel</td>
                      <td>Mattias Runge</td>
                      <td>Torsdag den 3:e januari</td>
                      <td>4</td>
                    </tr>
                  </tbody>
                </table>


                <div class="pagination pagination-centered">
                  <ul>
                    <li><a href="#">Föregående</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">Nästa</a></li>
                  </ul>
                </div>

              </div>
              </div>
              </div>

              <div class="tab-pane" id="tab4">
                <div class="row-fluid">
                <ul class="thumbnails">
              <li class="span4">
                <div class="thumbnail" style="background-color: white;">
                  <img alt="300x200" style="width: 300px; height: 200px;" src="img/fortissimo_small.jpg">
                  <div class="caption">
                    <h3>Lite bilder på en Fortissimo</h3>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

                  </div>
                </div>
              </li>
              <li class="span4">
                <div class="thumbnail" style="background-color: white;">
                  <img alt="300x200" style="width: 300px; height: 200px;" src="img/allegro_small.jpg">
                  <div class="caption">
                    <h3>Bilder på en vacker Allegro</h3>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

                  </div>
                </div>
              </li>
              <li class="span4">
                <div class="thumbnail" style="background-color: white;">
                  <img alt="300x200" style="width: 300px; height: 200px;" src="img/motorbat_small.jpg">
                  <div class="caption">
                    <h3>Bilder på fula motorbåtar</h3>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

                  </div>
                </div>
              </li>
            </ul>
            </div>
                 <div class="pagination pagination-centered">
                  <ul>
                    <li><a href="#">Föregående</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">Nästa</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="well" style="position: absolute; top: 0px; left: 0px; right: 0px; bottom: 0px; opacity: 0.9"></div>
      </div>
    </div>

    <script src="http://code.jquery.com/jquery-1.9.0.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>

    <script src="js/knockout-2.2.1.js"></script>
    <script src="js/knockout.mapping-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/jquery.history.min.js"></script>
    <script src="js/jquery.anystretch.min.js"></script>
    <script src="js/utils.js"></script>
    <script src="js/knockout.extensions.js"></script>

    <script src="views/news/model.js"></script>
    <script src="views/about/model.js"></script>
    <script src="views/model.js"></script>

    <script>

      $(function()
      {
        moment.lang('sv', {
          months : "januari_februari_mars_april_maj_juni_juli_augusti_september_oktober_november_december".split("_"),
          monthsShort : "jan_feb_mar_apr_maj_jun_jul_aug_sep_okt_nov_dec".split("_"),
          weekdays : "söndag_måndag_tisdag_onsdag_torsdag_fredag_lördag".split("_"),
          weekdaysShort : "sön_mån_tis_ons_tor_fre_lör".split("_"),
          weekdaysMin : "sö_må_ti_on_to_fr_lö".split("_"),
          longDateFormat : {
            LT : "HH:mm",
            L : "YYYY-MM-DD",
            LL : "D MMMM YYYY",
            LLL : "D MMMM YYYY LT",
            LLLL : "dddd D MMMM YYYY LT"
          },
          calendar : {
            sameDay: '[Idag klockan] LT',
            nextDay: '[Imorgon klockan] LT',
            lastDay: '[Igår klockan] LT',
            nextWeek: 'dddd [klockan] LT',
            lastWeek: '[Förra] dddd[en klockan] LT',
            sameElse: 'L'
          },
          relativeTime : {
            future : "om %s",
            past : "för %s sedan",
            s : "några sekunder",
            m : "en minut",
            mm : "%d minuter",
            h : "en timme",
            hh : "%d timmar",
            d : "en dag",
            dd : "%d dagar",
            M : "en månad",
            MM : "%d månader",
            y : "ett år",
            yy : "%d år"
          },
          ordinal : function (number) {
            var b = number % 10,
              output = (~~ (number % 100 / 10) === 1) ? 'e' :
              (b === 1) ? 'a' :
              (b === 2) ? 'a' :
              (b === 3) ? 'e' : 'e';
            return number + output;
          },
          week : {
            dow : 1, // Monday is the first day of the week.
            doy : 4  // The week that contains Jan 4th is the first week of the year.
          }
        });

        $.anystretch("img/background.jpg", {speed: 300});

        ko.applyBindings(mainModel);


        jQuery.History.bind(function(state)
        {
          mainModel.args(state.split(":"));
        });

        if (document.location.hash.length === 0)
        {
          jQuery.History.trigger("");
        }
      });

    </script>
  </body>
</html>
