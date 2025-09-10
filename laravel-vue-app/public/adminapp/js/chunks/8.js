(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[8],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/adminapp/js/cruds/Permissions/Index.vue?vue&type=script&lang=js":
/*!*******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/adminapp/js/cruds/Permissions/Index.vue?vue&type=script&lang=js ***!
  \*******************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var _components_Datatables_DatatableActions__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @components/Datatables/DatatableActions */ "./resources/adminapp/js/components/Datatables/DatatableActions.vue");
/* harmony import */ var _components_Datatables_TranslatedHeader__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @components/Datatables/TranslatedHeader */ "./resources/adminapp/js/components/Datatables/TranslatedHeader.vue");
/* harmony import */ var _components_Datatables_HeaderSettings__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @components/Datatables/HeaderSettings */ "./resources/adminapp/js/components/Datatables/HeaderSettings.vue");
/* harmony import */ var _components_Datatables_GlobalSearch__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @components/Datatables/GlobalSearch */ "./resources/adminapp/js/components/Datatables/GlobalSearch.vue");
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }





/* harmony default export */ __webpack_exports__["default"] = ({
  components: {
    GlobalSearch: _components_Datatables_GlobalSearch__WEBPACK_IMPORTED_MODULE_4__["default"],
    HeaderSettings: _components_Datatables_HeaderSettings__WEBPACK_IMPORTED_MODULE_3__["default"]
  },
  data: function data() {
    return {
      columns: [{
        title: 'cruds.permission.fields.id',
        field: 'id',
        thComp: _components_Datatables_TranslatedHeader__WEBPACK_IMPORTED_MODULE_2__["default"],
        sortable: true,
        colStyle: 'width: 100px;'
      }, {
        title: 'cruds.permission.fields.title',
        field: 'title',
        thComp: _components_Datatables_TranslatedHeader__WEBPACK_IMPORTED_MODULE_2__["default"],
        sortable: true
      }, {
        title: 'global.actions',
        thComp: _components_Datatables_TranslatedHeader__WEBPACK_IMPORTED_MODULE_2__["default"],
        tdComp: _components_Datatables_DatatableActions__WEBPACK_IMPORTED_MODULE_1__["default"],
        visible: true,
        thClass: 'text-right',
        tdClass: 'text-right td-actions',
        colStyle: 'width: 150px;'
      }],
      query: {
        sort: 'id',
        order: 'desc',
        limit: 100,
        s: ''
      },
      xprops: {
        module: 'PermissionsIndex',
        route: 'permissions',
        permission_prefix: 'permission_'
      }
    };
  },
  beforeDestroy: function beforeDestroy() {
    this.resetState();
  },
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapGetters"])('PermissionsIndex', ['data', 'total', 'loading'])),
  watch: {
    query: {
      handler: function handler(query) {
        this.setQuery(query);
        this.fetchIndexData();
      },
      deep: true
    }
  },
  methods: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapActions"])('PermissionsIndex', ['fetchIndexData', 'setQuery', 'resetState']))
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/adminapp/js/cruds/Permissions/Index.vue?vue&type=template&id=6f7d7b1c":
/*!*****************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!./node_modules/vue-loader/lib??vue-loader-options!./resources/adminapp/js/cruds/Permissions/Index.vue?vue&type=template&id=6f7d7b1c ***!
  \*****************************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "container-fluid"
  }, [_c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-12"
  }, [_c("div", {
    staticClass: "card"
  }, [_c("div", {
    staticClass: "card-header card-header-primary card-header-icon"
  }, [_vm._m(0), _vm._v(" "), _c("h4", {
    staticClass: "card-title"
  }, [_vm._v("\n            " + _vm._s(_vm.$t("global.table")) + "\n            "), _c("strong", [_vm._v(_vm._s(_vm.$t("cruds.permission.title")))])])]), _vm._v(" "), _c("div", {
    staticClass: "card-body"
  }, [_vm.$can(_vm.xprops.permission_prefix + "create") ? _c("router-link", {
    staticClass: "btn btn-primary",
    attrs: {
      to: {
        name: _vm.xprops.route + ".create"
      }
    }
  }, [_c("i", {
    staticClass: "material-icons"
  }, [_vm._v("\n              add\n            ")]), _vm._v("\n            " + _vm._s(_vm.$t("global.add")) + "\n          ")]) : _vm._e(), _vm._v(" "), _c("button", {
    staticClass: "btn btn-default",
    "class": {
      disabled: _vm.loading
    },
    attrs: {
      type: "button",
      disabled: _vm.loading
    },
    on: {
      click: _vm.fetchIndexData
    }
  }, [_c("i", {
    staticClass: "material-icons",
    "class": {
      "fa-spin": _vm.loading
    }
  }, [_vm._v("\n              refresh\n            ")]), _vm._v("\n            " + _vm._s(_vm.$t("global.refresh")) + "\n          ")])], 1), _vm._v(" "), _c("div", {
    staticClass: "card-body"
  }, [_c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-12"
  }, [_c("div", {
    directives: [{
      name: "show",
      rawName: "v-show",
      value: _vm.loading,
      expression: "loading"
    }],
    staticClass: "table-overlay"
  }, [_c("div", {
    staticClass: "table-overlay-container"
  }, [_c("material-spinner"), _vm._v(" "), _c("span", [_vm._v("Loading...")])], 1)]), _vm._v(" "), _c("datatable", {
    attrs: {
      columns: _vm.columns,
      data: _vm.data,
      total: _vm.total,
      query: _vm.query,
      xprops: _vm.xprops,
      HeaderSettings: false,
      pageSizeOptions: [10, 25, 50, 100]
    }
  }, [_c("global-search", {
    staticClass: "pull-left",
    attrs: {
      query: _vm.query
    }
  }), _vm._v(" "), _c("header-settings", {
    staticClass: "pull-right",
    attrs: {
      columns: _vm.columns
    }
  })], 1)], 1)])])])])])]);
};
var staticRenderFns = [function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "card-icon"
  }, [_c("i", {
    staticClass: "material-icons"
  }, [_vm._v("assignment")])]);
}];
render._withStripped = true;


/***/ }),

/***/ "./resources/adminapp/js/cruds/Permissions/Index.vue":
/*!***********************************************************!*\
  !*** ./resources/adminapp/js/cruds/Permissions/Index.vue ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Index_vue_vue_type_template_id_6f7d7b1c__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Index.vue?vue&type=template&id=6f7d7b1c */ "./resources/adminapp/js/cruds/Permissions/Index.vue?vue&type=template&id=6f7d7b1c");
/* harmony import */ var _Index_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Index.vue?vue&type=script&lang=js */ "./resources/adminapp/js/cruds/Permissions/Index.vue?vue&type=script&lang=js");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Index_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"],
  _Index_vue_vue_type_template_id_6f7d7b1c__WEBPACK_IMPORTED_MODULE_0__["render"],
  _Index_vue_vue_type_template_id_6f7d7b1c__WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/adminapp/js/cruds/Permissions/Index.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/adminapp/js/cruds/Permissions/Index.vue?vue&type=script&lang=js":
/*!***********************************************************************************!*\
  !*** ./resources/adminapp/js/cruds/Permissions/Index.vue?vue&type=script&lang=js ***!
  \***********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/adminapp/js/cruds/Permissions/Index.vue?vue&type=script&lang=js");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/adminapp/js/cruds/Permissions/Index.vue?vue&type=template&id=6f7d7b1c":
/*!*****************************************************************************************!*\
  !*** ./resources/adminapp/js/cruds/Permissions/Index.vue?vue&type=template&id=6f7d7b1c ***!
  \*****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_6f7d7b1c__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ref--6!../../../../../node_modules/vue-loader/lib??vue-loader-options!./Index.vue?vue&type=template&id=6f7d7b1c */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/adminapp/js/cruds/Permissions/Index.vue?vue&type=template&id=6f7d7b1c");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_6f7d7b1c__WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ref_6_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_6f7d7b1c__WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);