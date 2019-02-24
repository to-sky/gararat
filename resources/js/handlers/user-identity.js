// Key Generator
function generateHexString(length) {
    var ret = "";
    while (ret.length < length) {
        ret += Math.random().toString(16).substring(2);
    }
    return ret.substring(0,length);
}
(function($) {
    // Check key and generate it if missing
    let localStorageKey = localStorage.getItem('userKey');
    // let key = generateHexString(58);
    if(!localStorageKey) {
        localStorage.setItem('userKey', generateHexString(58));
    } else {
        // console.log(localStorageKey);
    }
    // Set key to each form with ID userKey
    if($('input[name="userKey"]').length !== 0) {
        console.log(true);
        $('input[name="userKey"]').val(localStorage.getItem('userKey'));
    } else {
        console.log(false);
    }
})(jQuery);
