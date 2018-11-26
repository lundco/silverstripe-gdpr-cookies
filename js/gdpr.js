function closeInfobox() {
    document.getElementById('gdpr-widget__infobox').style.display = 'none';
    var overlay = document.getElementsByClassName('gdpr-overlay-open');
    if(overlay[0]){
        overlay[0].style.left = '-100%';
        overlay[0].classList.remove("gdpr-overlay-open");
    }
}

function showInfobox() {
    document.getElementById('gdpr-widget__infobox').style.display = 'block';
}

function closePopup() {
    document.getElementById('gdpr-widget__popup').style.display = 'none';
}

function showPopup() {

    if (getCookie('performanceCookies')) {
        document.getElementById('gdpr-performance').checked = (getCookie('performanceCookies') === 'true');
        document.getElementById('gdpr-functional').checked = (getCookie('functionalCookies') === 'true');
        document.getElementById('gdpr-targeting').checked = (getCookie('targetingCookies') === 'true');
    } else {
        document.getElementById('gdpr-performance').checked = true;
        document.getElementById('gdpr-functional').checked = true;
        document.getElementById('gdpr-targeting').checked = true;
    }

    //Display popup
    document.getElementById('gdpr-widget__popup').style.display = 'block';
}

function closeNotice() {
    document.getElementById('gdpr-widget__popup-notice').style.display = 'none';
}

function showNotice() {
    document.getElementById('gdpr-widget__popup-notice').style.display = 'block';
}

function doVersionsMatch() {
    if (decodeURIComponent(getCookie('GDPRPolicyVersions')) === decodeURIComponent(getCookie('GDPRAcceptedPolicyVersions'))) {
        return true;
    }

    return false;
}

function savePreferences() {
    //Save policy versions
    currentPolicies = getCookie('GDPRPolicyVersions');
    setCookie('GDPRAcceptedPolicyVersions',currentPolicies,365);

    //Save performance cookie settings
    var checkStatus = document.getElementById('gdpr-performance').checked; //Gets the inverted value
    if (checkStatus) {
        setCookie('performanceCookies', true, 365);
    } else {
        setCookie('performanceCookies', false, 365);
    }

    //Save functional cookie settings
    var checkStatus = document.getElementById('gdpr-functional').checked; //Gets the inverted value
    if (checkStatus) {
        setCookie('functionalCookies', true, 365);
    } else {
        setCookie('functionalCookies', false, 365);
    }

    //Save targeting cookie settings
    var checkStatus = document.getElementById('gdpr-targeting').checked; //Gets the inverted value
    if (checkStatus) {
        setCookie('targetingCookies', true, 365);
    } else {
        setCookie('targetingCookies', false, 365);
    }

    sendData('save');

    //Close popup
    closePopup();
    closeNotice();
}

function sendData(url) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function(){
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
        {

        }
    };
    xmlHttp.open("post", '/gdpr-xhr/'+url);
    xmlHttp.send();
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires + "; path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return null;
}

function loadScript() {
    var googleTagID = getCookie('GTMID');
    var gtm_tag = document.createElement('script');
    gtm_tag.type = 'text/javascript';
    gtm_tag.text = '(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\':new Date().getTime(),event:\'gtm.js\'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';j.async=true;j.src=\'https://www.googletagmanager.com/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);})(window,document,\'script\',\'dataLayer\',\'' + googleTagID + '\');';
    document.body.appendChild(gtm_tag);
}

function closeCookies() {
    document.getElementById('gdpr-widget__infobox-content-cookies').style.left = '-100%';
    document.getElementById('gdpr-widget__infobox-content-cookies').classList.remove("gdpr-overlay-open");
}

function showCookies() {
    document.getElementById('gdpr-widget__infobox-content-cookies').style.left = '0';
    document.getElementById('gdpr-widget__infobox-content-cookies').classList.add("gdpr-overlay-open");
}

function showPolicy(policy) {
    document.getElementById('gdpr-widget__infobox-content-'+policy).style.left = '0';
    document.getElementById('gdpr-widget__infobox-content-'+policy).classList.add("gdpr-overlay-open");
}

function closePolicy(policy) {
    document.getElementById('gdpr-widget__infobox-content-'+policy).style.left = '-100%';
    document.getElementById('gdpr-widget__infobox-content-'+policy).classList.remove("gdpr-overlay-open");
}
