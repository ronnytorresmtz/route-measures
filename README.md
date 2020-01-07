# Laravel Nova Field - Route Measures

### Calculate the distance and duration of a route using the Mapbox Directory Api

## How to Use


        public function fields(Request $request)
        {

            $token = env('MAPBOX_ACCESS_TOKEN');
                    
            return [
                
                RouteMeasures::make('Measures')
                    ->route('100, 28', '100, 26', $token),
            ];
        
        }

