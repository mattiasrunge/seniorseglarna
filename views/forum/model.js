
function ForumModel(parentModel)
{
  var self = this;

  self.show = ko.computed(function()
  {
    return parentModel.args().length > 0 && parentModel.args()[0] === "forum";
  });

  self.categoryIndex = ko.computed(function()
  {
    return parentModel.args().length > 1 ? intval(parentModel.args()[1]) : 0;
  });

  self.threadIndex = ko.computed(function()
  {
    return parentModel.args().length > 2 ? intval(parentModel.args()[2]) : false;
  });



  self.categoryEdit = new EditModel(self, "forumCategories", "#dialogForumCategoryEdit", function()
  {
    self.categoryItems.update();
  });

  self.categoryEdit.addVar("name");


  self.categoryItems = new ItemsModel(self, {}, "forumCategories", sortName);

  self.categoryItems.update();


  self.category = ko.computed(function()
  {
    return self.categoryItems.items()[self.categoryIndex()] ? self.categoryItems.items()[self.categoryIndex()]._id : "0";
  });


  self.threadEdit = new EditModel(self, "forumThreads", "#dialogForumThreadEdit", function()
  {
    self.threadItems.update({ _category: self.category() });
  });

  self.threadEdit.addVar("name");
  self.threadEdit.addVar("text");
  self.threadEdit.addVar("_category", true);


  self.threadItems = new ItemsModel(self, {}, "forumThreads", sortTimestamp);


  self.thread = ko.computed(function()
  {
    return self.threadItems.items()[self.threadIndex()] ? self.threadItems.items()[self.threadIndex()]._id : "0";
  });


  self.category.subscribe(function(value)
  {
    self.threadEdit.vars._category(value);

    self.threadItems.update({ _category: value });
  });




  self.entryEdit = new EditModel(self, "forumEntries", "#dialogForumEntryEdit", function()
  {
    self.entryItems.update({ _thread: self.thread() });
  });

  self.entryEdit.addVar("text");
  self.entryEdit.addVar("_thread", true);


  self.entryItems = new ItemsModel(self, {}, "forumEntries", sortTimestampReverse);



  self.thread.subscribe(function(value)
  {
    self.entryEdit.vars._thread(value);

    self.entryItems.update({ _thread: value });
  });

};
