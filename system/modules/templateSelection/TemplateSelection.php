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
 * Class BaciFeHelper 
 */
class TemplateSelection extends Frontend
{

    protected static $arrThemeCache = array();
    
    /**
     *
     * @param Database_Result $objPage
     * @param Database_Result $objLayout
     * @param PageRegular $objPageRegular 
     */
    public function changeTemplate(Database_Result $objPage, Database_Result $objLayout, PageRegular &$objPageRegular)
    {
       
        if ($objPageRegular->Template->getName() == 'fe_page')
        {
            $objPageRegular->Template->setName('fe_page');
            //get theme
            $objTheme = $this->Database->prepare("SELECT * FROM tl_theme WHERE id = ?")->limit(1)->execute($objLayout->pid);
            //get templatesSelections
            $arrSelections = deserialize($objTheme->templateSelection);
            if (is_array($arrSelections) && count($arrSelections) > 0)
            {
           //     FB::log($arrSelections);
                
            }else
            {
         //       FB::log("No Selections");
            }
            
            
        }
    }
    
    public function test(&$template)
    {
        if (TL_MODE == 'BE') return;
        if ($template->getName() != 'fe_page') return;
        $arrTemplateSelection = false;
        
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
            $objPage = $this->Database->prepare("SELECT * FROM tl_page WHERE (id=? OR alias=?)" . (!BE_USER_LOGGED_IN ? " AND (start='' OR start<$time) AND (stop='' OR stop>$time) AND published=1" : ""))
                                                              ->execute((is_numeric($pageId) ? $pageId : 0), $pageId);
            // get the page details
            $objCurrentPage = $this->getPageDetails($objPage->id);
            //get the theme
            $objTheme = $this->Database->prepare("SELECT * FROM tl_theme WHERE id = (SELECT pid FROM tl_layout where id =? LIMIT 0,1)")->limit(1)->execute($objCurrentPage->layout);
            //store templateSelections in cache
            $arrTemplateSelection = deserialize($objTheme->templateSelection);
            self::$arrThemeCache[$this->Environment->__get('request')] = $arrTemplateSelection;
        }
        
//        echo "<pre>";
//        print_r($arrTemplateSelection);
//        print_r($this->Environment->agent);
//        echo "</pre>";
        
        $agent = $this->Environment->agent;
        FB::log($agent, 'agent');
        FB::log($arrTemplateSelection, '$arrTemplateSelection');
        foreach ($arrTemplateSelection as $selection)
        {
            $arrTmp = split('-', $selection['ts_client']);
            switch(strtolower($arrTmp[0]))
            {
                case 'os':
                        if (strtolower($arrTmp[1]) == strtolower($agent->os)){
                            $this->extendTemplate($template, $selection['ts_extension']);
                            FB::log($template->getFormat(), 'finalFormat');
                            return;
                        }
                    break;
                case 'browser':
                        if (strtolower($arrTmp[1]) == strtolower($agent->browser)){
                            if (count($arrTmp) == 2)
                            {
                                $this->extendTemplate($template, $selection['ts_extension']);
                                FB::log($template->getFormat(), 'finalFormat');
                                return;
                            }
                            else
                            {   
                                FB::log(strtolower($arrTmp[2]), 'arr');
                                FB::log(strtolower($agent->version), 'agent');
                                if (strtolower($arrTmp[2]) == strtolower($agent->version)){
                                    $this->extendTemplate($template, $selection['ts_extension']);
                                    FB::log("Match");
                                    FB::log($template->getFormat(), 'finalFormat');
                                    return;
                                }
                            }
                        }
                    break;
                case '@mobile':
                    if (strtolower($agent->mobile))
                    {
                        $this->extendTemplate($template, $selection['ts_extension']);
                        FB::log("Match");
                        FB::log($template->getFormat(), 'finalFormat');
                        
                        return;
                    }
                    break;
                    
                
            }
          //  FB::log( $selection['ts_client'], 'selection');
         //   FB::log($arrTmp);
        }
        
        FB::log($template->getName(), 'finalName');
        return ($template);
        
    }
    
    private function extendTemplate(&$template, $ext)
    {
        FB::log(TL_ROOT . '/templates/'.$template->getName().'.'.$ext);
        FB::log($template);
        FB::log($template->getFormat());
        if (file_exists(TL_ROOT . '/templates/'.$template->getName().'.'.$ext))
        {
            $template->setFormat($ext);
        }
        
    }
    
}

?>