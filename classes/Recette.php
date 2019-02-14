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
    private $idRecette;
    private $bouton;

    public function __construct($idRecette, $titre = 'Insérez le titre de votre recette', $description = 'Votre description', $difficulte = 1, $path = '...', $bouton = '')
    {
        if ($difficulte >= 1 && $difficulte <= 5)
            $this->difficulte = $difficulte;

        elseif ($difficulte < 1)
            $this->difficulte = 1;

        else
            $this->difficulte = 5;

        $this->titre = $titre;
        if (strlen($description) > 70)
            $this->description = substr($description, 0, 61) . ' ...';
        else
            $this->description = $description;
        $this->path = $path;
        $this->idRecette = $idRecette;

        $this->bouton = $bouton;
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
        if ($difficulte >= 1 && $difficulte <= 5)
            $this->difficulte = $difficulte;
        elseif ($difficulte < 1)
            $this->difficulte = 1;
        else
            $this->difficulte = 5;
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
        $bouton = '';
        for ($i = 0; $i < $this->difficulte; $i++)
            $etoiles .= "<i class=\"fas fa-star text-custom\"></i>";


        if ($this->bouton != '')
        {
            $bouton = "<a class='btn btn-danger ml-5' href='$this->bouton?id=$this->idRecette'>Supprimer</a>";
        }


        return
            "
        <div class=\"zoom col-xl-4 col-md-6 col-sm-12 mb-4\">
             <a class='text-normal' href='views.php?id=$this->idRecette'>
                <div class=\"cardHeight card\">
                    <img src=\"$this->path\" class=\"myNewDivHeight card-img-top\" alt=\"...\">
                    <div class=\"card-body\">
                        <h5 class=\"card-title\">$this->titre</h5>
                        <p class=\"card-text\">$this->description</p>
                        <div class=\"centerded\">
                            <label for=\"\">Difficulté : &nbsp</label>
                            $etoiles
                             $bouton 
                        </div>    
                    </div>
                </div>
             </a>
        </div>
        ";
    }


}