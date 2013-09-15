<?php

namespace models;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comic
 *
 * @ORM\Table(name="comic", indexes={@ORM\Index(name="fk_comic_author1", columns={"author_id"}), @ORM\Index(name="fk_comic_chapter1", columns={"chapter_id"})})
 * @ORM\Entity
 */
class Comic
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="page", type="integer", nullable=true)
     */
    private $page;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image_src", type="string", length=255, nullable=true)
     */
    private $imageSrc;

    /**
     * @var string
     *
     * @ORM\Column(name="image_thumb", type="string", length=255, nullable=true)
     */
    private $imageThumb;

    /**
     * @var string
     *
     * @ORM\Column(name="image_facebook", type="string", length=255, nullable=true)
     */
    private $imageFacebook;

    /**
     * @var \models\Author
     *
     * @ORM\ManyToOne(targetEntity="models\Author")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     * })
     */
    private $author;

    /**
     * @var \models\Chapter
     *
     * @ORM\ManyToOne(targetEntity="models\Chapter")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chapter_id", referencedColumnName="id")
     * })
     */
    private $chapter;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set page
     *
     * @param integer $page
     *
     * @return Comic
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return integer 
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Comic
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Comic
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set imageSrc
     *
     * @param string $imageSrc
     *
     * @return Comic
     */
    public function setImageSrc($imageSrc)
    {
        $this->imageSrc = $imageSrc;

        return $this;
    }

    /**
     * Get imageSrc
     *
     * @return string 
     */
    public function getImageSrc()
    {
        return $this->imageSrc;
    }

    /**
     * Set imageThumb
     *
     * @param string $imageThumb
     *
     * @return Comic
     */
    public function setImageThumb($imageThumb)
    {
        $this->imageThumb = $imageThumb;

        return $this;
    }

    /**
     * Get imageThumb
     *
     * @return string 
     */
    public function getImageThumb()
    {
        return $this->imageThumb;
    }

    /**
     * Set imageFacebook
     *
     * @param string $imageFacebook
     *
     * @return Comic
     */
    public function setImageFacebook($imageFacebook)
    {
        $this->imageFacebook = $imageFacebook;

        return $this;
    }

    /**
     * Get imageFacebook
     *
     * @return string 
     */
    public function getImageFacebook()
    {
        return $this->imageFacebook;
    }

    /**
     * Set author
     *
     * @param \models\Author $author
     *
     * @return Comic
     */
    public function setAuthor(\models\Author $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \models\Author 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set chapter
     *
     * @param \models\Chapter $chapter
     *
     * @return Comic
     */
    public function setChapter(\models\Chapter $chapter = null)
    {
        $this->chapter = $chapter;

        return $this;
    }

    /**
     * Get chapter
     *
     * @return \models\Chapter 
     */
    public function getChapter()
    {
        return $this->chapter;
    }
}
