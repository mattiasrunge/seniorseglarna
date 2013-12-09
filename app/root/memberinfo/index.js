
define(['plugins/http', 'knockout', 'server'], function(http, ko, server)
{
  var list = ko.observableArray();
  var loading = ko.observable(false);
  var errorText = ko.observable(false);
    
  function doRequest(item)
  {
    item.loading = ko.observable(true);
    item.errorText = ko.observable(false);
    item.html = ko.observable("");
    
    var request = http.get("proxy.php", { id: item.id });

    request.complete(function(response) 
    {
      item.loading(false);
      item.html(response.responseText);
    });
    
    request.error(function()
    {
      item.errorText("Kunde inte hämta informationen...");
    });
  }
  
  return {
    loading: loading,
    errorText: errorText,
    list: list,
    activate: function()
    {
      loading(true);
      errorText(false);
      list.removeAll();
      
      server.get("getList", { id: "0BxtIPWWoS9JySWdhSnU4QXl2TUE" }, function(error, data)
      {
        loading(false);
        
        if (error)
        {
          errorText(error);
          console.log(error);
          return;
        }
        
        for (var n = 0; n < Math.min(data.length, 10); n++)
        {
          doRequest(data[n]);
          list.push(data[n]);
        }
      });

    
      
      return true;
    }
  };
});
