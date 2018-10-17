<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class HomeController extends AppController
{

    public function home(){

        $file_tmp = "/files/initial_data/test.xlsx";
        $path = ROOT . $file_tmp;
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($path);

        $file = $spreadsheet->setActiveSheetIndex(0)->toArray(null, true, true, true);
        
        debug($file);Exit;
    }
}