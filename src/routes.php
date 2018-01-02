<?php

use Easteregg\Comment\CommentController;
//use Easteregg\Comment\Comment\CommentController;


Route::group(["middleware" => ["web", "auth", "acl"], "prefix" => "dashboard"], function () {
    Route::resource('comments', CommentController::class);
    Route::post('comments/{comment}/restore', CommentController::class ."@restore");
    Route::get('comments/{comment}/approve', CommentController::class ."@approve");
    Route::get('comments/{comment}/unapprove', CommentController::class ."@unapprove");
});

Route::group(["middleware" => ["web", "auth"]], function () {
    Route::post('comment/submit', CommentController::class ."@submit");
});
