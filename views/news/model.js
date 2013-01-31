
function NewsModel(parentModel)
{
  var self = this;

  self.show = ko.computed(function()
  {
    return parentModel.args().length === 0 || parentModel.args()[0] === "news";
  });

  self.newsItems = ko.observableArray();
  self.programItems = ko.observableArray();


  /* TODO: Temporary information */
  var item = {};

  item.title = "En nyhetsrubrik";
  item.timestamp = new Date().getTime();
  item.text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.";

  self.newsItems.push(item);
  self.newsItems.push(item);
  self.newsItems.push(item);


  var item = {};

  item.timestamp = new Date().getTime();
  item.text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.";

  self.programItems.push(item);
  self.programItems.push(item);
  self.programItems.push(item);
};
