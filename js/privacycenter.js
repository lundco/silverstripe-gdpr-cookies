function closeInfobox(){
	document.getElementById('gdpr-widget__infobox').style.display = 'none';
}

function showInfobox(){
	document.getElementById('gdpr-widget__infobox').style.display = 'block';
}

function closePopup(){
	document.getElementById('gdpr-widget__popup').style.display = 'none';
}

function showPopup(){

	if(getCookie('GDPRToken')){
		console.log(getCookie('functionalCookies'));
		document.getElementById('gdpr-performance').checked = (getCookie('performanceCookies') === 'true');
		document.getElementById('gdpr-functional').checked = (getCookie('functionalCookies') === 'true');
		document.getElementById('gdpr-targeting').checked = (getCookie('targetingCookies') === 'true');
		console.log(getCookie('functionalCookies'));
	}else{
		document.getElementById('gdpr-performance').checked = true;
		document.getElementById('gdpr-functional').checked = true;
		document.getElementById('gdpr-targeting').checked = true;
	}

	//Display popup
	document.getElementById('gdpr-widget__popup').style.display = 'block';
}

function savePreferences(){
	//Save policy versions

	//Save/create TokenID
	setCookie('GDPRToken',true,365);

	//Save performance cookie settings
	var checkStatus = document.getElementById('gdpr-performance').checked; //Gets the inverted value
	if(checkStatus){
		setCookie('performanceCookies', true, 365);
	}else{
		setCookie('performanceCookies', false, 365);
	}

	//Save functional cookie settings
	var checkStatus = document.getElementById('gdpr-functional').checked; //Gets the inverted value
	if(checkStatus){
		setCookie('functionalCookies', true, 365);
	}else{
		setCookie('functionalCookies', false, 365);
	}

	//Save targeting cookie settings
	var checkStatus = document.getElementById('gdpr-targeting').checked; //Gets the inverted value
	if(checkStatus){
		setCookie('targetingCookies', true, 365);
	}else{
		setCookie('targetingCookies', false, 365);
	}

	//Close popup
	closePopup();
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
	return false;
}

function loadScript()  {
	var googleTagID = getCookie('GTMID');
	var gtm_tag = document.createElement('script');
	gtm_tag.type = 'text/javascript';
	gtm_tag.text = '(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\':new Date().getTime(),event:\'gtm.js\'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';j.async=true;j.src=\'https://www.googletagmanager.com/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);})(window,document,\'script\',\'dataLayer\',\''+googleTagID+'\');';
	document.body.appendChild(gtm_tag);
}
