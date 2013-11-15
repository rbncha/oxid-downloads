<?php
/**
 * This file is part of OXID eSales PayPal module.
 *
 * OXID eSales PayPal module is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OXID eSales PayPal module is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OXID eSales PayPal module.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      http://www.oxid-esales.com
 * @copyright (C) OXID eSales AG 2003-2013
 * @version OXID eSales PayPal CE
 */

/**
 * PayPal order action factory class
 */
class oePayPalOrderActionFactory
{

    /**
     * Creates action object by given action name
     */
    public function createAction( $sAction )
    {
        $oAction = null;

        switch( $sAction ) {
            case 'capture':
                $oAction = oxNew( 'oePayPalOrderActionCapture' );
                break;
            case 'refund':
                $oAction = oxNew( 'oePayPalOrderActionRefund' );
                break;
            case 'void':
                $oAction = oxNew( 'oePayPalOrderActionVoid' );
                break;
            case 'reauthorize':
                $oAction = oxNew( 'oePayPalOrderActionReauthorize' );
                break;
            default:
                throw oxNew( 'oePayPalInvalidActionException' );
        }

        return $oAction;
    }

}