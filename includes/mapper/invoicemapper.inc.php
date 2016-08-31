<?php

/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 8/31/2016
 * Time: 12:16 PM
 */

require_once ('datamapper.inc.php');

class InvoiceMapper extends DataMapper
{
    public static function add($invoice){
        $st = self::$db->prepare("
        INSERT INTO Invoice SET 
        InvoiceNr = :InvoiceNr,
        Date = :Date,
        State = :State,
        Text = :Text
        ");

        $st->execute(array(
            ':InvoiceNr' => $invoice->getInvoiceNr(),
            ':Date' => $invoice->getDate(),
            ':State' => $invoice->getSate(),
            ':Text' => $invoice->getText()
        ));

        return self::$db->lastInsertId();
    }

    public static function delete($invoice)
    {
        self::$db->query("DELETE FROM Invoice WHERE ID=" . $invoice->getId());
    }

    public static function findById($id)
    {
        $query = self::$db->query("SELECT * FROM Invoice WHERE ID=" . $id);

        if($e = $query->fetch(PDO::FETCH_OBJ))
        {
            $Invoice = new Invoice();
            $Invoice->setId(intval($e->ID));
            $Invoice->setInvoiceNr($e->InvoiceNr);
            $Invoice->setDate(date($e->InvoiceNr));
            $Invoice->setState($e->State);
            $Invoice->setText($e->Text);

            return $Invoice;
        } else
        {
            return null;
        }
    }


    public static function getAllInvoices()
    {
        $query = self::$db->query("SELECT * FROM Invoice");

        $invoices = array();

        while($e = $query->fetch(PDO::FETCH_OBJ))
        {
            $Invoice = new Invoice();
            $Invoice->setId(intval($e->ID));
            $Invoice->setInvoiceNr($e->InvoiceNr);
            $Invoice->setDate(date($e->InvoiceNr));
            $Invoice->setState($e->State);
            $Invoice->setText($e->Text);

            $invoices[] = $Invoice;
        }

        if($query->rowCount() == 0)
            return null;
        else
            return $invoices;
    }

    public static function update($invoice)
    {
        $st = self::$db->prepare("
        UPDATE Invoice SET 
        InvoiceNr = :InvoiceNr,
        Date = :Date,
        State = :State,
        Text = :Text
        WHERE ID= :id
        ");

        $st->execute(array(
            ':InvoiceNr' => $invoice->getInvoiceNr(),
            ':Date' => $invoice->getDate(),
            ':State' => $invoice->getSate(),
            ':Text' => $invoice->getText()
        ));
    }


}
    
    

