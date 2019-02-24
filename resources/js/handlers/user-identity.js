// Key Generator
function generateHexString(length) {
    var ret = "";
    while (ret.length < length) {
        ret += Math.random().toString(16).substring(2);
    }
    return ret.substring(0,length);
}
// Cookie Helpers
function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {
    document.cookie = name+'=; Max-Age=-99999999;';
}
(function($) {
    // Check key and generate it if missing
    let userKey = getCookie('userKey');
    // let key = generateHexString(58);
    if(!userKey) {
        setCookie('userKey', generateHexString(58), 30);
    } else {
        // console.log(localStorageKey);
    }
    // Set key to each form with ID userKey
    if($('input[name="userKey"]').length !== 0) {
        console.log(true);
        $('input[name="userKey"]').val(getCookie('userKey'));
    } else {
        // console.log(false);
    }
})(jQuery);
