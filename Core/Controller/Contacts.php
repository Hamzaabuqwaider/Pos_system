<?php

namespace Core\Controller;

use Core\Model\Contact;
use Core\Helpers\Helper;
use Core\Base\Controller;
use Core\Model\Replay_contact;

class Contacts extends Controller
{
    public function render()
    {
        if (!empty($this->view))
            $this->view();
    }

    function __construct()
    {
        $this->auth();
        $this->admin_view(true);
    }

    /**
     * Undocumented function
     * @return array of data
     *! return the all of items from table items
     *! return the all of transactions from table transactions
     *! return the top of items salles from table transactions
     *! return the all of items quantity from table items
     *! return the all of users from table users
     */
    public function index()
    {
        $this->view = 'contacts.index';
        $replay = new Replay_contact();
        $id = $_SESSION['user']['user_id'];
        $this->data['contacts_replay_all'] = $replay->contact_replay(8);
    }

    public function store()
    {
        if (empty($_POST['Email'])) {
            $_SESSION['error_type'] = "error";
            $_SESSION['message'] = 'The Email is required';
            Helper::redirect('/contact/page');
        }

        if (empty($_POST['message_contact'])) {
            $_SESSION['error_type'] = "error";
            $_SESSION['message'] = 'The message_contact is required';
            Helper::redirect('/contact/page');
            die;
        }
        $contact = new Contact();
        $contact->create($_POST);
        $_SESSION['error_type'] = "success";
        $_SESSION['message'] = 'The message has been sent successfully';
        Helper::redirect('/contact/page');
    }


    public function list()
    {
        $this->view = ('contacts.list');
        $contact = new Contact;
        $this->data['contacts'] = $contact->get_all();
        $this->data['contacts_count'] = count($contact->get_all());
    }


    public function delete()
    {
        $this->permissions(['user:read', 'user:delete']);
        $contact = new Contact();
        $contact->delete($_GET['id']);
        $_SESSION['error_type'] = "success";
        $_SESSION['message'] = 'contact Deleted';
        Helper::redirect('/list/message');
    }

    public function replay()
    {
        $this->view = 'contacts.replay';
        $contact = new Contact();
        $contacts = $contact->get_all();
        $contact_all = array();
        foreach ($contacts as $contact_result) {
            array_push($contact_all, $contact_result->id);
        }

        if (!in_array($_GET['id'], $contact_all)) {
            $_SESSION['error_type'] = "error";
            $_SESSION['message'] = 'The id is not exist';
            Helper::redirect('/list/message');
            die;
        }

        $contact_check = $contact->get_contacts_by_id($_GET['user_contact']);
        $this->data['contact_result'] = $contact_check;
    }


    function rereplay()
    {
        $replay = new Replay_contact();
        $user_one = $_SESSION['user']['user_id'];
        $user_two = $_POST['user_2'];
        $replay_message = $_POST['replay_message'];
        if (empty($replay_message)) {
            $_SESSION['error_type'] = "error";
            $_SESSION['message'] = 'The replay_message is required';
            Helper::redirect('/list/message');
            die;
        }
        $stmt1 = $replay->connection->prepare("INSERT INTO replay_contact (user_1,user_2,mesaage_replay) VALUES (?,?,?)");
        $stmt1->bind_param('iis', $user_one, $user_two, $replay_message);
        $stmt1->execute();
        $stmt1->close();

        $_SESSION['error_type'] = "success";
        $_SESSION['message'] = 'replay message success';
        Helper::redirect('/list/message');
    }
}
