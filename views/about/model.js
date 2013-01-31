
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

  self.textItems = ko.observableArray();
  self.protocolItems = ko.observableArray();


  self.text = ko.computed(function()
  {
    if (self.type() === "text")
    {
      return self.textItems().length > self.index() ? self.textItems()[self.index()].text : "";
    }
    else if (self.type() === "protocol")
    {
      return self.protocolItems().length > self.index() ? self.protocolItems()[self.index()].text : "";
    }

    return "";
  });

  /* TODO: Temporary information */
  var item = {};

  item.title = "Om oss";
  item.text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.1";

  self.textItems.push(item);

  var item = {};

  item.title = "Stadgar";
  item.text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.2";

  self.textItems.push(item);


  var item = {};

  item.timestamp = new Date().getTime();
  item.text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.3";

  self.protocolItems.push(item);

  var item = {};

  item.timestamp = new Date().getTime();
  item.text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.4";

  self.protocolItems.push(item);

};
