<?php

namespace NT\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="NT\PlatformBundle\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date")
     */
    private $birthday;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="visit_day", type="datetime")
     */
    private $visitDay;
    
    /**
     * @var boolean
     * @ORM\Column(name="discount", type="boolean")
     */
    private $discount;
            
    /**
     * @var boolean
     * @ORM\Column(name="half_day", type="boolean")
     */
    private $halfDay;
    
    /**
    * @ORM\ManyToOne(targetEntity="NT\PlatformBundle\Entity\Tarif", inversedBy="ticket")
    * @ORM\JoinColumn(nullable=false)
    */
    private $tarif;
    
    /**
    * @ORM\ManyToOne(targetEntity="NT\PlatformBundle\Entity\Command", inversedBy="tickets", cascade={"persist"})
    * @ORM\JoinColumn(nullable=false)
    */
    private $command;
     
    public function __construct()
    {
//        $this->resaDate = new \DateTime('Europe/Paris');
    }
    
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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Ticket
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Ticket
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }
    
    public function getFullName()
    {
        return $this->getFirstname().' '.$this->getLastname();
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Ticket
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return Ticket
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    public function getAge()
    {   
        // calcul de l'age
        return $age;
    }
    
    /**
     * Set visitDay
     *
     * @param \DateTime $visitDay
     *
     * @return Ticket
     */
    public function setVisitDay($visitDay)
    {
        $this->visitDay = $visitDay;

        return $this;
    }

    /**
     * Get visitDay
     *
     * @return \DateTime
     */
    public function getVisitDay()
    {
        return $this->visitDay;
    }

    /**
     * Set tarif
     *
     * @param \NT\PlatformBundle\Entity\Tarif $tarif
     *
     * @return Ticket
     */
    public function setTarif(\NT\PlatformBundle\Entity\Tarif $tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return \NT\PlatformBundle\Entity\Tarif
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set command
     *
     * @param \NT\PlatformBundle\Entity\Command $command
     *
     * @return Ticket
     */
    public function setCommand(\NT\PlatformBundle\Entity\Command $command)
    {
        $this->command = $command;
        return $this;
    }

    /**
     * Get command
     *
     * @return \NT\PlatformBundle\Entity\Command
     */
    public function getCommand()
    {
        return $this->command;
    }
    
//    public function __toString()
//    {
//        return $this->setCommand();
//    }
    
     /**
     * Constructor
     */
//    public function __construct()
//    {
//        $this->command = new Command($id);
//    }
    
     /**
     * Constructor
     */
//    public function __construct()
//    {
//        $this->command = new \NT\PlatformBundle\Entity\Command();
//    }

    /**
     * Set discount
     *
     * @param boolean $discount
     *
     * @return Ticket
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return boolean
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set halfDay
     *
     * @param boolean $halfDay
     *
     * @return Ticket
     */
    public function setHalfDay($halfDay)
    {
        $this->halfDay = $halfDay;

        return $this;
    }

    /**
     * Get halfDay
     *
     * @return boolean
     */
    public function getHalfDay()
    {
        return $this->halfDay;
    }

}
