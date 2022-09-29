<?php

class BundleTest
{
    public string $idInput;

    public string $nameInput;

    public string $postId;

    public string $labelInput;

    public string $numberInput;

    public function __construct($label,$id, $idPost,$number){
        $this->labelInput = $label;
        $this->idInput = $id;
        $this->nameInput = $id;
        $this->postId = $idPost;
        $this->numberInput = $number;


    }

    public function buildField(){
        return Metabox::view('new_bundle',["id"=>$this->idInput,
            "label"=>$this->labelInput,
            "name"=>$this->nameInput,
            "number"=> $this->numberInput,
            "value"=>get_post_meta($this->postId,$this->idInput,true),

        ]);
    }
}