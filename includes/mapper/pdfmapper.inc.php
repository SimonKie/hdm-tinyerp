<?php
/**
 * Created by PhpStorm.
 * User: Elli
 * Date: 8/31/2016
 * Time: 1:11 PM
 */

require_once ('datamapper.inc.php');

class PdfArchiveMapper extends DataMapper{

    public static function add($pdfArchive){
        $st = self::$db->prepare("
        INSERT INTO PDFArchive SET 
        Type = :Type,
        Filetype = :Filetyp,
        File = :File
        ");

        $st->execute(array(
            ':Type' => $pdfArchive->getType(),
            ':Filetype' => $pdfArchive->getFiletype(),
            ':File' => $pdfArchive->getFile()
        ));

        return self::$db->lastInsertId();
    }

    public static function delete($pdfArchive)
    {
        self::$db->query("DELETE FROM PDFArchive WHERE ID=" . $pdfArchive->getId());
    }

    public static function findById($id)
    {
        $query = self::$db->query("SELECT * FROM PDFArchive WHERE ID=" . $id);

        if($e = $query->fetch(PDO::FETCH_OBJ))
        {
            $PdfArchive = new PdfArchive();
            $PdfArchive->setId(intval($e->ID));
            $PdfArchive->setFile($e->File);
            $PdfArchive->setFiletype($e->Filetype);
            $PdfArchive->setType($e->Type);

            return $PdfArchive;
        } else
        {
            return null;
        }
    }


    public static function getAllPdfArchives()
    {
        $query = self::$db->query("SELECT * FROM PDFArchive");

        $pdfArchives = array();

        while($e = $query->fetch(PDO::FETCH_OBJ))
        {
            $PdfArchive = new PdfArchive();
            $PdfArchive->setId(intval($e->ID));
            $PdfArchive->setFiletype($e->Filetype);
            $PdfArchive->setFile($e->File);
            $PdfArchive->setType($e->Type);

            $pdfArchives[] = $PdfArchive;
        }

        if($query->rowCount() == 0)
            return null;
        else
            return $pdfArchives;
    }

    public static function update($pdfArchive)
    {
        $st = self::$db->prepare("
        UPDATE PDFArchive SET 
        Filetype = :Filetype,
        File = :File,
        Type = :Type        
        WHERE ID= :id
        ");

        $st->execute(array(
            ':Filetype' => $pdfArchive->getFiletype(),
            ':File' => $pdfArchive->getFile(),
            ':Typ' => $pdfArchive->getFile(),
            ':id' => $pdfArchive->getId()
        ));
    }
}