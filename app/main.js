
requirejs.config({
  paths: {
    'text': '../lib/require/text',
    'durandal':'../lib/durandal/js',
    'plugins' : '../lib/durandal/js/plugins',
    'transitions' : '../lib/durandal/js/transitions',
    'knockout': '../lib/knockout/knockout-3.0.0',
    'bootstrap': '../lib/bootstrap/js/bootstrap',
    'jquery': '../lib/jquery/jquery-1.9.1',
    'jquery-ui': '../lib/jquery-ui/jquery-ui.min',
    'moment': '../lib/moment/moment.min',
    'server': '../lib/server/server'
  },
  shim: {
    'bootstrap': {
      deps: ['jquery'],
      exports: 'jQuery'
    }
  }
});

define(['durandal/system', 'durandal/app', 'plugins/widget'],  function(system, app, widget)
{
  //>>excludeStart("build", true);
  system.debug(true);
  //>>excludeEnd("build");

  app.title = 'Seniorseglarna';

  app.configurePlugins({
    router:true,
    dialog: true,
    widget: true
  });

  app.start().then(function()
  {
    app.setRoot('root/shell', 'entrance');
    
    widget.registerKind('driveFolder');
  });
});
