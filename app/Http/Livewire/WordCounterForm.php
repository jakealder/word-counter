<?php

namespace App\Http\Livewire;

use App\HtmlParser\Facades\HtmlParser;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class WordCounterForm extends Component
{

    public string $urls;
    public array $urlsArray = [];
    public array $wordCounts = [];

    public function updatedUrls($urls): void {
        $this->validateUrls();
    }

    /**
     * @return bool
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
     * @return mixed
     */
    public function render(): mixed {
        return view('livewire.word-counter-form')->layout('components.layout.app');
    }
}
