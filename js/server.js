
jQuery.extend({
  postJSON: function(url, data, callback) {
    return jQuery.ajax({
      type: "POST",
      url: url,
      data: data,
      success: callback,
      dataType: "json",
      processData: true
    });
  }
});

var server = new function()
{
  var self = this;

  self.queue = [];
  self.active = false;

  self.call = function()
  {
    if (self.queue.length === 0 || self.active)
    {
      return;
    }

    var req = self.queue.shift();

    self.active = true;

    var jqxhr = $.postJSON("backend.php", req.options, function(response)
    {
      self.active = false;

      console.log(response.session);
      req.callback(response.error, response.data);

      self.call();
    });

    jqxhr.error(function()
    {
      self.active = false;

      req.callback("Failed to call server!");

      self.call();
    });
  };


  self.emit = function(event, args, callback)
  {
    self.queue.push({ options: { event: event, args: args }, callback: callback });

    self.call();
  };

}();

