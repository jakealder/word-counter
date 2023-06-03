<?php

namespace App\HtmlParser\Drivers;

use Illuminate\Support\Facades\Http;
use PHPHtmlParser\Dom;

/**
 * Class CustomDriver
 *
 * This class is responsible for retrieving and formatting HTML content from a given URL and counting the words.
 *
 * @package App\HtmlParser\Drivers
 */
class CustomDriver
{
    /**
     * @var string $content The HTML content from the given URL.
     */
    public $content;

    /**
     * Retrieves HTML content from the given URL.
     *
     * @param string $url The URL from which to retrieve HTML content.
     * @return static Returns the current object to allow method chaining.
     */
    public function getContent($url): static {
        $this->content = file_get_contents($url);
        return $this;
    }

    /**
     * Formats the HTML content by removing scripts, styles, and HTML tags.
     *
     * @return static Returns the current object to allow method chaining.
     */
    public function formatContent(): static {
        $this->content = preg_replace('@<script[^>]*?>.*?</script>@si', '', $this->content);
        $this->content = preg_replace('@<style[^>]*?>.*?</style>@si', '', $this->content);
        $this->content = strip_tags($this->content);
        $this->content = trim($this->content);

        return $this;
    }

    /**
     * Counts the words in the HTML content.
     *
     * @return array|int Returns the word count.
     */
    public function wordCount(): array|int {
        return str_word_count($this->content, 0);
    }

    /**
     * Gets the word count from the HTML content of the given URL.
     *
     * @param string $url The URL from which to retrieve the HTML content and count words.
     * @return array|int Returns the word count.
     */
    public function getWordCount($url): array|int {
        return $this->getContent($url)->formatContent()->wordCount();
    }
}
