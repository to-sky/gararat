require('./bootstrap');

// Bootstrap utils
import 'bootstrap';

try {
    window.Url = require('domurl');
} catch (e) {}


// Custom for site
require('./app/cart');
require('./app/main');
require('./app/slider-pro');
