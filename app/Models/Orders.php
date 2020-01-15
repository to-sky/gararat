<?php

namespace App\Models;

use App\Mail\OrderCreated;
use App\User;
use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
use App;
use Hash;
use DB;
use Mail;

class Orders extends Model
{

    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'comment', 'created_at', 'user_id', 'country', 'city', 'post',
        'address', 'status'
    ];

    /**
     * Display id with lead zeros
     *
     * @return string
     */
    public function displayId()
    {
        return sprintf('%06d', $this->id);
    }

    /**
     * Return client full name
     *
     * @return string
     */
    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Full client address
     *
     * @return string
     */
    public function fullAddress()
    {
        return $this->country . ', ' . $this->city . ', ' . $this->address . ', ' . $this->post;
    }

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
        $cart = DB::table('cart')
            ->where('cart.user_key', $data['userKey'])
            ->join('cart_nodes', 'cart.cart_id', '=', 'cart_nodes.cart')
            ->get();

        $user = User::firstOrCreate(['email'  => $data['orderEmail']], [
            'name' => $data['orderEmail'],
            'email'  => $data['orderEmail'],
            'password' => Hash::make(uniqid())
        ]);

        $order = Orders::create([
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'email' => $data['orderEmail'],
            'phone' => $data['orderPhone'],
            'comment' => $data['orderComment'],
            'created_at' => Carbon::now(),
            'user_id' => $user->id,
            'country' => $data['orderCountry'],
            'city' => $data['orderCity'],
            'post' => $data['orderPost'],
            'address' => $data['orderAddress'],
            'status' => 0
        ]);

        foreach ($cart as $item) {
            DB::table('orders_to_nodes')->insert([
                'order' => $order->id,
                'node' => $item->node,
                'order_qty' => $item->order_qty
            ]);
            DB::table('cart_nodes')->where('cart', $item->cart)->where('node', $item->node)->delete();
        }
        DB::table('cart')->where('user_key', $data['userKey']);

        Mail::to([$order->email, config('mail.to.sales')])->send(new OrderCreated($order));

        return $order;
    }
    //======================================================================
    // READ
    //======================================================================
    /**
     * @return array
     */
    public function getOrders()
    {
        $getOrders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name')
            ->orderBy('orders.created_at', 'DESC')
            ->paginate(50);
        $array = [];
        foreach ($getOrders as $order) {
            $getNodes = DB::table('orders_to_nodes')
                ->where('orders_to_nodes.order', $order->oid)
                ->join('nodes', 'orders_to_nodes.node', '=', 'nodes.nid')
                ->get();
            $total = 0;
            foreach ($getNodes as $node) {
                if($node->is_special == 1) {
                    $total = $total + ($node->order_qty * $node->special_price);
                } else {
                    $total = $total + ($node->order_qty * $node->price);
                }
            }
            $array[] = array(
                'oid' => $order->oid,
                'customer' => $order->first_name . ' ' . $order->last_name,
                'total' => '$' . number_format($total, 0, '.', ' '),
                'status' => $order->status,
                'created_at' => $order->created_at
            );
        }
        return $array;
    }

    /**
     * @param $oid
     * @return mixed
     */
    public function getOrderById($oid)
    {
        return DB::table('orders')
            ->where('orders.oid', $oid)
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name')
            ->orderBy('orders.created_at', 'DESC')
            ->first();
    }

    /**
     * @param $oid
     * @return mixed
     */
    public function getOrderProducts($oid)
    {
        $getNodes = DB::table('orders_to_nodes')
            ->where('orders_to_nodes.order', $oid)
            ->join('nodes', 'orders_to_nodes.node', '=', 'nodes.nid')
            ->leftJoin('nodes_images', function($join) {
                $join->on('nodes.nid', '=', 'nodes_images.node')
                    ->where('nodes_images.is_featured', '=', 1);
            })
            ->get();
        return $getNodes;
    }
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

    /**
     * @param $userKey
     * @return string
     */
    public function getCartTableData($userKey)
    {
        $locale = App::getLocale();
        $return = '';
        $getCart = DB::table('cart')
            ->where('cart.user_key', $userKey)
            ->join('cart_nodes', 'cart.cart_id', '=', 'cart_nodes.cart')
            ->leftJoin('nodes', 'cart_nodes.node', '=', 'nodes.nid')
            ->leftJoin('nodes_machinery_fields', 'nodes.nid', '=', 'nodes_machinery_fields.node')
            ->leftJoin('nodes_parts_fields', 'nodes.nid', '=', 'nodes_parts_fields.node')
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
            if ($item->price == 0) {
                if($locale === 'en') {
                    $unitPrice = 'By Request';
                    $priceTotal = 'By Request';
                } else {
                    $unitPrice = 'حسب الطلب';
                    $priceTotal = 'حسب الطلب';
                }
            } else {
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
                if($locale === 'en') {
                    $priceTotal = $priceTotal . ' LE';
                    $unitPrice = $unitPrice . ' LE';
                } else {
                    $priceTotal = 'جنيه ' . $priceTotal;
                    $unitPrice = ' جنيه ' . $unitPrice;
                }
            }
            // Return
            if($locale === 'en') {
                $return .= '<tr>';
                $return .= '<td><a href="/node/' . $item->nid . '" target="_blank"><img src="' . $image . '" alt="' . $item->n_name_en . '" width="50" /></a></td>';
                if(isset($item->nmf_name_en)) {
                    $return .= '<td><a href="/node/' . $item->nid . '" target="_blank">' . $item->nmf_name_en . '</a></td>';
                } else {
                    $return .= '<td><a href="/node/' . $item->nid . '" target="_blank">' . $item->producer_id . ' - ' . $item->npf_name_en . '</a></td>';
                }
                $return .= '<td>' . $item->order_qty . '</td>';
                $return .= '<td>' . $unitPrice . '</td>';
                $return .= '<td>' . $priceTotal . '</td>';
                $return .= '<td><a href="/api/cart/remove/' . $item->user_key . '/' . $item->cart_nodes_id . '"><i class="far fa-trash-alt"></i></a></td>';
                $return .= '</tr>';
            } else {
                $return .= '<tr>';
                $return .= '<td><a href="/node/' . $item->nid . '" target="_blank"><img src="' . $image . '" alt="' . $item->n_name_ar . '" width="50" /></a></td>';
                if(isset($item->nmf_name_en)) {
                    $return .= '<td><a href="/node/' . $item->nid . '" target="_blank">' . $item->nmf_name_ar . '</a></td>';
                } else {
                    $return .= '<td><a href="/node/' . $item->nid . '" target="_blank">' . $item->producer_id . ' - ' . $item->npf_name_ar . '</a></td>';
                }
                $return .= '<td>' . $item->order_qty . '</td>';
                $return .= '<td>' . $unitPrice . '</td>';
                $return .= '<td>' . $priceTotal . '</td>';
                $return .= '<td><a href="/api/cart/remove/' . $item->user_key . '/' . $item->cart_nodes_id . '"><i class="far fa-trash-alt"></i></a></td>';
                $return .= '</tr>';
            }
        }
        return $return;
    }

    public function getCartProceedTableData($userKey)
    {
        $locale = App::getLocale();
        $return = '';
        $return .= '<input type="hidden" name="userKey" value="' . $userKey . '" />';
        $getCart = DB::table('cart')
            ->where('cart.user_key', $userKey)
            ->join('cart_nodes', 'cart.cart_id', '=', 'cart_nodes.cart')
            ->leftJoin('nodes', 'cart_nodes.node', '=', 'nodes.nid')
            ->leftJoin('nodes_machinery_fields', 'nodes.nid', '=', 'nodes_machinery_fields.node')
            ->leftJoin('nodes_parts_fields', 'nodes.nid', '=', 'nodes_parts_fields.node')
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
            if ($item->price == 0) {
                if($locale === 'en') {
                    $priceTotal = 'By Request';
                } else {
                    $priceTotal = 'حسب الطلب';
                }
            } else {
                switch($item->is_special) {
                    case 1:
                        $priceTotal = ((int)$item->special_price * (int)$item->order_qty);
                        break;
                    case 0:
                        $priceTotal = ((int)$item->price * (int)$item->order_qty);
                        break;
                    default:
                        $priceTotal = ((int)$item->price * (int)$item->order_qty);
                        break;
                }
                if($locale === 'en') {
                    $priceTotal = $priceTotal . ' LE';
                } else {
                    $priceTotal = 'جنيه ' . $priceTotal;
                }
            }
            // Return
            if($locale === 'en') {
                $return .= '<tr>';
                $return .= '<td><a href="/node/' . $item->nid . '" target="_blank"><img src="' . $image . '" alt="' . $item->n_name_en . '" width="50" /></a></td>';
                if (isset($item->nmf_name_en)) {
                    $return .= '<td><a href="/node/' . $item->nid . '" target="_blank">' . $item->nmf_name_en . '</a></td>';
                } else {
                    $return .= '<td><a href="/node/' . $item->nid . '" target="_blank">' . $item->producer_id . ' - ' . $item->npf_name_en . '</a></td>';
                }
                $return .= '<td>' . $item->order_qty . '</td>';
                $return .= '<td style="width: 15%;">' . $priceTotal . '</td>';
                $return .= '</tr>';
            } else {
                $return .= '<tr>';
                $return .= '<td><a href="/node/' . $item->nid . '" target="_blank"><img src="' . $image . '" alt="' . $item->n_name_ar . '" width="50" /></a></td>';
                if (isset($item->nmf_name_en)) {
                    $return .= '<td><a href="/node/' . $item->nid . '" target="_blank">' . $item->nmf_name_ar . '</a></td>';
                } else {
                    $return .= '<td><a href="/node/' . $item->nid . '" target="_blank">' . $item->producer_id . ' - ' . $item->npf_name_ar . '</a></td>';
                }
                $return .= '<td>' . $item->order_qty . '</td>';
                $return .= '<td style="width: 15%;">' . $priceTotal . '</td>';
                $return .= '</tr>';
            }
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
