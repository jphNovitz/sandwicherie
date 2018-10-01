<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="ImagesproductRepository")
 * @Vich\Uploadable
 */
class Invoice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\File()
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Input", inversedBy="invoices")
     * @ORM\JoinColumn(nullable=true)
     */
    private $input;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="input", fileNameProperty="invoiceName")
     *
     * @var File
     */
    private $invoiceFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $invoiceName;


    public function __construct()
    {

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
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return File
     */
    public function getInvoiceFile(): File
    {
        return $this->invoiceFile;
    }

    /**
     * @param File $invoiceFile
     */
    public function setInvoiceFile(File $invoiceFile): void
    {
        $this->invoiceFile = $invoiceFile;
    }

    /**
     * @return string
     */
    public function getInvoiceName(): string
    {
        return $this->invoiceName;
    }

    /**
     * @param string $invoiceName
     */
    public function setInvoiceName(string $invoiceName): void
    {
        $this->invoiceName = $invoiceName;
    }

    /**
     * @return mixed
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * @param mixed $input
     */
    public function setInput($input): void
    {
        $this->input = $input;
    }



}
