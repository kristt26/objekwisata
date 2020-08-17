(function(angular){
    'use strict';
    angular.module('app', ['ctrlguest', 'ui.utils.masks', 'ngLocale'])
    .directive('fileModel', function ($parse) {
        return {
           restrict: 'A',
           link: function(scope, element, attrs) {
              element.bind('change', function(){
              $parse(attrs.fileModel).assign(scope,element[0].files)
                 scope.$apply(x=>{
                    scope.fileTitle = element[0].files[0].name;
                 });
                 
              });
           }
        };
    })
    .directive('tooltip', function(){
       return {
           restrict: 'A',
           link: function(scope, element, attrs){
               element.hover(function(){
                   // on mouseenter
                   element.tooltip('show');
               }, function(){
                   // on mouseleave
                   element.tooltip('hide');
               });
           }
       };
    })
    .directive('format', function ($filter) {
        return {
          require: '?ngModel',
          link: function (scope, elem, attrs, ctrl) {
            if (!ctrl) return;
    
            ctrl.$formatters.unshift(function (a) {
              return $filter(attrs.format)(ctrl.$modelValue, attrs.format == 'currency' ? ' ' : null)
            });
    
            elem.bind('blur', function (event) {
              var plainNumber = elem.val().replace(/[^\d|\-+|\.+]/g, '');
              elem.val($filter(attrs.format)(plainNumber));
            });
          }
        };
      })
      .filter('limitHtml', function() {
        return function(text, limit) {

            var changedString = String(text).replace(/<[^>]+>/gm, '');
            var length = changedString.length;

            return length > limit ? changedString.substr(0, limit - 1) : changedString;
        }
    });
})(window.angular);
