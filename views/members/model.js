
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

  self.getQuery = function()
  {
    var query = { };

    if (!parentModel.profileModel.isAdmin())
    {
      query.hidden = "0";
    }

    return query;
  };

  self.memberEdit = new EditModel(self, "members", "#dialogMemberEdit", function()
  {
    self.memberItems.update(self.getQuery());
  });

  self.memberEdit.addVar("name");
  self.memberEdit.addVar("username", null, true);
  self.memberEdit.addVar("admin");
  self.memberEdit.addVar("hidden");
  self.memberEdit.addVar("street", null, true);
  self.memberEdit.addVar("address", null, true);
  self.memberEdit.addVar("assignments", null, true);
  self.memberEdit.addVar("homephone", null, true);
  self.memberEdit.addVar("mobilephone", null, true);
  self.memberEdit.addVar("email", null, true);
  self.memberEdit.addVar("vhf", null, true);
  self.memberEdit.addVar("boattype", null, true);
  self.memberEdit.addVar("sailnumber", null, true);
  self.memberEdit.addVar("boatname", null, true);
  self.memberEdit.addVar("harbor", null, true);
  self.memberEdit.addVar("joined", null, true);
  self.memberEdit.addVar("referer", null, true);
  self.memberEdit.addVar("description", null, true);

  self.memberItems = new ItemsModel(self, {}, "members", sortName);

  parentModel.profileModel.user.subscribe(function(value)
  {
    self.memberItems.update(self.getQuery());
  });

  self.member = ko.computed(function()
  {
    return self.memberItems.items()[self.index()] ? self.memberItems.items()[self.index()] : false;
  });
};
