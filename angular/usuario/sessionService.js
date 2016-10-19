angular.module('usuario')
        .service('sessionService', function () {
            this.create = function (sessionId, userId, userName, userRole) {
                this.id = sessionId;
                this.userId = userId;
                this.userName = userName;
                this.userRole = userRole;
            };
            this.destroy = function () {
                this.id = null;
                this.userId = null;
                this.userName = null;
                this.userRole = null;
            };
        })