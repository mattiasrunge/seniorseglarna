
function ProfileModel(parentModel)
{
  var self = this;

  self.show = ko.computed(function()
  {
    return parentModel.args().length > 0 && parentModel.args()[0] === "profile";
  });

  self.show.subscribe(function(value)
  {
    if (value)
    {
      setTimeout(function()
      {
        console.log("focus username");
        $("#inputUsername").focus();
      }, 100);
    }
  });

  self.user = ko.observable(false);
  self.disabled = ko.observable(false);
  self.error = ko.observable(null);
  self.inputUsername = ko.observable("");
  self.inputPassword = ko.observable("");

  self.isAdmin = ko.computed(function()
  {
    return self.user() !== false && self.user().admin;
  });

  self.error(null);
  self.disabled(true);

  server.emit("getUser", { }, function(error, user)
  {
    self.disabled(false);

    if (error)
    {
      console.log(error);
      self.error(error);
      return;
    }

    self.user(user ? user : false);
  });

  self.logoutSubmit = function()
  {
    self.error(null);
    self.disabled(true);

    server.emit("logout", { }, function(error)
    {
      self.disabled(false);

      if (error)
      {
        console.log(error);
        self.error(error);
        return;
      }

      self.user(false);
      self.inputUsername("");
      self.inputPassword("");
    });
  };

  self.loginSubmit = function()
  {
    self.error(null);

    if (self.inputUsername() === "" || self.inputPassword() === "")
    {
      console.log("Username or password is empty!");
      self.error(true);
      return;
    }

    self.disabled(true);

    server.emit("login", { username: self.inputUsername(), password: self.inputPassword() }, function(error, user)
    {
      self.disabled(false);

      if (error)
      {
        console.log(error);
        self.error(error);
        return;
      }

      self.user(user);
      self.inputUsername("");
      self.inputPassword("");
    });
  };




  self.passwordEditLoading = ko.observable(false);
  self.passwordEditPassword1 = ko.observable("");
  self.passwordEditPassword2 = ko.observable("");
  self.passwordEditError = ko.observable(null);

  self.passwordEditSave = function()
  {
    self.passwordEditError("");
    self.passwordEditLoading(false);

    if (self.passwordEditPassword1() !== self.passwordEditPassword2())
    {
      console.log("Passwords does not match!");
      self.passwordEditError("Passwords does not match!");
      return;
    }

    if (self.passwordEditPassword1() === "")
    {
      console.log("Passwords can not be empty!");
      self.passwordEditError("Passwords can not be empty!");
      return;
    }

    self.passwordEditLoading(true);

    server.emit("changePassword", { password: self.passwordEditPassword1() }, function(error)
    {
      self.passwordEditLoading(false);

      if (error)
      {
        console.log(error);
        self.passwordEditError(error);
        return;
      }

      self.passwordEditPassword1("");
      self.passwordEditPassword2("");

      $("#dialogProfilePasswordEdit").modal("hide");
    });
  };
};

