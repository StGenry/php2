<?php


namespace app\controllers;


use app\models\repositories\CartRepository;
use app\models\repositories\ProductRepository;
use app\services\Request;
use app\models\Cart;
use app\services\renderers\IRenderer;
use app\services\Session;

class CartController extends Controller
{
    public function __construct(IRenderer $renderer)
    {
        parent::__construct($renderer);
    }

    public function actionIndex()
    {
        $data = (new Cart())->getBasket();
        echo $this->render("cartalternative", ['basket' => $data]);
    }

    public function actionAdd()
    {
        $request = new Request();
        if($request->isPost()){
            $productId = $request->post('id');
            $productQty =  $request->post('qty') ?: 0;
            (new Cart())->add($productId, $productQty);
            echo json_encode(['success' => 'ok', "message" => "Товар был добавлен в корзину"]);
        }
    }

    public function actionCart()
    {
        $this->useLayout = false;
        
        $cart = (new Cart())->getCart((new Session())->get("userID"));        

        echo $this->render("cart", ['productList' => $cart["productList"], 'cartTotal' => $cart["total"]]);
    }
    
}