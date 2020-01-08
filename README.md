# Laravel Nova Field - Route Measures

- Calculate the distance and duration of a route using the Mapbox Directory API

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

### Parameters

->route($origin, $destination, $token)

        $origin: pair of geo-coordinates (longitude, latitude)

        $origin: pair of geo-coordinates (longitude, latitude)

        $token: access token from your Mapbox Account

### Create Mapbox Access Token and make the Laravel Configuration

- Create an Mapbox Account
- Create a public/permanent access token for your app
- Add a "MAPBOX_ACCESS_TOKEN" key in your laravel .env file and set your Access Token


### Additional Comments

- Show distance and duration of the route as IndexField and DetailField
- Mapbox has a free tier visit [Mapbox Site](https://www.mapbox.com/)


### References
- Read the [Mapbox Direction API](https://docs.mapbox.com/api/navigation/) documentation.
- Read the [Mapbox Access Token](https://docs.mapbox.com/help/tutorials/get-started-tokens-api/) documentation.





Any suggestion is welcome


