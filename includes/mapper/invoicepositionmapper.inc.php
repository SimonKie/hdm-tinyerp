<?php
/**
 * Created by PhpStorm.
 * User: Simon
 * Date: 31.08.2016
 * Time: 12:16
 */

require_once('dataMapper.inc.php');

class InvoicePositionMapper extends DataMapper
{
    public static function add($invoicePosition){
        $st = self::$db->prepare("
        INSERT INTO InvoicePosition SET 
        Invoice_ID = :Invoice_ID,
        Product_ID = :Product_ID,
        Price = :Price,
        Qty = :Qty,
        Sort = :Sort
        ");

        $st->execute(array(
            ':Invoice_ID' => $invoicePosition->getInvoice()->getId(),
            ':Product_ID' => $invoicePosition->getProduct()->getId(),
            ':Price' => $invoicePosition->getPrice(),
            ':Qty' => $invoicePosition->getQty(),
            ':Sort' => $invoicePosition->getSort(),
        ));

        return self::$db->lastInsertId();
    }

    // this should only work until the invoice is fakturiert oder? 
    public static function delete($invoicePosition)
    {
        self::$db->query("DELETE FROM InvoicePosition WHERE Invoice_ID=" . $invoicePosition->getInvoice()->getId() 
        . " AND Product_ID=" . $invoicePosition->getProduct()->getId());
    }

    /*
        proposal: you enter a invoice id, which returns an array 
        of all positions used in that invoice. otherwise you only get one
        position at a time and you also need to know all the product id's somehow  
        therefore would call it findByInvoiceId()
        Simon
    */
    public static function findByInvoiceId($invoiceId)
    {
        $query = self::$db->query("SELECT * FROM InvoicePosition WHERE Invoice_ID=" . $invoiceId);

        if($e = $query->fetch(PDO::FETCH_OBJ))
        {
            $invoicePositions = array();
            $counter = 0;

            while($e = $query->fetch(PDO::FETCH_OBJ)) {
                $invoicePositions[$counter] = new InvoicePosition();
                $invoicePositions[$counter]->setInvoice(Invoice::getById(intval($e->Invoice_ID)));
                $invoicePositions[$counter]->setInvoice(Product::getById(intval($e->Product_ID)));
                $invoicePositions[$counter]->setSort($e->Sort);
                $invoicePositions[$counter]->setPrice($e->Price);
                $invoicePositions[$counter++]->setQty($e->Qty);
            }
            return $invoicePositions;
        } else
        {
            return null;
        }
    }

    public static function update($invoicePosition)
    {
        $st = self::$db->prepare("
        UPDATE Company SET 
        Price = :Price,
        Qty = :Qty,
        Sort = :Sort
        WHERE Invoice_ID = :Invoice_ID
        AND Product_ID = :Product_ID
        ");

        $st->execute(array(
            ':Price' => $invoicePosition->getPrice(),
            ':Qty' => $invoicePosition->getQty(),
            ':Sort' => $invoicePosition->getSort(),
        ));
    }


}