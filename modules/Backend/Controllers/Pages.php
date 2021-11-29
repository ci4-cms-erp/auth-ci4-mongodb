<?php

namespace Modules\Backend\Controllers;

use JasonGrimes\Paginator;
use MongoDB\BSON\ObjectId;

class Pages extends BaseController
{
    public function index()
    {
        $totalItems = $this->commonModel->count('pages',[]);
        $itemsPerPage = 20;
        $currentPage = $this->request->uri->getSegment('3', 1);
        $urlPattern = '/backend/pages/(:num)';
        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        $paginator->setMaxPagesToShow(5);
        $this->defData['paginator'] = $paginator;
        $bpk = ($this->request->uri->getSegment(3, 1) - 1) * $itemsPerPage;
        $this->defData['pages']=$this->commonModel->getList('pages',[],['$limit'=>$itemsPerPage,'$skip'=>$bpk]);
        return view('Modules\Backend\Views\pages\list',$this->defData);
    }

    public function create()
    {
        $this->defData['tags']=$this->commonModel->getList('tags',[],['$limit'=>10]);
        return view('Modules\Backend\Views\pages\create',$this->defData);
    }

    public function create_post()
    {
        dd($_POST);
    }

    public function update($id)
    {
        
    }

    public function update_post($id)
    {
        
    }

    public function delete_post($id)
    {
        
    }
}
