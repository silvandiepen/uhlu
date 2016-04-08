angular.module('uhlu', [
		'ui.router',
		'angulartics',
	  'angulartics.google.analytics'
	])
	.config(['$stateProvider', '$urlRouterProvider', '$locationProvider', function($stateProvider, $urlRouterProvider, $locationProvider) {
		'use strict';

		// For any unmatched url, redirect to /state1
		$urlRouterProvider.otherwise('/');

		$stateProvider
			.state('error', {
				'abstract': true,
				views: {
					header: {
						templateUrl: 'sections/error/header.html',
						controller: 'ErrorHeaderController as errorheaderCtrl'
					},
					content: {
						templateUrl: '<div ui-view></div>'
					},
					footer: {
						templateUrl: 'sections/error/footer.html',
						controller: 'ErrorFooterController as errorfooterCtrl'
					}
				}
			})
			.state('oldbrowser', {
				url: '/oldbrowser',
				parent: 'error',
				templateUrl: 'sections/error/oldbrowser.html',
				controller: 'OldbrowserController as oldbrowserCtrl'
			})
			.state('root', {
				'abstract': true,
				views: {
					header: {
						templateUrl: 'sections/root/header.html',
						controller: 'HeaderController as headerCtrl'
					},
					content: {
						template: '<div ui-view></div>'
					},
					footer: {
						templateUrl: 'sections/root/footer.html',
						controller: 'FooterController as footerCtrl'
					}
				}
			})
			.state('home', {
				url: '/',
				parent: 'root',
				templateUrl: 'sections/home/home.html',
				controller: 'HomeController as homeCtrl'
			})
			.state('about', {
				url: '/about',
				parent: 'root',
				views: {
					'': {
						templateUrl: 'sections/about/about.html',
						controller: 'AboutController as aboutCtrl'
					},
					'top@about': {
						templateUrl: 'sections/about/top.html',
						controller: 'TopController as topCtrl'
					},
					'middle@about': {
						templateUrl: 'sections/about/middle.html',
						controller: 'MiddleController as middleCtrl'
					},
					'bottom@about': {
						templateUrl: 'sections/about/bottom.html',
						controller: 'BottomController as bottomCtrl'
					}
				}
			});
		// use the HTML5 History API
		$locationProvider.html5Mode(true);
	}])
	.run(['$rootScope', '$document', function($rootScope, $document) {
		'use strict';


		$document.on('keydown', function(e) {
			if (e.which === 8) {
				if (e.target.nodeName !== 'INPUT' && e.target.nodeName !== 'TEXTAREA') {
					e.preventDefault();
				}
			}
		});

		/* global $ */
		$rootScope.$on('$stateChangeSuccess', function(event, toState, toParams, fromState) {
			$('body')
				.removeClass('state-' + fromState.name)
				.addClass('state-' + toState.name);
			window.scrollTo(0, 0);
		});

	}]);
