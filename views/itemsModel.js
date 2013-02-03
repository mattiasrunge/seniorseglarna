
function ItemsModel(parentModel, query, options, sortFn)
{
  var self = this;

  self.error = ko.observable(null);
  self.loading = ko.observable(false);
  self.items = ko.observableArray();

  self.update = function(newQuery)
  {
    self.error(null);
    self.loading(true);

    server.emit("find", { query: newQuery ? newQuery : query, options: options }, function(error, itemList)
    {
      self.loading(false);

      if (error)
      {
        console.log(error);
        self.error(error);
        return;
      }

      itemList = makeArray(itemList);

      if (sortFn)
      {
        itemList.sort(sortFn);
      }

      self.items(itemList);
    });
  };
};
