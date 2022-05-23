<?php

namespace App\Controllers;

use App\Models\ComicsModel;

class Comics extends BaseController
{
    protected $comicsModel;

    public function __construct()
    {
        $this->comicsModel = new ComicsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Comics',
            'comics' => $this->comicsModel->getComic()
        ];
        return view('comics/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Comic',
            'comic' => $this->comicsModel->getComic($slug)
        ];
        if (empty($data['comic'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Comic ' . $slug . ' not found.');
        }
        return view('comics/detail', $data);
    }

    public function create()
    {
        $data = [
            'title'      => 'Add Comic',
            'validation' => \Config\Services::validation()
        ];
        return view('comics/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'title' => 'required|is_unique[comics.title]',
            'image' => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
        ])) {
            return redirect()->to('/comics/create')->withInput();
        }

        // get image input file and move to folder img public
        $fileImage = $this->request->getFile('image');
        if ($fileImage->getError() == 4)
            $nameImage = 'comicDefault.jpg';
        else {
            $nameImage = $fileImage->getRandomName();
            $fileImage->move('img', $nameImage);
        }

        $this->comicsModel->save([
            'title'     => $this->request->getVar('title'),
            'slug'      => url_title($this->request->getVar('title'), '-', true),
            'author'    => $this->request->getVar('author'),
            'publisher' => $this->request->getVar('publisher'),
            'image'     => $nameImage
        ]);

        session()->setFlashdata('message', $this->request->getVar('title') . ' has been successfully added.');
        return redirect()->to('/comics');
    }

    public function delete($id)
    {
        // remove image from folder image
        $imageName = $this->comicsModel->find($id)['image'];
        if ($imageName != 'comicDefault.jpg') unlink('img/' . $imageName);

        // delete data from database
        $this->comicsModel->delete($id);
        session()->setFlashdata('message', 'Comic deleted successfully.');
        return redirect()->to('/comics');
    }

    public function update($slug)
    {
        $data = [
            'title'      => 'Update Comic',
            'validation' => \Config\Services::validation(),
            'comic'      => $this->comicsModel->getComic($slug)
        ];
        return view('comics/update', $data);
    }

    public function saveUpdate($id)
    {
        // check unique title
        $newSlug = url_title($this->request->getVar('title'), '-', true);
        if ($this->request->getVar('slug') != $newSlug)
            $ruleTitle = 'required|is_unique[comics.title]';
        else
            $ruleTitle = 'required';

        if (!$this->validate([
            'title' => $ruleTitle,
            'image' => 'max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
        ])) {
            return redirect()->to('/comics/update/' . $this->request->getVar('slug'))->withInput();
        }

        // get image input file and move to folder img public
        $fileImage = $this->request->getFile('image');
        $nameImage = $this->request->getVar('oldImage');
        if ($fileImage->getError() != 4) {
            if ($nameImage != 'comicDefault.jpg') unlink('img/' . $nameImage);
            $nameImage = $fileImage->getRandomName();
            $fileImage->move('img', $nameImage);
        }

        $this->comicsModel->save([
            'id'        => $id,
            'title'     => $this->request->getVar('title'),
            'slug'      => $newSlug,
            'author'    => $this->request->getVar('author'),
            'publisher' => $this->request->getVar('publisher'),
            'image'     => $nameImage
        ]);

        session()->setFlashdata('message', $this->request->getVar('title') . ' has been successfully updated.');
        return redirect()->to('/comics');
    }
}
