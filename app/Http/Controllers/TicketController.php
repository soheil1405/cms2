<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Jobs\SendEmailJob;
use App\Mail\TicketAnswerEmail;
use App\Models\Ticket;
use Exception;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Mail;
use PDO;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('status', 'open')
            ->whereNull('answered_to')->orderByDesc('id')
            ->get();


            // $notSeenTickets = Ticket::where("answered_to" , null)->where("has_New_Ticket_In_This_Thread_from_user" , ">" , 0)->get();
        
            // foreach ($notSeenTickets as $ticket) {
              
            //     // dd($ticket->vendor);
             
            //     foreach ($ticket->answers as $answer) {
            //             $answer->delete();
            //         }
            //         $ticket->delete();
             
          
            //     }

         return view('admin.tickets.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::find($id);

        $answers = $ticket->answers;

        $ticket->update([

            'seen_at' => Carbon::now(),
            'has_New_Ticket_In_This_Thread_from_user'=>0
        ]);


        if (!is_null($answers)) {




            foreach ($answers as $item) {

                if ($item->username != "admin") {

                    $item->update([
                        'seen_at' => Carbon::now(),                  
                    ]);
                }

            }

        }


        

        //  dd($answers);
        return view('admin.tickets.show', compact('ticket', 'answers'));
    }





    public function create()
    {
        return view('user.tickets.create');
    }









    public function answer(Request $request)
    {

        $request->validate([
            'id' => 'required',
            'massage' => 'required',
        ]);

        $ticket = Ticket::find($request->id);


    
        $ticket->update([ 
            'has_New_Ticket_In_This_Thread_from_admin'=>1 ,
            'has_New_Ticket_In_This_Thread_from_user'=>0
        ]);


        

        $answer = Ticket::create([
            'username' => 'admin',
            'answered_to' => $request->id,
            'subject' => $ticket->subject,
            'massage' => $request->massage,
            'email' => 'instabargh@gmail.com',

        ]);

        if ($ticket->username == 'guest') {
            $details = [
                'email' => $ticket->email,
                'username' => 'guest',
                'massage' => $request->massage,
                'ticketSubject' => $ticket->subject,
                'ticketMassage' => $ticket->massage,
            ];



            dispatch(new SendEmailJob($details));


        } else {
            $vendor = Vendor::find($ticket->username);

            if ($vendor->socialMedias && $vendor->socialMedias->email) {

                $email = $vendor->socialMedias->email;

                $details = [
                    'email' => $email,
                    'username' => $vendor->title,
                ];

                dispatch(new SendEmailJob($details));
            }
        }

        return redirect()->back();
    }

    public function save(Request $request)
    {

        
        if (is_null(Auth::user())) {
            $request->validate([
                'username' => 'required',
                'subject' => 'required',
                'ticketEmail' => 'required',
                'ticketText' => 'required',
                'captcha' => ['required','Captcha'],
            ]);



        } else {
            $request->validate([
                'username' => 'required',
                'subject' => 'required',
                // 'ticketEmail' => 'required',
                'ticketText' => 'required',
                'captcha' => ['required','Captcha'],
            ]);




        }

        $ticket = Ticket::create([
            'username' => $request->username,
            'email' => $request->ticketEmail ? $request->ticketEmail : null,
            'massage' => $request->ticketText,
            'subject' => $request->subject,
            'number' => $request->number,

            'has_New_Ticket_In_This_Thread_from_user'=>1
        ]);


        return response()->json($ticket, 200);

    }



    public function save2(Request $request)
    {






        if (is_null(Auth::user())) {
            $request->validate([
                'username' => 'required',
                'subject' => 'required',
                'email' => 'required',
                'text' => 'required',
                'captcha' => 'required|captcha',
            ]);

        } else {
            $request->validate([
                'username' => 'required',
                'subject' => 'required',
                'ticketEmail' => 'required',
                // 'text' => 'required',
            ]);

        }




        $ticket = Ticket::create([
            'username' => $request->username,
            'email' => $request->email ? $request->email : null,
            'massage' => $request->ticketEmail,
            'subject' => $request->subject,
            'has_New_Ticket_In_This_Thread_from_user'=>1 ,
            'has_New_Ticket_In_This_Thread_from_admin'=>0,
            'number' => $request->number,
        ]);



        session()->flash('success' , 'تیکت مورد نظر ارسال شد و پس از بررسی توسظ کارشناسان پاسخ تیکت شما داده خواهد شد');


        alert()->success('تیکت مورد نظر ارسال شد', 'باتشکر');
        return redirect()->back();
    }

    public function userIndex()
    {
        $Tickets = Auth::user()->vendor->Tickets;

        return view('user.tickets.index', compact('Tickets'));
    }

    public function Usershow($id)
    {
        $ticket = Ticket::find($id);
        $answers = $ticket->answers;
        $ticket->update([
            
            'has_New_Ticket_In_This_Thread_from_user'=>1 ,
            'has_New_Ticket_In_This_Thread_from_admin'=>0,
        ]);



        
        foreach ($answers as $t) {
            
        $t->update([
            
            'has_New_Ticket_In_This_Thread_from_user'=>1 ,
            'has_New_Ticket_In_This_Thread_from_admin'=>0,
        ]);
        }

        // dd($answers);
        return view('user.tickets.show', compact('ticket', 'answers'));
    }

    public function UserAnswer(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'id' => 'required',
            'massage' => 'required',

        ]);



        $ticketThread = Ticket::find($request->id);





        if ($ticketThread->username == $request->username) {

            $ticketThread->update([
                'has_New_Ticket_In_This_Thread_from_admin'=>0
            ]);

            $ticket = Ticket::create([
                'username' => $request->username,
                'email' => $ticketThread->email,
                'massage' => $request->massage,
                'subject' => $ticketThread->subject,
                'answered_to' => $ticketThread->id ,
                'has_New_Ticket_In_This_Thread_from_admin'=>0,           
            'has_New_Ticket_In_This_Thread_from_user'=>1
            ]);

            return response()->json($ticket, 200);
        } else {
            return response()->json('username is not correct', 401);
        }

    }


    public function UserCloseTicket(Request $request)
    {



        $request->validate([

            'id' => 'required'

        ]);

        $ticket = Ticket::find($request->id);

        $ticket->update([
            'has_New_Ticket_In_This_Thread_from_admin'=>0,
            'has_New_Ticket_In_This_Thread_from_user'=>0,
            'status' => '1'

        ]);

        return redirect()->route('user.tickets.userIndex');


    }
    public function deleteByGroup(Request $request) {

        $request->validate([
            'TicketIDs' => 'required'
        ]);

        DB::beginTransaction();

        $ids =   explode("," ,$request->TicketIDs);

        try {
            foreach ($ids  as $id) {
                $ticket = Ticket::find($id);                
                if (is_null($ticket)) {
                    DB::rollBack();        
                    session()->flash('fail' , 'تیکت مورد نظر یافت نشد');
                    return redirect()->back();         
                }
                foreach ($ticket->answers as $answer ) {
                    $answer->delete();
                }
                $ticket->delete();
            }

            DB::commit();
            session()->flash('success' , 'تیکت های مورد نظر با موفقیت حذف شدند'); 
            return redirect()->back();         
        } catch (\Throwable $ex) {
            DB::rollBack();
        
            session()->flash('fail' , 'خطا در حذف تیکت ها');
            return redirect()->back();         
        }
    }
}