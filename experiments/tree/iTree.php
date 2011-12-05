<?php

interface yTreeNodeI{
    public function getParent();
    public function setParent();
    public function getChildren();
    public function appendChild($node);
}