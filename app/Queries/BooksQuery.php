<?php

namespace App\Queries;

use App\Models\V1\books;

class BooksQuery
{

    /**
     * Query para obtener todos los libros registrados
     * @return Illuminate\Database\Collection
     */
    public function getAllBooks()
    {
        return books::all();
    }

    /**
     * Query para registrar un libro
     * @param Array $bookInfo -> con la información de un libro
     */
    public function storeBook(array $bookInfo) {
        return books::create($bookInfo);
    }

    /**
     * Query para obtener todos los libros registrados
     * @param int $idBook
     * @return Illuminate\Database\Collection
     */
    public function getBookById(int $idBook)
    {
        return books::find($idBook);
    }

    /**
     * Query para actualizar un libro
     * @param Array $bookInfo -> con la información de un libro
     * @param int $id -> con el id del libro a actualizar
     */
    public function updateBookById(array $bookInfo, int $id) {
        return books::where('id_libro', $id)->update($bookInfo);
    }

    /**
     * Query para eliminar un libro por su id
     * @param int $id -> con el id del libro a eliminar
     */
    public function deleteBookById(int $id) {
        return books::where('id_libro', $id)->delete();
    }

}

?>