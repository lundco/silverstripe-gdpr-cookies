<% if $isNotGoogleBot %>
    <div class="gdpr-widget__popup" id="gdpr-widget__popup">
		<span class="gdpr-widget__popup-welcome">
			<%t PrivacyCenter.AdjustCookies 'Adjust cookies' %>
        </span>
        <div class="gdpr-widget__popup-categories">
            <div class="gdpr-widget__popup-categories-item">
                <div class="gdpr-widget__popup-categories-item-name">
                    <strong><%t PrivacyCenter.Essential 'Essential cookeis' %></strong>
                    <div class="gdpr-widget__popup-categories-item-count">
						<% loop $EssentialCookies %>
							$Text,
						<% end_loop %>
                    </div>
                </div>
                <div class="gdpr-widget__popup-categories-item-toggle">
                    <div class="onoffswitch">
                        <input type="checkbox" name="essential" disabled="disabled" checked="checked"
                               class="onoffswitch-checkbox  onoffswitch-checkbox--disabled" id="gdpr-essential">
                        <label class="onoffswitch-label" for="gdpr-essential"></label>
                    </div>
                </div>
            </div>
            <div class="gdpr-widget__popup-categories-item">
                <div class="gdpr-widget__popup-categories-item-name">
                    <strong><%t PrivacyCenter.Performance 'Performance cookies' %></strong>
                    <div class="gdpr-widget__popup-categories-item-count">
						<% loop $PerformanceCookies %>
							$Text,
						<% end_loop %>
                    </div>
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
                    <strong><%t PrivacyCenter.Functional 'Functional cookies' %></strong>
                    <div class="gdpr-widget__popup-categories-item-count">
						<% loop $FunctionalCookies %>
							$Text,
						<% end_loop %>
                    </div>
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
                    <strong><%t PrivacyCenter.Targeting 'Targeting cookies' %></strong>
                    <div class="gdpr-widget__popup-categories-item-count">
						<% loop $TargetingCookies %>
							$Text,
						<% end_loop %>
                    </div>
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
            <div class="gdpr-widget__popup-footer-round-button">
                <button onclick="savePreferences()"><%t PrivacyCenter.Save 'Save preferences' %></button>
            </div>
        </div>
    </div>

    <div class="gdpr-widget__notice" id="gdpr-widget__popup-notice">
        <div class="gdpr-widget__notice-wrapper">
            <div class="gdpr-widget__notice-content">
                <div class="text"><%t PrivacyCenter.CookieMessage 'By using this website you accept the use of cookies. <span class="gdpr-show" onclick="showPopup()">Set preferences</span> or <span class="gdpr-close" onclick="savePreferences()">close this message</span>' %> </div>
                <img src="/silverstripe-gdpr-cookies/img/close.svg" class=" close"  onclick="savePreferences()">
            </div>
        </div>
    </div>

    <div class="gdpr-widget__popup-bg" id="gdpr-widget__popup-bg"></div>

    <script>
        if (getCookie('performanceCookies') === 'pending') {
            showNotice();
        }
    </script>
<% end_if %>
