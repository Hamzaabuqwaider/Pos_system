<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<?php

use Core\Model\Replay_contact;
use Core\Model\User;

$id = $_SESSION['user']['user_id'];
$user = new User();
$user_info = $user->get_by_id($id);

$user_contact = $_GET['user_contact'];
$user_select_contact = $user->get_by_id($user_contact);

$replay = new Replay_contact();
$replay_contacts = $replay->contact_replay($user_contact);
?>
<div class="container">
    <div class="d-flex justify-content-center align-items-center">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card card-chat chat-app">
                    <div class="chat">
                        <div class="chat-history">
                            <ul class="m-b-0">
                                <li class="clearfix">
                                    <div class="message-data text-right">
                                        <img src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/Images/<?= $user_select_contact->img ?>" alt="avatar">
                                    </div>
                                    <?php
                                    foreach ($data->contact_result as $res) : ?>
                                        <p style="color:red;" class="ms-4"><?= $res->message_contact ?></p>
                                    <?php endforeach; ?>
                                </li>

                                <li class="clearfix">
                                    <div class="message-data text-right">
                                        <img src="<?= $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] ?>/resources/Images/<?= $user_info->img ?>" alt="avatar">
                                    </div>
                                    <?php
                                    foreach ($replay_contacts as $res2) : ?>
                                        <p style="color:green;" class="ms-4"><?= $res2->mesaage_replay ?></p>
                                    <?php endforeach; ?>
                                </li>
                            </ul>
                        </div>
                        <div class="chat-message clearfix">
                            <form class="input-group mb-0" method="POST" action="/message/rereplay">
                                <input type="hidden" value="<?= $user_contact ?>" name="user_2">
                                <button type="submit" class=""><span class="input-group-text" style="height: 61px;border: 2px solid green;"><i class="fa fa-send"></i></span></button>
                                <textarea type="text" name="replay_message" class="form-control" placeholder="Enter replay here..." required></textarea>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>