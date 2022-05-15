<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", uniqueConstraints={@ORM\UniqueConstraint(name="reservation_un2", columns={"r_email", "r_hour", "r_day", "r_month", "r_year"}), @ORM\UniqueConstraint(name="reservation_un", columns={"r_hour", "r_day", "r_month", "r_year"})})
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
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
    #[Assert\Type('string', message: "El campo sólo acepta caracteres alfanuméricos")]
    #[Assert\NotBlank(message: "El campo es obligatorio")]
    #[Assert\NotNull(message: "El campo es obligatorio")]
    private $rFirstName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="r_last_name", type="string", nullable=true)
     * @Groups({"full"})
     */
    #[Assert\Type('string', message: "El campo sólo acepta caracteres alfanuméricos")]
    private $rLastName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="r_phone", type="string", nullable=true)
     * @Groups({"full"})
     */
    #[Assert\Type('string', message: "El campo sólo acepta caracteres alfanuméricos")]
    private $rPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="r_email", type="string", nullable=false)
     * @Groups({"full"})
     */
    #[Assert\Email(message: 'El Email {{ value }} no es válido.')]
    #[Assert\NotBlank(message: "El campo es obligatorio")]
    #[Assert\NotNull(message: "El campo es obligatorio")]
    private $rEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="r_hour", type="string", nullable=false)
     * @Groups({"full"})
     */
    #[Assert\Type('string', message: "El campo sólo acepta caracteres alfanuméricos")]
    #[Assert\NotBlank(message: "El campo es obligatorio")]
    #[Assert\NotNull(message: "El campo es obligatorio")]
    private $rHour;

    /**
     * @var string
     *
     * @ORM\Column(name="r_day", type="string", nullable=false)
     * @Groups({"full"})
     */
    #[Assert\Type('string', message: "El campo sólo acepta caracteres alfanuméricos")]
    #[Assert\NotBlank(message: "El campo es obligatorio")]
    #[Assert\NotNull(message: "El campo es obligatorio")]
    private $rDay;

    /**
     * @var string
     *
     * @ORM\Column(name="r_month", type="string", nullable=false)
     * @Groups({"full"})
     */
    #[Assert\Type('string', message: "El campo sólo acepta caracteres alfanuméricos")]
    #[Assert\NotBlank(message: "El campo es obligatorio")]
    #[Assert\NotNull(message: "El campo es obligatorio")]
    private $rMonth;

    /**
     * @var string
     *
     * @ORM\Column(name="r_year", type="string", nullable=false)
     * @Groups({"full"})
     */
    #[Assert\Type('string', message: "El campo sólo acepta caracteres alfanuméricos")]
    #[Assert\NotBlank(message: "El campo es obligatorio")]
    #[Assert\NotNull(message: "El campo es obligatorio")]
    private $rYear;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true, insertable=false, updatable=false, generated="ALWAYS")
     * @Groups({"full"})
     */
    private $createdAt;

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

    public function getRDay(): ?string
    {
        return $this->rDay;
    }

    public function setRDay(string $rDay): self
    {
        $this->rDay = $rDay;

        return $this;
    }

    public function getRMonth(): ?string
    {
        return $this->rMonth;
    }

    public function setRMonth(string $rMonth): self
    {
        $this->rMonth = $rMonth;

        return $this;
    }

    public function getRYear(): ?string
    {
        return $this->rYear;
    }

    public function setRYear(string $rYear): self
    {
        $this->rYear = $rYear;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }


}
