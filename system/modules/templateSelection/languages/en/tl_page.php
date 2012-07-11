<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
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
 * @copyright  MEN AT WORK 2012
 * @package    templateSelection
 * @license    GNU/GPL 2
 * @filesource
 */

/**
 * Legend
 */
$GLOBALS['TL_LANG']['tl_page']['legend_template'] = 'Template file types';

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_page']['templateSelection'] = array('Templates', 'Here you cam map clients to a custom file type.');
$GLOBALS['TL_LANG']['tl_page']['ts_client_os'] = array('System', '');
$GLOBALS['TL_LANG']['tl_page']['ts_client_browser'] = array('Browser', '');
$GLOBALS['TL_LANG']['tl_page']['ts_client_browser_version'] = array('Version', 'Please enter the matching browser verion.');
$GLOBALS['TL_LANG']['tl_page']['ts_client_browser_operation'] = array('Operator', 'Geben Sie hier den zu filternden Operator ein.');
$GLOBALS['TL_LANG']['tl_page']['ts_client_is_mobile'] = array('Mobile', '');
$GLOBALS['TL_LANG']['tl_page']['ts_client_is_invert'] = array('Invert', 'Invert this filter rule.');
$GLOBALS['TL_LANG']['tl_page']['ts_extension'] = array('File type', '');

$GLOBALS['TL_LANG']['tl_page']['ts_include_selection'] = array('Activate TemplateSelection on this page and all subpages', 'Activate alternative template formates for specific user-agents');
$GLOBALS['TL_LANG']['tl_page']['ts_selection'] = array('TemplateSelection', 'Here you can configure alternative output formats for user-agents');

$GLOBALS['TL_LANG']['tl_page']['ts_include_selection_noinherit'] = array('Activate TemplateSelection on this page', 'Activate alternative template formates for specific user-agents');
$GLOBALS['TL_LANG']['tl_page']['ts_selection_noinherit'] = $GLOBALS['TL_LANG']['tl_page']['ts_include_selection'];
 
?>
