<?php

namespace App\Livewire;

use App\Traits\ConsumeApiTrait;
use Livewire\Component;
use App\Livewire\BaseComponent;
use illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Paystack;

class Book extends BaseComponent
{
    use ConsumeApiTrait;
    public $currentPage = 1;
    public $count = 0;

    public $baseUrl="";

    // form properties
    #[Rule('required')]
    // public $slotType;

    // public $ticketType;


    public $pages = [
        1 => [
            'heading' => 'Ticket Type',
            'subheading' => ' Ticket Groups',
        ],
        2 => [
            'heading' => 'Slot Type',
            'subheading' => ' Different Slot options',
        ],
        3 => [
            'heading' => 'Slot Date',
            'subheading' => ' Date and Day',
        ],
        4 => [
            'heading' => 'Number of uu',
            'subheading' => ' Counts and Summary',
        ],
        5 => [
            'heading' => 'Number of uu',
            'subheading' => ' Counts and Summary',
        ],
    ];
    private $steps = [
        '/step-one',
        '/step-two',
        'step-three',
        'step-four'
    ];


        #[Rule('required')]
        public $price = 1000;

        #[Rule('required')]
        public $no_of_people = 1;

    #[Rule('required|min:6')]
    public $firstname = 'mimi';

    #[Rule('required|min:6')]
    public $lastname = 'okon';


    #[Rule('required|email')]
    public $email ='mimi@gmail.com';


    #[Rule('required|min:11')]
    public $phonenumber = '08154545454';
    // public $availableArray =[];

    #[Rule( 'required|email|same:email')]
    public $confirmEmail;

    #[Rule('required|')]
    public $payment_method = 'web';

    #[Rule('required')]
    public $has_insurance = 0;


    #[Rule('required')]
    public $check;

    #[Rule('required')]
    public $group_id = 1;

    #[Rule('required')]
    public $category_id = 1;

    #[Rule('required')]
    public $date = "2023-10-30";

    #[Rule('required')]
    public $slot_id = 1;

    #[Rule('required')]
    public $slot_time;

    public $category_name;
    public $groups = [];
    public $selectedGroupId;
    public $availableArray;

    protected $rules = [
        // 'name' => 'required|min:6',
        // 'email' => 'required|email',
        // 'confirmEmail' => 'required|email',
        // 'check' => 'required',
        // 'number' => 'required|min:11',
        'group_id' => 'required',
        'category_id' => 'required',
        'date' => 'required|date',
    ];

    #[Rule('required')]
    public $title = '';


    #[Rule('required')]
    public $content = '';

    public $id = '';
    // public $title = '';
    // public $lastname = '';

    public function mount()
    {
        $this->baseUrl = env('UDH_BOOKING_BASE_URL');



        // Set the initial value of $date to today's date
        $this->date = now()->format('Y-m-d');

         $this->ticketGroup();
         $this->ticketCategories();
          $this->ticketSlots();
          $this->ticketAvailable();
          $this->ticketSubCategories();



        if(session()->has('dataStore')) {
            $formData = session('dataStore');

    }
}
    public function goToNextPage()
    {
        // $this->validate();
        $this->currentPage++;
        //  $this->updateRoute();
    }
    public function goToPreviousPage()
    {
        $this->currentPage--;
        // $this->updateRoute();
    }
    private function updateRoute()
    {
        if (isset($this->stepRoutes[$this->currentPage - 1])) {
            Route::redirect($this->stepRoutes[$this->currentPage - 1]);
        }
    }
    // public function sendAndNextStep()
    // {
    //     if ($this->currentPage == 1) {
    //         // $this->validat?e();
    //         $this->ticketAvailable();
    //         return '<div>{{currentPage}}</div>';
    //     } elseif ($this->currentPage == 2) {
    //         // $this->validat?e();
    //         $this->ticketAvailable();
    //         return '<div>{{currentPage}}</div>';
    //     } elseif($this->currentPage == 3) {
    //         $this->validate();
    //     } elseif($this->currentPage == 4) {
    //         $this->validate();
    //     } else ('congrates');

    //     $this->goToNextPage();
    // }
    public function ticketGroup()
    {
        $feedback = $this->makeRequestTwo($this->baseUrl,'GET','api/udh/ticket-group');

        if($feedback->success){
            $posts = $feedback->data;
            return $posts;
        }

     return [];
        // $response = Http::get("https://staging.landmarkbeach.ng/api/udh/ticket-group");
        // $result = $response->getBody()->getContents();
        // $data = json_decode($result);
        // $posts = $data->data;
        // return $posts;
        // dd($posts);
    }

    public function ticketCategories()
    {
        $feedback = $this->makeRequestTwo($this->baseUrl, 'GET', 'api/udh/ticket-categories');

        if ($feedback->success) {
            $posts = $feedback->data;
            return $posts;
        }
        return [];
        //  dd($posts);
    }
    public function ticketSlots()
    {
        $feedback = $this->makeRequestTwo($this->baseUrl, 'GET', 'api/udh/ticket-slots');

        if ($feedback->success) {
            $posts = $feedback->data;
            return $posts;
        }
        return [];
        //  dd($posts);
    }
    public function updated($property)
    {
        if ($property === 'firstname') {
            $response = Http::post(
                "https://staging.landmarkbeach.ng/api/udh/udh-web-booking",
                [
                    'firstname' => $this->firstname
                ]
            );
            // dd($response);
            $result = $response->getBody()->getContents();
            $data = json_decode($result);
            //   $posts = $data->data;
            return $data;
        }
        if ($property === 'lastname') {
            $response = Http::post(
                "https://staging.landmarkbeach.ng/api/udh/udh-web-booking",
                [
                    'lastname' => $this->lastname
                ]
            );
            // dd($response);
            $result = $response->getBody()->getContents();
            $data = json_decode($result);
            //   $posts = $data->data;
            return $data;
        }

        if ($property === 'email') {
            $response = Http::post(
                "https://staging.landmarkbeach.ng/api/udh/udh-web-booking",
                [
                    'email' => $this->email
                ]
            );
            // dd($response);
            $result = $response->getBody()->getContents();
            $data = json_decode($result);
            //   $posts = $data->data;
            return $data;
        }
        if ($property === 'phonenumber') {
            $response = Http::post(
                "https://staging.landmarkbeach.ng/api/udh/udh-web-booking",
                [
                    'phonenumber' => $this->phonenumber
                ]
            );
            // dd($response);
            $result = $response->getBody()->getContents();
            $data = json_decode($result);
            //   $posts = $data->data;
            return $data;
        }
        if ($property === 'has_insurance') {
            $response = Http::post(
                "https://staging.landmarkbeach.ng/api/udh/udh-web-booking",
                [
                    'has_insurance' => $this->has_insurance
                ]
            );
            // dd($response);
            $result = $response->getBody()->getContents();
            $data = json_decode($result);
            //   $posts = $data->data;
            return $data;
        }
        if ($property === 'payment_method') {
            $response = Http::post(
                "https://staging.landmarkbeach.ng/api/udh/udh-web-booking",
                [
                    'payment_method' => $this->payment_method
                ]
            );
            // dd($response);
            $result = $response->getBody()->getContents();
            $data = json_decode($result);
            //   $posts = $data->data;
            return $data;
        }

        // $this->debounce('updateApi', function () {
        $response = Http::post(
            "https://staging.landmarkbeach.ng/api/udh/availability-check",
            [
                'group_id' => $this->group_id,
                'category_id' => $this->category_id,
                'slot_id' => $this->slot_id,
                'date' => $this->date,
            ]
        );
        // dd($response);
        $result = $response->getBody()->getContents();
        $data = json_decode($result);
        // dd($data);
          $posts = $data->data;
        return $posts;
        //  dd($data);
        // }, 1000);

    }
    public function ticketAvailable()
    {
        // $availableArray = [];
        $response = Http::post(
            "https://staging.landmarkbeach.ng/api/udh/availability-check",
            [
                'group_id' => $this->group_id,
                'category_id' => $this->category_id,
                'slot_id' => $this->slot_id,
                'date' => $this->date,
            ]
        );
        //  dd($response);
        $result = $response->getBody()->getContents();
        // dd($result);
        $data = json_decode($result);
        //  dd($data);
          $posts = $data->data;
          $n=[];
          foreach ($posts->tickets as $post) {

                $n = [
                    'id' => $post->id,
                    'title' => $post->category_name,
                    'price' => $post->web_price,
                    'counter'=> 0,
                    'no_of_people' => $post->no_of_person,
                ];
                $this->availableArray[] =$n;
    }
    //   dd($this->availableArray);
    // dd($posts);
   return $this->availableArray;
  //  dd($data);
}
public function increment($index)
{
    if(isset($this->availableArray[$index])) {
        $this->availableArray[$index]['counter']++;
    }


}

    public function decrement($index)
    {
        if(isset($this->availableArray[$index])) {
            $this->availableArray[$index]['counter']--;

            if($this->availableArray[$index]['counter'] < 0) {
                $this->availableArray[$index]['counter'] = 0;
            }
        }
    }
    public function udhBooking()
    {
        // $availableArray = request->input('availableArray');
        // $counterGreaterThanZero = collect($this->availableArray)->pluck('count')->first();

        foreach($this->availableArray as $index => $item) {
            if($item['counter'] > 0) {
                $udhData = [
                    'firstname' => $this->firstname,
                    'lastname' => $this->lastname,
                    'email' => $this->email,
                    'phone' => $this->phonenumber,
                    'slot_id' => $this->slot_id,
                    'group_id' => $this->group_id,
                    'category_id' => $this->category_id,
                    'date' => $this->date,
                    'payment_method' => $this->payment_method,
                    'has_insurance' =>$this->has_insurance,
                    "items"=> $this->availableArray,
                ];

                $response = Http::post( "https://staging.landmarkbeach.ng/api/udh/udh-web-booking", $udhData );
                // dd($response);
                $result = $response->getBody()->getContents();
                $data = json_decode($result);
                  //  dd($data);
                //    $posts = $data->data;
                return $data;
            }
        }

        $this->currentPage++;

        //  if ($counterGreaterThanZero > 0) {
        // }else {
        //     dd('nne, this must be greater than one now');
        // return response()->json(['error' => 'The counter must be greater than zero (0)'], 422);
        // }

    }

    public function ticketSubCategories()
    {
        $response = Http::get("https://staging.landmarkbeach.ng/api/udh/ticket-sub-categories");
        $result = $response->getBody()->getContents();
        $data = json_decode($result);
        //   $posts = $data->data;
        return $data;
        //  dd($posts);
    }
     /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
    public function render()
    {


        return view(
            'livewire.book',
            [

                // 'back'=>$this->goToPreviousPage(),
                'posts' => $this->ticketGroup(),
                'categories' => $this->ticketCategories(),
                'slots' => $this->ticketSlots(),
                'availables' => $this->ticketAvailable(),
                'subcategories' => $this->ticketSubCategories(),
                // 'udhBooking'=>$this->udhBooking(),

            ]
        );
        // return view('livewire.book', [
        //     'data'=> collect($this->posts)->map(function ($posts) {})
        // ]);
    }
}
