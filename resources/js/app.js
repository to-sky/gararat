require('./bootstrap');

// Bootstrap utils
import 'bootstrap';

try {
    window.Url = require('domurl');
} catch (e) {}

// Custom for site
require('./app/main');
require('./app/qty-handler');
require('./app/cart');
require('./app/figure');

// Vendors for site
require('./vendor/slider-pro');
