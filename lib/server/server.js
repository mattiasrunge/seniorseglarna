
define(['plugins/http', 'plugins/serializer', 'knockout'], function(http, serializer, ko)
{
  var user = ko.observable(false);
  
  function get(event, query, callback)
  {
    callback = callback || query;
    
    var request = http.get("backend.php?event=" + event, query);
    
    request.complete(function(response) 
    {
      var data = JSON.parse(response.responseText);
      
      callback(data.error, data.data);
    });
    
    request.error(function()
    {
      callback("Request failed!");
    });
  }
  
  function post(event, query, callback)
  {
    callback = callback || query;
    
    var request = http.post("backend.php?event=" + event, query);
    
    request.complete(function(response) 
    {
      var data = serializer.deserialize(response.responseText);
      
      callback(data.error, data.data);
    });
    
    request.error(function()
    {
      callback("Request failed!");
    });
  }
  
  get("getUser", function(error, data)
  {
    if (error)
    {
      console.log("Could not get user, error: " + error);
      return;
    }
    
    user(data);
  });

  return {
    user: user,
    get: get,
    post: post,
    signin: function(username, password, callback)
    {
      get("login", { username: username, password: password }, function(error, data)
      {
        if (error)
        {
          callback(error);
          return;
        }
        
        user(data);
        callback();
      });
    },
    signout: function(callback)
    {
      get("logout", function(error)
      {
        if (error)
        {
          callback(error);
          return;
        }
        
        user(false);
        callback();
      });
    }
  };
});
