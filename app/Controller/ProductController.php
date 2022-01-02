<?php declare(strict_types=1);

namespace App\Controller;

use Core\Database\Connection;
use Core\FormBuilder\FormBuilder;
use Core\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;



class ProductController extends BaseController
{
    private $actions = [];
    protected $request;
    protected $connection;
    protected $formBuilder;
    protected $product;
    protected $category;

    public function __contructor( ){
        parent::iniController( $request, $formBuilder, $connection  );
        $this->actions = [
            'index' => 'index',
            'show' => 'show',
            'create' => 'create',
            'edit' => 'edit',
            'delete' => 'delete',
        ];
        
       
        
    }

    public function index()
    {
       
        $products = $this->fetchAll('product');
        dump($products);
        $this->render('product/index', [
            'products' => $products,
        ], 'admin');
    }
    /**
     * Method to show a product of the database
     * methode qui permet d'afficher un produit de la base de données
     * methode test sera depacé
     *
     * @param string $table
     * @return void
     */
    private function fetchAll(string $table)
    {
        $connection = Connection::get()->connect();
        $sql = "SELECT * FROM $table";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function show(int $id)
    {
        $connection = Connection::get()->connect();
        $product = $this->fetchOne('product', $id);
        $this->render('product/show', [
            'product' => $product,
        ], 'admin');
    }

    private function fetchOne(string $table, int $id)
    {
        $connection = Connection::get()->connect();
        $sql = "SELECT * FROM $table WHERE id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create()
    {
        $form = $this->formBuilder->create(
            'product',
            [
                'method' => 'POST',
                'action' => '/admin/product/create',
            ]
        );
        $this->render('product/create', [
            'form' => $form->create(),
        ], 'admin');
    }

    public function edit(int $id)
    {
        $connection = Connection::get()->connect();
        $product = $connection->fetch('SELECT * FROM product WHERE id = ?', [$id]);
        $form = $this->formBuilder->create(
            'product',
            [
                'method' => 'POST',
                'action' => '/admin/product/edit/' . $id,
                'model' => $product,
            ]
        );
        $this->render('product/edit', [
            'form' => $form->create(),
            'product' => $product,
        ], 'admin');
    }

    public function delete(int $id)
    {
        $connection = Connection::get()->connect();
        $connection->executeSql('DELETE FROM product WHERE id = ?', [$id]);
        $this->redirect('/admin/product');
    }

    
}
