<?php


namespace Expirenza\portmone\entities;


abstract class BaseResponse
{
    abstract public function isSuccess();
    abstract public function isFailed();

}
