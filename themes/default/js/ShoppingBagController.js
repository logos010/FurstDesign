// Provide a default path to dwr.engine
if (typeof this['dwr'] == 'undefined') this.dwr = {};
if (typeof dwr['engine'] == 'undefined') dwr.engine = {};
if (typeof dwr.engine['_mappedClasses'] == 'undefined') dwr.engine._mappedClasses = {};

if (window['dojo']) dojo.provide('dwr.interface.ShoppingBagController');

if (typeof this['ShoppingBagController'] == 'undefined') ShoppingBagController = {};

ShoppingBagController._path = '/INTLStore/dwr';


