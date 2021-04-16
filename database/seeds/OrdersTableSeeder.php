<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

use App\Data\Models\User;
use App\Data\Models\Menu;
use App\Data\Models\Table;
use App\Data\Models\Order;
use App\Data\Models\OrderDetail;
use App\Data\Models\OrderTable;


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

}
