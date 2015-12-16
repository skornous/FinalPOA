<?php
/**
 * Created by PhpStorm.
 * User: Leelo
 * Date: 15/12/2015
 * Time: 22:52
 */

namespace Controllers;

use Controllers\AppController;
use Models\Entities\Game;

class GameController extends AppController
{
    public function __construct() {

        parent::__construct();
        $this->loadModel('User');
        $this->loadModel('Game');
        $this->loadModel('Authorization');
    }
}