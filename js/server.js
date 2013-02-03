
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

  self.emit = function(event, args, callback)
  {
    var jqxhr = $.postJSON("backend.php", { event: event, args: args }, function(response)
    {
      callback(response.error, response.data);
    });

    jqxhr.error(function()
    {
      callback("Failed to call server!");
    });
  };

}();

