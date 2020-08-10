<?php


namespace Expirenza\portmone\instances;


abstract class BaseResponse
{
    abstract public function isSuccess();
    abstract public function isFailed();

}
