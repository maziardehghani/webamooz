<?php



use Hekmatinasser\Verta\Facades\Verta;

function newFeedback($title , $body , $type)
{
    session()->flash('feedback', ['title' => $title , 'body' => $body , 'type' => $type ]);
}

