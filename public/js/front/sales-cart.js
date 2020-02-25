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

/***/ "./resources/js/frontend/sales-cart.js":
/*!*********************************************!*\
  !*** ./resources/js/frontend/sales-cart.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var productsInCart = [];
var order = [];

function removeFromCart(id) {
  productsInCart = productsInCart.filter(function (item) {
    console.log($('#itemWrapper' + id), id);
    return item.id != id;
  });
}

$(document).ready(function () {
  $('.cartButtonWrapper').removeClass('hidden');
  $(document).bind('sentSaleOrder', function (e, obj) {
    var data = obj;
    var csrf = $('meta[name="csrf-token"]').attr('content');
    var url = $('#cartOrderUrl').val();
    console.log('obj', obj);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': csrf
      }
    });
    $.ajax({
      type: 'POST',
      url: url,
      data: data,
      success: function success(data) {
        if (data.success) {
          toastr.success('Excelente, estaremos en contacto, puedes seguir tu orden de compra en tu perfil');
        }

        window.location.replace('/client-profile');
      }
    });
  });
  $(document).bind('addThisProductToCart', function (e, obj) {
    var item = obj.item;
    var inCart = productsInCart.find(function (el) {
      if (el.id !== undefined && item !== undefined) {
        return el.id == item.id;
      }
    });

    if (item !== undefined && item !== 'undefined' && !inCart) {
      $('#productCartContainer').append("\n                 <div class=\"ibox-content\" id=\"itemWrapper".concat(item.id, ">\n                        <div class=\"table-responsive\">\n                            <table class=\"table shoping-cart-table\">\n                                <tbody>\n                                <tr>\n                                    <td width=\"90\">\n                                        <div class=\"cart-product-imitation\">\n                                        </div>\n                                    </td>\n                                    <td class=\"desc\">\n                                        <h3>\n                                            <a href=\"#\" class=\"text-navy\">\n                                                ").concat(item.name, "\n                                            </a>\n                                        </h3>\n\n                                        <dl class=\"small m-b-none\">\n                                            <dt>Descripci\xF3n</dt>\n                                            <dd>").concat(item.description, "</dd>\n                                        </dl>\n\n                                        <div class=\"m-t-sm\">\n                                            <a  class=\"text-muted\" onclick=\"removeFromCart(").concat(item.id, ")\" ><i class=\"fa fa-trash\"></i> Quitar del carrito</a>\n                                        </div>\n                                    </td>\n\n                                    <td >\n                                        $ ").concat(item.precio, "\n                                    </td>\n                                    <td width=\"65\">\n                                        <input id=\"itemUnitPrice").concat(item.id, "\" type=\"number\" min=1 value=1 class=\"form-control\">\n                                    </td>\n                                    <td>\n                                        <input type=\"text\" class=\"form-control\" disabled=\"disabled\" id=\"itemTotalPrice").concat(item.id, "\">\n                                    </td>\n                                </tr>\n                                </tbody>\n                            </table>\n                        </div>\n                    </div>\n                "));
      productsInCart.push(item);
      $('#cartItemCount').text(productsInCart.length);
      toastr.success('Se ha agregado ' + item.name + ' al carrito');
      productsInCart.forEach(function (el) {
        var cantidad = $('#itemUnitPrice' + item.id);
        var total = $('#itemTotalPrice' + item.id);
        total.val(cantidad.val() * item.precio);
        cantidad.change(function () {
          total.val(cantidad.val() * item.precio);
        });
      });
    } //endif undefined
    else {
        if (item !== undefined) {
          toastr.error('Ya has agregado ' + item.name + ' al carrito');
        }
      }
  });
  var sent = false;
  $('#cartOrderSubmit').click(function () {
    if (productsInCart.length > 0) {
      $('#cartContent').addClass('hidden');
      $('#cartLoading').removeClass('hidden');
      productsInCart.forEach(function (el) {
        var product = {
          cantidad: $('#itemUnitPrice' + el.id).val(),
          product_id: el.id
        };
        order.push(product);
      });
      $(document).trigger('sentSaleOrder', [{
        order: order
      }]);
      order = [];
    }
  });
  $('.addToCartButton').click(function (ev) {
    var clicked = $(ev.target).attr('id');
    var item = products.find(function (el) {
      return el.id == clicked;
    });
    $(document).trigger('addThisProductToCart', [{
      item: item
    }]);
  });
});

/***/ }),

/***/ 4:
/*!***************************************************!*\
  !*** multi ./resources/js/frontend/sales-cart.js ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! F:\programas\xampp\htdocs\genesis\resources\js\frontend\sales-cart.js */"./resources/js/frontend/sales-cart.js");


/***/ })

/******/ });