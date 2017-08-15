<?php
namespace App\Routing\Filter;

use Cake\Event\Event;
use Cake\Routing\DispatcherFilter;

class RESTFilter extends DispatcherFilter
{
    public function beforeDispatch(Event $event)
    {

        $request = $event->data['request'];
        $response = $event->data['response'];

        $origin = $request->header('Origin');
        if (!empty($origin))
        {
            $response->header('Access-Control-Allow-Origin', $origin);
            $response->header('Access-Control-Allow-Credentials', 'true');
        }

        if ($request->method() == 'OPTIONS')
        {
            $method = $request->header('Access-Control-Request-Method');
            $headers = $request->header('Access-Control-Request-Headers');
            $response->header('Access-Control-Allow-Headers', $headers);
            $response->header('Access-Control-Allow-Methods', empty($method) ? 'GET, POST, PUT, DELETE, OPTIONS, HEADER' : $method);
            $response->header('Access-Control-Allow-Credentials', 'true');
            $response->header('Access-Control-Max-Age', '10');
            $response->send();
            die;
        }
    }
}