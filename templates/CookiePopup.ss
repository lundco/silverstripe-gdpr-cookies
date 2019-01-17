<% if $isNotGoogleBot %>
<div class="gdpr-widget">
	<div class="gdpr-widget__popup" id="gdpr-widget__popup">
		<span class="gdpr-widget__popup-welcome">
			<%t PrivacyCenter.CookieMessage 'This site uses cookies. Some of them are essentials while other help us improve your experience.' %>
		</span>
		<div class="gdpr-widget__popup-categories">
			<div class="gdpr-widget__popup-categories-item">
				<div class="gdpr-widget__popup-categories-item-name">
					<strong><%t PrivacyCenter.Essential 'Essential' %></strong>
					<div class="gdpr-widget__popup-categories-item-count">$EssentialCookies.Count script</div>
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
					<div class="gdpr-widget__popup-categories-item-count">$PerformanceCookies.Count script</div>
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
					<div class="gdpr-widget__popup-categories-item-count">$FunctionalCookies.Count script</div>
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
					<div class="gdpr-widget__popup-categories-item-count">$TargetingCookies.Count script</div>
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
				<span onclick="showInfobox()"><%t PrivacyCenter.PolicyDetails 'Policies & details' %></span>
			</div>
			<div class="gdpr-widget__popup-footer-round-button">
				<button onclick="savePreferences()"><%t PrivacyCenter.Save 'Save preferences' %></button>
			</div>
		</div>
	</div>
	<div class="gdpr-widget__infobox" id="gdpr-widget__infobox">
		<div class="gdpr-widget__infobox-header">
			<%t PrivacyCenter.Title 'Privacy Setttings' %>
			<div class="gdpr-widget__infobox-header-close" id="close-infobox" onclick="closeInfobox()">
				&times;
			</div>
		</div>
		<div class="gdpr-widget__infobox-subheader">
			<%t PrivacyCenter.Welcome 'Here at {PageTitle} we take your privacy seriously and will only use personal data to provide the products and services you have requested from us.' PageTitle=$SiteConfig.Title%>

		</div>
		<div class="gdpr-widget__infobox-content">
			<div class="gdpr-widget__infobox-content-title">
				Menu
			</div>
			<a onclick="showCookies()">Cookies</a>
			<% loop $Policies %>
				<a onclick="showPolicy('$Slug')">$Title</a>
			<% end_loop %>
			<!--<a href="#cookie-policy">Forget me</a>-->
		</div>

		<div class="gdpr-widget__infobox-content gdpr-widget__infobox-content--overlay gdpr-widget__infobox-content--hidden" id="gdpr-widget__infobox-content-cookies">
			<div class="gdpr-widget__infobox-content-title">
				Cookies
			</div>
			<div class="gdpr-widget__infobox-content-close" onclick="closeCookies()">
				&times;
			</div>

			<div class="gdpr-widget__infobox-content-container">
				<%t PrivacyCenter.CookieText 'This site uses cookies. Some of them are essentials while other help us improve your experience.' %>
				<div class="gdpr-widget__infobox-content-container-cookies gdpr-widget__infobox-content-container-cookies-essentials">
					<div class="gdpr-widget__infobox-content-container-cookies-title"><%t PrivacyCenter.Essential 'Essential Cookies' %></div>
					<div class="gdpr-widget__infobox-content-container-cookies-description">
						<%t PrivacyCenter.StrictlyText 'These cookies are necessary for the website to function and cannot be switched off in our systems. They are usually only set in response to actions made by you which amount to a request for services, such as setting your privacy preferences, logging in or filling in forms.<br><br>You can set your browser to block or alert you about these cookies, but some parts of the site will not then work. These cookies do not store any personally identifiable information.' %>
					</div>
					<div class="gdpr-widget__infobox-content-container-cookies-list">
						<div class="gdpr-widget__infobox-content-container-cookies-list-cookies-used"><%t PrivacyCenter.CookiesUsed 'Cookies used' %></div>
						<% loop $EssentialCookies %>
							<p class="gdpr-widget__infobox-content-container-cookies-list-cookie-item"><span class="">$Text</span></p>
						<% end_loop %>
					</div>
				</div>
				<div class="gdpr-widget__infobox-content-container-cookies gdpr-widget__infobox-content-container-cookies-essentials">
					<div class="gdpr-widget__infobox-content-container-cookies-title"><%t PrivacyCenter.Performance 'Performance Cookies' %></div>
					<div class="gdpr-widget__infobox-content-container-cookies-description">
						<%t PrivacyCenter.PerformanceText 'These cookies allow us to count visits and traffic sources so we can measure and improve the performance of our site. They help us to know which pages are the most and least popular and see how visitors move around the site.<br><br>All information these cookies collect is aggregated and therefore anonymous. If you do not allow these cookies we will not know when you have visited our site, and will not be able to monitor its performance.' %>
					</div>
					<div class="gdpr-widget__infobox-content-container-cookies-list">
						<div class="gdpr-widget__infobox-content-container-cookies-list-cookies-used"><%t PrivacyCenter.CookiesUsed 'Cookies used' %></div>
						<% loop $PerformanceCookies %>
							<p class="gdpr-widget__infobox-content-container-cookies-list-cookie-item"><span class="">$Text</span></p>
						<% end_loop %>
					</div>
				</div>
				<div class="gdpr-widget__infobox-content-container-cookies gdpr-widget__infobox-content-container-cookies-essentials">
					<div class="gdpr-widget__infobox-content-container-cookies-title"><%t PrivacyCenter.Functional 'Functional Cookies'%></div>
					<div class="gdpr-widget__infobox-content-container-cookies-description">
						<%t PrivacyCenter.FunctionalText 'These cookies enable the website to provide enhanced functionality and personalisation. They may be set by us or by third party providers whose services we have added to our pages.<br><br>If you do not allow these cookies then some or all of these services may not function properly.' %>
					</div>
					<div class="gdpr-widget__infobox-content-container-cookies-list">
						<div class="gdpr-widget__infobox-content-container-cookies-list-cookies-used"><%t PrivacyCenter.CookiesUsed 'Cookies used' %></div>
						<% loop $FunctionalCookies %>
							<p class="gdpr-widget__infobox-content-container-cookies-list-cookie-item"><span class="">$Text</span></p>
						<% end_loop %>
					</div>
				</div>
				<div class="gdpr-widget__infobox-content-container-cookies gdpr-widget__infobox-content-container-cookies-essentials">
					<div class="gdpr-widget__infobox-content-container-cookies-title"><%t PrivacyCenter.Targeting 'Targeting Cookies'%></div>
					<div class="gdpr-widget__infobox-content-container-cookies-description">
						<%t PrivacyCenter.TargetingText 'These cookies may be set through our site by our advertising partners. They may be used by those companies to build a profile of your interests and show you relevant adverts on other sites.<br><br>They do not store directly personal information, but are based on uniquely identifying your browser and internet device. If you do not allow these cookies, you will experience less targeted advertising.' %>
					</div>
					<div class="gdpr-widget__infobox-content-container-cookies-list">
						<div class="gdpr-widget__infobox-content-container-cookies-list-cookies-used"><%t PrivacyCenter.CookiesUsed 'Cookies used' %></div>
						<% loop $TargetingCookies %>
							<p class="gdpr-widget__infobox-content-container-cookies-list-cookie-item"><span class="">$Text</span></p>
						<% end_loop %>
					</div>
				</div>
			</div>
		</div>

		<% loop $Policies %>
			<div class="gdpr-widget__infobox-content gdpr-widget__infobox-content--overlay gdpr-widget__infobox-content--hidden" id="gdpr-widget__infobox-content-$Slug">
				<div class="gdpr-widget__infobox-content-title">
					$Title
					<span><%t PrivacyCenter.LastUpdate 'Last updated' %> $getCurrentRelease</span>
				</div>
				<div class="gdpr-widget__infobox-content-close" onclick="closePolicy('$Slug')">
					&times;
				</div>
				<div class="gdpr-widget__infobox-content-container">
					$PolicyContent
				</div>
			</div>
		<% end_loop %>
	</div>
	<div class="gdpr-widget__popup" id="gdpr-widget__popup-notice" style="display: none">
		<div class="gdpr-widget__popup-welcome">
			<%t PrivacyCenter.PolicyChange 'Our policies have changed since last time you visited us.' %>
		</div>
		<div class="gdpr-widget__popup-footer">
			<div class="gdpr-widget__popup-footer-links">
				<span onclick="showInfobox()"><%t PrivacyCenter.PolicyDetails 'Policies & details' %></span>
			</div>
			<div class="gdpr-widget__popup-footer-round-button">
				<button onclick="savePreferences()"><%t PrivacyCenter.AcceptPolicy 'Accept policies' %></button>
			</div>
		</div>
	</div>
</div>

<script>
	if(getCookie('performanceCookies') === 'pending'){
		showPopup();
	}

	if(getCookie('GDPRToken') && getCookie('GDPRAcceptedPolicyVersions') && !doVersionsMatch()){
		showNotice();
	}
</script>
<% end_if %>
