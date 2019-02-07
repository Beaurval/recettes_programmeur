<?php
/**
 * Created by PhpStorm.
 * User: Valentin Beaury
 * Date: 06/02/2019
 * Time: 15:07
 */

class Recette
{
    private $difficulte;
    private $titre;
    private $description;

    public function __construct($titre = 'Insérez le titre de votre recette', $description = 'Votre description', $difficulte = 1, $path = '...')
    {
        $this->difficulte = $difficulte;
        $this->titre = $titre;
        $this->description = $description;
        $this->path = $path;
    }

    /**
     * @return int
     */
    public function getDifficulte()
    {
        return $this->difficulte;
    }

    /**
     * @param int $difficulte
     */
    public function setDifficulte($difficulte)
    {
        $this->difficulte = $difficulte;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    private $path;

    public function toHtml()
    {
        $etoiles = '';
        for ($i = 0; $i < $this->difficulte; $i++)
            $etoiles .= "<i class=\"fas fa-star text-custom\"></i>";
        return
            "
        <div class=\"zoom col-xl-4 col-md-6 col-sm-12 mb-4\">
             <a class='text-normal' href='#'>
                <div class=\"cardHeight card\">
                    <img src=\"$this->path\" class=\"myNewDivHeight card-img-top\" alt=\"...\">
                    <div class=\"card-body\">
                        <h5 class=\"card-title\">$this->titre</h5>
                        <p class=\"card-text\">$this->description</p>
                        <div class=\"centerded\">
                            <label for=\"\">Difficulté : &nbsp</label>
                            $etoiles
                        </div>
                    </div>
                </div>
             </a>
        </div>
        ";
    }


}