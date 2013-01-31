
var mainModel = new function()
{
  var self = this;

  self.args = ko.observableArray();

  self.newsModel = new NewsModel(self);
  self.aboutModel = new AboutModel(self);



}();
