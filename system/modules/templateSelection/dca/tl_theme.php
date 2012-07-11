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
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_theme']['palettes']['default'] = str_replace('screenshot', 'screenshot;{legend_template},templateSelection', $GLOBALS['TL_DCA']['tl_theme']['palettes']['default']);

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_theme']['fields']['templateSelection'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_theme']['templateSelection'],
    'exclude' => true,
    'inputType' => 'multiColumnWizard',
    'eval' => array
        (
        'columnFields' => array
            (
            'ts_client_os' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_theme']['ts_client_os'],
                'exclude' => true,
                'inputType' => 'select',
                'options_callback' => array(
                    'AgentSelection',
                    'getClientOs'
                ),
                'eval' => array(
                    'style' => 'width:100px',
                    'includeBlankOption' => true,
                    'chosen' => true
                )
            ),
            'ts_client_browser' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_theme']['ts_client_browser'],
                'exclude' => true,
                'inputType' => 'select',
                'options_callback' => array('AgentSelection', 'getClientBrowser'),
                'eval' => array(
                    'style' => 'width:100px',
                    'includeBlankOption' => true,
                    'chosen' => true
                )
            ),
            'ts_client_browser_operation' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_theme']['ts_client_browser_operation'],
                'inputType' => 'select',
                'options' => array(
                    'lt' => '<',
                    'lte' => '<=',
                    'gte' => '>=',
                    'gt' => '>'
                ),
                'eval' => array(
                    'style' => 'width:70px',
                    'includeBlankOption' => true
                )
            ),
            'ts_client_browser_version' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_theme']['ts_client_browser_version'],
                'inputType' => 'text',
                'eval' => array(
                    'style' => 'width:70px'
                )
            ),
            'ts_client_is_mobile' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_theme']['ts_client_is_mobile'],
                'exclude' => true,
                'inputType' => 'select',
                'options' => array(
                    '1' => $GLOBALS['TL_LANG']['MSC']['yes'],
                    '2' => $GLOBALS['TL_LANG']['MSC']['no']
                ),
                'eval' => array(
                    'includeBlankOption' => true
                )
            ),
            'ts_client_is_invert' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_theme']['ts_client_is_invert'],
                'exclude' => true,
                'inputType' => 'checkbox',
                'eval' => array(
                    'style' => 'width:60px'
                )
            ),
            'ts_extension' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_theme']['ts_extension'],
                'inputType' => 'text',
                'eval' => array('style' => 'width:100px'),
                'save_callback' => array(
                    array('TemplateSelection', 'checkFirstDot')
                )
            ),
        )
    )
);
?>