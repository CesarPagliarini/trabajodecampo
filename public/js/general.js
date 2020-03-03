/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/ajax-forms/admin/order-reporter.js":
/*!*********************************************************!*\
  !*** ./resources/js/ajax-forms/admin/order-reporter.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $('#orderCanvasListener').click(function () {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': token
      }
    });
    $.ajax({
      type: "POST",
      url: "reports",
      data: {
        'endpoint': 'forCanvas',
        _method: 'POST',
        'resource': 'sale-order'
      },
      success: function success(response) {
        var dataset = [];
        var labels = [];
        response.forEach(function (item) {
          dataset.push(item.quantity);
          labels.push(item.name);
        });
        var item = {
          'dataset': dataset,
          'labels': labels
        };
        $(document).trigger('instanceChart', [{
          item: item
        }]);
      }
    });
  });
});
$(document).bind('instanceChart', function (e, obj) {
  var item = obj.item;
  var dataset = item.dataset;
  var labels = item.labels;
  var ctx = document.getElementById('myChart');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: 'Cantidad de ordenes',
        data: dataset,
        responsive: true,
        legend: {
          position: 'top'
        },
        title: {
          display: true,
          text: 'Chart.js Bar Chart'
        },
        backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'],
        borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            max: 5,
            min: 0,
            stepSize: 1
          }
        }]
      }
    }
  });
  $('#orderCanvas').toggleClass('hidden');
});

/***/ }),

/***/ "./resources/js/miscellaneous.js":
/*!***************************************!*\
  !*** ./resources/js/miscellaneous.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$.fn.datepicker.dates['es'] = {
  days: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
  daysShort: ["Dom", "Lun", "Mar", "Mier", "Jue", "Vie", "Sab"],
  daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
  months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octoubre", "Noviembre", "Diciembre"],
  monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
  today: "Hoy",
  clear: "Borrar",
  format: "mm/dd/yyyy",
  titleFormat: "MM yyyy",

  /* Leverages same syntax as 'format' */
  weekStart: 0
};
$(document).ready(function () {
  $("#dateClientBirth").datepicker({
    language: 'es'
  });
});

/***/ }),

/***/ 4:
/*!***********************************************************************************************!*\
  !*** multi ./resources/js/miscellaneous.js ./resources/js/ajax-forms/admin/order-reporter.js ***!
  \***********************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\xampp\htdocs\genesis\resources\js\miscellaneous.js */"./resources/js/miscellaneous.js");
module.exports = __webpack_require__(/*! C:\xampp\htdocs\genesis\resources\js\ajax-forms\admin\order-reporter.js */"./resources/js/ajax-forms/admin/order-reporter.js");


/***/ })

/******/ });