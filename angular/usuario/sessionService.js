angular.module('usuario')
        .service('sessionService', function () {
            var session = {};
            session.id = "init";
            session.userId = "init";
            session.userName = "init";
            session.userRole = "init";

            session.create = function (sessionId, userId, userName, userRole) {
                session.id = sessionId;
                session.userId = userId;
                session.userName = userName;
                session.userRole = userRole;
                //alert("create " +this.userId+ " " + this.userName + " " +this.userRole);
            };
            session.destroy = function () {
                session.id = null;
                session.userId = null;
                session.userName = null;
                session.userRole = null;
            };
            return session
        });