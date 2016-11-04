angular.module('dataTable',['datatables', 'datatables.bootstrap']);

angular.module('select', ['ngSanitize', 'ui.select']);

angular.module('usuario',['ngStorage']);

angular.module('modal',['ui.bootstrap']);

angular.module('index', ['ngRoute','modal','usuario','dataTable','select']);

angular.module('registro',['usuario','modal']);

angular.module('app',['ngRoute','index','registro', 'usuario']);
        