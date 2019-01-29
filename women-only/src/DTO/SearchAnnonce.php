<?php 

//Permet de savoir ou se trouve la class
namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class SearchAnnonce
{

    /**
     * @Assert\Length(max="255")
     * @var string
     */
    public $title;

    /**
     * @Assert\DateTime()
     * @var \DateTimeImmutable
     */
    public $arrivalDate;

    /**
     * @Assert\DateTime()
     * @var \DateTimeImmutable
     */
    public $startdate;

    /**
     * @Assert\Length(max="255")
     * @var string
     */
    public $startplace;

    /**
     * @Assert\Length(max="255")
     * @var string
     */
    public $placearrived;

}