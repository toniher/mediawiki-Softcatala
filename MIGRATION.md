In this document there are some details of pending things to migration for version 1.23.x

## Composer already enabled

* Alink (Replace ExternalImage)
* ImageMap
* Semantic Bundle (we should check which ones we are using !!!)
* UserFunctions
* ExtractText
* Hashsum (replaces MD5sum)
* EmailAddressImage
* GetUserInfo
* MailMan

## Composer pending to test

* TwitterFBLike
* Colorbox
 
## Other (ideally composer upstream :/)
* CustomNavBlocks
* googleAnalytics with upstream (and new features?)

## Deprecated extensions (already enabled in MediaWiki or in another extension)

* ToggleDisplay2
* Vector
* ExternalImage


# STEPS

composer require "mediawiki/semantic-media-wiki" "2.1.x"
php maintenance/update.php
enableSemantics( 'beta.softcatala.org' );
php extensions/SemanticMediaWiki/maintenance/SMW_refreshData.php -d 50 -v

composer require "mediawiki/semantic-maps" "3.1.x"

composer require "mediawiki/semantic-forms"  "3.2.x"

composer require "mediawiki/semantic-result-formats" "2.1.x"

composer require "mediawiki/user-functions" "dev-master"

composer require "mediawiki/image-map" "dev-master"

composer require "mediawiki/extract-text" "dev-master"

composer require "mediawiki/piwik-integration" "dev-master"

composer require "mediawiki/mailman" "dev-master"

composer require "mediawiki/email-address-image" "dev-master"

composer require "mediawiki/get-user-info" "dev-master"

composer require "mediawiki/hashsum" "dev-master"

composer require "mediawiki/alink" "dev-master"

Install packages

SemanticInternalObjects
Variables
RegexFunctions
ApprovedRevs
Editcount
PipeEscape
Mycroft
OpenSearch




