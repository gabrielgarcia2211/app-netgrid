<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\Log;

class MediosTest extends DuskTestCase
{

    private $email = "garciaquinteroga@gmail.com";
    private $password = "123456789";
    private $site = "http://127.0.0.1:8000/";

    /**
     * A Dusk test example.
     * @group test 
     * @return void
     */
    public function testExample()
    {
        self::set_favorite();
    }

    private function set_favorite()
    {
        try {
            $this->browse(function (Browser $browser) {

                $browser->visit($this->site)
                    ->waitForText('NETGRID')
                    ->type('email', $this->email)
                    ->type('password', $this->password)
                    ->press('Acceder');

                $browser->pause(3000);

                $num = rand(1, 1000);

                #carga de datos
                $browser->type('filter-text-box', "$num");
                $browser->pause(1000);


                $inputs = $browser->elements('.ag-cell-value');

                foreach ($inputs as $key => $input) {
                    Log::debug($key);
                    if ($key == 0) {
                        $input->click();
                        $browser->pause(10000);
                        break;
                    }
                }

            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
