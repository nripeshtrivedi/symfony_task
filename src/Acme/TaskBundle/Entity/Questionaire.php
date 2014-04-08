<?php

namespace Acme\TaskBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Acme\TaskBundle\Entity\Questionaire
*
* @ORM\Entity
* @ORM\Table(name="Questionaire")
*/
class Questionaire
{
/**

     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
private $sid;
// ...
/**
   * @ORM\Column(type="integer")
   */
 private $uid;
/**
     * @ORM\Column(type="string", length=60)
     */

public $q_1;
/**
     * @ORM\Column(type="string", length=60)
     */
public $q_2;
/**
     * @ORM\Column(type="string", length=60)
     */
public $q_3;
/**
     * @ORM\Column(type="string", length=60)
     */
public $q_4;
/**
     * @ORM\Column(type="string", length=60)
     */
public $q_5;
/**
     * @ORM\Column(type="string", length=60)
     */
public $q_6;


    /**
     * Get sid
     *
     * @return integer 
     */
    public function getSid()
    {
        return $this->sid;
    }

    /**
     * Set q_1
     *
     * @param string $q1
     * @return Questionaire
     */
    public function setQ1($q1)
    {
        $this->q_1 = $q1;

        return $this;
    }

    /**
     * Get q_1
     *
     * @return string 
     */
    public function getQ1()
    {
        return $this->q_1;
    }

    /**
     * Set q_2
     *
     * @param string $q2
     * @return Questionaire
     */
    public function setQ2($q2)
    {
        $this->q_2 = $q2;

        return $this;
    }

    /**
     * Get q_2
     *
     * @return string 
     */
    public function getQ2()
    {
        return $this->q_2;
    }

    /**
     * Set q_3
     *
     * @param string $q3
     * @return Questionaire
     */
    public function setQ3($q3)
    {
        $this->q_3 = $q3;

        return $this;
    }

    /**
     * Get q_3
     *
     * @return string 
     */
    public function getQ3()
    {
        return $this->q_3;
    }

    /**
     * Set q_4
     *
     * @param string $q4
     * @return Questionaire
     */
    public function setQ4($q4)
    {
        $this->q_4 = $q4;

        return $this;
    }

    /**
     * Get q_4
     *
     * @return string 
     */
    public function getQ4()
    {
        return $this->q_4;
    }

    /**
     * Set q_5
     *
     * @param string $q5
     * @return Questionaire
     */
    public function setQ5($q5)
    {
        $this->q_5 = $q5;

        return $this;
    }

    /**
     * Get q_5
     *
     * @return string 
     */
    public function getQ5()
    {
        return $this->q_5;
    }

    /**
     * Set q_6
     *
     * @param string $q6
     * @return Questionaire
     */
    public function setQ6($q6)
    {
        $this->q_6 = $q6;

        return $this;
    }

    /**
     * Get q_6
     *
     * @return string 
     */
    public function getQ6()
    {
        return $this->q_6;
    }

    /**
     * Set user
     *
     * @param \Acme\TaskBundle\Entity\user $user
     * @return Questionaire
     */
    public function setUser(\Acme\TaskBundle\Entity\user $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Acme\TaskBundle\Entity\user 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set uid
     *
     * @param integer $uid
     * @return Questionaire
     */
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Get uid
     *
     * @return integer 
     */
    public function getUid()
    {
        return $this->uid;
    }
}
