<?php

namespace App\Entity;

use App\Form\InputType;
use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProviderRepository")
 * @Vich\Uploadable
 */
class Provider
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=80, nullable=false)
     * @Assert\NotBlank(message="Vous avez oublié le nom ")
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=80, unique=true)
     */
    private $slug;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $street_name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $street_nr;

    /**
     * @var  string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $email;

    /**
     *
     * @ORM\OneToOne(targetEntity="App\Entity\City")
     */
    private $city;

    /**
     * @var ArrayCollection $input
     * @ORM\OneToMany(targetEntity="App\Entity\Input", mappedBy="provider")
     */
    private $inputs;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="image_provider", fileNameProperty="image")
     *
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $image;


    /**
     * Provider constructor.
     */

    public function __construct()
    {
        $this->input = new ArrayCollection();
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getStreetName()
    {
        return $this->street_name;
    }

    /**
     * @param string $street_name
     */
    public function setStreetName($street_name)
    {
        $this->street_name = $street_name;
    }

    /**
     * @return string
     */
    public function getStreetNr()
    {
        return $this->street_nr;
    }

    /**
     * @param string $street_nr
     */
    public function setStreetNr($street_nr)
    {
        $this->street_nr = $street_nr;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return ArrayCollection
     */
    public function getInputs(): ArrayCollection
    {
        return $this->inputs;
    }

    /**
     * @param ArrayCollection $inputs
     */
    public function setInputs(ArrayCollection $inputs): void
    {
        $this->inputs = $inputs;
    }



    /**
     * @return Input
     */
    public function getInput(): Input
    {
        return $this->input;
    }

    /**
     * @param mixed $input
     */
    public function addInput($input)
    {
        $this->input->add($input);
        $input->setProvider($this);
    }

    /**
     * @param mixed $input
     */
    public function removeInput($input)
    {
        $this->input->removeElement($input);
        $input->setProvider(null);
    }

    /**
     * @return DateTime
     */
    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * @param DateTime $created
     */
    public function setCreated(DateTime $created): void
    {
        $this->created = $created;
    }

    /**
     * @return DateTime
     */
    public function getUpdated(): DateTime
    {
        return $this->updated;
    }

    /**
     * @param DateTime $updated
     */
    public function setUpdated(DateTime $updated): void
    {
        $this->updated = $updated;
    }

    /**
     * @return mixed
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param mixed $imageFile
     */
    public function setImageFile($imageFile): void
    {
        $this->imageFile = $imageFile;
    }

    /**
     * @return string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }



    public function __toString()
    {
        return $this->name;
    }

//    /**
//     * @Assert\Callback
//     */
//    public function validate(ExecutionContextInterface $context)
//    {
//        if (! in_array($this->imageFile->getMimeType(), array(
//            'image/jpeg',
//            'image/gif',
//            'image/png'
//        ))) {
//            $context
//                ->buildViolation('Wrong file type (jpg,gif,png)')
//                ->atPath('fileName')
//                ->addViolation()
//            ;
//        }
//    }
}
