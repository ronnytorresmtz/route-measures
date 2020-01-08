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
                    ->route($origin, $destination, $token),
            ];
        
        }

### Parameters:

->route($origin, $destination, $token)

        $origin: pair of geo-coordinates (longitude, latitude)

        $origin: pair of geo-coordinates (longitude, latitude)

        $token: access token from your Mapbox Account


### Aditional comments

- Show distance and duration of the route as IndexField and DetailField



Any suggestion is welcome


