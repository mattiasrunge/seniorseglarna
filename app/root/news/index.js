
define(['plugins/http', 'knockout', 'server'], function(http, ko, server)
{
  var newsList = ko.observableArray();
  var newsLoading = ko.observable(false);
  var newsErrorText = ko.observable(false);
  var programList = ko.observableArray();
  var programLoading = ko.observable(false);
  var programErrorText = ko.observable(false);
  
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
    newsLoading: newsLoading,
    newsErrorText: newsErrorText,
    newsList: newsList,
    programList: programList,
    programLoading: programLoading,
    programErrorText: programErrorText,
    activate: function()
    {
      newsLoading(true);
      newsErrorText(false);
      newsList.removeAll();
      
      server.get("getList", { id: "0BxtIPWWoS9JyXzJ3Rlo3SWt5cE0" }, function(error, data)
      {
        newsLoading(false);
        
        if (error)
        {
          newsErrorText(error);
          console.log(error);
          return;
        }
        
        for (var n = 0; n < Math.min(data.length, 10); n++)
        {
          doRequest(data[n]);
          newsList.push(data[n]);
        }
      });

      programLoading(true);
      programErrorText(false);
      programList.removeAll();
      
      server.get("getList", { id: "0BxtIPWWoS9Jya0loejNManRycnM" }, function(error, data)
      {
        programLoading(false);
        
        if (error)
        {
          programErrorText(error);
          console.log(error);
          return;
        }
        
        for (var n = 0; n < Math.min(data.length, 10); n++)
        {
          doRequest(data[n]);
          programList.push(data[n]);
        }
      });
      
      return true;
    }
  };
});
