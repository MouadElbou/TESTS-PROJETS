<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



#[ORM\Entity(repositoryClass: ArticlesRepository::class)]

#[Vich\Uploadable]
class Articles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $color = null;

    #[ORM\Column(length: 255)]
    private ?string $size = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imagpath = null;

    #[Vich\UploadableField(mapping: 'img', fileNameProperty: 'imagpath')]
    private $imageFile = null;

    
    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?Categori $Cat = null;

    public function getUrl(): ?string
    {
        return sprintf('/uploads/images/%s', $this->imagpath);
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getImagpath(): ?string
    {
        return $this->imagpath;
    }

    public function setImagpath(?string $imagpath): self
    {
        $this->imagpath = $imagpath;

        return $this;
    }

    public function getCat(): ?Categori
    {
        return $this->Cat;
    }

    public function setCat(?Categori $Cat): self
    {
        $this->Cat = $Cat;

        return $this;
    }


    

    public function getImageFile(): ?File
    {

        return $this->imageFile;
    }



    public function setImageFile(?File $imageFile = null)
    {

        $this->imageFile = $imageFile;
        

    }

}
