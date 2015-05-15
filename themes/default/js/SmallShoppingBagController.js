// Provide a default path to dwr.engine
if (typeof this['dwr'] == 'undefined') this.dwr = {};
if (typeof dwr['engine'] == 'undefined') dwr.engine = {};
if (typeof dwr.engine['_mappedClasses'] == 'undefined') dwr.engine._mappedClasses = {};

if (window['dojo']) dojo.provide('dwr.interface.SmallShoppingBagController');

if (typeof this['SmallShoppingBagController'] == 'undefined') SmallShoppingBagController = {};

SmallShoppingBagController._path = '/INTLStore/dwr';

/**
 * @param {class java.lang.String} p0 a param
 * @param {function|Object} callback callback function or options object
 */
SmallShoppingBagController.getProductPrice = function(p0, callback) {
  return dwr.engine._execute(SmallShoppingBagController._path, 'SmallShoppingBagController', 'getProductPrice', arguments);
};

/**
 * @param {function|Object} callback callback function or options object
 */
SmallShoppingBagController.checkTotalQAuantity = function(callback) {
  return dwr.engine._execute(SmallShoppingBagController._path, 'SmallShoppingBagController', 'checkTotalQAuantity', arguments);
};

/**
 * @param {function|Object} callback callback function or options object
 */
SmallShoppingBagController.reserveAtpFromShoppingBag = function(callback) {
  return dwr.engine._execute(SmallShoppingBagController._path, 'SmallShoppingBagController', 'reserveAtpFromShoppingBag', arguments);
};

/**
 * @param {int} p0 a param
 * @param {function|Object} callback callback function or options object
 */
SmallShoppingBagController.deleteBagItem = function(p0, callback) {
  return dwr.engine._execute(SmallShoppingBagController._path, 'SmallShoppingBagController', 'deleteBagItem', arguments);
};

/**
 * @param {class java.lang.String} p0 a param
 * @param {class java.lang.String} p1 a param
 * @param {class java.lang.String} p2 a param
 * @param {function|Object} callback callback function or options object
 */
SmallShoppingBagController.getQtyList = function(p0, p1, p2, callback) {
  return dwr.engine._execute(SmallShoppingBagController._path, 'SmallShoppingBagController', 'getQtyList', arguments);
};

/**
 * @param {class java.lang.String} p0 a param
 * @param {class java.lang.String} p1 a param
 * @param {class java.lang.String} p2 a param
 * @param {class java.lang.String} p3 a param
 * @param {class java.lang.String} p4 a param
 * @param {function|Object} callback callback function or options object
 */
SmallShoppingBagController.registeredAdd = function(p0, p1, p2, p3, p4, callback) {
  return dwr.engine._execute(SmallShoppingBagController._path, 'SmallShoppingBagController', 'registeredAdd', arguments);
};

/**
 * @param {class java.lang.String} p0 a param
 * @param {class java.lang.String} p1 a param
 * @param {function|Object} callback callback function or options object
 */
SmallShoppingBagController.getProductColorInfoDetails = function(p0, p1, callback) {
  return dwr.engine._execute(SmallShoppingBagController._path, 'SmallShoppingBagController', 'getProductColorInfoDetails', arguments);
};

/**
 * @param {class java.lang.String} p0 a param
 * @param {function|Object} callback callback function or options object
 */
SmallShoppingBagController.getSelectedColor = function(p0, callback) {
  return dwr.engine._execute(SmallShoppingBagController._path, 'SmallShoppingBagController', 'getSelectedColor', arguments);
};

/**
 * @param {class java.lang.String} p0 a param
 * @param {class java.lang.String} p1 a param
 * @param {function|Object} callback callback function or options object
 */
SmallShoppingBagController.getProductListingImgDetails = function(p0, p1, callback) {
  return dwr.engine._execute(SmallShoppingBagController._path, 'SmallShoppingBagController', 'getProductListingImgDetails', arguments);
};

/**
 * @param {class java.lang.String} p0 a param
 * @param {class java.lang.String} p1 a param
 * @param {function|Object} callback callback function or options object
 */
SmallShoppingBagController.getProductSmallListingImgDetails = function(p0, p1, callback) {
  return dwr.engine._execute(SmallShoppingBagController._path, 'SmallShoppingBagController', 'getProductSmallListingImgDetails', arguments);
};

/**
 * @param {class java.lang.String} p0 a param
 * @param {class java.lang.String} p1 a param
 * @param {class java.lang.String} p2 a param
 * @param {function|Object} callback callback function or options object
 */
SmallShoppingBagController.getProductInfoDetails = function(p0, p1, p2, callback) {
  return dwr.engine._execute(SmallShoppingBagController._path, 'SmallShoppingBagController', 'getProductInfoDetails', arguments);
};

/**
 * @param {class java.lang.String} p0 a param
 * @param {function|Object} callback callback function or options object
 */
SmallShoppingBagController.getProductColorList = function(p0, callback) {
  return dwr.engine._execute(SmallShoppingBagController._path, 'SmallShoppingBagController', 'getProductColorList', arguments);
};

/**
 * @param {class java.lang.String} p0 a param
 * @param {class java.lang.String} p1 a param
 * @param {function|Object} callback callback function or options object
 */
SmallShoppingBagController.getProductSizeDisableList = function(p0, p1, callback) {
  return dwr.engine._execute(SmallShoppingBagController._path, 'SmallShoppingBagController', 'getProductSizeDisableList', arguments);
};

/**
 * @param {class java.lang.String} p0 a param
 * @param {function|Object} callback callback function or options object
 */
SmallShoppingBagController.checkQuantity = function(p0, callback) {
  return dwr.engine._execute(SmallShoppingBagController._path, 'SmallShoppingBagController', 'checkQuantity', arguments);
};

/**
 * @param {function|Object} callback callback function or options object
 */
SmallShoppingBagController.getSmallBagSize = function(callback) {
  return dwr.engine._execute(SmallShoppingBagController._path, 'SmallShoppingBagController', 'getSmallBagSize', arguments);
};

/**
 * @param {class java.lang.String} p0 a param
 * @param {class java.lang.String} p1 a param
 * @param {class java.lang.String} p2 a param
 * @param {class java.lang.String} p3 a param
 * @param {function|Object} callback callback function or options object
 */
SmallShoppingBagController.decodeInputName = function(p0, p1, p2, p3, callback) {
  return dwr.engine._execute(SmallShoppingBagController._path, 'SmallShoppingBagController', 'decodeInputName', arguments);
};

/**
 * @param {class java.lang.String} p0 a param
 * @param {class java.lang.String} p1 a param
 * @param {function|Object} callback callback function or options object
 */
SmallShoppingBagController.decodeInputFirstName = function(p0, p1, callback) {
  return dwr.engine._execute(SmallShoppingBagController._path, 'SmallShoppingBagController', 'decodeInputFirstName', arguments);
};

/**
 * @param {function|Object} callback callback function or options object
 */
SmallShoppingBagController.checkOutValidation = function(callback) {
  return dwr.engine._execute(SmallShoppingBagController._path, 'SmallShoppingBagController', 'checkOutValidation', arguments);
};

/**
 * @param {class java.lang.String} p0 a param
 * @param {class java.lang.String} p1 a param
 * @param {function|Object} callback callback function or options object
 */
SmallShoppingBagController.getProductImageForMobile = function(p0, p1, callback) {
  return dwr.engine._execute(SmallShoppingBagController._path, 'SmallShoppingBagController', 'getProductImageForMobile', arguments);
};

/**
 * @param {function|Object} callback callback function or options object
 */
SmallShoppingBagController.getItemQuantity = function(callback) {
  return dwr.engine._execute(SmallShoppingBagController._path, 'SmallShoppingBagController', 'getItemQuantity', arguments);
};

/**
 * @param {function|Object} callback callback function or options object
 */
SmallShoppingBagController.getOSC = function(callback) {
  return dwr.engine._execute(SmallShoppingBagController._path, 'SmallShoppingBagController', 'getOSC', arguments);
};


