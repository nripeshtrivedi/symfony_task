<?php

namespace Acme\TaskBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Acme\TaskBundle\Entity\Question_Answer
*
* @ORM\Entity
* @ORM\Table(name="Questionstore")
*/
class Questionstore
{
/**

     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
public $qid;
/**
* @ORM\Column(type="string", length=200)
*/
public $q_name;
/**
     * @ORM\Column(type="string", length=60)
     */

public $option_1;
/**
     * @ORM\Column(type="string", length=60)
     */
public $option_2;
/**
     * @ORM\Column(type="string", length=60)
     */
public $option_3;
/**
     * @ORM\Column(type="string", length=60)
     */
public $option_4;
/**
     * @ORM\Column(type="string", length=60)
     */
public $option_5;
/**
     * @ORM\Column(type="string", length=60)
     */
public $option_6;

    /**
     * Get qid
     *
     * @return integer 
     */
    public function getQid()
    {
        return $this->qid;
    }

    /**
     * Set q_name
     *
     * @param string $qName
     * @return Questionstore
     */
    public function setQName($qName)
    {
        $this->q_name = $qName;

        return $this;
    }

    /**
     * Get q_name
     *
     * @return string 
     */
    public function getQName()
    {
        return $this->q_name;
    }

    /**
     * Set option_1
     *
     * @param string $option1
     * @return Questionstore
     */
    public function setOption1($option1)
    {
        $this->option_1 = $option1;

        return $this;
    }

    /**
     * Get option_1
     *
     * @return string 
     */
    public function getOption1()
    {
        return $this->option_1;
    }

    /**
     * Set option_2
     *
     * @param string $option2
     * @return Questionstore
     */
    public function setOption2($option2)
    {
        $this->option_2 = $option2;

        return $this;
    }

    /**
     * Get option_2
     *
     * @return string 
     */
    public function getOption2()
    {
        return $this->option_2;
    }

    /**
     * Set option_3
     *
     * @param string $option3
     * @return Questionstore
     */
    public function setOption3($option3)
    {
        $this->option_3 = $option3;

        return $this;
    }

    /**
     * Get option_3
     *
     * @return string 
     */
    public function getOption3()
    {
        return $this->option_3;
    }

    /**
     * Set option_4
     *
     * @param string $option4
     * @return Questionstore
     */
    public function setOption4($option4)
    {
        $this->option_4 = $option4;

        return $this;
    }

    /**
     * Get option_4
     *
     * @return string 
     */
    public function getOption4()
    {
        return $this->option_4;
    }

    /**
     * Set option_5
     *
     * @param string $option5
     * @return Questionstore
     */
    public function setOption5($option5)
    {
        $this->option_5 = $option5;

        return $this;
    }

    /**
     * Get option_5
     *
     * @return string 
     */
    public function getOption5()
    {
        return $this->option_5;
    }

    /**
     * Set option_6
     *
     * @param string $option6
     * @return Questionstore
     */
    public function setOption6($option6)
    {
        $this->option_6 = $option6;

        return $this;
    }

    /**
     * Get option_6
     *
     * @return string 
     */
    public function getOption6()
    {
        return $this->option_6;
    }
}
