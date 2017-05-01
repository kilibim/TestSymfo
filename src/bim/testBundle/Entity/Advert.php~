<?php

namespace bim\testBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
// N'oubliez pas ce use :
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Advert
 *
 * @ORM\Table(name="advert")
 * @ORM\Entity(repositoryClass="bim\testBundle\Repository\AdvertRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Advert
{
    /**
     * @ORM\OneToOne(targetEntity="bim\testBundle\Entity\image", cascade={"persist"})
     */
    private $image;

    /**
     * @ORM\Column(name="published", type="boolean")
     */
    private $published = true;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="bim\testBundle\Entity\Application" , mappedBy="Advert" , cascade={"persist"})
     */
    private $applications;

    /**
     * @ORM\OneToMany(targetEntity="bim\testBundle\Entity\AdvertSkill" , mappedBy="advert")
     */
    private $skills;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     * @Assert\NotBlank(message="Ce champ ne peut pas etre vide")
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @ORM\ManyToMany(targetEntity="bim\testBundle\Entity\Category", cascade={"persist"})
     */
    private $categories;
    /**
     * @var datetime
     * @ORM\Column(name="UpdateAd", type="datetime", nullable=true)
     */
    private $UpdateAd;


    /**
    * @Gedmo\Slug(fields={"title"})
    * @ORM\Column(name="slug", type="string", length=255, unique=true)
    */
    private $slug;
    
    public function __construct()
    {
        // Par défaut, la date de l'annonce est la date d'aujourd'hui
        $this->date = new \Datetime();
        $this->categories =new ArrayCollection();
        $this->applications =new ArrayCollection();
        $this->skills =new ArrayCollection();
    }

    /**
     * @ORM\PreUpdate
     */
    public function UpdateDate()
    {
        $this->setUpdatead(new \DateTime());
    }

    public function getId()
    {
        return $this->id;
    }

    public function addCategory(Category $category)
    {
        $this->categories[]=$category;
    }

    public function removeCategory(Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Advert
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Advert
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Advert
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Advert
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set published
     *
     * @param boolean $published
     *
     * @return Advert
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set image
     *
     * @param \bim\testBundle\Entity\image $image
     *
     * @return Advert
     */
    public function setImage(\bim\testBundle\Entity\image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \bim\testBundle\Entity\image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add application
     *
     * @param \bim\testBundle\Entity\Application $application
     *
     * @return Advert
     */
    public function addApplication(\bim\testBundle\Entity\Application $application)
    {
        $this->applications[] = $application;

        // On lie l'annonce à la candidature
        $application->setAdvert($this);

        return $this;
    }

    /**
     * Remove application
     *
     * @param \bim\testBundle\Entity\Application $application
     */
    public function removeApplication(\bim\testBundle\Entity\Application $application)
    {
        $this->applications->removeElement($application);
    }

    /**
     * Get applications
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getApplications()
    {
        return $this->applications;
    }

    /**
     * Set UpdateAd
     *
     * @param \DateTime $updatead
     *
     * @return Advert
     */
    public function setUpdatead($updatead)
    {
        $this->UpdateAd = $updatead;

        return $this;
    }

    /**
     * Get updatead
     *
     * @return \DateTime
     */
    public function getUpdatead()
    {
        return $this->UpdateAd;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Advert
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add skill
     *
     * @param \bim\testBundle\Entity\AdvertSkill $skill
     *
     * @return Advert
     */
    public function addSkill(\bim\testBundle\Entity\AdvertSkill $skill)
    {
        $this->skills[] = $skill;
        $skill->setAdvert(this);
        return $this;
    }

    /**
     * Remove skill
     *
     * @param \bim\testBundle\Entity\AdvertSkill $skill
     */
    public function removeSkill(\bim\testBundle\Entity\AdvertSkill $skill)
    {
        $this->skills->removeElement($skill);
    }

    /**
     * Get skills
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSkills()
    {
        return $this->skills;
    }
}
