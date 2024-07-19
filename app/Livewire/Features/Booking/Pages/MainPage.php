<?php

namespace App\Livewire\Features\Booking\Pages;

use App\Services\Udh\UdhAvailabilityService;
use App\Services\Udh\UdhBookingService;
use App\Services\Udh\UdhListService;
use App\Traits\ConsumeApiTrait;
use App\Traits\CurlApiTrait;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\Computed;

class MainPage extends Component
{
    use ConsumeApiTrait,CurlApiTrait;

    public $payment_key;
    public $payment_url;
    public $currentStep = 1;
    public $totalStep = 5;
    public $grand_total=0;
    public $baseUrl;

    public $isLoading=false;
    public $list_of_tickets;
    public $date ='';
    public $slot_id = "";

    public $group_id="";

    public $selectCounter=[];

    public $has_insurance=0;

    public $insurance_fee=0;
    public $insurance_total=0;
    public $insurance_terms="";

    public $firstname;
    public $lastname;
    public $email;
    public $phone;
    public $counter=0;

    public $available_numbers =0;

    public $agreeToTerms;

    public $stepList=[
        1 =>'date',
        2=>'tickets',
        3=>'details',
        4=>'summary',
        5=>'success'

    ];

    protected $listeners = ['refreshQueryString'];
    public function mount($step = 'date')
    {
        $this->date = now()->format('Y-m-d');
        $this->payment_key = env('PAYMENT_API_KEY');
        $this->payment_url = env('PAYMENT_URL');

        $this->baseUrl = env('UDH_BOOKING_BASE_URL');
        $this->currentStep = array_search($step, $this->stepList);
        //search session for previous data
        $this->initSession();

    }


    public function render()
    {
        $slots = $this->ticketSlots();
        $groups = $this->ticketGroup();
        $step = $this->returnStepName($this->currentStep);
        $this->getAppSetting();
        $insurance_term = $this->insurance_terms();
        return view('livewire.features.booking.pages.step_'.$step,compact('slots','groups','insurance_term'));
    }

    public function initSession(){
        if (Session::has('form')) {
            $form = Session::get('form');
            $this->date = $form['date'];
            $this->slot_id = $form['slot_id'];
            $this->group_id = $form['group_id'];
        }
        if (Session::has('tickets')) {
            $tickets = Session::get('tickets');
            $this->list_of_tickets = $tickets;
        } else {
            $this->list_of_tickets = collect();
        }

       if (Session::has('available_number')){
        $this->available_numbers = session()->get('available_number');
       }
        if (Session::has('insurance')) {
            $this->has_insurance = session()->get('insurance');
        }
        if (Session::has('selected_tickets')) {
            $t = Session::get('selected_tickets');
          $this->list_of_tickets =   array_replace_recursive($this->list_of_tickets, $t);
        }

        if (Session::has('details')) {
            $form = Session::get('details');
            $this->firstname = $form['firstname'];
            $this->lastname = $form['lastname'];
            $this->phone = $form['phone'];
            $this->email = $form['email'];
        }
    }
    public function updated($property){
        if($property=='has_insurance'){
        }
    }
    public function returnStepName($step)
    {
        return $this->stepList[$step];
    }
    public function saveDataToSession(){
        $form =['date'=>$this->date,'slot_id'=>$this->slot_id,'group_id'=>$this->group_id];

        session()->put('form', $form);
    }
    public function refreshQueryString()
    {
        $this->refreshQueryString = true;
    }

    public function goToStep($step)
    {
        $this->currentStep = $step;
        $this->dispatch('refreshQueryString');
        $mstep = $this->returnStepName($step);
        return redirect()-> route('booking', ['step' => $mstep]);
    }
    public function previousStep(){
       if($this->currentStep>1){
        $this->currentStep--;
        $this->goToStep($this->currentStep);
            $this->initSession();
       }
    }
    public function nextStep()
    {
        if ($this->currentStep < $this->totalStep) {
            switch ($this->currentStep) {
                case 1:
                    $this->submitStep1();
                    # code...
                    break;
                case 2:
                    $this->submitStep2();
                    # code...
                    break;

                default:
                    # code...
                    break;
            }
        }
    }
    protected function checkIfACounterIsSelected()
    {
        $total =0;
        foreach($this->list_of_tickets as $ticket) {
            $n = $ticket['counter'] * $ticket['no_of_people'];
            $total+=$n;
        }
        return $total;
    }
    protected function getTotalAndFee()
    {
        $total = 0;
        $insurance = 0;
        foreach ($this->list_of_tickets as $ticket) {
            if ($ticket['counter'] > 0) {
                $total += $ticket['counter'] * $ticket['price'];
                $n = $ticket['counter'] * $ticket['no_of_people'];
                $insurance += ($this->insurance_fee * $n);
            }
        }
        return ['total'=>$total,'insurance'=>$insurance];
    }

    public function decrement($key){
        if($this->list_of_tickets[$key]['counter'] > 0){
            $this->list_of_tickets[$key]['counter']--;
        }
    }

    public function increment($key){
        $n = $this->checkIfACounterIsSelected();
       if($n < $this->available_numbers){
         $this->list_of_tickets[$key]['counter']++;
       }else{
        $this->dispatch('swal',title:'Info',message:'There are '.$this->available_numbers.' slots available');
       }
    }
    #[Computed]
    public function calculatedInsuranceFee(){
        $v = $this->getTotalAndFee();
        $this->insurance_total = $v['insurance'];
        return   $this->insurance_total;
    }
    #[Computed]
    public function subTotal($key){
        return $this->list_of_tickets[$key]['counter'] * $this->list_of_tickets[$key]['price'];
    }

    #[Computed]
    public function grandTotal()
    {
        $v = $this->getTotalAndFee();
        $total = $v['total'];
        $insurance = $v['insurance'];

       if($this->has_insurance){
            $total += $insurance;

       }
       $this->grand_total = $total;



       return $this->grand_total;
    }
    /**STEP FORM SUBMITION */

    public function submitStep1()
    {
        // Validate the data for Step 1
        $this->validate([
            'date' => 'required',
            'slot_id' => 'required',
            'group_id' => 'required'
            // Add your specific validation rules
            // Add more validation rules for other fields in Step 1 if needed
        ],
        [
            'date.required' => 'Select a date to proceed',
            'slot_id.required' => 'Time slot is required',
            'group_id.required' => 'Ticket type is required',
        ]

    );

        $this->getTicketList();

        // If validation passes, proceed to process or store the data
        // $this->step1Data['field1'] = $this->step1Data['field1']; // Access the field data and store it as needed
        // Store data to be used later or before final submission

        $this->saveDataToSession();
        $selected_group = array_values(array_filter($this->ticketGroup()->toArray(), function ($item)  {
            return $item->id == $this->group_id;
        }));
        $selected_slot = array_values(array_filter($this->ticketSlots()->toArray(), function ($item) {
            return $item->id == $this->slot_id;
        }));

        session()->put('selected_group', $selected_group[0]);
        session()->put('selected_slot', $selected_slot[0]);

        // Move to the next step
        $this->goToStep(2); // Go to Step 2 after successful validation and data handling
    }
    public function submitStep2()
    {
        $total = $this->checkIfACounterIsSelected();
        if ($total > 0) {
            if($total <= $this->available_numbers){
                $arr = array_filter($this->list_of_tickets, function ($item) {
                    return $item['counter'] > 0;
                });
                session()->put('selected_tickets', $arr);
                session()->put('insurance', $this->has_insurance);
                $this->goToStep(3);
                return;
            }
            return $this->dispatch('swal', title: 'Info', message: 'There are only '.$this->available_numbers.' slots available' );

        }
       return $this->dispatch('swal', title: 'Info', message: 'select a number of ticket');
        // $this->dispatch('contentChanged', ['message' => 'Kindly select the number']);
    }
    public function submitStep3(){
       $value = $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'phone'=>'required|numeric|min:10',
            'email'=>'required|email'
            // Add your specific validation rules
            // Add more validation rules for other fields in Step 1 if needed
        ],
        [
                'firstname.required' => 'First name is required',
                'lastname.required' => 'Last name is required',
                'phone.required' => 'Phone number is required',
                'email.required' => 'Email is required',
        ]);

       session()->put('details', $value);
        $this->goToStep(4);
    }
    public function submitStep4(){
        $this->validate([
            'agreeToTerms'=>'required'
        ], [
            'agreeToTerms.required' => 'Agree to terms to proceed'
        ]);
        $form = session()->get('form');
        $items = session()->get('selected_tickets');
        $details = session()->get('details');
        $insurance = session()->get('insurance');
        $slots = session()->get('selected_slot');
        //  dd($slots->slot_name);

        $data = [
            'slot_id'=>$form['slot_id'],
            'date'=>$form['date'],
            'group_id'=>$form['group_id'],
            'items'=>$items,
            'has_insurance'=>$insurance,
            'firstname'=>$details['firstname'],
            'lastname'=>$details['lastname'],
            'payment_method'=>'web',
            'phone'=>$details['phone'],
            'email'=>$details['email'],
            'slot_name' => $slots->slot_name,
        ];


        //submit to api
        // $feedback = $this->makeRequestTwo($this->baseUrl, 'POST', '/api/udh/udh-web-booking', [], $data);
         $feedback =  appService(UdhBookingService::class)->saveBooking($data);

        if ($feedback['status']) {
            $booking = $feedback['data'];
            $total = $booking->grand_total*100;
            $ref_no = $booking->booking_ref;
            $email = $data['email'];
            $notify_url = route('payment.notification',['ref'=> $ref_no]);
            //CALL PAYSTACK PAYMENT GATEWAY
            // $transaction = $this->makeRequestTwo($this->payment_url, 'POST', 'api/udh/udh-web-booking', [], $data);
            $this->goToStep(5);
            $transaction = CurlApiTrait::callCurlApi($this->payment_url,'POST',$total, $email, $notify_url, $this->payment_key, $ref_no);

             if (!$transaction) {
                $this->goToStep(5);
               return  $this->dispatch('swal', title: 'Failed', message: 'transaction failed');
            }

            if ($transaction['status'] == true) {
                return redirect($transaction['data']['authorization_url']);
            }else{
                return redirect()->route('home');
            }
        }
        else{
            return $this->dispatch('swal', title: 'Error', message: $feedback['msg']);
        }
    }

    /** API CAlls */
    public function ticketSlots()
    {
        $feedback = appService(UdhListService::class)->listTicketSlot();
        if ($feedback['status']) {
            return $feedback['data'];
        }
        return [];
    }
    public function ticketGroup()
    {
          $feedback = appService(UdhListService::class)->listTicketGroup();
        if($feedback['status']){
            return $feedback['data'];
        }
        return [];
    }
    public function getTicketList()
    {
        $this->isLoading = true;
       $form =  ['date'=>$this->date,'slot_id'=>$this->slot_id,'group_id'=>$this->group_id];
        $feedback = appService(UdhAvailabilityService::class)->checkSlotAvailability($form);
        if($feedback['status']){
            $r = $feedback['data'];
            $tickets = $r['tickets'];
            $available_numbers = $r['available_number'];
            $this->list_of_tickets = [];
            foreach ($tickets as $ticket) {
                $l = ['id' => $ticket->id, 'title' => $ticket->category_name, 'price' => $ticket->web_price, 'counter' => 0, 'no_of_people' => $ticket->no_of_person];
                $this->list_of_tickets[] = $l;
            }
            session()->put('tickets', $this->list_of_tickets);
            session()->put('available_number', $available_numbers);
        }
        return [];
    }
    public function getAppSetting(){
          $fee = getAppSetting('insurance_fee');
            $this->insurance_fee=$fee;
    }
    public function insurance_terms(){
        return  getAppSetting('insurance_fee_term');
    }
}
