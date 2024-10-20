<?php

namespace App\Http\Controllers\Api\V1;

use App\Queries\BooksQuery;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    protected $responseStructure = [
        'data' => [],
        'errors' => [],
        'meta' => [
            'author' => 'Sebasdroid98'
        ]
    ];

    public $booksQuery;

    public function __construct()
    {
        $this->booksQuery = new BooksQuery();
    }

    /**
     * Función index para listar todos los libros
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $respuestaAPI = $this->responseStructure;
        $respuestaAPI['data'] = $this->booksQuery->getAllBooks();
        return response()->json($respuestaAPI, 200);
    }

    /**
     * Función store para registrar los datos de un libro
     * @param Request $request -> con los datos del libro
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $respuestaAPI = $this->responseStructure;
        $datosRecibidos = $request->except('_token');

        $rules = [
            'nombre_libro' => 'required|string|max:100'
        ];

        $messages = [
            'nombre_libro.required' => 'El nombre es obligatorio',
            'nombre_libro.max' => 'El nombre solo puede tener maximo 100 caracteres'
        ];

        $validator = Validator::make($datosRecibidos,$rules, $messages);

        // Si falla la validación
        if ($validator->fails()) {
            $errores = $validator->errors()->all();
            $respuestaAPI['errors'] = $errores;
            return response()->json($respuestaAPI, 200);
        }

        $libroTemporal = $this->booksQuery->storeBook($datosRecibidos);
        $respuestaAPI['data'] = ($libroTemporal) ? 'El Libro fue registrado con exito' : "El Libro no se registro";
        return response()->json($respuestaAPI, 200);
    }

    /**
     * Función show para mostrar los datos de un libro por su id
     * @param int $id
     * @return Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $respuestaAPI = $this->responseStructure;
        $libroEncontrado = $this->booksQuery->getBookById($id);
        if (is_null($libroEncontrado)) {
            $respuestaAPI['errors'][] = "El libro con el id $id no existe";
            return response()->json($respuestaAPI, 200);
        }
        $respuestaAPI['data'] = $libroEncontrado;
        return response()->json($respuestaAPI, 200);
    }

    /**
     * Función update para actualizar los datos de un libro
     * @param \Illuminate\Http\Request $request -> con los datos del libro
     * @param int $id -> con el id del libro a actualizar
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $respuestaAPI = $this->responseStructure;
        $datosRecibidos = $request->except('_token');

        $rules = [
            'nombre_libro' => 'required|string|max:100'
        ];

        $messages = [
            'nombre_libro.required' => 'El nombre es obligatorio',
            'nombre_libro.max' => 'El nombre solo puede tener maximo 100 caracteres'
        ];

        $validator = Validator::make($datosRecibidos,$rules, $messages);

        // Si falla la validación
        if ($validator->fails()) {
            $errores = $validator->errors()->all();
            $respuestaAPI['errors'] = $errores;
            return response()->json($respuestaAPI, 200);
        }

        $libroTemporal = $this->booksQuery->updateBookById($datosRecibidos, $id);
        $respuestaAPI['data'] = ($libroTemporal) ? 'El Libro fue actualizado con exito' : "El Libro con el id $id no existe";

        return response()->json($respuestaAPI, 200);
    }

    /**
     * Función destroy para eliminar un libro por su id
     * @param int $id
     * @return Illuminate\Http\Response
     */
    public function destroy(int $id) 
    {
        $respuestaAPI = $this->responseStructure;
        $libroTemporal = $this->booksQuery->deleteBookById($id);
        $respuestaAPI['data'] = ($libroTemporal) ? 'El Libro fue eliminado con exito' : "El Libro con el id $id no existe";
        return response()->json($respuestaAPI, 200);
    }
}
