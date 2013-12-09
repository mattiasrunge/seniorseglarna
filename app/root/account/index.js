
define(['plugins/router', 'knockout', 'server'], function(router, ko, server)
{
  var loading = ko.observable(false);
  var errorText = ko.observable(false);
  var password1 = ko.observable("");
  var password2 = ko.observable("");
  var editingPassword = ko.observable(false);
  
  return {
    user: server.user,
    loading: loading,
    errorText: errorText,
    password1: password1,
    password2: password2,
    editingPassword: editingPassword,
    editPassword: function()
    {
      editingPassword(!editingPassword());
    },
    signout: function()
    {
      errorText(false);
      loading(true);
      
      server.signout(function(error)
      {
        loading(false);
        
        if (error)
        {
          errorText(error);
          return;
        }
        
        router.navigate("signin");
      });
    },
    changePassword: function()
    {
      errorText(false);
      
      if (password1() === "" || password2() === "")
      {
        errorText("Alla fält måste vara ifyllda");
        return;
      }
      
      loading(true);
      
      server.get("changePassword", { password: password1() }, function(error, data)
      {
        loading(false);
        
        if (error)
        {
          console.log(error);
          errorText(error);
          return;
        }
        
        password1("");
        password2("");
        editingPassword(false);
      });
    },
    activation: function()
    {
      editingPassword(false);
      password1("");
      password2("");
      errorText(false);
      loading(false);
      return true;
    }
  };
});
