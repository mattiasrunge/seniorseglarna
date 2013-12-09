
define(["durandal/app", "knockout", "server", "moment"], function(app, ko, server, moment)
{
  var name = ko.observable("");
  var text = ko.observable("");
  var loading = ko.observable(false);
  var errorText = ko.observable(false);
  var list = ko.observableArray();
  var current = ko.observable(false);
  var editing = ko.observable(false);
  
  var formName = ko.observable("");
  var formStreet = ko.observable("");
  var formAddress = ko.observable("");
  var formHomephone = ko.observable("");
  var formMobilephone = ko.observable("");
  var formEmail = ko.observable("");
  var formAssignments = ko.observable("");
  var formJoined = ko.observable("");
  var formReferer = ko.observable("");
  var formBoattype = ko.observable("");
  var formBoatname = ko.observable("");
  var formSailnumber = ko.observable("");
  var formVHF = ko.observable("");
  var formHarbor = ko.observable("");
  var formUsername = ko.observable("");
  var formAdmin = ko.observable(false);
  
  function load()
  {
    loading(true);
    errorText(false);
    name("");
    text("");
    list.removeAll();
    
    server.get("find", { options: "members" }, function(error, data)
    {
      loading(false);
      
      if (error)
      {
        console.log(error);
        errorText(error);
        return;
      }
      
      var unsorted = [];
      
      for (var n in data)
      {
        unsorted.push(data[n]);
      }
      
      
      list(unsorted.sort(function(a, b)
      {
        if (a.name < b.name)
        {
          return -1;
        }

        if (a.name > b.name)
        {
          return 1;
        }

        return 0;
      }));
      
    }.bind(this));
  };

  return {
    loading: loading,
    errorText: errorText,
    list: list,
    current: current,
    name: name,
    text: text,
    user: server.user,
    editing: editing,
    formName: formName,
    formStreet: formStreet,
    formAddress: formAddress,
    formHomephone: formHomephone,
    formMobilephone: formMobilephone,
    formEmail: formEmail,
    formAssignments: formAssignments,
    formJoined: formJoined,
    formReferer: formReferer,
    formBoattype: formBoattype,
    formBoatname: formBoatname,
    formSailnumber: formSailnumber,
    formVHF: formVHF,
    formHarbor: formHarbor,
    formUsername: formUsername,
    formAdmin: formAdmin,
    select: function(data, event)
    {
      event.stopPropagation();
      event.preventDefault();
      
      editing(false);
      current(data);
    },
    edit: function(data, event)
    {
      event.stopPropagation();
      event.preventDefault();
      
      editing(!editing());
      
      if (editing())
      {
        formName(current().name);
        formStreet(current().street);
        formAddress(current().address);
        formHomephone(current().homephone);
        formMobilephone(current().mobilephone);
        formEmail(current().email);
        formAssignments(current().assignments);
        formJoined(current().joined);
        formReferer(current().referer);
        formBoattype(current().boattype);
        formBoatname(current().boatname);
        formSailnumber(current().sailnumber);
        formVHF(current().vhf);
        formHarbor(current().harbor);
        formUsername(current().username);
        formAdmin(current().admin);
      }
      else
      {
        formName("");
        formStreet("");
        formAddress("");
        formHomephone("");
        formMobilephone("");
        formEmail("");
        formAssignments("");
        formJoined("");
        formReferer("");
        formBoattype("");
        formBoatname("");
        formSailnumber("");
        formVHF("");
        formHarbor("");
        formUsername("");
        formAdmin(false);
      }
    },
    remove: function(data, event)
    {
      event.stopPropagation();
      event.preventDefault();
      
      app.showMessage("Är du säker på att du vill ta bort personen?", "Ta bort", ["Ta bort", "Avbryt"]).done(function(answer)
      {
        if (answer === "Ta bort")
        {
          server.get("delete", { item: current(), collection: "members" }, function(error, data)
          {
            loading(false);
            
            if (error)
            {
              console.log(error);
              errorText(error);
              return;
            }
            
            current(false);
            load();
          });
        }
      });
    },
    submit: function()
    {
      errorText(false);
      
      if (formName() === "")
      {
        errorText("Alla fält måste vara ifyllda");
        return;
      }
      
      var item = JSON.parse(JSON.stringify(current()));
      
      item.name = formName();
      item.street = formStreet();
      item.address = formAddress();
      item.homephone = formHomephone();
      item.mobilephone = formMobilephone();
      item.email = formEmail();
      item.assignments = formAssignments();
      item.joined = formJoined();
      item.referer = formReferer();
      item.boattype = formBoattype();
      item.boatname = formBoatname();
      item.sailnumber = formSailnumber();
      item.vhf = formVHF();
      item.harbor = formHarbor();
      item.username = formUsername();
      item.admin = formAdmin();
      
      
      loading(true);
      
      server.get("save", { item: item, collection: "members" }, function(error, data)
      {
        loading(false);
        
        if (error)
        {
          console.log(error);
          errorText(error);
          return;
        }
        
        editing(false);
        load();
        current(data);
      });
    },
    activate: function()
    {
      load();
    }
  };
});
