<?php

namespace App\Http\Livewire;

use App\HtmlParser\Facades\HtmlParser;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

/**
 * Class WordCounterForm
 *
 * This class represents a Livewire component responsible for handling word count from a list of URLs.
 *
 * @package App\Http\Livewire
 */
class WordCounterForm extends Component
{
    /**
     * @var string $urls The string of URLs.
     */
    public string $urls;

    /**
     * @var array $urlsArray The array of URLs.
     */
    public array $urlsArray = [];

    /**
     * @var array $wordCounts The word count for each URL.
     */
    public array $wordCounts = [];

    /**
     * Event triggered when URLs are updated.
     *
     * @param string $urls The new URLs.
     * @return void
     */
    public function updatedUrls($urls): void {
        $this->validateUrls();
    }

    /**
     * Validates the list of URLs provided by the user.
     *
     * @return bool Returns true if URLs are valid, otherwise false.
     */
    public function validateUrls(): bool {
        $urls = preg_split("/\r\n|\n|\r/", $this->urls);
        $this->resetErrorBag('urls');

        if (!$urls || count($urls) > 5) {
            $this->addError('urls', 'Not enough or too many URLS present.');
            return false;
        }

        $validator = Validator::make($urls, [
            '*' => 'url'
        ]);

        if ($validator->fails()) {
            $this->addError('urls', 'One of the URLs is invalid');
            return false;
        }

        $this->urlsArray = $urls;
        return true;
    }

    /**
     * Retrieves the word count from each URL.
     *
     * @return void
     */
    public function getWordCount(): void {
        $this->validateUrls();
        $this->reset('wordCounts');
        foreach ($this->urlsArray as $url) {
            try {
                $result = HtmlParser::getWordCount($url);
            } catch (\Exception $exception) {
                $result = 'Error getting content, URL is inaccessible';
            }
            $this->wordCounts[$url] = $result;
        }
    }

    /**
     * Renders the Livewire component.
     *
     * @return mixed The rendered component.
     */
    public function render(): mixed {
        return view('livewire.word-counter-form')->layout('components.layout.app');
    }
}
