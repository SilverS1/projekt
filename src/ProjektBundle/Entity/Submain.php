<?php

namespace ProjektBundle\Entity;

/**
 * Submain
 */
class Submain
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $images;

    /**
     * @var \DateTime
     */
    private $dueDate;

    /**
     * @var \DateTime
     */
    private $createdDate;

    /**
     * @var \DateTime
     */
    private $startDate;

    /**
     * @var int
     */
    private $mainId = null;

    /**
     * @var int
     */
    private $submainId = null;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Submain
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Submain
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set images
     *
     * @param string $images
     *
     * @return Submain
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get images
     *
     * @return string
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     *
     * @return Submain
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return Submain
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Submain
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set mainId
     *
     * @param integer $mainId
     *
     * @return Submain
     */
    public function setMainId($mainId)
    {
        $this->mainId = $mainId;

        return $this;
    }

    /**
     * Get mainId
     *
     * @return int
     */
    public function getMainId()
    {
        return $this->mainId;
    }

    /**
     * Set submainId
     *
     * @param integer $submainId
     *
     * @return Submain
     */
    public function setSubmainId($submainId)
    {
        $this->submainId = $submainId;

        return $this;
    }

    /**
     * Get submainId
     *
     * @return int
     */
    public function getSubmainId()
    {
        return $this->submainId;
    }
}

