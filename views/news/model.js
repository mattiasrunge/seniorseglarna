
function NewsModel(parentModel)
{
  var self = this;

  self.show = ko.computed(function()
  {
    return parentModel.args().length === 0 || parentModel.args()[0] === "" || parentModel.args()[0] === "news";
  });


  self.newsEdit = new EditModel(self, "news", "#dialogNewsEdit", function()
  {
    self.newsItems.update();
  });

  self.newsEdit.addVar("title");
  self.newsEdit.addVar("text");


  self.newsItems = new ItemsModel(self, {}, { collection: "news", limit: 5, sort: "timestamp" }, sortTimestamp);

  self.newsItems.update();



  self.programEdit = new EditModel(self, "program", "#dialogProgramEdit", function()
  {
    self.programItems.update();
  });

  self.programEdit.addVar("date");
  self.programEdit.addVar("text");


  self.programItems = new ItemsModel(self, {}, "program", sortDate);

  self.programItems.update();
};
