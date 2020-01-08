# Laravel Nova Field - Route Measures

- Calculate the distance and duration of a route using the Mapbox Directory Api

## How to install

        npm install ronnytorresmtz/routemeasures


## How to Use


        public function fields(Request $request)
        {

            $token = env('MAPBOX_ACCESS_TOKEN');
            $origin = '100, 28';
            $destination = '100, 26'
                    
            return [
                
                RouteMeasures::make('Measures')
                    ->route($origin,  $destination, $token),
            ];
        
        }

### Parameters:

->route($origin, $destination, $token)

        $origin: pair of geo-coordinates (longitude, latitude)

        $origin: pair of geo-coordinates (longitude, latitude)

        $token: token access from your Mapbox Account


