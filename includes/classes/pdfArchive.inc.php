<?php

/**
 * Created by PhpStorm.
 * User: Heike
 * Date: 30.08.2016
 * Time: 15:07
 */
class PdfArchive
{
    private $id;
    private $type;
    private $file;
    private $filetype;
    private $invoice;


    /**
     * pdfArchive constructor.
     * @param $id
     * @param $type
     * @param $file
     * @param $filetype
     */
    public function __construct($id, $type, $file, $filetype, $invoice)
    {
        $this->id = $id;
        $this->type = $type;
        $this->file = $file;
        $this->filetype = $filetype;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getFiletype()
    {
        return $this->filetype;
    }

    /**
     * @param mixed $filetype
     */
    public function setFiletype($filetype)
    {
        $this->filetype = $filetype;
    }

    /**
     * @return mixed
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * @param mixed $invoice
     */
    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;
    }

    public function listObject()
    {
        $return = '
        <h6>' . $this->getInvoice() . '</h6>
        <p>File: ' . $this->getFile() . 'Filetype: ' . $this->getFiletype(). 'Typ: ' . $this->getType().'
        <a href="">bearbeiten</a> | <a href="">löschen</a>
        </p>        
        ';

        return $return;
    }

    public static function getDropdown($pdfArchive)
    {
        $content = "
        <select class='dropdown' name=\"PDFArchive\">
        <option selected value=\"null\">&nbsp;</option> ";

        foreach ($pdfArchive as $p)
        {
            $content .= "<option value=\"" . $p->getId() . "\">" . $p->getFile() . "</option>\n";
        }

        $content .= "</select>";

        return $content;
    }

}