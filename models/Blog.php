<?php

namespace models;

class Blog implements \JsonSerializable
{
    public function __construct (
        private String $image,
        private String $titel,
        private String $body,
        private String $create_date,
        private String $id
    ){}

    public function toHtml() {
        $html = file_get_contents('views/blog.partial.html');
        foreach(['image','body','titel','create_date','id'] as $element) {
            $html = str_replace('{{'.$element.'}}', $this->$element, $html);
        }
        return $html;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'titel'=>$this->titel,
            'body'=>$this->body,
            'image'=>$this->image,
            'create_date'=>$this->create_date,
            'id'=>$this->id
        ];
    }
}