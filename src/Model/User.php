<?php

namespace App\Model;

class User {
    private string $titre;
    private string $auteur;
    private bool $disponible;

    public function __construct($titre, $auteur, $disponible)
    {
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->disponible = $disponible;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function getAuteur(): string
    {
        return $this->auteur;
    }

    public function getDisponible(): string
    {
        return $this->disponible;
    }

    public function setTitre($titre): self
    {
      return $this->titre = $titre;
    }

    public function setAuteur($auteur): self
    {
        return $this->auteur = $auteur;
    }

    public function setDisponible($disponible): self
    {
        return $this->disponible = $disponible;
    }

    public function take()
    {
        return $this->disponible = false;
    }

    public static function fromArray(array $data): self
    {
        return new static($data['title'], $data['author'], $data['available']);
    }
}
?>