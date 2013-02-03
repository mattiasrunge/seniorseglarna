
function AboutModel(parentModel)
{
  var self = this;

  self.show = ko.computed(function()
  {
    return parentModel.args().length > 0 && parentModel.args()[0] === "about";
  });

  self.type = ko.computed(function()
  {
    return parentModel.args().length > 1 ? parentModel.args()[1] : "text";
  });

  self.index = ko.computed(function()
  {
    return parentModel.args().length > 2 ? parseInt(parentModel.args()[2], 10) : 0;
  });


  self.textEdit = new EditModel(self, "texts", "#dialogTextEdit", function()
  {
    self.textItems.update();
  });

  self.textEdit.addVar("name");
  self.textEdit.addVar("text");


  self.textItems = new ItemsModel(self, {}, "texts", sortName);

  self.textItems.update();


  self.protocolEdit = new EditModel(self, "protocols", "#dialogProtocolEdit", function()
  {
    self.protocolItems.update();
  });

  self.protocolEdit.addVar("date");
  self.protocolEdit.addVar("text");


  self.protocolItems = new ItemsModel(self, {}, "protocols", sortDate);

  self.protocolItems.update();


  self.text = ko.computed(function()
  {
    if (self.type() === "text")
    {
      return self.textItems.items().length > self.index() ? self.textItems.items()[self.index()] : false;
    }
    else if (self.type() === "protocol")
    {
      return self.protocolItems.items().length > self.index() ? self.protocolItems.items()[self.index()] : false;
    }

    return false;
  });
};
