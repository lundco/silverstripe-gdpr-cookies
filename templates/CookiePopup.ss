<% if $isNotGoogleBot %>
<div class="gdpr-widget">
	<div class="gdpr-widget__widget-button" onclick="showPopup()"></div>
	<div class="gdpr-widget__popup" id="gdpr-widget__popup">
		<span class="gdpr-widget__popup-welcome">
			<%t PrivacyCenter.CookieMessage 'This site uses cookies. Some of them are essentials while other help us improve your experience.' %>
		</span>
		<div class="gdpr-widget__popup-categories">
			<div class="gdpr-widget__popup-categories-item">
				<div class="gdpr-widget__popup-categories-item-name">
					<strong><%t PrivacyCenter.Essential 'Essential' %></strong>
					<div class="gdpr-widget__popup-categories-item-count">1 script</div>
				</div>
				<div class="gdpr-widget__popup-categories-item-toggle">
					<div class="onoffswitch">
						<input type="checkbox" name="essential" disabled="disabled" checked="checked" class="onoffswitch-checkbox  onoffswitch-checkbox--disabled" id="gdpr-essential">
						<label class="onoffswitch-label" for="gdpr-essential"></label>
					</div>
				</div>
			</div>
			<div class="gdpr-widget__popup-categories-item">
				<div class="gdpr-widget__popup-categories-item-name">
					<strong><%t PrivacyCenter.Performance 'Performance' %></strong>
					<div class="gdpr-widget__popup-categories-item-count">1 script</div>
				</div>
				<div class="gdpr-widget__popup-categories-item-toggle">
					<div class="onoffswitch">
						<input type="checkbox" name="analytics" class="onoffswitch-checkbox" id="gdpr-performance">
						<label class="onoffswitch-label" for="gdpr-performance"></label>
					</div>
				</div>
			</div>
			<div class="gdpr-widget__popup-categories-item">
				<div class="gdpr-widget__popup-categories-item-name">
					<strong><%t PrivacyCenter.Functional 'Functional' %></strong>
					<div class="gdpr-widget__popup-categories-item-count">2 script</div>
				</div>
				<div class="gdpr-widget__popup-categories-item-toggle">
					<div class="onoffswitch">
						<input type="checkbox" name="marketing" class="onoffswitch-checkbox" id="gdpr-functional">
						<label class="onoffswitch-label" for="gdpr-functional"></label>
					</div>
				</div>
			</div>
			<div class="gdpr-widget__popup-categories-item">
				<div class="gdpr-widget__popup-categories-item-name">
					<strong><%t PrivacyCenter.Targeting 'Targeting' %></strong>
					<div class="gdpr-widget__popup-categories-item-count">2 script</div>
				</div>
				<div class="gdpr-widget__popup-categories-item-toggle">
					<div class="onoffswitch">
						<input type="checkbox" name="marketing" class="onoffswitch-checkbox" id="gdpr-targeting">
						<label class="onoffswitch-label" for="gdpr-targeting"></label>
					</div>
				</div>
			</div>
		</div>
		<div class="gdpr-widget__popup-footer">
			<div class="gdpr-widget__popup-footer-links">
				<span onclick="showInfobox()">Policies & details</span>
			</div>
			<div class="gdpr-widget__popup-footer-round-button">
				<button onclick="savePreferences()"><%t PrivacyCenter.Save 'Save preferences' %></button>
			</div>
		</div>
	</div>
	<div class="gdpr-widget__infobox" id="gdpr-widget__infobox">
		<div class="gdpr-widget__infobox-header">
			Privacy settings
			<div class="gdpr-widget__infobox-header-close" id="close-infobox" onclick="closeInfobox()">
				&times;
			</div>
		</div>
		<div class="gdpr-widget__infobox-subheader">
			Here at Lund&co we take your privacy seriously and will only use personal data
			to provide the products and services you have requested from us.
		</div>
		<div class="gdpr-widget__infobox-content">
			<div class="gdpr-widget__infobox-content-title">
				Menu
			</div>
			<a onclick="showCookies()">Cookies</a>
			<% loop $Policies %>
				<a onclick="showPolicy('privacy')">$Title</a>
			<% end_loop %>
			<a href="#cookie-policy">Forget me</a>


			<div class="gdpr-widget__infobox-content gdpr-widget__infobox-content--overlay gdpr-widget__infobox-content--hidden" id="gdpr-widget__infobox-content-cookies">
				<div class="gdpr-widget__infobox-content-title">
					Cookies
				</div>
				This site uses cookies. Some of them are essentials while other help us improve your experience.
			</div>
			<% loop $Policies %>
			<div class="gdpr-widget__infobox-content gdpr-widget__infobox-content--overlay gdpr-widget__infobox-content--hidden" id="gdpr-widget__infobox-content-privacy">
				<div class="gdpr-widget__infobox-content-title">
					$Title
				</div>
				$PolicyVersions.Filter('Status','Published').Sort('VersionCount','DESC').First
			</div>
			<% end_loop %>
		</div>
	</div>
	<div class="gdpr-widget__popup" id="gdpr-widget__popup-notice" style="display: none">
		<div class="gdpr-widget__popup-welcome">
			Our policies have changed since last time you visited us.
		</div>
		<div class="gdpr-widget__popup-footer">
			<div class="gdpr-widget__popup-footer-links">
				<span onclick="showInfobox()">Policies & details</span>
			</div>
			<div class="gdpr-widget__popup-footer-round-button">
				<button onclick="savePreferences()">Accept policies</button>
			</div>
		</div>
	</div>
</div>

<script>
	if(!getCookie('GDPRToken')){
		showPopup();
	}

	if(getCookie('GDPRToken') && !doVersionsMatch()){
		showNotice();
	}
</script>
<% end_if %>
