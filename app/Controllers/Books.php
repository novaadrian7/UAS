<?php
namespace App\Controllers;

use App\Models\Book;

class Books extends BaseController
{
    public function index()
    {
        $role = session()->get('role');
        if (!$role) {
            return redirect()->to('/');
        }

        $model = new Book();
        $data = [
            'books' => $model->findAll(),
            'role' => $role
        ];

        return view('books_view', $data);
    }

    public function add()
    {
        return view('books_add');
    }

    public function save()
    {
        $model = new Book();
        $model->save([
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'published_year' => $this->request->getPost('published_year'),
            'available' => 1,
        ]);
        return redirect()->to('/books');
    }

    public function edit($id)
{
    $model = new Book();
    $data['book'] = $model->find($id);

    if (!$data['book']) {
        return redirect()->to('/books')->with('error', 'Book not found.');
    }

    return view('books_edit', $data);
}

    public function update($id)
    {
        $model = new Book();
        $model->update($id, [
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'published_year' => $this->request->getPost('published_year'),
            'available' => $this->request->getPost('available') ? 1 : 0,
        ]);

        return redirect()->to('/books')->with('success', 'Book updated.');
    }

    public function delete($id)
    {
        $model = new Book();
        $model->delete($id);

        return redirect()->to('/books')->with('success', 'Book deleted.');
    }

}
