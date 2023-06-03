<?php

namespace App\HtmlParser\Drivers;

use Illuminate\Support\Facades\Http;
use PHPHtmlParser\Dom;

class CustomDriver
{
    public $content;

    public function getContent($url): static {
        $this->content = file_get_contents($url);
        return $this;
    }


    public function formatContent(): static {
        $this->content = preg_replace('@<script[^>]*?>.*?</script>@si', '', $this->content);
        $this->content = preg_replace('@<style[^>]*?>.*?</style>@si', '', $this->content);
        $this->content = strip_tags($this->content);
        $this->content = trim($this->content);

        return $this;
    }

    public function wordCount(): array|int {
        return str_word_count($this->content, 0);
    }

    public function getWordCount($url): array|int {
        return $this->getContent($url)->formatContent()->wordCount();
    }
}
