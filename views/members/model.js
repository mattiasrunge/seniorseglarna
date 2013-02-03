
function MembersModel(parentModel)
{
  var self = this;

  self.show = ko.computed(function()
  {
    return parentModel.args().length > 0 && parentModel.args()[0] === "members";
  });

  self.index = ko.computed(function()
  {
    return parentModel.args().length > 1 ? parseInt(parentModel.args()[1], 10) : 0;
  });


  self.memberEdit = new EditModel(self, "members", "#dialogMemberEdit", function()
  {
    self.memberItems.update();
  });

  self.memberEdit.addVar("name");


  self.memberItems = new ItemsModel(self, {}, "members", sortName);

  self.memberItems.update();
};
