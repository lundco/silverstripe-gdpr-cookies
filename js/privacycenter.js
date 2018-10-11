//Menu tabs
function Tabs() {
	var bindAll = function() {
		var menuElements = document.querySelectorAll('.menu-item');
		for(var i = 0; i < menuElements.length ; i++) {
			menuElements[i].addEventListener('click', change, false);
		}
	};

	var clear = function() {
		var menuElements = document.querySelectorAll('[data-tab]');
		for(var i = 0; i < menuElements.length ; i++) {
			menuElements[i].classList.remove('menu-item-selected');
			var id = menuElements[i].getAttribute('data-tab');
			document.getElementById(id).classList.remove('active');
		}
	};

	var change = function(e) {
		e.preventDefault();
		clear();
		e.target.classList.add('menu-item-selected');
		var id = e.currentTarget.getAttribute('data-tab');
		document.getElementById(id).classList.add('active');
	};
	bindAll();
}


function switchCookie(label,cookie){
	var checkStatus = document.getElementById(label.htmlFor).checked; //Gets the inverted value
	if(checkStatus){
		setCookie(cookie, false, 365);
		var labelVal = label.getAttribute('data-inactive');
		label.innerHTML = labelVal;
	}else{
		setCookie(cookie, true, 365);
		var labelVal = label.getAttribute('data-active');
		label.innerHTML = labelVal;
	}
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
	for(var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

function showPrivacyCenter() {
	document.getElementById('privacy-center').style.display = 'block';
	document.getElementById('privacy-bg').style.display = 'block';
}

function checkStatus() {
	if(!getCookie('cookie_decided')){
		setCookie('cookiePerformanceState', true, 365);
		setCookie('cookieFunctionalState', true, 365);
		setCookie('cookieTargetingState', true, 365);
		loadScript();
	}else(
		loadScript()
	)
}

function allowAllCookies(){
	closeCookieAlert();
	setCookie('cookiePerformanceState', true, 365);
	setCookie('cookieFunctionalState', true, 365);
	setCookie('cookieTargetingState', true, 365);
	loadScript();
}

function saveSettings(){
	if(document.getElementById('cookieMessage')){
		closeCookieAlert();
	}
	closePrivacyCenter();
	if (!getCookie('cookieFirstVisit')) {
		loadScript();
	}
}

function closeCookieAlert() {
	setCookie('cookie_decided', 1, 365);
	document.getElementById('cookieMessage').style.display = 'none';
}

function closePrivacyCenter(){
	document.getElementById('privacy-center').style.display = 'none';
	document.getElementById('privacy-bg').style.display = 'none';
}

function loadScript()  {
	var googleTagID = getCookie('GTMID');
	var gtm_tag = document.createElement('script');
	gtm_tag.type = 'text/javascript';
	gtm_tag.text = '(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\':new Date().getTime(),event:\'gtm.js\'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';j.async=true;j.src=\'https://www.googletagmanager.com/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);})(window,document,\'script\',\'dataLayer\',\''+googleTagID+'\');';
	document.body.appendChild(gtm_tag);
}