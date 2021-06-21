<?php

namespace App\Controller;

use App\Model\ContactManager;

class HomeController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        return $this->twig->render('Home/index.html.twig');
    }

    public function register()
    {
        return $this->twig->render('Security/register.html.twig', [
            'session' => $_SESSION
            ]);
    }


    /**
     * ROUTE /home/contact
     */
    public function contact()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (
                !empty($_POST['firstname'])
                && !empty($_POST['lastname'])
                && !empty($_POST['subject']) && !empty($_POST['message']) && !empty($_POST['age'])
                && !empty ($_POST['sex'])
            ) {
                $contactManager = new ContactManager();
                $contact = [
                    'firstname' => $_POST['firstname'],
                    'lastname' => $_POST['lastname'],
                    'subject' => $_POST['subject'],
                    'message' => $_POST['message'],
                    'age' => $_POST['age'],
                    'sex' => $_POST['sex'],
                ];
                $contactManager->insert($contact);
                header('Location: /home/success');
            } else {
                $errors[] = "All fields are required !";
            }
        }
        return $this->twig->render('Home/contact.html.twig', ['errors' => $errors]);
    }

    /**
     * ROUTE /home/success
     */
    public function success()
    {
        return $this->twig->render('Home/success.html.twig');
    }

    /**
     * ROUTE /home/about
     */
    public function about()
    {
        return $this->twig->render('Home/about.html.twig');
    }


    /**
     * ROUTE /home/error
     */
    public function error()
    {
        return $this->twig->render('Security/404Error.html.twig');
    }

    public function plans()
    {
        return $this->twig->render('Home/ourPlans.html.twig');
    }

    public function planets()
    {
        return $this->twig->render('Home/planets.html.twig');
    }


    public function rencontre()
    {
        return $this->twig->render('/Home/rencontre.html.twig');
    }

    public function messages()
    {
        return $this->twig->render('/Home/messages.html.twig');
    }

    public function message()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (
                !empty($_POST['message'])
            ) {
                $contactManager = new ContactManager();
                $contact = [
                    'message' => $_POST['message'],
                ];
                $contactManager->insert($contact);
                header('Location: /home/success');
            } else {
                $errors[] = "All fields are required !";
            }
        }
        return $this->twig->render('Home/messages.html.twig', ['errors' => $errors]);
    }


}