<div class="privacy-bg" id="privacy-bg"></div>

<div class="privacy-center" id="privacy-center">
	<div class="privacy-top">
		<%t PrivacyCenter.Title 'Privacy Preference Center' %>
	</div>
	<div class="privacy-body">
		<div class="leftcol">
			<ul class="privacy-menu">
				<li class="menu-item-about" title="Your Privacy">
					<a href="#privacy" class="menu-item menu-item-selected" data-tab="privacy"><%t PrivacyCenter.YourPrivacy 'Your privacy' %></a>
				</li>
				<li class="menu-item-necessary" title="Strictly Necessary Cookies">
					<a href="#necessary" class="menu-item"  data-tab="necessary"><%t PrivacyCenter.Strictly 'Strictly Necessary Cookies' %></a>
				</li>
				<li class="menu-item-performance" title="Performance Cookies">
					<a href="#performance" class="menu-item" data-tab="performance"><%t PrivacyCenter.Performance 'Performance Cookies' %></a>
				</li>
				<li class="menu-item-functional" title="Functional Cookies">
					<a href="#functional" class="menu-item" data-tab="functional"><%t PrivacyCenter.Functional 'Functional Cookies'%></a>
				</li>
				<li class="menu-item-targeting" title="Targeting Cookies">
					<a href="#targeting" class="menu-item" data-tab="targeting"><%t PrivacyCenter.Targeting 'Targeting Cookies'%></a>
				</li>
			</ul>
		</div>
		<div class="rightcol">

			<div id="privacy" class="tabItem active">
				<div class="title"><%t PrivacyCenter.YourPrivacy 'Your privacy' %></div>
				<div class="main-text">
					<%t PrivacyCenter.PrivacyText 'When you visit any web site, it may store or retrieve information on your browser, mostly in the form of cookies. This information might be about you, your preferences or your device and is mostly used to make the site work as you expect it to. The information does not usually directly identify you, but it can give you a more personalized web experience. Because we respect your right to privacy, you can choose not to allow some types of cookies. Click on the different category headings to find out more and change our default settings. However, blocking some types of cookies may impact your experience of the site and the services we are able to offer.<br><br> Disabling a cookie may not always delete it from your system, but Privacy Prefrence Center, stops any data from beeing sent. By doing so you still have access to any identification that can be used to clear any earlier collected data from the systems.'%>
				</div>
			</div>

			<div id="necessary" class="tabItem">
				<div class="title"><%t PrivacyCenter.Strictly 'Strictly Necessary Cookies' %></div>
				<div class="privacy-status status-always-active">
					<div class="">
						<p><%t PrivacyCenter.AlwaysActive 'Always Active' %></p>
					</div>
				</div>
				<div class="main-text"><%t PrivacyCenter.StrictlyText 'These cookies are necessary for the website to function and cannot be switched off in our systems. They are usually only set in response to actions made by you which amount to a request for services, such as setting your privacy preferences, logging in or filling in forms.<br><br>You can set your browser to block or alert you about these cookies, but some parts of the site will not then work. These cookies do not store any personally identifiable information.' %>
					<div class="cookie-list">
						<div class="cookies-used"><%t PrivacyCenter.CookiesUsed 'Cookies used' %></div>
						<p class="cookie-item"><span class="">Cookie Privacy Center</span></p>
						<p class="cookie-item"><span class="">Google Tag Manager</span></p>
						<p class="cookie-item"><span class="">System cookies</span></p>
						<% loop $StrictlyCookies %>
							<p class="cookie-item"><span class="">$Text</span></p>
						<% end_loop %>
					</div>
				</div>
			</div>

			<div id="performance" class="tabItem">
				<div class="title"><%t PrivacyCenter.Performance 'Performance Cookies' %></div>
				<div class="privacy-status">
					<form>
						<fieldset>
							<p class="privacy-status-on">
								<input type="checkbox" value="check" id="chkPerformance" checked="checked">
								<label for="chkPerformance" id="chkPerformanceLabel" data-active="<%t PrivacyCenter.Active 'Active' %>" data-inactive="<%t PrivacyCenter.InActive 'Inactive' %>" onclick="javascript:switchCookie(this,'cookiePerformanceState');"><%t PrivacyCenter.Active 'Active' %></label>
							</p>
						</fieldset>
					</form>
				</div>
				<div class="main-text">
					<%t PrivacyCenter.PerformanceText 'These cookies allow us to count visits and traffic sources so we can measure and improve the performance of our site. They help us to know which pages are the most and least popular and see how visitors move around the site.<br><br>All information these cookies collect is aggregated and therefore anonymous. If you do not allow these cookies we will not know when you have visited our site, and will not be able to monitor its performance.' %>
					<div class="cookie-list">
						<div class="cookies-used"><%t PrivacyCenter.CookiesUsed 'Cookies used' %></div>
						<% loop $PerformanceCookies %>
							<p class="cookie-item"><span class="">$Text</span></p>
						<% end_loop %>
					</div>
				</div>
			</div>

			<div id="functional" class="tabItem">
				<div class="title"><%t PrivacyCenter.Functional 'Functional Cookies'%></div>
				<div class="privacy-status">
					<form>
						<fieldset>
							<p class="privacy-status-on">
								<input type="checkbox" value="check" id="chkFunctional" checked="checked">
								<label for="chkFunctional" id="chkFunctionalLabel" data-active="<%t PrivacyCenter.Active 'Active' %>" data-inactive="<%t PrivacyCenter.InActive 'Inactive' %>" onclick="javascript:switchCookie(this,'cookieFunctionalState');"><%t PrivacyCenter.Active 'Active' %></label>
							</p>
						</fieldset>
					</form>
				</div>
				<div class="main-text"><%t PrivacyCenter.FunctionalText 'These cookies enable the website to provide enhanced functionality and personalisation. They may be set by us or by third party providers whose services we have added to our pages.<br><br>If you do not allow these cookies then some or all of these services may not function properly.' %>
					<div class="cookie-list">
						<div class="cookies-used"><%t PrivacyCenter.CookiesUsed 'Cookies used' %></div>
						<% loop $FunctionalCookies %>
							<p class="cookie-item"><span class="">$Text</span></p>
						<% end_loop %>
					</div>
				</div>
			</div>

			<div id="targeting" class="tabItem">
				<div class="title"><%t PrivacyCenter.Targeting 'Targeting Cookies'%></div>
				<div class="privacy-status">
					<form>
						<fieldset>
							<p class="privacy-status-on">
								<input type="checkbox" value="check" id="chkTargeting" checked="checked">
								<label for="chkTargeting" id="chkTargetingLabel" data-active="<%t PrivacyCenter.Active 'Active' %>" data-inactive="<%t PrivacyCenter.InActive 'Inactive' %>" onclick="javascript:switchCookie(this,'cookieTargetingState');"><%t PrivacyCenter.Active 'Active' %></label>
							</p>
						</fieldset>
					</form>
				</div>
				<div class="main-text">
					<%t PrivacyCenter.TargetingText 'These cookies may be set through our site by our advertising partners. They may be used by those companies to build a profile of your interests and show you relevant adverts on other sites.<br><br>They do not store directly personal information, but are based on uniquely identifying your browser and internet device. If you do not allow these cookies, you will experience less targeted advertising.' %>
					<div class="cookie-list">
						<div class="cookies-used"><%t PrivacyCenter.CookiesUsed 'Cookies used' %></div>
						<% loop $TargetingCookies %>
							<p class="cookie-item"><span class="">$Text</span></p>
						<% end_loop %>
					</div>
				</div>
			</div>

		</div>
	</div>
	<div class="privacy-bottom">
		<div class="copy"><a class="lundcoCopy" href="https://www.lund-co.dk/" target="_blank">GDPR by <span>Lund&amp;Co</span></a></div>
		<a href="javascript:saveSettings();" id="saveSettings" class="saveSettings"><%t PrivacyCenter.Save 'Save settings'%></a>
	</div>
</div>

<script>
	Tabs();
	if(!getCookie('GTMID')){
		setCookie('GTMID', '$TagID', 365)
	}

	if(getCookie('cookieFirstVisit')){
		checkStatus();
	}

	if(!getCookie('cookieFirstVisit')){
		setCookie('cookieFirstVisit',true, 365)
	}
</script>