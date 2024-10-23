<?php

namespace models;

class Blog implements \JsonSerializable
{
    public function __construct (
        private String $link,
        private String $title,
        private String $body,
        private String $create_date,
        private String $id
    ){}

    public function toHtml() {
        $html = file_get_contents('views/blog.partial.html');
        foreach(['link','body','title','create_date','id'] as $element) {
            $html = str_replace('{{'.$element.'}}', $this->$element, $html);
        }
        return $html;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'titel'=>$this->title,
            'body'=>$this->body,
            'image'=>$this->link,
            'create_date'=>$this->create_date,
            'id'=>$this->id
        ];
    }
}