<?php

// namespace MichaelNjuguna\KenyaAdministrativeDivisions;

// use MichaelNjuguna\KenyaAdministrativeDivisions\src\MainController;


// class KenyaAdministrativeDivisions
// {
//     public static function getAll(): array
//     {
//         return (new MainController())->getAll();
//     }
//     public static function getCounties(): array
//     {
//         return (new MainController())->getCounties();
//     }
// }



namespace MichaelNjuguna\KenyaAdministrativeDivisions;

use MichaelNjuguna\KenyaAdministrativeDivisions\src\MainController;

class KenyaAdministrativeDivisions
{
    /**
     * Dynamically handle static calls to non-existent methods on this class.
     * Delegates the call directly to an instance of MainController.
     *
     * @param string $method
     * @param array $arguments
     * @return mixed
     */
    public static function __callStatic(string $method, array $arguments)
    {
        $controller = new MainController();

        return $controller->$method(...$arguments);
    }
}
