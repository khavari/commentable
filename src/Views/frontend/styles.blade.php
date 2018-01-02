<style>

    .box-comments {
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        background: #fff;
    }
    .comment-item {
        border: 1px solid #bad8e7;
        padding: 15px;
        margin-bottom: 15px;
        background: #d2eaf6;
        font-size: 13px;
        border-radius: 0px;
        position: relative;
    }

    .box-comments.rtl .comment-item .modal-btn {
        float: left;
    }
    .box-comments.ltr .comment-item .modal-btn {
        float: right;
    }
    .box-comments.ltr .child{
        margin-left: 15px;
    }
    .box-comments.rtl .child{
        margin-right: 15px;
    }
    .comment-item .comment-title .name {
        display: inline-block;
        margin-bottom: 10px;
    }

    .comment-item .comment-title .date {
        display: inline-block;
        margin-bottom: 20px;
        margin: 0px 15px;
    }

    .box-comments.rtl .comment-item .comment-title .fa {
        padding-left: 5px;
    }
    .box-comments.ltr .comment-item .comment-title .fa {
        padding-right: 5px;
    }

    .comment-item .comment-body p {

        line-height: 25px;
    }

</style>
