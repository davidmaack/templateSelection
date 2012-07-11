<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
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
foreach (array('regular', 'root') as $strType)
{
    $GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'ts_include_selection';
    $GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'ts_include_selection_noinherit';

    $GLOBALS['TL_DCA']['tl_page']['palettes'][$strType] = preg_replace(
            '#({cache_legend:hide}.*);#U', '{template_selection_legend:hide},ts_include_selection,ts_include_selection_noinherit;$1', $GLOBALS['TL_DCA']['tl_page']['palettes'][$strType]
    );
}
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['ts_include_selection']           = 'ts_selection';
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['ts_include_selection_noinherit'] = 'ts_selection_noinherit';

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['ts_selection'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_page']['templateSelection'],
    'exclude' => true,
    'inputType' => 'multiColumnWizard',
    'eval' => array
        (
        'columnFields' => array
            (
            'ts_client_os' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_page']['ts_client_os'],
                'exclude' => true,
                'inputType' => 'select',
                'options_callback' => array(
                    'AgentSelection',
                    'getClientOs'
                ),
                'eval' => array(
                    'style' => 'width:125px',
                    'includeBlankOption' => true
                )
            ),
            'ts_client_browser' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_page']['ts_client_browser'],
                'exclude' => true,
                'inputType' => 'select',
                'options_callback' => array('AgentSelection', 'getClientBrowser'),
                'eval' => array(
                    'style' => 'width:125px',
                    'includeBlankOption' => true
                )
            ),
            'ts_client_browser_operation' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_page']['ts_client_browser_operation'],
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
                'label' => &$GLOBALS['TL_LANG']['tl_page']['ts_client_browser_version'],
                'inputType' => 'text',
                'eval' => array(
                    'style' => 'width:55px'
                )
            ),
            'ts_client_is_mobile' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_page']['ts_client_is_mobile'],
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
                'label' => &$GLOBALS['TL_LANG']['tl_page']['ts_client_is_invert'],
                'exclude' => true,
                'inputType' => 'checkbox',
                'eval' => array(
                    'style' => 'width:60px'
                )
            ),
            'ts_extension' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_page']['ts_extension'],
                'inputType' => 'text',
                'eval' => array('style' => 'width:75px'),
                'save_callback' => array(
                    array('TemplateSelection', 'checkFirstDot')
                )
            ),
        )
    )
);

// Copy and relabel field
$GLOBALS['TL_DCA']['tl_page']['fields']['ts_selection_noinherit'] = $GLOBALS['TL_DCA']['tl_page']['fields']['ts_selection'];


$GLOBALS['TL_DCA']['tl_page']['fields']['ts_include_selection'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_page']['ts_include_selection'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => array('submitOnChange' => true)
);

$GLOBALS['TL_DCA']['tl_page']['fields']['ts_include_selection_noinherit'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_page']['ts_include_selection_noinherit'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => array('submitOnChange' => true)
);
?>