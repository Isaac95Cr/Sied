angular.module('usuario',['ngStorage']);

angular.module('modal',['ui.bootstrap']);

angular.module('index', ['ngRoute','modal']);

angular.module('registro',['index','usuario','modal']);

angular.module('app',['ngRoute','index','registro', 'usuario']);
        