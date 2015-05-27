// Provide a default path to dwr.engine
if (typeof this['dwr'] == 'undefined') this.dwr = {};
if (typeof dwr['engine'] == 'undefined') dwr.engine = {};
if (typeof dwr.engine['_mappedClasses'] == 'undefined') dwr.engine._mappedClasses = {};

if (window['dojo']) dojo.provide('dwr.interface.ProductController');

if (typeof this['ProductController'] == 'undefined') ProductController = {};

ProductController._path = '/INTLStore/dwr';

/**
 * @param {class java.lang.String} p0 a param
 * @param {class java.lang.String} p1 a param
 * @param {class java.lang.String} p2 a param
 * @param {function|Object} callback callback function or options object
 */
ProductController.getProductSizeQuantity = function(p0, p1, p2, callback) {
  return dwr.engine._execute(ProductController._path, 'ProductController', 'getProductSizeQuantity', arguments);
};

/**
 * @param {class java.lang.String} p0 a param
 * @param {class java.lang.String} p1 a param
 * @param {function|Object} callback callback function or options object
 */
ProductController.getFullImage = function(p0, p1, callback) {
  return dwr.engine._execute(ProductController._path, 'ProductController', 'getFullImage', arguments);
};


