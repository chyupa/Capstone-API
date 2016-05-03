<?php

function responseJson($success, $msg)
{
    return response()
        ->json([
            "success" => $success,
            "msg" => $msg
        ]);
}