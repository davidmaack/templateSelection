<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

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
 * @license    GNU/LGPL
 * @filesource
 */

/**
 * Class templateSelection
 */
class TemplateSelection extends Frontend
{

    protected static $arrThemeCache = array();
    protected static $arrStrFileCache = array();

    /**
     * Function for change the template
     * 
     * @param array $template
     * @return array 
     */
    public function changeTemplate(&$template)
    {
        if (TL_MODE == 'BE')
        {
            return;
        }

        $arrTemplateSelection = (self::$arrThemeCache[$this->Environment->__get('request')]) ? self::$arrThemeCache[$this->Environment->__get('request')] : false;

        if (!$arrTemplateSelection)
        {
            // Get page ID
            $pageId = $this->getPageIdFromUrl();

            // Load a website root page object if there is no page ID
            if (is_null($pageId))
            {
                $objHandler = new $GLOBALS['TL_PTY']['root']();
                $pageId = $objHandler->generate($this->getRootIdFromUrl(), true);
            }

            $time = time();
            // Get the current page object
            $objDBResultPage = $this->Database->prepare("SELECT * FROM tl_page WHERE (id=? OR alias=?)" . (!BE_USER_LOGGED_IN ? " AND (start='' OR start<$time) AND (stop='' OR stop>$time) AND published=1" : ""))
                    ->execute((is_numeric($pageId) ? $pageId : 0), $pageId);

            // Check the URL of each page if there are multiple results
            if ($objDBResultPage->numRows > 1)
            {
                $objNewPage = null;
                $strHost = $this->Environment->host;

                while ($objDBResultPage->next())
                {
                    $objCurrentPage = $this->getPageDetails($objDBResultPage->id);

                    // Look for a root page whose domain name matches the host name
                    if ($objCurrentPage->domain == $strHost || $objCurrentPage->domain == 'www.' . $strHost)
                    {
                        $objNewPage = $objCurrentPage;
                        break;
                    }

                    // Fall back to a root page without domain name
                    if ($objCurrentPage->domain == '')
                    {
                        $objNewPage = $objCurrentPage;
                    }
                }

                // Matching root page found
                if (is_object($objNewPage))
                {
                    $objDBResultPage = $objNewPage;
                }
            }

            // get the page details
            $objCurrentPage = $this->getPageDetails($objDBResultPage->id);
            //get the theme
            $objTheme = $this->Database->prepare("SELECT * FROM tl_theme WHERE id = (SELECT pid FROM tl_layout where id =? LIMIT 0,1)")->limit(1)->execute($objCurrentPage->layout);
            //store templateSelections in cache
            $arrTemplateSelection = deserialize($objTheme->templateSelection);
            self::$arrThemeCache[$this->Environment->__get('request')] = $arrTemplateSelection;
        }

        //check for cached results
        $strFormat = (self::$arrStrFileCache[$this->Environment->__get('request') . '-' . $template->getName()]) ? (self::$arrStrFileCache[$this->Environment->__get('request') . '-' . $template->getName()]) : false;

        //setFormat if format was allready cached
        if ($strFormat)
        {
            $template->setFormat($strFormat);
            return;
        }

        //get agent
        $agent = $this->Environment->agent;
        if (!is_array($arrTemplateSelection)) return;

        foreach ($arrTemplateSelection as $selection)
        {
            preg_match('#^os-(.*)$#', $selection['ts_client_os'], $os);
            preg_match('#^browser-(.*?)(?:-(\d+))?$#', $selection['ts_client_browser'], $browser);

            if (
                    (empty($os[1]) || ($os[1] == $agent->os)) &&
                    (empty($browser[1]) || ($browser[1] == $agent->browser)) &&
                    (empty($browser[2]) || (floatval($browser[2]) == $agent->version)) &&
                    ($agent->mobile == $selection['ts_client_mobile'])
            )
            {
                $this->extendTemplate($template, $selection['ts_extension']);
                return;
            }
        }
    }

    /**
     * Extend the template subfolders
     * 
     * @param array $template
     * @param array $ext 
     */
    private function extendTemplate(&$template, $ext)
    {
        global $objPage;

        $strTemplateGroup = str_replace(array('../', 'templates/'), '', $objPage->templateGroup);

        if ($strTemplateGroup != '')
        {
            $strFile = $strTemplateGroup . '/' . $template->getName();
            //check folder
            if (file_exists(TL_ROOT . '/templates/' . $strFile . '.' . $ext))
            {
                //setFormat
                $template->setFormat($ext);
                //store format in cache
                self::$arrStrFileCache[$this->Environment->__get('request') . '-' . $template->getName()] = $ext;

                return;
            }
        }

        //check folder
        if (file_exists(TL_ROOT . '/templates/' . $template->getName() . '.' . $ext))
        {
            //setFormat
            $template->setFormat($ext);
            //store format in cache
            self::$arrStrFileCache[$this->Environment->__get('request') . '-' . $template->getName()] = $ext;
        }
    }

    /**
     * Check and delete the first dot
     * 
     * @param string $strValue
     * @param DataContainer $dc
     * @return string 
     */
    public function checkFirstDot($strValue)
    {
        return strncmp($strValue, '.', 1) == 0 ? substr($strValue, 1) : $strValue;
    }

}

?>