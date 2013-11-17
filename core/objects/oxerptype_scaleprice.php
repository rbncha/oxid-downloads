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
 * @link http://www.oxid-esales.com
 * @package core
 * @copyright (C) OXID eSales AG 2003-2009
 * @version OXID eShop CE
 * $Id: oxerptype_scaleprice.php 18033 2009-04-09 12:15:54Z arvydas $
 */

require_once 'oxerptype.php';

/**
 * ERP scale price description class
 */
class oxERPType_ScalePrice extends oxERPType
{
    /**
     * Class constructor
     *
     * @return null
     */
    public function __construct()
    {
        parent::__construct();

        $this->_sTableName = 'oxprice2article';
        $this->_blRestrictedByShopId = true;

        $this->_aFieldList = array(
            'OXSHOPID'		 => 'OXSHOPID',
            'OXARTID'		 => 'OXARTID',
            'OXADDABS'		 => 'OXADDABS',
            'OXADDPERC'		 => 'OXADDPERC',
            'OXAMOUNT'		 => 'OXAMOUNT',
            'OXAMOUNTTO'	 => 'OXAMOUNTTO',
            'OXID'		     => 'OXID'
        );

        $this->_aKeyFieldList = array(
            'OXID' => 'OXID'
        );
    }

}