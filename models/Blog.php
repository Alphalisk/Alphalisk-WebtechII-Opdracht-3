<?php

namespace models;

class Blog implements \JsonSerializable
{
    public function __construct (
        private String $id,
        private String $user_id,
        private String $title,
        private String $body,
        private String $link,
        private String $create_date,
        
    ){}

    public function toHtml() {
        $html = file_get_contents('views/blog.partial.html');
        foreach(['id','user_id','title','body','link','create_date'] as $element) {
            $html = str_replace('{{'.$element.'}}', $this->$element, $html);
        }
        return $html;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'title'=>$this->title,
            'body'=>$this->body,
            'link'=>$this->link,
            'create_date'=>$this->create_date,
        ];
    }
}