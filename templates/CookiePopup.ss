<% if $isNotGoogleBot %>
    <div class="gdpr-widget__popup" id="gdpr-widget__popup">
		<span class="gdpr-widget__popup-welcome">
			<%t PrivacyCenter.AdjustCookies 'Adjust cookies' %>
        </span>
        <div class="gdpr-widget__popup-categories">
            <div class="gdpr-widget__popup-categories-item">
                <div class="gdpr-widget__popup-categories-item-name">
                    <strong><%t PrivacyCenter.Essential 'Essential' %></strong>
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
                    <strong><%t PrivacyCenter.Performance 'Performance' %></strong>
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
                    <strong><%t PrivacyCenter.Functional 'Functional' %></strong>
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
                    <strong><%t PrivacyCenter.Targeting 'Targeting' %></strong>
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
                <span class="gdpr-widget__notice-content-title"><%t PrivacyCenter.OurCookiePolicy 'Our Cookie Policy' %></span>
                <p><%t PrivacyCenter.CookieMessage 'By continuing to browse this website you consent to our use of cookies designed to ease your
                navigation through the site and generate site visit statistics. Read more about cookies {linkStart}here{linkEnd} or' linkStart=$CookiesLink linkEnd='</a>'%> <a href="#" onclick="showPopup()"><%t PrivacyCenter.AdjustCookies 'Adjust cookies' %></a>.</p>
            </div>
            <div class="gdpr-widget__notice-actions">
                <button class="gdpr-widget__notice-actions--roundButton"
                        onclick="savePreferences()"><%t PrivacyCenter.Accept 'Accept' %></button>
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
