
define(['plugins/router', 'durandal/app', 'server', 'knockout', 'jquery'], function(router, app, server, ko, $)
{
  return {
    router: router,
    user: server.user,
    activate: function()
    {
      var loggedIn = ko.computed(function()
      {
        return !!server.user();
      });
      
      var notLoggedIn = ko.computed(function()
      {
        return !server.user();
      });
      
      var userName = ko.computed(function()
      {
        return server.user() ? server.user().name : "";
      });
      
      router.map([
        { route: ['', 'news'],  title: 'Nyheter',             moduleId: 'root/news/index',      nav: true, visible: true, hash: '#news' },
        { route: 'about',       title: 'Om oss',              moduleId: 'root/about/index',     nav: true, visible: true, },
        { route: 'guestbook',   title: 'Gästbok',             moduleId: 'root/guestbook/index', nav: true, visible: true, },
        { route: 'logs',        title: 'Loggböcker',          moduleId: 'root/logs/index',      nav: true, visible: true, },
        { route: 'jubilees',    title: 'Jubileumsskrifter',   moduleId: 'root/jubilees/index',  nav: true, visible: true, },
        { route: 'signin',      title: 'Logga in',            moduleId: 'root/signin/index',    nav: true, visible: notLoggedIn, right: true },
        { route: 'account',     title: userName(),            moduleId: 'root/account/index',   nav: true, visible: loggedIn, right: true },
        { route: 'members',     title: 'Matrikel',            moduleId: 'root/members/index',   nav: true, visible: loggedIn, right: true },
        { route: 'memberinfo',  title: 'Medlemsinformation',  moduleId: 'root/memberinfo/index',nav: true, visible: loggedIn, right: true },
      ]);

      router.mapUnknownRoutes(function(instruction)
      {
        console.log("shell-route-unknown", instruction);
      });

      router.buildNavigationModel();

      return router.activate();
    }
  };
});
