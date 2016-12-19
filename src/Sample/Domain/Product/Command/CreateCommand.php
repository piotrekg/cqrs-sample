<?php

namespace Sample\Domain\Product\Command;

use Ramsey\Uuid\Uuid;

class CreateCommand
{
    /**
     * @var Uuid
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @param Uuid      $id
     * @param string    $name
     * @param float     $price
     * @param string    $description
     * @param \DateTime $createdAt
     */
    public function __construct(
        Uuid $id,
        string $name,
        float $price,
        string $description,
        \DateTime $createdAt
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->createdAt = $createdAt;
    }

    /**
     * Gets the value of id.
     *
     * @return Uuid
     */
    public function getId() : Uuid
    {
        return $this->id;
    }

    /**
     * Gets the value of name.
     *
     * @return mixed
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Gets the value of price.
     *
     * @return mixed
     */
    public function getPrice() : float
    {
        return $this->price;
    }

    /**
     * Gets the value of description.
     *
     * @return mixed
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Gets the value of createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }
}
