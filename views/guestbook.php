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
 * @package   views
 * @copyright (C) OXID eSales AG 2003-2010
 * @version OXID eShop CE
 * @version   SVN: $Id: guestbook.php 26730 2010-03-22 11:58:18Z arvydas $
 */

/**
 * Shop guestbook page.
 * Manages, collects, denies user comments.
 */
class GuestBook extends oxUBase
{
    /**
     * Number of possible pages.
     * @var integer
     */
    protected $_iCntPages = null;

    /**
     * Boolean for showing login form instead of guestbook entries
     * @var bool
     */
    protected $_blShowLogin = false;

    /**
     * Array of sorting columns
     * @var array
     */
    protected $_aSortColumns = false;

    /**
     * Order by
     * @var string
     */
    protected $_sSortBy = false;

    /**
     * Oreder directory
     * @var string
     */
    protected $_sSortDir = false;

    /**
     * Flood protection
     * @var bool
     */
    protected $_blFloodProtection = null;

    /**
     * Guestbook entries
     * @var array
     */
    protected $_aEntries = null;

    /**
     * Current class template name.
     * @var string
     */
    protected $_sThisTemplate = 'guestbook.tpl';

    /**
     * Current class login template name
     * @var string
     */
    protected $_sThisLoginTemplate = 'guestbook_login.tpl';

    /**
     * Marked which defines if current view is sortable or not
     * @var bool
     */
    protected $_blShowSorting = true;

    /**
     * Page navigation
     * @var object
     */
    protected $_oPageNavigation = null;

    /**
     * Current view search engine indexing state
     *
     * @var int
     */
    protected $_iViewIndexState = VIEW_INDEXSTATE_NOINDEXNOFOLLOW;

    /**
     * Loads guestbook entries, forms guestbook naviagation URLS,
     * executes parent::render() and returns name of template to
     * render guestbook::_sThisTemplate.
     *
     * Template variables:
     * <b>entries</b>, <b>navigationPages</b>
     *
     * @return  string  $this->_sThisTemplate   current template file name
     */
    public function render()
    {
        parent::render();

        // #774C no user mail and password check in guesbook
        if ( $this->_blShowLogin ) {
            //no valid login
            return $this->_sThisLoginTemplate;
        }

        // flood protection
        $this->_aViewData['hideentries'] = $this->floodProtection();

        $this->_aViewData["allsortcolumns"] = $this->getSortColumns();

        $this->_aViewData['gborderby'] = $this->getGbSortBy();
        $this->_aViewData['gborder']   = $this->getGbSortDir();

        // loading GB records
        $this->_aViewData['entries'] = $this->getEntries();

        // page navigation object
        $this->_aViewData['pageNavigation'] = $this->getPageNavigation();

        return $this->_sThisTemplate;
    }

    /**
     * Sets variable bShowLogin to true
     *
     * @deprecated use link to account page instead (e.g. "cl=account&amp;sourcecl=guestbook"+required parameters)
     *
     * @return null
     */
    public function showLogin()
    {
        $this->_blShowLogin = true;
    }

    /**
     * Template variable getter. Returns sorting columns
     *
     * @return array
     */
    public function getSortColumns()
    {
        return $this->_aSortColumns;
    }

    /**
     * Template variable getter. Returns order by
     *
     * @return string
     */
    public function getGbSortBy()
    {
        return $this->_sSortBy;
    }

    /**
     * Template variable getter. Returns order directory
     *
     * @return void
     */
    public function getGbSortDir()
    {
        return $this->_sSortDir;
    }

    /**
     * Loads guestbook entries for active page and returns them.
     *
     * @return array $oEntries guestbook entries
     */
    public function getEntries()
    {
        if ( $this->_aEntries === null) {
            $this->_aEntries  = false;
            $iNrofCatArticles = (int) $this->getConfig()->getConfigParam( 'iNrofCatArticles' );
            $iNrofCatArticles = $iNrofCatArticles ? $iNrofCatArticles : 10;

            // loading only if there is some data
            $oEntries = oxNew( 'oxgbentry' );
            if ( $iCnt = $oEntries->getEntryCount() ) {
                $this->_iCntPages = round( $iCnt / $iNrofCatArticles + 0.49 );
                $this->_aEntries  = $oEntries->getAllEntries( $this->getActPage() * $iNrofCatArticles, $iNrofCatArticles, $this->getSortingSql( 'oxgb' ) );
            }
        }
        return $this->_aEntries;
    }

    /**
     * Template variable getter. Returns boolean of flood protection
     *
     * @return bool
     */
    public function floodProtection()
    {
        if ( $this->_blFloodProtection === null ) {
            $this->_blFloodProtection = false;
            // is user logged in ?
            $sUserId = oxSession::getVar( 'usr' );
            $sUserId = $sUserId ? $sUserId : 0;

            $oEntries = oxNew( 'oxgbentry' );
            $this->_blFloodProtection = $oEntries->floodProtection( $this->getConfig()->getShopId(), $sUserId );

        }
        return $this->_blFloodProtection;
    }

    /**
     * Retrieves from session or gets new sorting parameters for
     * guestbook entries. Sets new sorting parameters
     * (reverse or new column sort) to session.
     *
     * Template variables:
     * <b>gborderby</b>, <b>gborder</b>, <b>allsortcolumns</b>
     *
     * Session variables:
     * <b>gborderby</b>, <b>gborder</b>
     *
     * @return  void
     */
    public function prepareSortColumns()
    {
        $oUtils = oxUtils::getInstance();

        $this->_aSortColumns  = array( 'oxuser.oxusername', 'oxgbentries.oxcreate' );

        $sSortBy  = oxConfig::getParameter( 'gborderby' );
        $sSortDir = oxConfig::getParameter( 'gborder' );

        if ( !$sSortBy && $aSorting = $this->getSorting( 'oxgb' ) ) {
            $sSortBy  = $aSorting['sortby'];
            $sSortDir = $aSorting['sortdir'];
        }

        // finally setting defaults
        if ( !$sSortBy ) {
            $sSortBy  = 'oxgbentries.oxcreate';
            $sSortDir = 'desc';
        }

        if ( $sSortBy && oxDb::getInstance()->isValidFieldName( $sSortBy ) &&
             $sSortDir && oxUtils::getInstance()->isValidAlpha( $sSortDir ) ) {

            $this->_sSortBy  = $sSortBy;
            $this->_sSortDir = $sSortDir;

            // caching sorting config
            $this->setItemSorting( 'oxgb', $sSortBy, $sSortDir );
        }
    }

    /**
     * Template variable getter. Returns page navigation
     *
     * @return object
     */
    public function getPageNavigation()
    {
        if ( $this->_oPageNavigation === null ) {
            $this->_oPageNavigation = false;
            $this->_oPageNavigation = $this->generatePageNavigation();
        }
        return $this->_oPageNavigation;
    }

}
