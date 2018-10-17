<?php
// src/Entity/User.php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 *
 * @UniqueEntity(
 *     fields="email",
 *     message="This email is already used, please try another one.",
 *     repositoryMethod="findByIncludeSoftDeleteable",
 *     groups={"register", "admin"}
 * )

 * @ExclusionPolicy("all")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Expose
     */
    protected $id;

    /**
     * @var string
     *
     * @Expose
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255, nullable=true)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     *
     * @Expose
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255, nullable=true)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 40,
     *      minMessage = "Your last name must be at least {{ limit }} characters long",
     *      maxMessage = "Your last name cannot be longer than {{ limit }} characters"
     * )
     *
     * @Expose
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 40,
     *      minMessage = "Address must be at least {{ limit }} characters long",
     *      maxMessage = "Address cannot be longer than {{ limit }} characters"
     * )
     *
     * @Expose
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="postalCode", type="string", length=255, nullable=true)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "Postal code must be at least {{ limit }} characters long",
     *      maxMessage = "Postal code cannot be longer than {{ limit }} characters"
     * )
     *
     * @Expose
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "City must be at least {{ limit }} characters long",
     *      maxMessage = "City cannot be longer than {{ limit }} characters"
     * )
     *
     * @Expose
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     *
     * @Expose
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Phone must be at least {{ limit }} characters long",
     *      maxMessage = "Phone cannot be longer than {{ limit }} characters"
     * )
     *
     * @Expose
     */
    private $phone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     *
     * @Expose
     */
    private $birthday;

    /**
     * @var int
     *
     * @ORM\Column(name="gender", type="smallint")
     *
     * @Expose
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     *
     * @Assert\Url
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Social links must be at least {{ limit }} characters long",
     *      maxMessage = "Social links cannot be longer than {{ limit }} characters"
     * )
     *
     * @Expose
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     *
     * @Assert\Url
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Social links must be at least {{ limit }} characters long",
     *      maxMessage = "Social links cannot be longer than {{ limit }} characters"
     * )
     *
     * @Expose
     */
    private $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     *
     * @Assert\Url
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Social links must be at least {{ limit }} characters long",
     *      maxMessage = "Social links cannot be longer than {{ limit }} characters"
     * )
     *
     * @Expose
     */
    private $twitter;

    /**
     * @var string
     *
     * @Assert\NotBlank(
     *      groups={"register"}
     * )
     * @Assert\Length(
     *      min = 6,
     *      max = 50,
     *      minMessage = "Your password must be at least {{ limit }} characters long",
     *      maxMessage = "Your password cannot be longer than {{ limit }} characters",
     *      groups={"register"}
     * )
     *
     */
    protected $plainPassword;

    /**
     * @ORM\Column(name="about", type="text", nullable=true)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 1000,
     *      minMessage = "About must be at least {{ limit }} characters long",
     *      maxMessage = "About cannot be longer than {{ limit }} characters"
     * )
     *
     * @Expose
     */
    private $about;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"firstName", "lastName"})
     * @ORM\Column(length=128, unique=true, nullable=true)
     *
     * @Expose
     */
    protected $slug;

    public function __construct()
    {
        parent::__construct();

        $this->gender = 0;

    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     *
     * @return User
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return User
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
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return User
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

    /**
     * Set gender
     *
     * @param integer $gender
     *
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return int
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return $this
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     *
     * @return $this
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     *
     * @return $this
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Override email setter to automatically set username same as email.
     *
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        parent::setEmail($email);
        $this->setUsername($email);

        return $this;
    }

    /**
     * Check if user is enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
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
     * Set about
     *
     * @param string $about
     * @return User
     */
    public function setAbout($about)
    {
        $this->about = $about;
        return $this;
    }

    /**
     * Get about
     *
     * @return string
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Return string casting of user.
     *
     * @return string
     */
    public function __toString() {
        return $this->username;
    }

    /**
     * Get full name
     *
     * @return string
     */
    public function getFullName()
    {
        $fullName = $this->firstName;

        if ($this->lastName) {
            $fullName = $fullName . ' ' . $this->lastName;
        }

        return $fullName;
    }

}