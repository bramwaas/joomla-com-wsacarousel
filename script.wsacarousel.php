<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
use Joomla\CMS\Factory; 
use Joomla\CMS\Version;

class Com_WsaCarouselInstallerScript
{
	/*
	 * $parent is the class calling this method.
	 * $type is the type of change (install, update or discover_install, not uninstall).
	 * preflight runs before anything else and while the extracted files are in the uploaded temp folder.
	 * If preflight returns false, Joomla will abort the update and undo everything already done.
	 */
	function preflight( $type, $parent ) {
		$jversion = new Version();
		
		if(version_compare($this->getParam('version'), '0.0.1', 'lt')) {
			
			$db = Factory::getDBO();
			$db->setQuery('SELECT extension_id FROM #__extensions WHERE name = "com_wsacarousel"');
			$ext_id = $db->loadResult();
			// adding the schema version before update to 2.0+
			if($ext_id) {
				$db->setQuery("INSERT INTO #__schemas (extension_id, version_id) VALUES (".$ext_id.", '0.0.1')");
				$db->query();
			}
		}
	}
	
	function getParam( $name ) {
		$db = Factory::getDbo();
		$db->setQuery('SELECT manifest_cache FROM #__extensions WHERE name = "com_wsacarousel"');
		$manifest = json_decode( $db->loadResult(), true );
		return $manifest[ $name ];
	}
 
	/*
	 * sets parameter values in the component's row of the extension table
	 */
	function setParams($param_array) {
		if ( count($param_array) > 0 ) {
			// read the existing component value(s)
			$db = Factory::getDbo();
			$db->setQuery('SELECT params FROM #__extensions WHERE name = "com_wsacarousel"');
			$params = json_decode( $db->loadResult(), true );
			// add the new variable(s) to the existing one(s)
			foreach ( $param_array as $name => $value ) {
				$params[ (string) $name ] = (string) $value;
			}
			// store the combined new and existing values back as a JSON string
			$paramsString = json_encode( $params );
			$db->setQuery('UPDATE #__extensions SET params = ' .
				$db->quote( $paramsString ) .
				' WHERE name = "com_wsacarousel"' );
				$db->query();
		}
	}
}
