//angular.module('your-app', ['mgo-angular-wizard']);
angular.module('apiConnector',[]);

angular.module('empdep',['apiConnector']);

angular.module('dataTable',['datatables', 'datatables.bootstrap']);

angular.module('select', ['ngSanitize', 'ui.select']);

angular.module('usuario',['ngStorage','apiConnector']);

angular.module('modal',['ui.bootstrap']);

angular.module('index', ['ngRoute','modal','usuario','dataTable','select', 'empdep', 'daterangepicker', 'mgo-angular-wizard']);

angular.module('registro',['usuario','modal','select','empdep']);

angular.module('app',['ngRoute','index','registro', 'usuario']);
        