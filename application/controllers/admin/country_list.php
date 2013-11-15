<?php
/**
 *    This file is part of OXID eShop Community Edition.
 *
 *    OXID eShop Community Edition is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    OXID eShop Community Edition is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with OXID eShop Community Edition.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      http://www.oxid-esales.com
 * @package   admin
 * @copyright (C) OXID eSales AG 2003-2013
 * @version OXID eShop CE
 * @version   SVN: $Id: country_list.php 48458 2012-08-10 06:59:10Z linas.kukulskis $
 */

/**
 * Admin selectlist list manager.
 * @package admin
 */
class Country_List extends oxAdminList
{
    /**
     * Name of chosen object class (default null).
     *
     * @var string
     */
    protected $_sListClass = 'oxcountry';

    /**
     * Default SQL sorting parameter (default null).
     *
     * @var string
     */
    protected $_sDefSortField = 'oxactive';

    /**
     * Enable/disable sorting by DESC (SQL) (default false - disable).
     *
     * @var bool
     */
    protected $_blDesc = false;


    /**
     * Executes parent method parent::render() and returns name of template
     * file "selectlist_list.tpl".
     *
     * @return string
     */
    public function render()
    {

        parent::render();
        return "country_list.tpl";
    }
}
