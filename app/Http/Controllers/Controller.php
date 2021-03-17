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
    
    public function showfirewallrule(Request $request, $id)
    {
        $method = 'GET';

        $unifi_connection = new Unifi_Client($_ENV["UNIFI_USER"], $_ENV["UNIFI_PASS"], $_ENV["UNIFI_URL"], $_ENV["UNIFI_SITE"], $_ENV["UNIFI_VERSION"], false);
        $login            = $unifi_connection->login();

        // we are going to use this as a shortcut to update
        if($request -> get('enabled'))
        {
            $method = 'PUT';
            $payload = array('enabled' => ($request->get('enabled')));
            $results          = $unifi_connection->custom_api_request('/api/s/' . $_ENV["UNIFI_SITE"] . '/rest/firewallrule/' . $id, $method, $payload);
        }
        else
        {
            $results          = $unifi_connection->custom_api_request('/api/s/' . $_ENV["UNIFI_SITE"] . '/rest/firewallrule/' . $id, $method);
        }

        return response()->json($results);

    }

    public function updatefirewallrule(Request $request, $id)
    {
        $payload = array('enabled' => ($request->json()->get('enabled')));
        $method = 'PUT';

        $unifi_connection = new Unifi_Client($_ENV["UNIFI_USER"], $_ENV["UNIFI_PASS"], $_ENV["UNIFI_URL"], $_ENV["UNIFI_SITE"], $_ENV["UNIFI_VERSION"], false);
        $login            = $unifi_connection->login();
        $results          = $unifi_connection->custom_api_request('/api/s/' . $_ENV["UNIFI_SITE"] . '/rest/firewallrule/' . $id, $method, $payload);

        return response()->json($results);

    }

}
