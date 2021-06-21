<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\UserManager;

/**
 * Class UserController
 *
 */

class SecurityController extends AbstractController
{

    public function register()
    {
        $userManager = new UserManager();
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (
                !empty($_POST['firstname']) && !empty($_POST['lastname'])
                && !empty($_POST['email']) && !empty($_POST['sex'])
                && !empty($_POST['age']) && !empty($_POST['planet_id'])
                && !empty($_POST['password'])
            ) {
                $user = $userManager->searchUser($_POST['email']);
                if (!$user) {
                    if ($_POST['password']) {
                        if (strlen($_POST['password']) >= 1 && strlen($_POST['password']) <= 16) {
                            $user = [
                                'firstname' => trim($_POST['firstname']),
                                'lastname' => trim($_POST['lastname']),
                                'email' => filter_var(($_POST['email']), FILTER_VALIDATE_EMAIL),
                                'sex' => trim($_POST['sex']),
                                'age' => trim($_POST['age']),
                                'planet_id' => trim($_POST['planet_id']),
                                'password' => md5($_POST['password']),
                            ];
                            $id = $userManager->insert($user);
                            if ($id) {
                                $_SESSION['user'] = $userManager->selectOneById($id);
                                header('Location: /');
                            }
                        } else {
                            $errors[] = "Password must contain between 6 and 12 characters";
                        }
                    } else {
                        $errors[] = "Passwords do not match";
                    }
                } else {
                    $errors[] = "This email already exist";
                }
            } else {
                $errors[] = "All fields are required";
            }
        }
        return $this->twig->render('Security/register.html.twig', [
            'errors' => $errors,
            'session' => $_SESSION
            ]);
    }

    public function login()
    {
        $userManager = new UserManager();
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $user = $userManager->searchUser($_POST['email']);
                if ($user) {
                    if ($user['password'] === md5($_POST['password'])) {
                        $_SESSION['user'] = $user;
                        header('Location: /');
                    } else {
                        $errors[] = "Invalid password";
                    }
                } else {
                    $errors[] = "This email does not exist";
                }
            } else {
                $errors[] = "All fields are required";
            }
        }
        return $this->twig->render('Security/login.html.twig', [
            'errors' => $errors,
            'session' => $_SESSION
            ]);
    }

    public function logout()
    {
        session_destroy();
        header('Location: /');
    }
}
