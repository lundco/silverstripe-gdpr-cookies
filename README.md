# Silverstripe GDPR Cookies
Silverstripe GDPR Cookies is a module which enables you to controle which cookies and external services should be loaded into the webpage, and gives to website visitor control over what they want to be loaded to make the website GDPR compliant.

## Installation
```composer require lundco/silverstripe-gdpr-cookies```

Alternatively simply download the zip file from github. After installation run a run dev/build?flush=1 on your project.

## Display cookiemessage & privacycenter
To display cookiemessage include ```$PrivacyCenter``` and ```$CookiePopup``` on your .ss base template (Page.ss)

## Requirements
 - Silverstripe CMS ~3.1
 
## Configuration
The configuration of the module is done using the mysite config.yml.

### Setting google tag manager id
To set the Google tag manager id use `TagID`

### Setting cookie list
The cookies are divided into 4 different types
 - Strictly (Like use login cookies)
 - Performance (Like Google Analytics)
 - Technical (Like Drift)
 - Targeting (Like AdWords, Facebook pixel etc.)

So when done your config.yml should have something like this:
```
PrivacyCenter:
  TagID:
    - 'GTM-XXXXXXX'
  StrictlyCookies:
    - 'Cookiename'
  PerformanceCookies:
    - 'Cookiename'
  TechnicalCookies:
    - 'Cookiename'
  TargetingCookies:
    - 'Cookiename'
```

## Translations
The plugin will be delivered with english as base language and a danish language file. If you create additional language files please feel free to share them with us. We will be happy to include them in the repository.

## Todo
 - Improve mobile view
