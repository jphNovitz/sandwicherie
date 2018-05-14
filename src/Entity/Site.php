<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Site
 * No link to database
 */
class Site
{
    /**
     * @var String
     */
    private $title;

    /**
     * @var String
     */
    private $subTitle;

    /**
     * @var String
     */
    private $introduction;

    /**
     * @var String
     */
    private $adress;

    /**
     * @var String
     */
    private $city;

    /**
     * @var String
     */
    private $phone;

    /**
     * @var String
     */
    private $tva;

    /**
     * @var String
     */
    private $SocialFacebook;

    /**
     * @var String
     */
    private $SocialInstagram;

    /**
     * @return String
     */
    public function getTitle(): ?String
    {
        return $this->title;
    }

    /**
     * @param String $title
     */
    public function setTitle(String $title): void
    {
        $this->title = $title;
    }

    /**
     * @return String
     */
    public function getSubTitle(): ?String
    {
        return $this->subTitle;
    }

    /**
     * @param String $subTitle
     */
    public function setSubTitle(String $subTitle): void
    {
        $this->subTitle = $subTitle;
    }

    /**
     * @return String
     */
    public function getIntroduction(): ?String
    {
        return $this->introduction;
    }

    /**
     * @param String $introduction
     */
    public function setIntroduction(String $introduction): void
    {
        $this->introduction = $introduction;
    }



    /**
     * @return String
     */
    public function getAdress(): ?String
    {
        return $this->adress;
    }

    /**
     * @param String $adress
     */
    public function setAdress(String $adress): void
    {
        $this->adress = $adress;
    }

    /**
     * @return String
     */
    public function getCity(): ?String
    {
        return $this->city;
    }

    /**
     * @param String $city
     */
    public function setCity(String $city): void
    {
        $this->city = $city;
    }



    /**
     * @return String
     */
    public function getPhone(): ?String
    {
        return $this->phone;
    }

    /**
     * @param String $phone
     */
    public function setPhone(String $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return String
     */
    public function getTva(): ?String
    {
        return $this->tva;
    }

    /**
     * @param String $tva
     */
    public function setTva(String $tva): void
    {
        $this->tva = $tva;
    }

    /**
     * @return String
     */
    public function getSocialFacebook(): ?String
    {
        return $this->SocialFacebook;
    }

    /**
     * @param String $SocialFacebook
     */
    public function setSocialFacebook(String $SocialFacebook): void
    {
        $this->SocialFacebook = $SocialFacebook;
    }

    /**
     * @return String
     */
    public function getSocialInstagram(): ?String
    {
        return $this->SocialInstagram;
    }

    /**
     * @param String $SocialInstagram
     */
    public function setSocialInstagram(String $SocialInstagram): void
    {
        $this->SocialInstagram = $SocialInstagram;
    }



}
