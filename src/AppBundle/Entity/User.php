<?php
namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * User
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @UniqueEntity("id",message="This ID is already Used , ID most be Unique")
 * @UniqueEntity("email",message="This Email Address is already used")
 */
class User extends BaseUser
{
/**
* @ORM\Id
* @ORM\Column(type="integer")
* @ORM\GeneratedValue(strategy="AUTO")
*/
    protected $id;
    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     * @Assert\Length(
     *     min= "3",
     *     max= "15",
     *     minMessage = "First Name must be at least {{ limit }} characters long",
     *     maxMessage = "First Name  cannot be longer than {{ limit }} characters"
     * )
     * @Assert\Type(type="alpha",message="First Name Most contain only characters")
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     * @Assert\Length(
     *     min= "3",
     *     max= "15",
     *     minMessage = "Last Name must be at least {{ limit }} characters long",
     *     maxMessage = "Last Name  cannot be longer than {{ limit }} characters"
     * )
     * @Assert\Type(type="alpha",message="Last Name Most contain only characters")
     */
    private $lastName;
    /**
     * @var string
     *
     * @ORM\Column(name="userType", type="string", length=255, nullable=true)
     * @Assert\Choice({"Administrator" ,"Responsable Etudiant", "Responsable enseignant","Responsable parent","User","Etudiant","Teacher"},message="Please Select a valid User Type")
     */
    private $userType;
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
     * Set userType
     *
     * @param string $userType
     *
     * @return User
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;

        return $this;
    }

    /**
     * Get userType
     *
     * @return string
     */
    public function getUserType()
    {
        return $this->userType;
    }




public function __construct()
{
parent::__construct();
// your own logic
}
}