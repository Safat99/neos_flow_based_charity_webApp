<?php
namespace SincNovation\Charity\Domain\Model;

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @Flow\Entity
 * @ORM\Table(name="charity_donation")
 */
class Donation
{
    /**
     * @var int
     * @Flow\Identity
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @var DateTime
     */
    protected $date;

    /**
     * @ORM\ManyToOne(targetEntity="SincNovation\Charity\Domain\Model\Organization")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id", nullable=false)
     * @var Organization
     */
    protected $organization;

    /**
     * @ORM\ManyToOne(targetEntity="SincNovation\Charity\Domain\Model\DonationCode")
     * @ORM\JoinColumn(name="donation_code_id", referencedColumnName="id", nullable=false)
     * @var DonationCode
     */
    protected $donationCode;

    /**
     * Get the ID of the donation.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the date of the donation.
     *
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * Set the date of the donation.
     *
     * @param DateTime $date
     */
    public function setDate(DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * Get the organization associated with the donation.
     *
     * @return Organization
     */
    public function getOrganization(): Organization
    {
        return $this->organization;
    }

    /**
     * Set the organization associated with the donation.
     *
     * @param Organization $organization
     */
    public function setOrganization(Organization $organization): void
    {
        $this->organization = $organization;
    }

    /**
     * Get the donation code associated with the donation.
     *
     * @return DonationCode
     */
    public function getDonationCode(): DonationCode
    {
        return $this->donationCode;
    }

    /**
     * Set the donation code associated with the donation.
     *
     * @param DonationCode $donationCode
     */
    public function setDonationCode(DonationCode $donationCode): void
    {
        $this->donationCode = $donationCode;
    }
}
