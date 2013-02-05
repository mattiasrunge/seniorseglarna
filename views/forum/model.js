
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
    return parentModel.args().length > 2 ? intval(parentModel.args()[2]) : 0;
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
  {console.log("b", self.category());
    self.threadItems.update({ _category: self.category() });
  });

  self.threadEdit.addVar("name");
  self.threadEdit.addVar("_category", true);


  self.threadItems = new ItemsModel(self, {}, "forumThreads", sortTimestamp);


  self.thread = ko.computed(function()
  {
    return self.threadItems.items()[self.threadIndex()] ? self.threadItems.items()[self.threadIndex()] : false;
  });


  self.category.subscribe(function(value)
  {
    self.threadEdit.vars._category(value);
console.log("a", value);
    self.threadItems.update({ _category: value });
  });




  self.entryEdit = new EditModel(self, "forumEntries", "#dialogForumEntryEdit", function()
  {
    if (self.thread() !== false)
    {
      self.entryItems.update({ _thread: self.thread()._id });
    }
  });

  self.entryEdit.addVar("text");
  self.entryEdit.addVar("_thread", true);


  self.entryItems = new ItemsModel(self, {}, "forumEntries", sortTimestampReverse);



  self.thread.subscribe(function(value)
  {
    if (value !== false)
    {
      self.entryEdit.vars._thread(value._id);

      self.entryItems.update({ _thread: value._id });
    }
  });

};
