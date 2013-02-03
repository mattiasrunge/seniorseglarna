<?php require_once("start.php"); ?>
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
    <link href="css/bootstrap-wysihtml5-0.0.2.css" rel="stylesheet">
    <link href="css/datepicker.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
    <script type="text/html" id="loadingTemplate">
      <div class="well" style="background-color: white;">
        <h4>Laddar <span data-bind="text: $data"></span>...</h4>
        <div class="progress progress-striped active" style="margin-bottom: 0px;">
          <div class="bar" style="width: 80%;"></div>
        </div>
      </div>
    </script>

    <?php include("./views/news/dialogs.html"); ?>
    <?php include("./views/about/dialogs.html"); ?>
    <?php include("./views/forum/dialogs.html"); ?>
    <?php include("./views/members/dialogs.html"); ?>

    <div class="center-container">

      <div class="well main-background"></div>

      <div class="main-container">
        <div class="pull-right" style="padding-right: 15px;">
          <div class="nav-header" style="padding-right: 0px; text-align: right;">Kontakt</div>
          <a href="mailto:info@seniorseglarna.se">info@seniorseglarna.se</a>
        </div>

        <img class="pull-left main-logo" alt="" src="img/logo.png"/>

        <div class="page-header main-header">
          <h1>
            Seniorseglarna<br/>
            <small><i>En förening för seglingsintresserade</i></small>
          </h1>
        </div>

        <div class="tabbable">
          <ul class="nav nav-tabs">
            <li data-bind="css: { active: newsModel.show }">
              <a href="#news">Nyheter</a>
            </li>
            <li data-bind="css: { active: aboutModel.show }">
              <a href="#about">Om oss</a>
            </li>
            <li data-bind="css: { active: guestbookModel.show }">
              <a href="#guestbook">Gästbok</a>
            </li>
            <li data-bind="css: { active: forumModel.show }">
              <a href="#forum">Forum</a>
            </li>
            <li data-bind="css: { active: galleryModel.show }" style="display: none;">
              <a href="#gallery">Galleri</a>
            </li>
            <li data-bind="css: { active: storiesModel.show }" style="display: none;">
              <a href="#stories">Logböcker</a>
            </li>

            <li class="pull-right" data-bind="css: { active: profileModel.show }">
              <a href="#profile">
                <span data-bind="visible: profileModel.user() === false">Logga in</span>
                <span data-bind="visible: profileModel.user() !== false, text: profileModel.user().name"></span>
              </a>
            </li>
            <li class="pull-right" data-bind="css: { active: membersModel.show }, visible: profileModel.user() !== false">
              <a href="#members">Medlemmar</a>
            </li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane" data-bind="css: { active: newsModel.show }">
              <?php include("./views/news/view.html"); ?>
            </div>
            <div class="tab-pane" data-bind="css: { active: aboutModel.show }">
              <?php include("./views/about/view.html"); ?>
            </div>
            <div class="tab-pane" data-bind="css: { active: guestbookModel.show }">
              <?php include("./views/guestbook/view.html"); ?>
            </div>
            <div class="tab-pane" data-bind="css: { active: forumModel.show }">
              <?php include("./views/forum/view.html"); ?>
            </div>
            <div class="tab-pane" data-bind="css: { active: galleryModel.show }" style="display: none;">
              <?php include("./views/gallery/view.html"); ?>
            </div>
            <div class="tab-pane" data-bind="css: { active: storiesModel.show }" style="display: none;">
              <?php include("./views/stories/view.html"); ?>
            </div>
            <div class="tab-pane" data-bind="css: { active: membersModel.show }">
              <?php include("./views/members/view.html"); ?>
            </div>
            <div class="tab-pane" data-bind="css: { active: profileModel.show }">
              <?php include("./views/profile/view.html"); ?>
            </div>
          </div>

        </div>
      </div>
    </div>

    <script src="http://code.jquery.com/jquery-1.9.0.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>

    <script src="js/knockout-2.2.1.js"></script>
    <script src="js/knockout.mapping-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/jquery.history.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/wysihtml5-0.3.0.min.js"></script>
    <script src="js/bootstrap-wysihtml5-0.0.2.min.js"></script>
    <script src="js/jquery.anystretch.min.js"></script>
    <script src="js/utils.js"></script>
    <script src="js/knockout.extensions.js"></script>
    <script src="js/server.js"></script>
    <script src="views/editModel.js"></script>
    <script src="views/itemsModel.js"></script>
    <script src="views/news/model.js"></script>
    <script src="views/about/model.js"></script>
    <script src="views/guestbook/model.js"></script>
    <script src="views/forum/model.js"></script>
    <script src="views/gallery/model.js"></script>
    <script src="views/stories/model.js"></script>
    <script src="views/members/model.js"></script>
    <script src="views/profile/model.js"></script>
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

        ko.applyBindings(mainModel);

        jQuery.History.bind(function(state)
        {
          mainModel.args(state.split(":"));
        });

        if (document.location.hash.length === 0)
        {
          jQuery.History.trigger("");
        }

        $.anystretch("img/background2.jpg", {speed: 300});

        setInterval(function()
        {
          server.emit("echo", {}, function() { });
        }, 60 * 1000);
      });

    </script>
  </body>
</html>
