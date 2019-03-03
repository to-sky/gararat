
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');
require('./handlers/qty-handler');
require('./handlers/user-identity');
require('./handlers/cart');
require('./handlers/slider');

(function($) {
    if($('#figureConstructorWrapperTarget').length !== 0) {
        require('./figures/secured-constructor');
    }
})(jQuery);
require('./figures/frontend-fogure');
