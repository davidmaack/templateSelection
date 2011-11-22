<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  MEN AT WORK 2011
 * @package    templateSelection
 * @license    LGPL
 * @filesource
 */

/**
 * Add to palette
 */
$GLOBALS['TL_DCA']['tl_theme']['palettes']['default'] = str_replace('screenshot', 'screenshot;{legend_template},templateSelection', $GLOBALS['TL_DCA']['tl_theme']['palettes']['default']);

/**
 * Add field
 */
$GLOBALS['TL_DCA']['tl_theme']['fields']['templateSelection'] = array
(
	'label'		=> &$GLOBALS['TL_LANG']['tl_theme']['templateSelection'],
	'exclude' => true,
	'inputType' => 'multiColumnWizard',
	'eval' => array
	(
		'columnFields' => array
		(
			'ts_client_os' => array
			(
				'label'                 => &$GLOBALS['TL_LANG']['tl_theme']['ts_client_os'],
				'exclude'               => true,
				'inputType'             => 'select',
				'options'            	=> array
				(
                                        'os-win'        => 'Windows',
                                        'os-win-ce'     => 'Windows CE / Phone',
                                        'os-mac'        => 'Macintosh',
                                        'os-unix'       => 'UNIX (Linux, FreeBSD, OpenBSD, NetBSD)',
                                        'os-ios'        => 'iOS (iPad, iPhone, iPod)',
                                        'os-android'    => 'Android',
                                        'os-blackberry' => 'Blackberry',
                                        'os-symbian'    => 'Symbian',
                                        'os-webos'      => 'WebOS'
				),
				'eval'                  => array('style'=>'width:250px', 'includeBlankOption'=>true)
			),
			'ts_client_browser' => array
			(
				'label'                 => &$GLOBALS['TL_LANG']['tl_theme']['ts_client_browser'],
				'exclude'               => true,
				'inputType'             => 'select',
				'options'            	=> array
				(
                                        'browser-ie'           => 'InternetExplorer',
                                        'browser-ie-6'         => 'InternetExplorer 6',
                                        'browser-ie-7'         => 'InternetExplorer 7',
                                        'browser-ie-8'         => 'InternetExplorer 8',
                                        'browser-ie-9'         => 'InternetExplorer 9',
                                        'browser-ie-10'        => 'InternetExplorer 10',
                                        'browser-ie-mobile'    => 'InternetExplorer Mobile',
                                        'browser-firefox'      => 'Firefox',
                                        'browser-firefox-3'    => 'Firefox-3',
                                        'browser-firefox-4'    => 'Firefox-4',
                                        'browser-firefox-5'    => 'Firefox-5',
                                        'browser-firefox-6'    => 'Firefox-6',
                                        'browser-chrome'       => 'Chrome',
                                        'browser-chrome-10'    => 'Chrome-10',
                                        'browser-chrome-11'    => 'Chrome-11',
                                        'browser-chrome-12'    => 'Chrome-12',
                                        'browser-omniweb'      => 'OmniWeb',
                                        'browser-safari'       => 'Safari',
                                        'browser-safari-4'     => 'Safari 4',
                                        'browser-safari-5'     => 'Safari 5',
                                        'browser-opera'        => 'Opera',
                                        'browser-opera-mini'   => 'Opera Mini',
                                        'browser-opera-mobile' => 'Opera Mobile',
                                        'browser-camino'       => 'Camino',
                                        'browser-konqueror'    => 'Konqueror',
                                        'browser-other'        => 'Other'
				),
				'eval'                  => array('style'=>'width:180px', 'includeBlankOption'=>true)
			),
			'ts_client_mobile' => array
			(
				'label'                 => &$GLOBALS['TL_LANG']['tl_theme']['ts_client_mobile'],
				'exclude'               => true,
				'inputType'             => 'checkbox',
				'eval'                  => array('style'=>'width:40px')

			),
			'ts_extension' => array
			(
				'label'                 => &$GLOBALS['TL_LANG']['tl_theme']['ts_extension'],
				'inputType'             => 'text',
				'eval'                  => array('style'=>'width:115px'),
				'save_callback' => array(
					array('TemplateSelection', 'checkFirstDot')
				)
			),
		)
	)
);

?>