<?php

/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 22.08.2016
 * Time: 23:46
 */

require_once('config.inc.php');

class Page
{
    private $Title = "";
    private $Content = "";
    private $RightCol = "";

    private $MainNav = array(
        'Home' => 'index.php',
        'Rechnungen' => 'invoice.php',
        'Kunden' => 'customers.php'
    );

    /**
     * @param string $Title
     */
    public function setTitle($Title)
    {
        $this->Title = $Title;
    }

    /**
     * @param string $Content
     */
    public function setContent($Content)
    {
        $this->Content = $Content;
    }

    /**
     * @param string $rightCol
     */
    public function setRightCol($RightCol)
    {
        $this->RightCol = $RightCol;
    }

    /**
     * @return string
     */
    private function getHeader()
    {
        return '';
    }

    /**
     * @return string
     */
    private function getMainNav()
    {
        $return = '<ul>';

        foreach($this->MainNav as $key => $value)
        {
            $return .= '<li></li>';
        }

        $return .= '</ul>';

        return $return;
    }

    /**
     * @return string
     */
    private function getFooter()
    {
        return '';
    }

    public function run()
    {

    }



}