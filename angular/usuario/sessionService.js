angular.module('usuario')
        .service('sessionService', ['$sessionStorage', function ($sessionStorage) {
                var session = {};

                session.create = function (sessionId, userId, userName, userRole) {
                    session.id = sessionId;
                    session.userId = userId;
                    session.userName = userName;
                    session.userRole = userRole;
                    //alert("create " +this.userId+ " " + this.userName + " " +this.userRole);
                    $sessionStorage.session = session;
                };

                session.load = function () {
                    var x = $sessionStorage.session;
                    if (x != null) {
                        session.id = x.id;
                        session.userId = x.userId;
                        session.userName = x.userName;
                        session.userRole = x.userRole;
                    }
                    return x;
                };

                session.destroy = function () {
                    session.id = null;
                    session.userId = null;
                    session.userName = null;
                    session.userRole = null;
                    delete $sessionStorage.session;
                };
                return session;
            }]);