require('./bootstrap');

try {
    window.Url = require('domurl');
} catch (e) {}

// Custom for site
require('./app/qty-handler');
require('./app/user-identity');
require('./app/cart');
require('./app/lang');
require('./app/figure');

// Vendors for site
require('./vendor/slider-pro');