<?php

use Easteregg\Comment\CommentController;
//use Easteregg\Comment\SettingController;

Route::group(["middleware" => ["web", "auth", "acl"], "prefix" => "dashboard"], function () {
    Route::resource('comments', CommentController::class);
    Route::post('comments/{comment}/restore', CommentController::class ."@restore");
    Route::get('comments/{comment}/approve', CommentController::class ."@approve");
    Route::get('comments/{comment}/unapprove', CommentController::class ."@unapprove");



});
