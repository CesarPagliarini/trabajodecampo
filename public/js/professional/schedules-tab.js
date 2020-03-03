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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/ajax-forms/professional-settings/schedules-tab.js":
/*!************************************************************************!*\
  !*** ./resources/js/ajax-forms/professional-settings/schedules-tab.js ***!
  \************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

if (typeof ScheduleModule === 'undefined') ScheduleModule = {};

ScheduleModule = function ($) {
  var attributes = {
    professional: {},
    specialties: {},
    attentionCenters: [],
    dateSelected: {}
  };
  var objectToSend = {}; //inputs

  var schedulespecialtySelect = $(".schedules_specialty_select");
  var tabListener = $('#schedule_tab_listener');
  var attentionPlaceSelect = $(".schedules_attention_place_select");
  var scheduleInterval = $('#schedule_range .input-daterange');
  var dayOfTheWeeks = $('#schedule_day_select');
  var formWizard = $('#professional-schedules-wrapper');
  var buttonNoConfig = $('#alert_no_config');
  var settingListener = $('#setting_tab_listener');
  var morningTimeFrom = $('#morning_from');
  var morningTimeTo = $('#morning_to');
  var afternoonTimeFrom = $('#afternoon_from');
  var afternoonTimeTo = $('#afternoon_to');
  var fullTimeFrom = $('#full_time_from');
  var fullTimeTo = $('#full_time_to');
  var formSubmitHandler = $('#save_schedules');
  var addButtonHandler = $('#add_schedule_button');
  var addButtonIcon = $('#schedule_button_icon');
  var formWrapper = $('#schedlue_form_wrapper');
  var cancelButtonHandler = $('#cancel_schedules');
  var dateTo = $('#date_to');
  var dateFrom = $('#date_from'); //configs

  var morningConfig = {
    timeFormat: 'HH:mm',
    interval: 15,
    minTime: '01',
    maxTime: '13:59pm',
    startTime: '01:00',
    maxMinutes: 15,
    dynamic: false,
    dropdown: true,
    scrollbar: false,
    change: function change(time) {
      resolveTime($(this));
    }
  };
  var afternoonConfig = {
    timeFormat: 'HH:mm',
    interval: 15,
    minTime: '14:00pm',
    maxTime: '23:59pm',
    maxMinutes: 15,
    startTime: '12:00pm',
    dynamic: false,
    dropdown: true,
    scrollbar: false,
    change: function change(time) {
      resolveTime($(this));
    }
  }; //publishers

  var init = function init() {
    formWizard.bind('checkConfigs', checkConfig);
    $.when(refreshConfigs()).done(function () {
      schedulespecialtySelect.select2({
        width: '100%'
      });
      attentionPlaceSelect.select2({
        width: '100%'
      });
      dayOfTheWeeks.select2({
        width: '100%',
        placeholder: "Selecciona los dias"
      });
      morningTimeFrom.timepicker(morningConfig);
      morningTimeTo.timepicker(morningConfig);
      afternoonTimeFrom.timepicker(afternoonConfig);
      afternoonTimeTo.timepicker(afternoonConfig);
      fullTimeFrom.timepicker(morningConfig);
      fullTimeTo.timepicker(afternoonConfig);
      scheduleInterval.datepicker({
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        startDate: new Date(),
        format: 'd/mm/yyyy'
      });
      tabListener.on('click', refreshConfigs);
      formSubmitHandler.on('click', submitForm);
      buttonNoConfig.on('click', function () {
        settingListener.click();
      });
      addButtonHandler.on('click', toggleForm);
      cancelButtonHandler.on('click', cancelForm);
    });
  }; // suscribers


  attentionPlaceSelect.on('select2:select', function (e) {
    refreshSpecialties(e.params.data);
  }); //metodos utiles

  var refreshConfigs = function refreshConfigs() {
    callApi(professionalConfigs, {
      professional_id: professional.id
    }).then(function (response) {
      attributes.professional = response.data;
      var centers = response.data.map(function (item) {
        item.attention_place['specialty_id'] = item.specialty.id;
        return item.attention_place;
      });
      var distinctCenters = Array.from(new Set(centers.map(function (center) {
        return center.id;
      }))).map(function (id) {
        return centers.find(function (center) {
          return center.id === id;
        });
      });
      attributes.attentionCenters = distinctCenters;
      attributes.specialties = response.data.map(function (item) {
        item.specialty['attention_place_id'] = item.attention_place.id;
        return item.specialty;
      });
      $('#professional-schedules-wrapper').removeClass('sk-loading');
      refreshCenters();
      formWizard.trigger('checkConfigs');
    });
  };

  var refreshCenters = function refreshCenters() {
    attentionPlaceSelect.clearSelect();
    attentionPlaceSelect.append(new Option('Seleccione una centro de atencion', '', 'selected'));
    attributes.attentionCenters.filter(function (center) {
      attentionPlaceSelect.append(new Option(center.name, center.id));
    });
  };

  var refreshSpecialties = function refreshSpecialties() {
    var data = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
    schedulespecialtySelect.clearSelect();
    var specialties = attributes.specialties.filter(function (spec) {
      return spec.attention_place_id === parseInt(data.id);
    });
    var uniqueSpecialties = [];
    var map = new Map();
    var _iteratorNormalCompletion = true;
    var _didIteratorError = false;
    var _iteratorError = undefined;

    try {
      for (var _iterator = specialties[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
        var item = _step.value;

        if (!map.has(item.id)) {
          map.set(item.id, true); // establece cualquier valor en Map

          uniqueSpecialties.push({
            id: item.id,
            name: item.name
          });
        }
      }
    } catch (err) {
      _didIteratorError = true;
      _iteratorError = err;
    } finally {
      try {
        if (!_iteratorNormalCompletion && _iterator["return"] != null) {
          _iterator["return"]();
        }
      } finally {
        if (_didIteratorError) {
          throw _iteratorError;
        }
      }
    }

    uniqueSpecialties.length ? uniqueSpecialties.filter(function (spec) {
      schedulespecialtySelect.append(new Option(spec.name, spec.id));
    }) : schedulespecialtySelect.append(new Option('Selecciona una especialidad', '', 'selected'));
  };

  var checkConfig = function checkConfig() {
    console.log(attributes.professional.length);

    if (attributes.professional.length) {
      formWizard.removeClass('hidden');
      buttonNoConfig.addClass('hidden');
      addButtonHandler.removeClass('hidden');
    } else {
      formWizard.addClass('hidden');
      buttonNoConfig.removeClass('hidden');
      addButtonHandler.addClass('hidden');
    }
  };

  var resolveTime = function resolveTime(input) {
    var element = input;
    var parent = element.data('parent');
    var child = element.data('child');
    var parentElement = parent !== undefined ? $('#' + parent) : null;
    var childElement = child !== undefined ? $('#' + child) : null;
    var errorHandler = $('#error-' + element.data('error'));
    var selfValue = element.val();

    if (parentElement != null && parentElement.val() !== 'Apertura') {
      if (parentElement.val() >= selfValue) {
        errorHandler.text('El horario de apertura no puede ser menor que el de cierre');
      } else {
        errorHandler.text('');
      }
    }

    if (childElement != null && childElement.val() !== 'Cierre') {
      if (childElement.val() <= selfValue) {
        errorHandler.text('El horario de apertura no puede ser menor que el de cierre');
      } else {
        errorHandler.text('');
      }
    }

    var id = element.attr('id');

    if (id === 'full_time_from' || id === 'full_time_to') {
      morningTimeFrom.val('Apertura');
      morningTimeTo.val('Cierre');
      afternoonTimeFrom.val('Apertura');
      afternoonTimeTo.val('Cierre');
    } else {
      fullTimeFrom.val('Apertura');
      fullTimeTo.val('Cierre');
    }
  };

  var callApi = function callApi(url) {
    var params = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': token
      }
    });
    return $.ajax({
      beforeSend: function beforeSend() {
        $('#professional-schedules-wrapper').addClass('sk-loading');
      },
      type: "POST",
      url: url,
      data: params
    });
  };

  var getSelectedScheduleTime = function getSelectedScheduleTime() {
    var schedulesTimes = [{
      schedule: 'morning',
      from: morningTimeFrom.val(),
      to: morningTimeTo.val()
    }, {
      schedule: 'afternoon',
      from: afternoonTimeFrom.val(),
      to: afternoonTimeTo.val()
    }, {
      schedule: 'fulltime',
      from: fullTimeFrom.val(),
      to: fullTimeTo.val()
    }];
    var selected = schedulesTimes.filter(function (schedule) {
      if (schedule.from !== 'Apertura' && schedule.to !== 'Cierre' && schedule.from !== undefined && schedule.to !== undefined) {
        return schedule;
      }
    });
    return selected;
  };

  var buildFormData = function buildFormData() {
    var days = dayOfTheWeeks.select2('data');
    var specialties = schedulespecialtySelect.select2('data');
    var clearDays = days.map(function (day) {
      return {
        id: day.id,
        day: day.text
      };
    });
    var clearSpecialties = specialties.map(function (spec) {
      return {
        id: spec.id
      };
    });
    var times = getSelectedScheduleTime();
    var finalObj = {
      professional_id: professional.id,
      specialties: {
        value: JSON.stringify(clearSpecialties),
        selector: schedulespecialtySelect,
        required: true
      },
      attention_place_id: {
        value: attentionPlaceSelect.find(':selected').val(),
        selector: attentionPlaceSelect,
        required: true
      },
      from: {
        value: dateFrom.val(),
        selector: dateFrom,
        required: true
      },
      to: {
        value: dateTo.val(),
        selector: dateTo,
        required: true
      },
      days: {
        value: JSON.stringify(clearDays),
        required: true,
        selector: dayOfTheWeeks
      },
      morning_schedule: {},
      afternoon_schedule: {},
      run_schedule: {}
    };
    times.filter(function (time) {
      if (time.schedule === 'morning') {
        finalObj.morning_schedule = time;
      }

      if (time.schedule === 'afternoon') {
        finalObj.afternoon_schedule = time;
      }

      if (time.schedule === 'fulltime') {
        finalObj.run_schedule = time;
      }
    });
    return finalObj;
  };

  var checkValidval = function checkValidval(val) {
    return val !== undefined && val !== 'undefined' && val !== '';
  };

  var validateForm = function validateForm() {
    var form = buildFormData();
    var isValidForm = true;

    if (!checkValidval(form.specialties.value) || form.specialties.value === '[]') {
      $('#specialty_error').removeClass('hidden');
      isValidForm = false;
    } else {
      $('#specialty_error').addClass('hidden');
    }

    if (!checkValidval(form.attention_place_id.value)) {
      $('#attention_place_error').removeClass('hidden');
      isValidForm = false;
    } else {
      $('#attention_place_error').addClass('hidden');
    }

    if (!checkValidval(form.from.value) || !checkValidval(form.to.value)) {
      $('#date_interval_error').removeClass('hidden');
      isValidForm = false;
    } else {
      $('#date_interval_error').addClass('hidden');
    }

    if (!checkValidval(form.days.value) || form.days.value === '[]') {
      $('#schedule_days_error').removeClass('hidden');
      isValidForm = false;
    } else {
      $('#schedule_days_error').addClass('hidden');
    }

    var morn = Object.getOwnPropertyNames(form.morning_schedule).length > 0;
    var afte = Object.getOwnPropertyNames(form.afternoon_schedule).length > 0;
    var full = Object.getOwnPropertyNames(form.run_schedule).length > 0;

    if (!morn && !afte && !full) {
      $('#time_error').removeClass('hidden');
      isValidForm = false;
    } else {
      $('#time_error').addClass('hidden');
    }

    if (isValidForm) {
      objectToSend = {
        professional_id: professional.id,
        specialties_ids: form.specialties.value,
        attention_place_id: form.attention_place_id.value,
        from: form.from.value,
        to: form.to.value,
        days: form.days.value,
        morning_schedule: null,
        afternoon_schedule: null,
        run_schedule: null
      };

      if (morn) {
        var sched = form.morning_schedule.from + ',' + form.morning_schedule.to;
        objectToSend.morning_schedule = sched.trim();
      }

      if (afte) {
        var _sched = form.afternoon_schedule.from + ',' + form.afternoon_schedule.to;

        objectToSend.afternoon_schedule = _sched.trim();
      }

      if (full) {
        var _sched2 = form.run_schedule.from + ',' + form.run_schedule.to;

        objectToSend.run_schedule = _sched2.trim();
      }
    }

    return isValidForm;
  };

  var toggleForm = function toggleForm() {
    addButtonIcon.toggleClass('fa-plus fa-minus');
    formWrapper.toggleClass('hidden');
  };

  var cancelForm = function cancelForm() {
    $('#specialty_error').addClass('hidden');
    $('#attention_place_error').addClass('hidden');
    $('#date_interval_error').addClass('hidden');
    $('#schedule_days_error').addClass('hidden');
    $('#time_error').addClass('hidden');
    toggleForm();
  };

  var submitForm = function submitForm() {
    if (validateForm()) {
      callApi(scheduleAddUrl, objectToSend).then(function (response) {
        console.log(response);

        if (response.error === true) {
          toastr.error(response.message);
        } else {
          toastr.success(response.message);
          window.location.reload();
        }

        $('#professional-schedules-wrapper').removeClass('sk-loading');
      });
    }

    ;
  };

  var getAttributes = function getAttributes() {
    return attributes;
  }; // expose public methods


  return {
    init: init,
    attributes: getAttributes
  };
}(jQuery);

jQuery(document).ready(ScheduleModule.init);

/***/ }),

/***/ 3:
/*!******************************************************************************!*\
  !*** multi ./resources/js/ajax-forms/professional-settings/schedules-tab.js ***!
  \******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\genesis\resources\js\ajax-forms\professional-settings\schedules-tab.js */"./resources/js/ajax-forms/professional-settings/schedules-tab.js");


/***/ })

/******/ });