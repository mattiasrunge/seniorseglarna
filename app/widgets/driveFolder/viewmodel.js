
define(['durandal/composition', 'jquery', 'knockout', 'server'], function(composition, $, ko, server)
{
  var ctor = function() {};

  ctor.prototype.activate = function(settings)
  {
    settings.model = this;
    
    this.subjects = ko.observableArray();
    this.loading = ko.observable(false);
    this.errorText = ko.observable(false);
    this.currentYear = ko.observable(false);
    this.currentSubject = ko.observable(false);
    this.currentItem = ko.observable(false);
    this.currentItems = ko.computed(function()
    {
      var list = [];
      
      if (this.currentSubject() !== false && this.currentYear() !== false)
      {
        for (var n = 0; n < this.currentSubject().items().length; n++)
        {
          if (this.currentYear() === this.currentSubject().items()[n].year)
          {
            list.push(this.currentSubject().items()[n]);
          }
        }
      }

      return list;
    }.bind(this));
    
    this.yearClicked = function(data, event)
    {
      event.preventDefault();
      event.stopPropagation();
      
      this.currentItem(false);
      this.currentYear(data.year());
      this.currentSubject(data.subject);
    }.bind(this);
    
    this.itemClicked = function(data, event)
    {
      event.preventDefault();
      event.stopPropagation();
      
      this.currentItem(data);
      
      if (!data.year)
      {
        this.currentYear(false);
      }
    }.bind(this);
    
    this.itemUnsetClicked = function(data, event)
    {
      event.preventDefault();
      event.stopPropagation();
      
      this.currentItem(false);
    }.bind(this);
  
    this.loading(true);
    this.errorText(false);
    this.subjects.removeAll();
    
    server.get("getList", { id: ko.unwrap(settings.id) }, function(error, data)
    {
      this.loading(false);
      
      if (error)
      {
        this.errorText(error);
        console.log(error);
        return;
      }
      
      this.loadSubject = function(subjectData)
      {
        var subject = {};
        subject.name = ko.observable(subjectData.name);
        subject.years = ko.observableArray();
        subject.items = ko.observableArray();
        subject.loading = ko.observable(true);
        subject.errorText = ko.observable(false);
        
        this.subjects.push(subject);

        server.get("getList", { id: subjectData.id }, function(error, data)
        {
          subject.loading(false);

          if (error)
          {
            console.log(error);
            subject.errorText(error);
            return;
          }
          
          var years = [];
          
          for (var n = 0; n < data.length; n++)
          {
            if (data[n].date !== data[n].name)
            {
              data[n].year = data[n].date.substr(0, 4);
              
              if (years.indexOf(data[n].year) === -1)
              {
                years.push(data[n].year);
                subject.years.push({ year: ko.observable(data[n].year), subject: subject });
              }
            }

            subject.items.push(data[n]);
          }
        }.bind(this));
      }.bind(this);
      
      for (var n = 0; n < data.length; n++)
      {
        this.loadSubject(data[n]);
      }
      
    }.bind(this));
  };

  return ctor;
});
