<?php

namespace Sample\Domain\Product;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

class Product
{
    /**
     * @var Uuid
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 100,
     *      minMessage = "product.description.min_length"
     * )
     */
    private $description;

    /**
     * @var float
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="float", message="product.price")
     */
    private $price;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @param string $name
     * @param float  $price
     * @param string $description
     */
    public function __construct(
        string $name,
        ? float $price,
        string $description
    ) {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->createdAt = new \DateTime();
    }

    /**
     * Get id.
     *
     * @return Uuid
     */
    public function getId() : Uuid
    {
        return $this->id;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Get price.
     *
     * @return float
     */
    public function getPrice() : float
    {
        return $this->price;
    }

    /**
     * Gets the value of createdAt.
     *
     * @return \DateTime $created
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }
}
