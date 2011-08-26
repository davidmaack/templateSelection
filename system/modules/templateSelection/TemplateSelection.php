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
                //FB::log($arrSelections);
                
            }else
            {
              //  FB::log("No Selections");
            }
            
            
        }
    }
    
    public function test($template)
    {
       // FB::log($template);
        
    }
    
}

?>