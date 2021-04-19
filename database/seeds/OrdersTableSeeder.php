<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use App\Data\Models\User;
use App\Data\Models\Menu;
use App\Data\Models\Table;
use App\Data\Models\Order;
use App\Data\Models\OrderDetail;
use App\Data\Models\OrderTable;
use App\Data\Models\OrderPayment;


class OrdersTableSeeder extends Seeder
{
    private $usersId;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->resetTableAvailability();

        $this->usersId = [];
        $users = User::all('id');
        foreach ($users as $user) {
            $this->usersId[] = $user->id;
        }

        $echoFormat = "d/m/Y - H:i:s";

        $now = Carbon::now();

        $beginDate = Carbon::now()->addMonths(-6);

        echo "Now = " . $now->format($echoFormat) . "\n";
        echo "BeginDate = " . $beginDate->format($echoFormat) . "\n";
        $beginDate->addHours(mt_rand(1, 3))->addMinutes(mt_rand(1, 59));
        echo "BeginDate = " . $beginDate->format($echoFormat) . "\n";
        $now->addDays(-1);

        while ($beginDate <= $now) {
            $this->AddOrder($beginDate);
            $beginDate->addHours(mt_rand(1, 3))->addMinutes(mt_rand(1, 59));
//            echo "Date is:" . $beginDate->format($echoFormat) . "\n";
        }
        echo "=== end ===" . "\n";
    }

    private function AddOrder(Carbon $beginDate)
    {
        $faker = \Faker\Factory::create();
        $adults = mt_rand(1, 6);
        $children = ($adults >= 2) ? mt_rand(0, $adults - 1) : 0;
        $userId = $this->getUserId();

        $order = new Order([
            'uuid' => Str::uuid(),
            'order_date' => $beginDate,
            'delivery_date' => $beginDate,
            'adults' => $adults,
            'children' => $children,
            'user_id' => ($userId > -1) ? $userId : null,
            'customer' => ($userId > -1) ? null : $this->getName($faker),
            'is_closed' => null,
            'note' => $faker->paragraph(mt_rand(3, 10)),
        ]);
        $order->save();
        $this->addTablesToOrder($order);
        $this->addMenuItemsToOrder($order);
        $this->addPaymentsToOrder($order, $beginDate);
    }

    private function getUserId()
    {
        $rand = mt_rand(1, 1000);
        $id = $this->usersId[mt_rand(0, count($this->usersId) - 1)];
        $even = ($rand % 2 == 0);
        if (($rand % 2 == 0) && ($id % 2 == 0)) {
            return $this->usersId[mt_rand(0, count($this->usersId) - 1)];
        } else {
            return -1;
        }


    }

    private function getName($faker)
    {
        $rand = mt_rand(1, 1000);
        $id = $this->usersId[mt_rand(0, count($this->usersId) - 1)];
        $even = ($rand % 2 == 0);
        if (($rand % 2 == 0) && ($id % 2 == 0)) {
            return $faker->name;
        } else {
            return null;
        }
    }

    private function addTablesToOrder($order)
    {
        $tables = Table::where('available', true)->get();
        if (null == $tables || count($tables) <= 0) $this->resetTableAvailability();
        $customers = $order->adults + $order->children;

        foreach ($tables as $table) {
            $customers = $customers - $table->chairs;
            $ot = new OrderTable();
            $ot->order_id = $order->id;
            $ot->table_id = $table->id;
            $table->available = false;
            $table->save();
            $ot->save();
            if ($customers <= 0) break;
        }
    }

    private function resetTableAvailability($id = null)
    {
        if (null == $id) {
            DB::table(Table::getTableName())->update(['available' => true]);
        } else {
            DB::table(Table::getTableName())->where('id', $id)->update(['available' => true]);
        }

    }

    private function addMenuItemsToOrder($order)
    {

        $customers = $order->adults + $order->children;
        $items = round($customers * 1.5);
        $products = Menu::all();
//        var_dump(count($products));
//        var_dump($products[0]);
        $prod = [];
        foreach ($products as $product) {
//            var_dump($product->id);
            $prod[] = $product->id;
        }
        for ($i = 1; $i <= $items; $i++) {
            $prodItem = Menu::where('id', mt_rand(0, count($prod) - 1))->first();
            if (null == $prodItem) break;
            (new OrderDetail([
                'order_id' => $order->id,
                'item_id' => $prodItem->id,
                'qty' => mt_rand(1, 3),
                'price' => $prodItem->price,
            ]))->save();
        }

    }

    private function addPaymentsToOrder($order, Carbon $beginDate)
    {
        $pDate = $beginDate;
        $amount = $order->total;
        $pos = (mt_rand(1, 100) % 2 == 0) ? true : false;
        $received = 0;
        $change = 0;
        if (!$pos) {
            if ($amount <= 50) {
                $received = 50;
            } elseif ($amount <= 100) {
                $received = 100;
            } elseif ($amount <= 150) {
                $received = 150;
            } elseif ($amount <= 200) {
                $received = 200;
            } else {
                $received = 500;
            }
            $change = $received - $amount;
        }

        (new OrderPayment([
            'order_id' => $order->id,
            'payment_date' => $pDate->addMinutes(mt_rand(30, 120)),
            'amount' => $amount,
            'received' => $received,
            'change' => $change,
            'pos' => $pos,
        ]))->save();

        $tables = $order->tables->all();
        foreach($tables as $table){
            $this->resetTableAvailability($table->id);
        }

    }

}
