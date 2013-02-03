
function StoriesModel(parentModel)
{
  var self = this;

  self.show = ko.computed(function()
  {
    return parentModel.args().length > 0 && parentModel.args()[0] === "stories";
  });

};
