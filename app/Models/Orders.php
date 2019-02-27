<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use Hash;
use DB;

class Orders extends Model
{
    //======================================================================
    // CREATE
    //======================================================================
    /**
     * @param $userKey
     * @return mixed
     */
    public function createCart($userKey)
    {
        $getCart = DB::table('cart')->where('user_key', $userKey)->first();
        if(!isset($getCart->cart_id) || $getCart->cart_id === NULL) {
            return DB::table('cart')->insertGetId([
                'user_key' => $userKey
            ]);
        } else {
            return $getCart->cart_id;
        }
    }

    /**
     * @param $cartId
     * @param $node
     * @param $qty
     * @return mixed
     */
    public function createCartItems($cartId, $node, $qty)
    {
        $checkIfNodeExist = DB::table('cart_nodes')->where('cart', $cartId)->where('node', $node)->first();
        if(!isset($checkIfNodeExist->node) || $checkIfNodeExist->node === NULL) {
            return DB::table('cart_nodes')->insert([
                'cart' => $cartId,
                'node' => $node,
                'order_qty' => $qty
            ]);
        } else {
            $newQty = $checkIfNodeExist->order_qty + $qty;
            return DB::table('cart_nodes')->where('cart', $cartId)->where('node', $node)->update([
                'order_qty' => $newQty
            ]);
        }
    }

    /**
     * @param $data
     * @return mixed
     */
    public function createOrder($data)
    {
        $getCart = DB::table('cart')
            ->where('cart.user_key', $data['userKey'])
            ->join('cart_nodes', 'cart.cart_id', '=', 'cart_nodes.cart')
            ->get();
        $userID = $data['uid'];
        if($data['uid'] == 'guest') {
            $createUser = DB::table('users')->insertGetId([
                'name'        => $data['orderEmail'],
                'email'       => $data['orderEmail'],
                'password'    => Hash::make(uniqid())
            ]);
            $userID = $createUser;
        }
        $createOrder = DB::table('orders')->insertGetId([
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'email' => $data['orderEmail'],
            'phone' => $data['orderPhone'],
            'comment' => $data['orderComment'],
            'created_at' => Carbon::now(),
            'user_id' => $userID,
            'country' => $data['orderCountry'],
            'city' => $data['orderCity'],
            'post' => $data['orderPost'],
            'address' => $data['orderAddress'],
            'status' => 0
        ]);
        foreach ($getCart as $cart) {
            DB::table('orders_to_nodes')->insert([
                'order' => $createOrder,
                'node' => $cart->node,
                'order_qty' => $cart->order_qty
            ]);
            DB::table('cart_nodes')->where('cart', $cart->cart)->where('node', $cart->node)->delete();
        }
        DB::table('cart')->where('user_key', $data['userKey']);
        return $createOrder;
    }
    //======================================================================
    // READ
    //======================================================================
    /**
     * @param $userKey
     * @return array
     */
    public function getCurrentUserCartData($userKey)
    {
        $qty = 0;
        $total = 0;

        $getCart = DB::table('cart')
            ->where('cart.user_key', $userKey)
            ->join('cart_nodes', 'cart.cart_id', '=', 'cart_nodes.cart')
            ->leftJoin('nodes', 'cart_nodes.node', '=', 'nodes.nid')
            ->get();

        foreach ($getCart as $item) {
            $qty = $qty + (int)$item->order_qty;
            switch($item->is_special) {
                case 1:
                    $total = $total + ((int)$item->special_price * (int)$item->order_qty);
                    break;
                case 0:
                    $total = $total + ((int)$item->price * (int)$item->order_qty);
                    break;
                default:
                    break;
            }
        }
        return array('qty' => $qty, 'total' => $total);
    }

    public function getCartTableData($userKey)
    {
        $return = '';
        $getCart = DB::table('cart')
            ->where('cart.user_key', $userKey)
            ->join('cart_nodes', 'cart.cart_id', '=', 'cart_nodes.cart')
            ->leftJoin('nodes', 'cart_nodes.node', '=', 'nodes.nid')
            ->leftJoin('nodes_images', function($join) {
                $join->on('nodes.nid', '=', 'nodes_images.node')
                    ->where('nodes_images.is_featured', '=', 1);
            })
            ->get();
        foreach ($getCart as $item) {
            // Logic
            if($item->thumb_path !== NULL) {
                $image = '/' . $item->thumb_path;
            } else {
                $image = '/assets/logos/logo.jpg';
            }
            switch($item->is_special) {
                case 1:
                    $priceTotal = ((int)$item->special_price * (int)$item->order_qty);
                    $unitPrice = (int)$item->special_price;
                    break;
                case 0:
                    $priceTotal = ((int)$item->price * (int)$item->order_qty);
                    $unitPrice = (int)$item->price;
                    break;
                default:
                    $priceTotal = ((int)$item->price * (int)$item->order_qty);
                    $unitPrice = (int)$item->price;
                    break;
            }
            // Return
            $return .= '<tr>';
            $return .= '<td><a href="/node/' . $item->nid . '" target="_blank"><img src="' . $image . '" alt="' . $item->n_name_en . '" width="50" /></a></td>';
            $return .= '<td><a href="/node/' . $item->nid . '" target="_blank">' . $item->n_name_en . '</a></td>';
            $return .= '<td>' . $item->order_qty . '</td>';
            $return .= '<td>$' . $unitPrice . '</td>';
            $return .= '<td>$' . $priceTotal . '</td>';
            $return .= '<td><a href="/api/cart/remove/' . $item->user_key . '/' . $item->cart_nodes_id . '"><i class="far fa-trash-alt"></i></a></td>';
            $return .= '</tr>';
        }
        return $return;
    }

    public function getCartProceedTableData($userKey)
    {
        $return = '';
        $return .= '<input type="hidden" name="userKey" value="' . $userKey . '" />';
        $getCart = DB::table('cart')
            ->where('cart.user_key', $userKey)
            ->join('cart_nodes', 'cart.cart_id', '=', 'cart_nodes.cart')
            ->leftJoin('nodes', 'cart_nodes.node', '=', 'nodes.nid')
            ->leftJoin('nodes_images', function($join) {
                $join->on('nodes.nid', '=', 'nodes_images.node')
                    ->where('nodes_images.is_featured', '=', 1);
            })
            ->get();
        foreach ($getCart as $item) {
            // Logic
            if($item->thumb_path !== NULL) {
                $image = '/' . $item->thumb_path;
            } else {
                $image = '/assets/logos/logo.jpg';
            }
            switch($item->is_special) {
                case 1:
                    $priceTotal = ((int)$item->special_price * (int)$item->order_qty);
                    $unitPrice = (int)$item->special_price;
                    break;
                case 0:
                    $priceTotal = ((int)$item->price * (int)$item->order_qty);
                    $unitPrice = (int)$item->price;
                    break;
                default:
                    $priceTotal = ((int)$item->price * (int)$item->order_qty);
                    $unitPrice = (int)$item->price;
                    break;
            }
            // Return
            $return .= '<tr>';
            $return .= '<td><a href="/node/' . $item->nid . '" target="_blank"><img src="' . $image . '" alt="' . $item->n_name_en . '" width="50" /></a></td>';
            $return .= '<td><a href="/node/' . $item->nid . '" target="_blank">' . $item->n_name_en . '</a></td>';
            $return .= '<td>' . $item->order_qty . '</td>';
            $return .= '<td>$' . $priceTotal . '</td>';
            $return .= '</tr>';
        }
        return $return;
    }
    //======================================================================
    // UPDATE
    //======================================================================

    //======================================================================
    // DELETE
    //======================================================================
    /**
     * @param $cartNode
     * @return mixed
     */
    public function removeNodeFromCart($cartNode)
    {
        return DB::table('cart_nodes')->where('cart_nodes_id', $cartNode)->delete();
    }
}
