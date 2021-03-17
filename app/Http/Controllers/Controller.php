<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use UniFi_API\Client as Unifi_Client;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    public function index()
    {
     
        $rules = array('Foo' => 'Bar');

        /**
         * initialize the Unifi API connection class, log in to the controller and request the alarms collection
         * (this example assumes you have already assigned the correct values to the variables used)
         */
        $unifi_connection = new Unifi_Client($_ENV["UNIFI_USER"], $_ENV["UNIFI_PASS"], $_ENV["UNIFI_URL"], $_ENV["UNIFI_SITE"], $_ENV["UNIFI_VERSION"], false);
        $login            = $unifi_connection->login();
        $results          = $unifi_connection->list_firewallrules(); // returns a PHP array containing alarm objects

        return response()->json($results);

    }

    public function listfirewallrules()
    {
        /**
         * initialize the Unifi API connection class, log in to the controller and request the alarms collection
         * (this example assumes you have already assigned the correct values to the variables used)
         */
        $unifi_connection = new Unifi_Client($_ENV["UNIFI_USER"], $_ENV["UNIFI_PASS"], $_ENV["UNIFI_URL"], $_ENV["UNIFI_SITE"], $_ENV["UNIFI_VERSION"], false);
        $login            = $unifi_connection->login();
        $results          = $unifi_connection->list_firewallrules(); // returns a PHP array containing alarm objects

        return response()->json($results);

    }
    
    public function showfirewallrule($id)
    {
        /**
         * initialize the Unifi API connection class, log in to the controller and request the alarms collection
         * (this example assumes you have already assigned the correct values to the variables used)
         */
        $unifi_connection = new Unifi_Client($_ENV["UNIFI_USER"], $_ENV["UNIFI_PASS"], $_ENV["UNIFI_URL"], $_ENV["UNIFI_SITE"], $_ENV["UNIFI_VERSION"], false);
        $login            = $unifi_connection->login();
        //$results          = $unifi_connection->fetch_results('/api/s/' . $this->site . '/rest/firewallrule');
        $results          = $unifi_connection->custom_api_request('/api/s/' . $_ENV["UNIFI_SITE"] . '/rest/firewallrule/' . $id, 'GET');

        return response()->json($results);

    }

    public function updatefirewallrule(Request $request, $id)
    {
        $payload = array('enabled' => ($request->json()->get('enabled')));

        $unifi_connection = new Unifi_Client($_ENV["UNIFI_USER"], $_ENV["UNIFI_PASS"], $_ENV["UNIFI_URL"], $_ENV["UNIFI_SITE"], $_ENV["UNIFI_VERSION"], false);
        $login            = $unifi_connection->login();
        $results          = $unifi_connection->custom_api_request('/api/s/' . $_ENV["UNIFI_SITE"] . '/rest/firewallrule/' . $id, 'PUT', $payload);

        return response()->json($results);

    }

}
