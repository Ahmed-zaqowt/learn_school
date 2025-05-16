<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SectionController extends Controller
{
     function index()  {
        return view('dashboard.sections.index');
     }

     function getdata(Request $request)
    {
        $grades = Section::query();
        return DataTables::of($grades)
            ->addIndexColumn()
            ->addColumn('name', function ($qur) {


                return 'الشعبة ' . ' ' . $qur->name;

            })
            ->addColumn('action', function ($qur) {
                if($qur->status == 'active'){
                    return ' <div data-bs-toggle="modal" data-grade-id="'. $qur->id .'" data-grade="'.  $qur->tag  .'" data-bs-target="#sectionModal" class="d-flex align-items-center gap-3 fs-6 btn-add-section">
                    <a href="javascript:;" class="text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" ><i class="fadeIn animated bx bx-message-square-add"></i></a>
                  </div>';
                }

                return '-' ;

            })
            ->addColumn('status', function ($qur) {
                        if($qur->status == 'active'){
                            return 'مفعل' ;
                        }
                        return 'غير مفعل' ;
            })
            ->make(true);
    }

    function add(Request $request) {
           //dd($request->all());

           $newcount = (int)$request->count_section ;
           $currentCount = Section::count();
           if($newcount > $currentCount){
           // dd($newcount  - $currentCount);
               for($i = $currentCount + 1 ; $i <= $newcount ; $i++){
                     Section::create([
                        'name' => $i ,
                        'status' => 'active' ,
                     ]);
               }


               $sectionInAcive = Section::query()->where('status' , 'inactive')->get();
               foreach($sectionInAcive as $s){
                  $s->update([
                    'status' => 'active' ,
                  ]);
               }
           }elseif($newcount < $currentCount){
              $limit = $currentCount - $newcount ;
              $lastSections = Section::query()->orderBy('id' , 'desc')->limit($limit)->get();
              // dd($lastSections);

              foreach($lastSections as $l){
                 $l->update([
                    'status' => 'inactive' ,
                 ]);
              }
           }elseif($newcount == $currentCount){
            $sectionInAcive = Section::query()->where('status' , 'inactive')->get();
               foreach($sectionInAcive as $e){
                  $e->update([
                    'status' => 'active' ,
                  ]);
               }
           }



           return response()->json([
            'success' => 'تمت العملية بنجاح'
        ]);
    }


}
