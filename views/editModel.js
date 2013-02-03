
function EditModel(parentModel, collection, dialogId, onSaveCallback)
{
  var self = this;

  self.error = ko.observable(false);
  self.loading = ko.observable(false);
  self.item = ko.observable(false);

  self.vars = [];
  self.readonlyVars = [];
  self.allowedemptyVars = [];

  self.addVar = function(name, readonly, allowedempty)
  {
    self.vars[name] = ko.observable("");

    if (readonly)
    {
      self.readonlyVars.push(name);
    }

    if (allowedempty)
    {
      self.allowedemptyVars.push(name);
    }
  };

  self.reset = function()
  {
    for (var name in self.vars)
    {
      if (!inArray(name, self.readonlyVars))
      {
        self.vars[name]("");
      }
    }
  };

  self.open = function(data)
  {
    self.reset();

    if (data.isParent)
    {
      self.item(false);
    }
    else
    {
      self.item(data);

      for (var name in self.vars)
      {
        self.vars[name](data[name]);
      }
    }

    if (dialogId)
    {
      $(dialogId).modal("show");
    }
  };

  self.save = function()
  {
    var item = {};

    self.error(false);

    for (var name in self.vars)
    {
      if (self.vars[name]() === "" && !inArray(name, self.allowedemptyVars))
      {
        console.log(name + " is empty!");
        self.error(name + " is empty!");
        return;
      }
    }

    if (self.item() !== false)
    {
      item = self.item();
    }

    for (var name in self.vars)
    {
      item[name] = self.vars[name]();
    }


    self.loading(true);

    server.emit("save", { item: item, collection: collection }, function(error)
    {
      self.loading(false);

      if (error)
      {
        console.log(error);
        self.error(error);
        return;
      }

      if (dialogId)
      {
        $(dialogId).modal("hide");
      }

      self.reset();

      onSaveCallback();
    });
  };

  self.remove = function(data)
  {
    if (confirm("Är du säker på att du vill ta bort?"))
    {
      self.loading(true);

      server.emit("delete", { item: data, collection: collection }, function(error)
      {
        self.loading(false);

        if (error)
        {
          console.log(error);
          self.error(error);
          return;
        }

        onSaveCallback();
      });
    }
  };
};
