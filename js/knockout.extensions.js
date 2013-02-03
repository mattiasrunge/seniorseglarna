
$(function()
{
  var whoNames = {};

  ko.bindingHandlers.textWhoName = {
    update: function(element, valueAccessor)
    {
      var value = valueAccessor();
      var rawValue = ko.utils.unwrapObservable(value);

      if (!rawValue)
      {
        $(element).text("okänt namn");
        return;
      }

      if (whoNames[rawValue])
      {
        $(element).text(whoNames[rawValue]);
        return;
      }

      server.emit("getWhoName", { _id: rawValue }, function(error, name)
      {
        if (error)
        {
          console.log(error);
          $(element).text("okänt namn");
          return;
        }

        if (name === "")
        {
          $(element).text("okänt namn");
          return;
        }

        $(element).text(name);
        whoNames[rawValue] = name;
      });
    }
  };

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

  ko.bindingHandlers.htmlTimestamp = {
    update: function(element, valueAccessor)
    {
      var value = valueAccessor();
      var rawValue = ko.utils.unwrapObservable(value);

      if (!rawValue)
      {
        $(element).text("okänt datum");
        return;
      }

      var dateItem = moment(rawValue);

      if (!dateItem.date())
      {
        $(element).html(rawValue);
      }
      else
      {
        $(element).html(ucfirst(dateItem.format("LLLL")));
      }
    }
  };

  ko.bindingHandlers.htmlTimestampDate = {
    update: function(element, valueAccessor)
    {
      var value = valueAccessor();
      var rawValue = ko.utils.unwrapObservable(value);

      if (!rawValue)
      {
        $(element).text("okänt datum");
        return;
      }

      var dateItem = moment(rawValue);

      if (!dateItem.date())
      {
        $(element).html(rawValue);
      }
      else
      {
        $(element).html(ucfirst(dateItem.format("LL")));
      }
    }
  };

  /**
  * Correct version of a wysihtml5 binding for KnockoutJS that is safe for multiple inclusion on a single page
  */
  ko.bindingHandlers.wysihtml5 = {
    init: function (element, valueAccessor, allBindingsAccessor, viewModel) {
      var control = $(element).wysihtml5({
        link: false,
        image: false,
        color: false,
        placeholderText: $(element).prop("placeholder"),
        events: {
          change : function() {
            var observable = valueAccessor();
            observable(control.getValue());
          }
        }
      }).data("wysihtml5").editor;
    },
    update: function (element, valueAccessor, allBindingsAccessor, viewModel) {
      var content = valueAccessor();

      if (content != undefined) {
        var control = $(element).data("wysihtml5").editor;
        control.setValue(content());
      }
    }
  };


  ko.bindingHandlers.datepicker = {
    init: function (element, valueAccessor, allBindingsAccessor, viewModel)
    {
      $(element).datepicker({ weekStart: 1 });

      $(element).datepicker().on("changeDate", function(ev)
      {
        var observable = valueAccessor();
        observable($(element).val());
      });
    },
    update: function (element, valueAccessor, allBindingsAccessor, viewModel)
    {
      var observable = valueAccessor();
      $(element).datepicker("setValue", observable());
      $(element).val(observable());
    }
  };
});

