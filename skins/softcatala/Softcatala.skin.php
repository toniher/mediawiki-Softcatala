<?php
/**
 * Sofcatalà
 *
 * Based on Monobook noveau and Anna & Paloma's design. Performed by toniher
 * Translated from gwicke's previous TAL template version to remove
 * dependency on PHPTAL.
 *
 * @todo document
 * @file
 * @ingroup Skins
 */

if( !defined( 'MEDIAWIKI' ) )
	die( -1 );

/*
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 * @todo document
 * @ingroup Skins
 */
class SkinSoftcatala extends SkinTemplate {
	
	var $skinname = 'softcatala', $stylename = 'softcatala',
	$template = 'SoftcatalaTemplate', $useHeadElement = true;
		
	/**
	 * Initializes output page and sets up skin-specific parameters
	 * @param $out OutputPage object to initialize
	 */
	public function initPage( OutputPage $out ) {
		global $wgLocalStylePath;

		parent::initPage( $out );
		$out->addModuleScripts( 'skins.softcatala' );
		
		// Append CSS which includes IE only behavior fixes for hover support -
		// this is better than including this in a CSS fille since it doesn't
		// wait for the CSS file to load before fetching the HTC file.
		$min = $this->getRequest()->getFuzzyBool( 'debug' ) ? '' : '.min';
		$out->addHeadItem( 'csshover',
			'<!--[if lt IE 7]><style type="text/css">body{behavior:url("' .
				htmlspecialchars( $wgLocalStylePath ) .
				"/{$this->stylename}/csshover{$min}.htc\")}</style><![endif]-->"
		);
		// We add extra elements until a better way
		$out->addHeadItem( 'publicitat', '<!--# include virtual="/ssi/ad.html" -->');
		$out->addHeadItem( 'logo', '<link rel="image_src" href="https://www.softcatala.org/imatges/noticies/softcatala.png" />');
		$out->addHeadItem( 'logometa', '<meta property="og:image" content="https://www.softcatala.org/imatges/noticies/softcatala.png" />');
	}

	/**
	 * Load skin and user CSS files in the correct order
	 * fixes bug 22916
	 * @param $out OutputPage object
	 */
	function setupSkinUserCss( OutputPage $out ){
		
		parent::setupSkinUserCss( $out );
		
		// FIXME: This is the "proper" way to include CSS
		// however, MediaWiki's ResourceLoader messes up media queries
		// See: https://bugzilla.wikimedia.org/show_bug.cgi?id=38586
		// &: http://stackoverflow.com/questions/11593312/do-media-queries-work-in-mediawiki
		//
		//$out->addModuleStyles( 'skins.softcatala' );
	
		// Instead, we're going to manually add each, 
		// so we can use media queries
		foreach ( $wgResourceModules['skins.softcatala']['styles'] as $cssfile => $cssvals ) {
		  if (isset($cssvals)) {
			$out->addStyle( $cssfile, $cssvals['media'] );
		  } else {
			$out->addStyle( $cssfile );
		  }
		}
	}

}

/**
 * @todo document
 * @ingroup Skins
 */
class SoftcatalaTemplate extends BaseTemplate {

	var $skin;
	/**
	 * Template filter callback for MonoBook skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 *
	 * @access private
	 */

	function execute() {

		global $wgVectorUseIconWatch;
		global $wgLocalStylePath;
		
		$wgTitle = $this->getSkin()->getTitle();
		
		$imgPath = $wgLocalStylePath."/softcatala/img";
		
		// Build additional attributes for navigation urls
		$nav = $this->data['content_navigation'];

		if ( $wgVectorUseIconWatch ) {
			$mode = $this->getSkin()->getTitle()->userIsWatching() ? 'unwatch' : 'watch';
			if ( isset( $nav['actions'][$mode] ) ) {
				$nav['views'][$mode] = $nav['actions'][$mode];
				$nav['views'][$mode]['class'] = rtrim( 'icon ' . $nav['views'][$mode]['class'], ' ' );
				$nav['views'][$mode]['primary'] = true;
				unset( $nav['actions'][$mode] );
			}
		}

		$xmlID = '';
		foreach ( $nav as $section => $links ) {
			foreach ( $links as $key => $link ) {
				if ( $section == 'views' && !( isset( $link['primary'] ) && $link['primary'] ) ) {
					$link['class'] = rtrim( 'collapsible ' . $link['class'], ' ' );
				}

				$xmlID = isset( $link['id'] ) ? $link['id'] : 'ca-' . $xmlID;
				$nav[$section][$key]['attributes'] =
					' id="' . Sanitizer::escapeId( $xmlID ) . '"';
				if ( $link['class'] ) {
					$nav[$section][$key]['attributes'] .=
						' class="' . htmlspecialchars( $link['class'] ) . '"';
					unset( $nav[$section][$key]['class'] );
				}
				if ( isset( $link['tooltiponly'] ) && $link['tooltiponly'] ) {
					$nav[$section][$key]['key'] =
						Linker::tooltip( $xmlID );
				} else {
					$nav[$section][$key]['key'] =
						Xml::expandAttributes( Linker::tooltipAndAccesskeyAttribs( $xmlID ) );
				}
			}
		}
		$this->data['namespace_urls'] = $nav['namespaces'];
		$this->data['view_urls'] = $nav['views'];
		$this->data['action_urls'] = $nav['actions'];
		$this->data['variant_urls'] = $nav['variants'];

		// Reverse horizontally rendered navigation elements
		if ( $this->data['rtl'] ) {
			$this->data['view_urls'] =
				array_reverse( $this->data['view_urls'] );
			$this->data['namespace_urls'] =
				array_reverse( $this->data['namespace_urls'] );
			$this->data['personal_urls'] =
				array_reverse( $this->data['personal_urls'] );
		}
		// Output HTML Page
		$this->html( 'headelement' );

		// Data for assigning classes
		$ns = $this->getThemeContext('ns');
		$alltitle = $this->getThemeContext('alltitle');
		$titleshow = $this->getThemeContext('title');
		$subtitle = $this->getThemeContext('subtitle');
	
		$fitxa = $this->assignClass( $ns, $alltitle, $titleshow );
		
		echo '<div id="wrapper" class="thrColHybHdr fondo2 '.$fitxa.'">';
		
?>

	<div id="container">
	<?php echo $this->renderPubli( $fitxa ) ?>
	<?php echo $this->renderBoxHeader() ?>
		
	<!-- Sidebar -->
	<div id="sidebar1">
		<div id="wiki_int">
		<h1>Wiki de Softcatalà  <span class="blanco"> <a href="/wiki/Wiki de Softcatalà">Què és?</a></span></h1>
		
		
		<div id="personal-links">
			<?php echo $this->renderPersonal( $this->data['personal_urls'] ); ?>
		</div>
		<div class="menuwiki"> <?php $this->renderPortals( $this->data['sidebar'] ); ?></div>
		</div>
<!-- abans /ssi/ads/wiki-requadre-lateral.html" -->
		<div class="img_sidebar">
		  <a href="/wiki/Projectes/Rebost/Instruccions#Incorporaci.C3.B3_de_nous_programes_a_El_Rebost"><img class="bzero" longdesc="#" alt="Afegeix un programa" src="/img/banner_afegir.jpg"></a>
		</div>
	</div>
	<!-- Sidebar end -->
	
	<!-- content -->
	<div id="mainContent" class="mw-body">
		<!-- header -->
		<div id="mw-head" class="noprint">
			<div id="right-navigation">
				<?php $this->renderNavigation( array( 'VIEWS', 'ACTIONS' ) ); ?>
			</div>
		</div>
		<!-- /header -->

		<div class="gridfull">
			<a id="top"></a>
			<div id="mw-js-message" style="display:none;"<?php $this->html( 'userlangattributes' ) ?>></div>
			<?php if ( $this->data['sitenotice'] ): ?>
			<!-- sitenotice -->
			<div id="siteNotice"><?php $this->html( 'sitenotice' ) ?></div>
			<!-- /sitenotice -->
			<?php endif; ?>
			<?php $this->renderGridFull( $fitxa, $titleshow, $subtitle ) ?>
		</div>
		
		<!-- bodyContent -->
		<div id="bodyContent" class="boxwhite3">
			
			<div class="body_white3">
				
				<?php if ( $this->data['isarticle'] ): ?>
				<!-- tagline -->
				<!-- <div id="siteSub"><?php $this->msg( 'tagline' ) ?></div> -->
				<!-- /tagline -->
				<?php endif; ?>
				<?php if ( $this->data['undelete'] ): ?>
				<!-- undelete -->
				<div id="contentSub2"><?php $this->html( 'undelete' ) ?></div>
				<!-- /undelete -->
				<?php endif; ?>
				<?php if( $this->data['newtalk'] ): ?>
				<!-- newtalk -->
				<div class="usermessage"><?php $this->html( 'newtalk' )  ?></div>
				<!-- /newtalk -->
				<?php endif; ?>
				<?php if ( $this->data['showjumplinks'] ): ?>
				<!-- jumpto -->
				<div id="jump-to-nav" class="mw-jump">
					<?php $this->msg( 'jumpto' ) ?>
					<a href="#mw-head"><?php $this->msg( 'jumptonavigation' ) ?></a><?php $this->msg( 'comma-separator' ) ?>
					<a href="#p-search"><?php $this->msg( 'jumptosearch' ) ?></a>
				</div>
				<!-- /jumpto -->
				<?php endif; ?>
				<!-- bodycontent -->
				<?php $this->html( 'bodycontent' ) ?>
				<!-- /bodycontent -->
				<?php if ( $this->data['printfooter'] ): ?>
				<!-- printfooter -->
				<div class="printfooter">
				<?php $this->html( 'printfooter' ); ?>
				</div>
				<!-- /printfooter -->
				<?php endif; ?>
				
			</div>

			<?php if ( $this->data['catlinks'] && ( $fitxa == 'projectes' ||  $fitxa == 'paginasimple' )  ): ?>
			<!-- catlinks -->
			<div class="lindot">
				<img src="/img/shim.gif" alt="Separa Categories" longdesc="Separa Categories">
			</div>
			<?php $this->html( 'catlinks' ); ?>
			<!-- /catlinks -->
			<?php endif; ?>
			<?php if ( $this->data['dataAfterContent'] ): ?>
			<!-- dataAfterContent -->
			<?php $this->html( 'dataAfterContent' ); ?>
			<!-- /dataAfterContent -->
			<?php endif; ?>
			<div class="visualClear"></div>
			<!-- debughtml -->
			<?php $this->html( 'debughtml' ); ?>
			<!-- /debughtml -->
		</div>
		<!-- /bodyContent -->
	</div>
	<!-- /content -->


	</div>
	<br class="clearfloat" >
	
		<!-- I FOOTER -->
		<div id="footer"<?php $this->html( 'userlangattributes' ) ?>>
			<p>Softcatalà © 1998-<?php echo date('Y');?>   <a href="/wiki/Contacte">Contacte</a>  |  <a href="/avislegal.htm">Avís legal</a>  |  <a href="/wiki/Codi_de_conducta">Codi de conducta</a></p>
			<?php foreach( $this->getFooterLinks() as $category => $links ): ?>
				<ul id="footer-<?php echo $category ?>">
					<?php foreach( $links as $link ): ?>
						<li id="footer-<?php echo $category ?>-<?php echo $link ?>"><?php $this->html( $link ) ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endforeach; ?>

			<div style="clear:both"></div>
			<!--# include virtual="/ssi/footer-logos.html" -->
		</div>
		<!-- F FOOTER -->	

		<?php $this->printTrail(); ?>
</div>
	</body>
</html>
<?php
	}
	
	private function assignClass ( $ns, $alltitle, $titleshow ) {
		
		if ( $ns == NS_REBOST)  {
			$fitxa = "rebostfitxa";
		} elseif ( $ns == NS_CATEGORY && preg_match( "/^Rebost/", $titleshow ) ) {
			$fitxa = "rebostwiki";
		} else {
			$fitxa = "paginasimple";
		}

		if ( preg_match("/^Projectes/", $alltitle) ) { 
			$fitxa = "projectes";
		}
		
		return $fitxa;
	}
	
	private function renderGridFull( $fitxa, $titleshow, $subtitle ) {
		
		
		echo '<div class="fitxa-'.$fitxa.'">';
		
		if ($fitxa == 'rebostfitxa') {
			// Placeholder temporal logo
			echo '<div class="logofitxa"><img src="/w/images/c/c0/Ico_llengua.jpg"></div>';
		}
		
		echo '
		<!-- firstHeading -->
		<h1 id="firstHeading" class="firstHeading"><span dir="auto">';
		
		if ( $fitxa == 'rebostfitxa' || $fitxa == 'rebostwiki' ) {
			echo $titleshow;
		} elseif ( $fitxa == 'projectes' ) {
			echo $subtitle;
		} else {
			$this->html('title');
		}
		
		echo '</span></h1>
		<!-- /firstHeading -->
		<!-- subtitle -->
		<div id="contentSub"';
		
		$this->html('userlangattributes');
		echo '>';
		
		$this->html('subtitle');
		
		if ($fitxa == 'rebostfitxa') {
			echo $this->rebostcategories();
		}
		
		echo '</div>
		<!-- /subtitle -->
		</div>
		<div class="bloque2">
		<br>
		</div>';
		
	}
	
	private function renderPubli( $fitxa ) {
	
		if ( $fitxa == 'rebostfitxa' || $fitxa == 'rebostwiki' ) {
			$string = '
<!--# include virtual="/ssi/ads/superior-rebost.html" -->';

		} else {
			$string = '
<!--# include virtual="/ssi/ads/superior.html" -->';
		}
		
		return $string;
	}
	

	private function renderBoxHeader(  ) {
		$string = '
<!--# include virtual="/ssi/header-notrack.html" -->' ;
		
		return $string;
	}
	
	private function renderPersonal( $urls ) {
				
		$string = "";
		foreach($urls as $key => $item) {
			$string.="<p id=\"pt-".Sanitizer::escapeId($key)."\"";
			if ($item['active']) { $string.=" class=\"active\""; }
			$string.=">";
			$string.="<a href=\"".htmlspecialchars($item['href'])."\">";
			$string.=htmlspecialchars($item['text']);
			$string.="</a></p>";
		}
		
		return($string);
		
	}

	/**
	 * Render a series of portals
	 *
	 * @param $portals array
	 */
	private function renderPortals( $portals ) {
		// Force the rendering of the following portals
		if ( !isset( $portals['SEARCH'] ) ) {
			$portals['SEARCH'] = true;
		}
		if ( !isset( $portals['TOOLBOX'] ) ) {
			$portals['TOOLBOX'] = true;
		}
		if ( !isset( $portals['LANGUAGES'] ) ) {
			$portals['LANGUAGES'] = true;
		}
		// Render portals
		foreach ( $portals as $name => $content ) {
			if ( $content === false )
				continue;

			echo "\n<!-- {$name} -->\n";
			switch( $name ) {
				case 'SEARCH':
					break;
				case 'TOOLBOX':
					$this->renderPortal( 'tb', $this->getToolbox(), 'toolbox', 'SkinTemplateToolboxEnd' );
					break;
				case 'LANGUAGES':
					if ( $this->data['language_urls'] ) {
						$this->renderPortal( 'lang', $this->data['language_urls'], 'otherlanguages' );
					}
					break;
				default:
					$this->renderPortal( $name, $content );
				break;
			}
			echo "\n<!-- /{$name} -->\n";
		}
	}

	/**
	 * @param $name string
	 * @param $content array
	 * @param $msg null|string
	 * @param $hook null|string|array
	 */
	protected function renderPortal( $name, $content, $msg = null, $hook = null ) {
		if ( $msg === null ) {
			$msg = $name;
		}
		?>
<div class="portal" id='<?php echo Sanitizer::escapeId( "p-$name" ) ?>'<?php echo Linker::tooltip( 'p-' . $name ) ?>>
	<h5<?php $this->html( 'userlangattributes' ) ?>><?php $msgObj = wfMessage( $msg ); echo htmlspecialchars( $msgObj->exists() ? $msgObj->text() : $msg ); ?></h5>
	<div class="body">
<?php
		if ( is_array( $content ) ): ?>
		<ul>
<?php
			foreach( $content as $key => $val ): ?>
			<?php echo $this->makeListItem( $key, $val ); ?>

<?php
			endforeach;
			if ( $hook !== null ) {
				wfRunHooks( $hook, array( &$this, true ) );
			}
			?>
		</ul>
<?php
		else: ?>
		<?php echo $content; /* Allow raw HTML block to be defined by extensions */ ?>
<?php
		endif; ?>
	</div>
</div>
<?php
	}

	/**
	 * Render one or more navigations elements by name, automatically reveresed
	 * when UI is in RTL mode
	 *
	 * @param $elements array
	 */
	protected function renderNavigation( $elements ) {
		global $wgVectorUseSimpleSearch;

		$talk = $this->getThemeContext('talk');
		$talklink = $this->getThemeContext('talklink');
		$ns = $this->getThemeContext('ns');
		
		// If only one element was given, wrap it in an array, allowing more
		// flexible arguments
		if ( !is_array( $elements ) ) {
			$elements = array( $elements );
		// If there's a series of elements, reverse them when in RTL mode
		} elseif ( $this->data['rtl'] ) {
			$elements = array_reverse( $elements );
		}
		// Render elements
		foreach ( $elements as $name => $element ) {
			echo "\n<!-- {$name} -->\n";
			switch ( $element ) {
				case 'NAMESPACES':
?>
<div id="p-namespaces" class="vectorTabs<?php if ( count( $this->data['namespace_urls'] ) == 0 ) echo ' emptyPortlet'; ?>">
	<h5><?php $this->msg( 'namespaces' ) ?></h5>
	<ul<?php $this->html( 'userlangattributes' ) ?>>
		<?php foreach ( $this->data['namespace_urls'] as $link ): ?>
			<li <?php echo $link['attributes'] ?>><span><a href="<?php echo htmlspecialchars( $link['href'] ) ?>" <?php echo $link['key'] ?>><?php echo htmlspecialchars( $link['text'] ) ?></a></span></li>
		<?php endforeach; ?>
	</ul>
</div>
<?php
				break;
				case 'VARIANTS':
?>
<div id="p-variants" class="vectorMenu<?php if ( count( $this->data['variant_urls'] ) == 0 ) echo ' emptyPortlet'; ?>">
	<h4>
	<?php foreach ( $this->data['variant_urls'] as $link ): ?>
		<?php if ( stripos( $link['attributes'], 'selected' ) !== false ): ?>
			<?php echo htmlspecialchars( $link['text'] ) ?>
		<?php endif; ?>
	<?php endforeach; ?>
	</h4>
	<h5><span><?php $this->msg( 'variants' ) ?></span><a href="#"></a></h5>
	<div class="menu"> 
		<ul>
			<?php foreach ( $this->data['variant_urls'] as $link ): ?>
				<li<?php echo $link['attributes'] ?>><a href="<?php echo htmlspecialchars( $link['href'] ) ?>" lang="<?php echo htmlspecialchars( $link['lang'] ) ?>" hreflang="<?php echo htmlspecialchars( $link['hreflang'] ) ?>" <?php echo $link['key'] ?>><?php echo htmlspecialchars( $link['text'] ) ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<?php
				break;
				case 'VIEWS':
?>
<div id="p-views" class="vectorTabs<?php if ( count( $this->data['view_urls'] ) == 0 ) { echo ' emptyPortlet'; } ?>">
	<h5><?php $this->msg('views') ?></h5>
	<ul<?php $this->html('userlangattributes') ?>>
		<?php foreach ( $this->data['view_urls'] as $link ): ?>
			<li<?php echo $link['attributes'] ?>><span><a href="<?php echo htmlspecialchars( $link['href'] ) ?>" <?php echo $link['key'] ?>><?php
				// $link['text'] can be undefined - bug 27764
				if ( array_key_exists( 'text', $link ) ) {
					echo array_key_exists( 'img', $link ) ?  '<img src="' . $link['img'] . '" alt="' . $link['text'] . '" />' : htmlspecialchars( $link['text'] );
				}
				?></a></span></li>
		<?php endforeach;
		// Adding talk in view, avoiding special pages
		if ( $ns >= 0 ) {
			if ( $talk ) {
				echo "<li><a href='".$talklink."'>".wfMessage( 'Articlepage' )->text()."</a></li>";
			} else {
				echo "<li><a href='".$talklink."'>".wfMessage( 'Talkpage' )->text()."</a></li>";
			}
		}
		?>
	</ul>
</div>
<?php
				break;
				case 'ACTIONS':
?>
<div id="p-cactions" class="vectorMenu<?php if ( count( $this->data['action_urls'] ) == 0 ) echo ' emptyPortlet'; ?>">
	<h5><span><?php $this->msg( 'actions' ) ?></span><a href="#"></a></h5>
	<!-- <div class="menu"> -->
		<ul<?php $this->html( 'userlangattributes' ) ?>>
			<?php foreach ( $this->data['action_urls'] as $link ): ?>
				<li<?php echo $link['attributes'] ?>><a href="<?php echo htmlspecialchars( $link['href'] ) ?>" <?php echo $link['key'] ?>><?php echo htmlspecialchars( $link['text'] ) ?></a></li>
			<?php endforeach; ?>
		</ul>
	<!-- </div> -->
</div>
<?php
				break;
				case 'PERSONAL':
?>
<div id="p-personal" class="<?php if ( count( $this->data['personal_urls'] ) == 0 ) echo ' emptyPortlet'; ?>">
	<h5><?php $this->msg( 'personaltools' ) ?></h5>
	<ul<?php $this->html( 'userlangattributes' ) ?>>
<?php			foreach( $this->getPersonalTools() as $key => $item ) { ?>
		<?php echo $this->makeListItem( $key, $item ); ?>

<?php			} ?>
	</ul>
</div>
<?php
				break;
				case 'SEARCH':
?>
<div id="p-search">
	<h5<?php $this->html( 'userlangattributes' ) ?>><label for="searchInput"><?php $this->msg( 'search' ) ?></label></h5>
	<form action="<?php $this->text( 'wgScript' ) ?>" id="searchform">
		<?php if ( $wgVectorUseSimpleSearch && $this->getSkin()->getUser()->getOption( 'vector-simplesearch' ) ): ?>
		<div id="simpleSearch">
			<?php if ( $this->data['rtl'] ): ?>
			<?php echo $this->makeSearchButton( 'image', array( 'id' => 'searchButton', 'src' => $this->getSkin()->getSkinStylePath( 'images/search-rtl.png' ), 'width' => '12', 'height' => '13' ) ); ?>
			<?php endif; ?>
			<?php echo $this->makeSearchInput( array( 'id' => 'searchInput', 'type' => 'text' ) ); ?>
			<?php if ( !$this->data['rtl'] ): ?>
			<?php echo $this->makeSearchButton( 'image', array( 'id' => 'searchButton', 'src' => $this->getSkin()->getSkinStylePath( 'images/search-ltr.png' ), 'width' => '12', 'height' => '13' ) ); ?>
			<?php endif; ?>
		<?php else: ?>
		<div>
			<?php echo $this->makeSearchInput( array( 'id' => 'searchInput' ) ); ?>
			<?php echo $this->makeSearchButton( 'go', array( 'id' => 'searchGoButton', 'class' => 'searchButton' ) ); ?>
			<?php echo $this->makeSearchButton( 'fulltext', array( 'id' => 'mw-searchButton', 'class' => 'searchButton' ) ); ?>
		<?php endif; ?>
			<input type='hidden' name="title" value="<?php $this->text( 'searchtitle' ) ?>"/>
		</div>
	</form>
</div>
<?php

				break;
			}
			echo "\n<!-- /{$name} -->\n";
		}
	}
		
	
	private function getThemeContext($ask) {
		
		global $wgRequest;
		global $wgUser;
		
		// Correspondences NS
		
		$HMainpage = false;
		$HTitle = "";
		$HATitle = "";
		$HSTitle = "";
		$HNS = "0";
		$HUGroups = array();
		$HAction = "";
		$HUSysop = false;
		$HULogged = false;
		$HNewFormPage = false;
		$HEditPage = false;
		$HForm = false;
		$HTalk = false;
		
		$thTitle = $this->getSkin()->getTitle();
		
		$HTitle = $thTitle->getText();
		
		$HATitle = $thTitle->getPrefixedText();
		
		$HSTitle = $thTitle->getSubpageText();

		
		$HNS = $thTitle->getNamespace();
		$HUGroups = $wgUser->getEffectiveGroups();
		$HULogged = $wgUser->isLoggedIn();
		$HUsername = $wgUser->getName();

		if (in_array('sysop', $HUGroups)) {
			$HUSysop = true;
		}

		if ( strpos ( $_SERVER["REQUEST_URI"], 'FormEdit' ) ) {
			$HNewFormPage = true;
		}

		$HAction = $wgRequest->getText('action');

		if ( $thTitle->isMainPage() ) { $HMainpage = true; }
		
		$HTalkLink = "";
		$HTalk = $thTitle->isTalkPage();
		
		if ( $HTalk ) {
			$HTalkLink = $thTitle->getSubjectPage()->getLocalURL();
		} else {
			if ( $thTitle->canTalk() ) { 
				$HTalkLink = $thTitle->getTalkPage()->getLocalURL();
			}
		}

		if ( $ask == 'title' ) {
			return $HTitle;
		}
		
		if ( $ask == 'alltitle' ) {
			return $HATitle;
		}
		
		if ( $ask == 'subtitle' ) {
			return $HSTitle;
		}
		
		if ($ask == 'mainpage') {
			return $HMainpage;
		}
		if ($ask == 'ns') {
			return $HNS;
		}
		if ($ask == 'groups') {
			return $HUGroups;
		}
		if ($ask == 'action') {
			return $HAction;
		}
		if ($ask == 'sysop') {
			return $HUSysop;
		}
		if ($ask == 'logged') {
			return $HULogged;
		}
		if ($ask == 'username') {
			return $HUsername;
		}
		if ($ask == 'newformpage') {
			return $HNewFormPage;
		}

		if ($ask == 'categoria') {
			return $_REQUEST["categoria"];
		}
		
		if ($ask == 'editpage') {
			
			if ($HAction == 'edit' || $HAction == 'formedit' || $HForm ) {
				
				$HEditPage = true;
			}
			
			return $HEditPage;
		}
		
		if ( $ask == 'talk' ) {
			return $HTalk;
		}
		if ( $ask == 'talklink' ) {
			return $HTalkLink;
		}
		
		else { return ''; }
	}
	
	private function  curPageURL() {
		$isHTTPS = (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on");
		$port = (isset($_SERVER["SERVER_PORT"]) && ((!$isHTTPS && $_SERVER["SERVER_PORT"] != "80") || ($isHTTPS && $_SERVER["SERVER_PORT"] != "443")));
		$port = ($port) ? ':'.$_SERVER["SERVER_PORT"] : '';
		$url = ($isHTTPS ? 'https://' : 'http://').$_SERVER["SERVER_NAME"].$port.$_SERVER["REQUEST_URI"];
		return $url;
	}
	
	private function rebostcategories() {
		
		$categoriesall = $this->data['catlinks'];
		
		$categories = preg_split("/\s\|\s/", $categoriesall);	

		$textcatrebost = "";

		$textcatrebost.='<div id="rebost_categories">';

		$textcatrebost.= '<a href="/wiki/Categoria:Rebost">Rebost</a> ';

		$detectso = array("Windows", "Linux", "Mac", "Web", "Android", "Mòbil", "iOS");

		if (count($categories>1)) {

			$endcat =  strip_tags($categories[0]);
			$endcat = str_replace("Categories: ", "", $endcat);
			$endcat = str_replace(" ", "_", $endcat);	
	
			$parts = explode("Rebost", $endcat);

			for ($i=0; $i<count($parts); $i++) {
	
				$parts[$i] = preg_replace('/^_/', '', $parts[$i]);
				$cleanpart = str_replace("_", " ", $parts[$i]);
				$cleanpart = preg_replace('/·/', ' ', $cleanpart);
				if (! empty($cleanpart) ) {

					$recatcount = 0;
					foreach ($detectso as $so) {
						if ( strpos( $cleanpart, $so ) ) {
							$textcatrebost.= '| <a href="/wiki/Categoria:Rebost_'.$parts[$i]. '">'.$so.'</a> ';
							$recatcount++;
						}

					}
			
					if ($recatcount == 0) {
						$textcatrebost.= '» <a href="/wiki/Categoria:Rebost_'.$parts[$i]. '">'.$cleanpart.'</a> ';
					}
				}
			}
		
		}

		$textcatrebost.= '</div>';
		
		return $textcatrebost;
	}
	

} // end of class
