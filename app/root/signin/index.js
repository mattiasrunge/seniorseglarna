
define(['plugins/router', 'knockout', 'server'], function(router, ko, server)
{
  var username = ko.observable("");
  var password = ko.observable("");
  var loading = ko.observable(false);
  var errorText = ko.observable("");
  
  return {
    username: username,
    password: password,
    loading: loading,
    errorText: errorText,
    submit: function()
    {
      errorText("");
      loading(false);
      
      if (username() === "")
      {
        errorText("Användarnamn saknas");
        return;
      }
      
      if (password() === "")
      {
        errorText("Lösenord saknas");
        return;
      }
      
      loading(true);
      
      server.signin(username(), password(), function(error)
      {
        loading(false);
        
        if (error)
        {
          errorText(error);
          return;
        }
        
        router.navigate("account");
      });
    }
  };
});
