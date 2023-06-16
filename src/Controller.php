<?php

class Controller
{
    protected $entityId;

    public function runAction($actionName)
    {
        if(method_exists($this, 'runBeforeAction')) {
            $result = $this->runBeforeAction();
            if(!$result) {
                return;
            }
        }

        $actionName .= 'Action';
        if (method_exists($this, $actionName)) {
            $this->$actionName();
        } else {
            include VIEW_PATH  . 'status-pages/404.html';
        }
    }

    public function setEntityId($entityId) {
        $this->entityId = $entityId;
    }
}