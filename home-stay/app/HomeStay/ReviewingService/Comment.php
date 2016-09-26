<?php

namespace App\HomeStay\ReviewingService;


/**
 * Class Comment
 * @package App\HomeStay\ReviewingService
 */
class Comment
{
    /**
     * @var string
     */
    private $content;

    /**
     * Comment constructor.
     * @param string $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getContent();
    }
}
