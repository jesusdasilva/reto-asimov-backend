<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


/**
 * Reservation
 *
 * @ORM\Table(name="reservation", uniqueConstraints={@ORM\UniqueConstraint(name="reservation_un", columns={"r_email", "r_date"})}, indexes={@ORM\Index(name="reservation_r_date_idx", columns={"r_date"})})
 * @ORM\Entity
 */
#[ApiResource(collectionOperations:['get','post'], itemOperations: ['get'], normalizationContext: ['groups' => ['full']], attributes: ['pagination_enabled' => false, 'route_prefix' => '/v1'])]
#[ApiFilter(SearchFilter::class, properties: ['rEmail' => 'exact', 'rDate' => 'exact', 'rTime' => 'exact'])]
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="r_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"full"})
     */
    private $rId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="r_first_name", type="string", nullable=true)
     * @Groups({"full"})
     */
    private $rFirstName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="r_last_name", type="string", nullable=true)
     * @Groups({"full"})
     */
    private $rLastName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="r_phone", type="string", nullable=true)
     * @Groups({"full"})
     */
    private $rPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="r_email", type="string", nullable=false)
     * @Groups({"full"})
     */
    private $rEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="r_hour", type="string", nullable=false)
     * @Groups({"full"})
     */
    private $rHour;

    /**
     * @var string
     *
     * @ORM\Column(name="r_date", type="string", nullable=false)
     * @Groups({"full"})
     */
    private $rDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="r_created_at", type="datetime", nullable=true, insertable=false, updatable=false, generated="ALWAYS"))
     * @Groups({"full"})
     */
    private $rCreatedAt;

    public function getRId(): ?string
    {
        return $this->rId;
    }

    public function getRFirstName(): ?string
    {
        return $this->rFirstName;
    }

    public function setRFirstName(?string $rFirstName): self
    {
        $this->rFirstName = $rFirstName;

        return $this;
    }

    public function getRLastName(): ?string
    {
        return $this->rLastName;
    }

    public function setRLastName(?string $rLastName): self
    {
        $this->rLastName = $rLastName;

        return $this;
    }

    public function getRPhone(): ?string
    {
        return $this->rPhone;
    }

    public function setRPhone(?string $rPhone): self
    {
        $this->rPhone = $rPhone;

        return $this;
    }

    public function getREmail(): ?string
    {
        return $this->rEmail;
    }

    public function setREmail(string $rEmail): self
    {
        $this->rEmail = $rEmail;

        return $this;
    }

    public function getRHour(): ?string
    {
        return $this->rHour;
    }

    public function setRHour(string $rHour): self
    {
        $this->rHour = $rHour;

        return $this;
    }

    public function getRDate(): ?string
    {
        return $this->rDate;
    }

    public function setRDate(string $rDate): self
    {
        $this->rDate = $rDate;

        return $this;
    }

    public function getRCreatedAt(): ?\DateTimeInterface
    {
        return $this->rCreatedAt;
    }

    public function setRCreatedAt(?\DateTimeInterface $rCreatedAt): self
    {
        $this->rCreatedAt = $rCreatedAt;

        return $this;
    }


}
