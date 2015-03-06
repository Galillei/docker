<!DOCTYPE html>
<html ng-app="app">
<title>Test application</title>
<link rel="stylesheet" href="public/css/style.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<script src="http://code.jquery.com/jquery-1.11.2.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

<script src="public/js/lib/angular.js"></script>
<script src="public/js/lib/angular-route.js"></script>
<script src="public/js/app/app.js"></script>
<script src="public/js/app/controllers/StartController.js"></script>
<script src="public/js/app/controllers/NavigateController.js"></script>
<script src="public/js/app/controllers/InstallController.js"></script>
<script src="public/js/app/controllers/ApplicationController.js"></script>
<body>
<div class="container">
    <div ng-controller="NavigateController as nc">

<ul class="nav nav-pills" ng-click="nc.loadStatus()">
    <li role="presentation" ng-class="(nc.isActive('/')? 'active':'')"><a href="#/">Major Pagee</a></li>
    <li role="presentation" ng-class="(nc.isActive('/install')? 'active':'')" ng-show="!nc.isInstall"><a href="#/install">Install</a></li>
    <li role="presentation" ng-class="(nc.isActive('/application')? 'active':'')"ng-show="nc.isInstall"><a href="#/application">Application</a></li>
</ul>
    </div>


    <div ng-view>

</div>
</div>
</body>
</html>