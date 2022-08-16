<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\TransLink;
use App\ListOfTable;

class SystemFunctionController extends Controller
{
    //
    public function StoreTransLink($TransId,$DocTransName,$ParentId='0')
    {   
        $docId = '';
        $Doc = ListOfTable::where('doc_name',$DocTransName)->get();

        foreach($Doc as $docs){

            $docId = $docs->id;
        }

        $translink = new TransLink;
        $translink->TransId=$TransId;
        $translink->DocId=$docId;
        $translink->ParentId=$ParentId;
        $translink->save();
    }

    public function UpdateTransLink($TransId,$DocTransName,$ParentId='0')
    {
        $docId = '';
        $Doc = ListOfTable::where('doc_name',$DocTransName)->get();

        foreach($Doc as $docs){

            $docId = $docs->id;
        }

        $translinksId='';
        $translinks = TransLink::where('TransId',$TransId)
                        ->where('DocId',$docId)->get();
        foreach($translinks as $translink){
            $translinksId=$translink->id;
        }

        if (TransLink::where('id', '=', $translinksId)->count() > 0) {
            $translink = TransLink::find($translinksId);
            $translink->TransId=$TransId;
            $translink->DocId=$docId;
            $translink->ParentId=$ParentId;
            // $translink->updated_at = date("Y-m-d h:i");
            $translink->save();
        }

        


        // foreach($Doc as $docs){

        //     $docId = $docs->id;
        // }


    }
}
