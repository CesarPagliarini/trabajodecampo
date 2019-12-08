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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/ajax-forms/admin/bulk-delete.js":
/*!******************************************************!*\
  !*** ./resources/js/ajax-forms/admin/bulk-delete.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$('button[data-action=show]').click(function (e) {
  e.preventDefault();
  $("#resultado").html("");
  $('#' + bulkConfig.modalName).modal('show');
});
$('button[data-action=delete]').click(function (e) {
  e.preventDefault();
  var ids = $('[name="ids[]"]:checked').map(function () {
    return this.value;
  }).get();

  if (!ids.length) {
    $("#resultado").html("Debe seleccionar algo a eliminar");
  } else {
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': token
      }
    });
    $.ajax({
      type: "POST",
      url: "bulk-delete",
      data: {
        'ids': ids,
        _method: 'POST',
        'soft': bulkConfig.soft,
        'model': bulkConfig.model,
        'restore': bulkConfig.restore
      },
      beforeSend: function beforeSend() {
        $("#resultado").html("Procesando, espere por favor...");
      },
      success: function success(response) {
        console.log(response);
        $('#' + bulkConfig.modalName).modal('toggle');

        if (response.error) {
          var errorMsg = bulkConfig.restore ? 'Los siguientes usuarios no se han restaurado: ' : 'Los siguientes usuarios no se han eliminado: ';
          toastr.error(errorMsg + response.failed);
        } else {
          var successMsg = bulkConfig.restore ? 'Se han restaurado correctamente' : 'Se han eliminado correctamente';
          toastr.success(successMsg);
        }

        setTimeout(function () {
          location.reload();
        }, 500);
      }
    });
  }
});

/***/ }),

/***/ 0:
/*!************************************************************!*\
  !*** multi ./resources/js/ajax-forms/admin/bulk-delete.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\genesis\resources\js\ajax-forms\admin\bulk-delete.js */"./resources/js/ajax-forms/admin/bulk-delete.js");


/***/ })

/******/ });