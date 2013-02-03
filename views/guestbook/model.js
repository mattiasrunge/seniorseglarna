
function GuestbookModel(parentModel)
{
  var self = this;

  self.show = ko.computed(function()
  {
    return parentModel.args().length > 0 && parentModel.args()[0] === "guestbook";
  });


  self.entryEdit = new EditModel(self, "guestbook", null, function()
  {
    self.entryItems.update();
  });

  self.entryEdit.addVar("name");
  self.entryEdit.addVar("text");


  self.entryItems = new ItemsModel(self, {}, "guestbook", sortTimestamp);

  self.entryItems.update();
};
