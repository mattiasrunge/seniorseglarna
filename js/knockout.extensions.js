
$(function()
{

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

      var dateItem = moment(rawValue).local();

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

      var dateItem = moment(rawValue).local();

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


});

