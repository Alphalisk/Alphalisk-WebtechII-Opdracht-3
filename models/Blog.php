<?php

namespace models;

class Blog implements \JsonSerializable
{
    public function __construct (
        private String $image,
        private String $titel,
        private String $datum
    ){}

    public function toHtml() {
        $html = file_get_contents('views/blog.partial.html');
        foreach(['image','datum','titel'] as $element) {
            $html = str_replace('{{'.$element.'}}', $this->$element, $html);
        }
        return $html;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'titel'=>$this->titel,
            'datum'=>$this->datum,
            'image'=>$this->image
        ];
    }
}