<?php
// src/AppBundle/Entity/User.php

namespace ProjektBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 */
class User extends BaseUser
{

    /**
     * @var int
     */
    protected $id;

    private $projekts;

     /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

}