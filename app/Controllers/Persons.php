<?php

namespace App\Controllers;

use App\Models\PersonsModel;

class Persons extends BaseController
{
    protected $personsModel;

    public function __construct()
    {
        $this->personsModel = new PersonsModel();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword)
            $persons = $this->personsModel->search($keyword);
        else
            $persons = $this->personsModel;

        $data = [
            'title'   => 'Person List',
            'persons' => $persons->paginate(8, 'persons'),
            'pager'   => $this->personsModel->pager,
            'page'    => $this->request->getVar('page_persons') ? $this->request->getVar('page_persons') : 1
        ];
        return view('persons/index', $data);
    }
}
