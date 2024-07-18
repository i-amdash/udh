<?php

namespace App\Services\Udh;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;


class UdhListService extends BaseService
{
    public function listTicketGroup(){
       $data= DB::table('udh_ticket_groups')->where('is_active',1)->get();
        return $this->success('ticket_group', $data);
    }
    public function listTicketCategory()
    {
       $data =  DB::table('udh_ticket_categories')->where('is_active', 1)->get();
        return $this->success('ticket_categories', $data);
    }
    public function listTicketSlot()
    {
       $data =  DB::table('udh_ticket_slots')->where('is_active', 1)->get();
        return $this->success('ticket_categories', $data);
    }
}
