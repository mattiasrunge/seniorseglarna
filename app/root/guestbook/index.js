
define(["durandal/app", "knockout", "server", "moment"], function(app, ko, server, moment)
{
  var name = ko.observable("");
  var text = ko.observable("");
  var loading = ko.observable(false);
  var errorText = ko.observable(false);
  var list = ko.observableArray();
  
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
  
  ko.bindingHandlers.htmlTimestampAgo = {
    update: function(element, valueAccessor)
    {
      var value = valueAccessor();
      var rawValue = ko.utils.unwrapObservable(value);

      if (!rawValue)
      {
        $(element).text("okänt datum");
        return;
      }

      var dateItem = moment(parseInt(rawValue) * 1000);

      if (!dateItem.date())
      {
        $(element).html(rawValue);
      }
      else
      {
        $(element).html(dateItem.fromNow());
      }
    }
  };
  
  function load()
  {
    loading(true);
    errorText(false);
    name("");
    text("");
    list.removeAll();
    
    server.get("find", { options: "guestbook" }, function(error, data)
    {
      loading(false);
      
      if (error)
      {
        console.log(error);
        errorText(error);
        return;
      }
      
      for (var n in data)
      {
        list.push(data[n]);
      }
    }.bind(this));
  };

  return {
    loading: loading,
    errorText: errorText,
    list: list,
    name: name,
    text: text,
    user: server.user,
    remove: function(data, event)
    {
      event.stopPropagation();
      event.preventDefault();
      
      app.showMessage("Är du säker på att du vill ta bort inlägget?", "Ta bort", ["Ta bort", "Avbryt"]).done(function(answer)
      {
        if (answer === "Ta bort")
        {
          server.get("delete", { item: data, collection: "guestbook" }, function(error, data)
          {
            loading(false);
            
            if (error)
            {
              console.log(error);
              errorText(error);
              return;
            }
            
            load();
          });
        }
      });
    },
    submit: function()
    {
      errorText(false);
      
      if (text() === "" || name() === "")
      {
        errorText("Alla fält måste vara ifyllda");
        return;
      }
      
      loading(true);
      
      server.get("save", { item: { name: name(), text: text() }, collection: "guestbook" }, function(error, data)
      {
        loading(false);
        
        if (error)
        {
          console.log(error);
          errorText(error);
          return;
        }
        
        name("");
        text("");
        
        list.push(data);
      });
    },
    activate: function()
    {
      load();
    }
  };
});
